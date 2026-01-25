<style>
    .support-settings .card-title {
        margin-right: 5px;
    }
</style>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.editor_settings') }}</h3>
            </div>
            <div class="card-body">
                {{ Field::select('Editor Type', 'editor_type', [
                    'value' => get_config('editor_type', 'tinymce'),
                    'options' => [
                        'tinymce' => 'TinyMCE',
                        'ckeditor' => 'CKEditor',
                        'summernote' => 'Summernote',
                        'quill' => 'Quill',
                        'simple' => 'Simple Textarea'
                    ],
                    'class' => 'form-select',
                ]) }}

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Rich Editor', 'enable_rich_editor', [
                        'checked' => get_config('enable_rich_editor', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable File Upload', 'enable_file_upload', [
                        'checked' => get_config('enable_file_upload', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Image Upload', 'enable_image_upload', [
                        'checked' => get_config('enable_image_upload', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.editor_features') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Bold/Italic', 'enable_bold_italic', [
                        'checked' => get_config('enable_bold_italic', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Lists', 'enable_lists', [
                        'checked' => get_config('enable_lists', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Links', 'enable_links', [
                        'checked' => get_config('enable_links', 1) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>

                <div class="form-check form-switch mb-3">
                    {{ Field::checkbox('Enable Code Blocks', 'enable_code_blocks', [
                        'checked' => get_config('enable_code_blocks', 0) == 1,
                        'class' => 'form-check-input',
                    ]) }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ trans('sticket::content.editor_toolbar') }}</h3>
            </div>
            <div class="card-body">
                {{ Field::textarea('Editor Toolbar Buttons', 'editor_toolbar_buttons', [
                    'value' => get_config('editor_toolbar_buttons', 'bold,italic,underline,strikethrough,|,bullist,numlist,|,link,unlink,|,image,|,undo,redo'),
                    'class' => 'form-control',
                    'rows' => 3,
                    'help' => trans('sticket::content.editor_toolbar_buttons_description'),
                ]) }}

                {{ Field::text('Editor Height (px)', 'editor_height', [
                    'type' => 'number',
                    'value' => get_config('editor_height', 300),
                    'class' => 'form-control',
                    'min' => 100,
                    'max' => 1000,
                ]) }}

                {{ Field::textarea('Editor Custom CSS', 'editor_custom_css', [
                    'value' => get_config('editor_custom_css', ''),
                    'class' => 'form-control',
                    'rows' => 4,
                    'help' => trans('sticket::content.editor_custom_css_description'),
                ]) }}
            </div>
        </div>
    </div>
</div>