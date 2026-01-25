
<div class="comment-item mb-3" data-comment-id="{{ $comment?->id }}">
    <div class="d-flex">
        <div class="flex-shrink-0">
            <div class="avatar avatar-sm">
                <span class="avatar-initials">
                    {{ substr($comment?->createdBy?->name ?? 'U', 0, 1) }}
                </span>
            </div>
        </div>
        <div class="flex-grow-1 ms-3">
            <div class="comment-header d-flex justify-content-between align-items-start mb-2">
                <div>
                    <h6 class="mb-0">{{ $comment?->createdBy?->name ?? trans('sticket::content.unknown_user') }}</h6>
                    <small class="text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock me-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M12 7v5l3 3"></path>
                        </svg>
                        {{ mc_date_format($comment?->created_at) }}
                    </small>
                </div>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                            <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                        </svg>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="editComment({{ $comment?->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit me-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                            {{ trans('sticket::content.edit') }}
                        </a></li>
                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteComment({{ $comment?->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash me-2">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                            {{ trans('sticket::content.delete') }}
                        </a></li>
                    </ul>
                </div>
            </div>
            
            <div class="comment-content">
                {!! e_html($comment?->content) !!}
            </div>
            
            @if($comment?->attachments && $comment?->attachments->count() > 0)
                <div class="comment-attachments mt-2">
                    <small class="text-muted">{{ trans('sticket::content.attachments') }}:</small>
                    <div class="mt-1">
                        @foreach($comment?->attachments as $attachment)
                            <a href="{{ $attachment->file_url }}" target="_blank" class="btn btn-outline-secondary btn-sm me-1 mb-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-paperclip">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a2 2 0 0 0 -3 -3z"></path>
                                    <path d="M17 17v.01"></path>
                                    <path d="M7 7v.01"></path>
                                </svg>
                                {{ $attachment->original_name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function editComment(commentId) {
    // Implement edit comment functionality
    console.log('Edit comment:', commentId);
}

function deleteComment(commentId) {
    if (confirm('{{ trans('sticket::content.confirm_delete_comment') }}')) {
        // Implement delete comment functionality
        console.log('Delete comment:', commentId);
    }
}
</script>
