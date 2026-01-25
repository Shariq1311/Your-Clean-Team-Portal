@php
/**
 * Base email template for vendor notifications
 * This template can be extended by specific vendor email templates
 * Variables available:
 * - $user: The user object
 * - $title: Email title
 * - $titleColor: Color for the title (default: #17a2b8)
 * - $infoBoxColor: Background color for info box (default: #d1ecf1)
 * - $callToAction: Text for call to action button (optional)
 * - $callToActionUrl: URL for call to action button (optional)
 * - $callToActionColor: Color for call to action button (default: #28a745)
 * - $shop_name: Vendor shop name (optional)
 */
@endphp

<div style="padding: 20px; background-color: #f8f9fa; border-radius: 8px; margin: 20px 0; font-family: Arial, sans-serif;">
    @if(isset($title))
    <h2 style="color: {{ $titleColor ?? '#17a2b8' }}; margin-bottom: 20px;">{{ $title }}</h2>
    @endif
    
    <p style="margin-bottom: 15px;">{{ trans('ecomm::content.emails.dear') }} {{ $user->name ?? $user->email ?? trans('ecomm::content.emails.vendor') }},</p>
    
    @yield('content')
    
    @if(isset($shop_name))
    <div style="background-color: {{ $infoBoxColor ?? '#d1ecf1' }}; padding: 15px; border-radius: 5px; margin: 15px 0;">
        <strong>{{ trans('ecomm::content.shop_name') }}:</strong> {{ $shop_name }}
    </div>
    @endif
    
    @yield('additional_content')
    
    @if(isset($callToAction) && isset($callToActionUrl))
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $callToActionUrl }}" style="background-color: {{ $callToActionColor ?? '#28a745' }}; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">{{ $callToAction }}</a>
    </div>
    @endif
    
    <p style="margin-bottom: 15px;">{{ trans('ecomm::content.emails.thank_you') }}</p>
    
    <p style="margin-bottom: 15px;">{{ trans('ecomm::content.emails.team') }}</p>
</div>