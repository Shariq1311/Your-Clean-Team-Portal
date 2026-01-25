<?php
/**
 * Mojar CMS - Laravel CMS for Your Project
 *
 * @package    Mojarcms/cms
 * @author     Mojar Team
 * @link       https://Mojarcms.com
 * @license    GNU V2
 */

namespace Mojahid\ContactForm\Http\Controllers\Frontend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use MojarCMS\CMS\Http\Controllers\FrontendController;
use Mojahid\ContactForm\Http\Requests\StoreContactRequest;
use Mojahid\ContactForm\Repositories\ContactRepository;

class ContactController extends FrontendController
{
    public function __construct(protected ContactRepository $contactRepository)
    {
    }

    public function store(StoreContactRequest $request): JsonResponse|RedirectResponse
    {
        $this->contactRepository->create($request->safe()->all());

        return $this->success(
            __('Contact form submitted successfully!'),
        );
    }
}
