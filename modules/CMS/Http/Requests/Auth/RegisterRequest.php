<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use MojarCMS\Backend\Events\RegisterSuccessful;
use MojarCMS\CMS\Models\User;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => [
                'bail',
                'required',
                'min:5',
            ],
            'email' => [
                'bail',
                'required',
                'email',
                'max:150',
                Rule::modelUnique(User::class, 'email')
            ],
            'password' => [
                'bail',
                'required',
                'min:6',
                'max:32',
                'confirmed'
            ],
            'is_vendor' => [
                'boolean'
            ],
            'is_customer' => [
                'boolean'
            ],
            'shop_name' => [
                'nullable',
                'string',
                'min:5',
            ],
            'business_phone' => [
                'nullable',
                'string',
                'min:5',
            ],
            'business_address' => [
                'nullable',
                'string',
                'min:5',
            ]
        ];

        if (get_config('captcha')) {
            $rules['g-recaptcha-response'] = 'bail|required|recaptcha';
        }

        return $rules;
    }

    public function createUserFromRequest(): User
    {
        do_action('register.handle', $this);
        $password = $this->post('password');

        DB::beginTransaction();
        try {
            $user = new User();

            $user->fill($this->safe()->only(['name', 'email']));

            $user->setAttribute('password', Hash::make($password));

            $user->save();

            if ($this->post('is_vendor')) {
                $metaData = [
                    'user_type' => 'vendor',
                    'user_status' => 'under_review',
                    'shop_name' => $this->post('shop_name'),
                    'business_phone' => $this->post('business_phone'),
                    'business_address' => $this->post('business_address')
                ];
                foreach ($metaData as $key => $value) {
                    $user->setMeta($key, $value);
                }
                
                // Send vendor registration notification email
                $this->sendVendorRegistrationEmail($user);
            }

            if ($this->post('is_customer')) {
                $metaData = [
                    'user_type' => 'customer',
                ];
                foreach ($metaData as $key => $value) {
                    $user->setMeta($key, $value);
                }
            }

            // Set default role based on user type
            if ($this->post('is_vendor')) {
                $user->syncRoles('customer'); // Start with customer role until approved
            } else {
                $user->syncRoles('customer');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        event(new RegisterSuccessful($user));

        do_action('register.success', $user);

        return $user;
    }

    /**
     * Send vendor registration notification email
     *
     * @param User $user
     * @return void
     */
    private function sendVendorRegistrationEmail(User $user): void
    {
        try {
            $emailData = [
                'user' => $user,
                'shop_name' => $user->getMeta('shop_name'),
            ];
            
            $body = view('ecomm::emails.vendor.registration', $emailData)->render();
            
            Mail::send('cms::backend.email.layouts.default', [
                'body' => $body
            ], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject("Vendor Registration Received");
            });
        } catch (\Exception $e) {
            // Log error but don't break the flow
            Log::error('Failed to send vendor registration email: ' . $e->getMessage());
        }
    }
}
