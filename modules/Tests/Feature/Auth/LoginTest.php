<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Tests\Feature\Auth;

use Illuminate\Support\Facades\Hash;
use MojarCMS\CMS\Models\User;
use MojarCMS\Tests\TestCase;

class LoginTest extends TestCase
{
    public function testIndex()
    {
        $this->get('app/login')->assertStatus(200);
    }

    public function testLogin()
    {
        $user = User::factory()->create(['password' => Hash::make('12345678')]);

        $this->json(
            'POST',
            '/app/login',
            [
                'email' => $user->email,
                'password' => '12345678',
            ]
        )
            ->assertJson(['status' => true]);
    }
}
