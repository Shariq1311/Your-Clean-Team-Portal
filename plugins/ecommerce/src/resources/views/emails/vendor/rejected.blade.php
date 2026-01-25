@extends('ecomm::emails.vendor.layouts.base')

@php
$title = trans('ecomm::content.emails.rejected_title');
$titleColor = '#dc3545';
$infoBoxColor = '#f8d7da';
@endphp

@section('content')
    <p style="margin-bottom: 15px;">{{ trans('ecomm::content.emails.rejected_message') }}</p>
@endsection

@section('additional_content')
    <p style="margin-bottom: 15px;">{{ trans('ecomm::content.emails.rejected_reason') }}</p>
    
    <p style="margin-bottom: 15px;">{{ trans('ecomm::content.emails.contact_support') }}</p>
@endsection