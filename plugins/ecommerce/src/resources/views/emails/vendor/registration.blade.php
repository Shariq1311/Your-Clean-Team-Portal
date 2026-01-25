@extends('ecomm::emails.vendor.layouts.base')

@php
$title = trans('ecomm::content.emails.registration_title');
$titleColor = '#17a2b8';
$infoBoxColor = '#d1ecf1';
@endphp

@section('content')
    <p style="margin-bottom: 15px;">{{ trans('ecomm::content.emails.registration_message') }}</p>
@endsection

@section('additional_content')
    <p style="margin-bottom: 15px;">{{ trans('ecomm::content.emails.registration_next_steps') }}</p>
    
    <div style="background-color: #fff3cd; padding: 15px; border-radius: 5px; margin: 15px 0; border-left: 4px solid #ffc107;">
        <strong>{{ trans('ecomm::content.emails.important_note') }}:</strong>
        <p style="margin: 10px 0 0 0;">{{ trans('ecomm::content.emails.registration_note') }}</p>
    </div>
@endsection