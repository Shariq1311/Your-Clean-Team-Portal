@extends('ecomm::emails.vendor.layouts.base')

@php
$title = trans('ecomm::content.emails.approved_title');
$titleColor = '#28a745';
$infoBoxColor = '#e8f5e8';
$callToAction = trans('ecomm::content.emails.login_now');
$callToActionUrl = url('/login');
$callToActionColor = '#28a745';
@endphp

@section('content')
    <p style="margin-bottom: 15px;">{{ trans('ecomm::content.emails.approved_message') }}</p>
@endsection

@section('additional_content')
    <p style="margin-bottom: 15px;">{{ trans('ecomm::content.emails.approved_next_steps') }}</p>
@endsection