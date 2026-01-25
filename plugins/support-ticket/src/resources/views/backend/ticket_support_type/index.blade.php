@extends('cms::layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus me-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        {{ trans('sticket::content.add_type') }}
                    </h3>
                </div>
                <div class="card-body">
                    @component('cms::components.form', [])

                        {{ Field::text(trans('sticket::content.name'), 'name', [
                            'required' => true, 
                            'validators' => ['required'],
                            'placeholder' => trans('sticket::content.enter_type_name')
                        ]) }}

                        {{ Field::textarea(trans('sticket::content.description'), 'description', [
                            'rows' => 3,
                            'placeholder' => trans('sticket::content.enter_type_description')
                        ]) }}

                        {{ Field::select(trans('sticket::content.status'), 'status', [
                            'options' => [
                                'active' => trans('sticket::content.active'),
                                'inactive' => trans('sticket::content.inactive')
                            ],
                            'value' => 'active'
                        ]) }}

                        <button class="btn btn-tabler w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus me-1">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            {{ trans('sticket::content.add_type') }}
                        </button>

                    @endcomponent
                </div>
            </div>
        </div>

        <div class="col-md-8">
            {{ $dataTable->render() }}
        </div>
    </div>
@endsection
