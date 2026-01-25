@extends('cms::layouts.backend')

@section('content')
    <div class="container-xl support-ticket-settings">
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <h2 class="page-title">{{ $title ?? trans('sticket::content.setting') }}</h2>
                </div>
            </div>
        </div>
        
        <form method="post" action="{{ route('admin.support-ticket.setting.save') }}" class="form-ajax">
            @component('cms::components.tabs', [
                'tabs' => [
                    'general' => [
                        'label' => trans('cms::app.general'),
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-apps"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" /><path d="M14 7l6 0" /><path d="M17 4l0 6" /></svg>',
                        'show' => true
                    ],
                    'automation' => [
                        'label' => trans('sticket::content.automation'),
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-robot"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 11h4v4h-4z"></path><path d="M10 11v4"></path><path d="M10 15h4"></path><path d="M8 8v.01"></path><path d="M12 8v.01"></path><path d="M16 8v.01"></path><path d="M9 4h6l1 2h-8l1 -2z"></path><path d="M7 15h10v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2v-4z"></path></svg>',
                        'show' => true
                    ],
                    'notifications' => [
                        'label' => trans('sticket::content.notifications'),
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-bell"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg>',
                        'show' => false
                    ],
                    'rating' => [
                        'label' => trans('sticket::content.rating'),
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-star"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>',
                        'show' => false
                    ],
                    'editor' => [
                        'label' => trans('sticket::content.editor'),
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path><path d="M16 5l3 3"></path></svg>',
                        'show' => false
                    ],
                ],
            ])
                @slot('tab_general')
                    @include('sticket::backend.setting.components.general')
                @endslot

                @slot('tab_automation')
                    @include('sticket::backend.setting.components.automation')
                @endslot
                
                @slot('tab_notifications')
                    @include('sticket::backend.setting.components.notifications')
                @endslot
                
                @slot('tab_rating')
                    @include('sticket::backend.setting.components.rating')
                @endslot
                
                @slot('tab_editor')
                    @include('sticket::backend.setting.components.editor')
                @endslot
            @endcomponent

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path><path d="M14 4l0 4l-6 0l0 -4"></path></svg>
                    </span>
                    {{ __('Save Changes') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize any special controls here
        });
    </script>
@endsection 