@component('cms::components.form_resource', [
        'model' => $model
    ])

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('sticket::content.ticket_details') }}</h3>
                </div>
                <div class="card-body">
                    @component('cms::components.form_input', [
                        'name' => 'title',
                        'label' => trans('sticket::content.ticket_subject'),
                        'value' => $model->title ?? '',
                        'required' => true,
                        'placeholder' => trans('sticket::content.enter_ticket_subject'),
                    ])
                    @endcomponent

                    @component('cms::components.form_textarea', [
                        'name' => 'content',
                        'label' => trans('sticket::content.ticket_description'),
                        'value' => $model->content ?? '',
                        'rows' => 8,
                        'required' => true,
                        'placeholder' => trans('sticket::content.describe_your_issue'),
                        'class' => 'rich-editor',
                    ])
                    @endcomponent
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('sticket::content.ticket_settings') }}</h3>
                </div>
                <div class="card-body">
                    @component('cms::components.form_select', [
                        'name' => 'support_type_id',
                        'label' => trans('sticket::content.ticket_type'),
                        'value' => $model->support_type_id ?? '',
                        'options' => $supportTypes,
                        'required' => true,
                    ])
                    @endcomponent

                    @component('cms::components.form_select', [
                        'name' => 'priority',
                        'label' => trans('sticket::content.priority'),
                        'value' => $model->priority ?? 'medium',
                        'options' => [
                            'low' => trans('sticket::content.low'),
                            'medium' => trans('sticket::content.medium'),
                            'high' => trans('sticket::content.high'),
                            'urgent' => trans('sticket::content.urgent'),
                        ],
                    ])
                    @endcomponent

                    @if(get_config('enable_attachments', 1))
                        @component('sticket::components.form_file', [
                            'name' => 'attachments[]',
                            'label' => trans('sticket::content.attachments'),
                            'multiple' => true,
                            'accept' => get_config('allowed_attachment_types', 'jpg,jpeg,png,gif,pdf,doc,docx,txt'),
                        ])
                        @endcomponent
                    @endif
                </div>
            </div>
        </div>
    </div>
@endcomponent

@section('script')
<script>
$(document).ready(function() {
    // Initialize rich editor if enabled
    @if(get_config('enable_rich_editor', 1))
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '.rich-editor',
                height: {{ get_config('editor_height', 300) }},
                plugins: 'link image code table lists',
                toolbar: '{{ get_config('editor_toolbar_buttons', 'bold,italic,underline,strikethrough,|,bullist,numlist,|,link,unlink,|,image,|,undo,redo') }}',
                @if(get_config('enable_file_upload', 1))
                file_picker_callback: function(callback, value, meta) {
                    // File upload callback
                },
                @endif
                @if(get_config('editor_custom_css'))
                content_css: '{{ get_config('editor_custom_css') }}',
                @endif
            });
        }
    @endif
});
</script>
@endsection
