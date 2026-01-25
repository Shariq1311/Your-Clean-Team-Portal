@php
    $multiple = $multiple ?? false;
    $accept = $accept ?? get_config('allowed_attachment_types', 'jpg,jpeg,png,gif,pdf,doc,docx,txt');
    $maxSize = get_config('max_attachment_size', 10); // MB
    $acceptMime = collect(explode(',', $accept))->map(function($ext) {
        $ext = trim($ext);
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) return 'image/' . ($ext === 'jpg' ? 'jpeg' : $ext);
        if ($ext === 'pdf') return 'application/pdf';
        if (in_array($ext, ['doc', 'docx'])) return 'application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document';
        if ($ext === 'txt') return 'text/plain';
        return '';
    })->filter()->implode(',');
@endphp

<div class="mb-3">
    <label class="form-label" for="{{ $name }}">{{ $label ?? trans('sticket::content.attachments') }}</label>
    <input
        type="file"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-control"
        {{ $multiple ? 'multiple' : '' }}
        accept="{{ $acceptMime }}"
        data-max-size="{{ $maxSize * 1024 * 1024 }}"
    >
    <small class="form-hint">
        {{ trans('sticket::content.upload_files') }}
        ({{ $accept }}, {{ $maxSize }}MB max)
    </small>
    <div class="invalid-feedback"></div>
</div>

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInputs = document.querySelectorAll('input[type="file"][data-max-size]');
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function(e) {
            const maxSize = parseInt(input.getAttribute('data-max-size'));
            for (let file of input.files) {
                if (file.size > maxSize) {
                    input.value = '';
                    input.classList.add('is-invalid');
                    input.nextElementSibling.nextElementSibling.textContent = 'File size exceeds max allowed (' + (maxSize / 1024 / 1024) + 'MB)';
                    break;
                } else {
                    input.classList.remove('is-invalid');
                    input.nextElementSibling.nextElementSibling.textContent = '';
                }
            }
        });
    });
});
</script>
@endpush