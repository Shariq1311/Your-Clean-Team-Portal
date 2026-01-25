@extends('cms::layouts.backend')

@section('content')

    @component('cms::components.form_resource', [
        'model' => $model
    ])
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">

                        {{ Field::text($model, 'name', [
                            'required' => true
                        ]) }}

                        {{ Field::text($model, 'email', [
                            'disabled' => $model->id ? true : false
                        ]) }}

                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="password">{{ trans('cms::app.password') }}</label>
                            <input type="password" name="password" class="form-control" id="password" autocomplete="off" @if(empty($model->id)) required @endif>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="password_confirmation">{{ trans('cms::app.confirm_password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" autocomplete="off" @if(empty($model->id)) required @endif>
                        </div>
                    </div>
                </div>

                @do_action('user.form.left', $model)
            </div>

            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="status">{{ trans('cms::app.status') }}</label>
                            <select name="status" id="status" class="form-control" required>
                                @foreach($allStatus as $key => $name)
                                    <option value="{{ $key }}" @if($model->status == $key) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="vendor_status">{{ trans('ecomm::content.vendor_status') }}</label>
                            <select name="vendor_status" id="vendor_status" class="form-control" required>
                                @foreach($vendorStatuses as $key => $name)
                                    <option value="{{ $key }}" @if(($vendor_status ?? 'under_review') == $key) selected @endif>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{ Field::image($model, 'avatar') }}
                    </div>
                </div>

                <!-- Vendor Meta Information -->
                @if($model->id)
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('ecomm::content.vendor_information') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label">{{ trans('ecomm::content.shop_name') }}</label>
                            <input type="text" class="form-control" value="{{ $shop_name ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">{{ trans('ecomm::content.business_phone') }}</label>
                            <input type="text" class="form-control" value="{{ $business_phone ?? '-' }}" readonly>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">{{ trans('ecomm::content.business_address') }}</label>
                            <textarea class="form-control" rows="3" readonly>{{ $business_address ?? '-' }}</textarea>
                        </div>
                    </div>
                </div>
                @endif

                @do_action('user.form.right', $model)
            </div>
        </div>

        <input type="hidden" name="id" value="{{ $model->id }}">
    @endcomponent

@endsection 