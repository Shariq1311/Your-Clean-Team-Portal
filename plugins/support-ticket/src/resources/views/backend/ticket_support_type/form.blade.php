@extends('cms::layouts.backend')

@section('content')
    @component('cms::components.form_resource', [
        'model' => $model
    ])
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list me-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M9 6l11 0"></path>
                                <path d="M9 12l11 0"></path>
                                <path d="M9 18l11 0"></path>
                                <path d="M5 6l0 .01"></path>
                                <path d="M5 12l0 .01"></path>
                                <path d="M5 18l0 .01"></path>
                            </svg>
                            {{ $model->id ? trans('sticket::content.edit_type') : trans('sticket::content.add_type') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                {{ Field::text($model, 'name', [
                                    'label' => trans('sticket::content.name'),
                                    'required' => true,
                                    'placeholder' => trans('sticket::content.enter_type_name')
                                ]) }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                {{ Field::textarea($model, 'description', [
                                    'label' => trans('sticket::content.description'),
                                    'rows' => 3,
                                    'placeholder' => trans('sticket::content.enter_type_description')
                                ]) }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {{ Field::select($model, 'status', [
                                    'label' => trans('sticket::content.status'),
                                    'options' => [
                                        'active' => trans('sticket::content.active'),
                                        'inactive' => trans('sticket::content.inactive')
                                    ],
                                    'value' => $model->status ?? 'active'
                                ]) }}
                            </div>
                            <div class="col-md-6">
                                {{ Field::text($model, 'sort_order', [
                                    'label' => trans('sticket::content.sort_order'),
                                    'type' => 'number',
                                    'placeholder' => '0',
                                    'value' => $model->sort_order ?? 0
                                ]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-settings me-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                            </svg>
                            {{ trans('sticket::content.settings') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        {{ Field::checkbox($model, 'is_default', [
                            'label' => trans('sticket::content.is_default'),
                            'value' => $model->is_default ?? false
                        ]) }}

                        {{ Field::checkbox($model, 'require_priority', [
                            'label' => trans('sticket::content.require_priority'),
                            'value' => $model->require_priority ?? false
                        ]) }}

                        {{ Field::checkbox($model, 'require_attachment', [
                            'label' => trans('sticket::content.require_attachment'),
                            'value' => $model->require_attachment ?? false
                        ]) }}

                        {{ Field::checkbox($model, 'auto_assign', [
                            'label' => trans('sticket::content.auto_assign'),
                            'value' => $model->auto_assign ?? false
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection
