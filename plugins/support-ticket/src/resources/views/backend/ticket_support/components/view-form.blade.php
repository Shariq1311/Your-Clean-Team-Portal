<div class="container-xl">
    <div class="row">
        <div class="col-md-8">
            <!-- Ticket Details -->
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="card-title">
                                <span class="badge bg-{{ $model->status == 'open' ? 'green' : ($model->status == 'closed' ? 'red' : 'yellow') }} me-2">
                                    {{ ucfirst($model->status) }}
                                </span>
                                {{ $title }}
                            </h3>
                            <div class="card-subtitle">
                                <span class="text-muted">{{ trans('sticket::content.submitted_by') }}: {{ $model->createdBy?->name }}</span>
                                <span class="text-muted ms-3">{{ trans('sticket::content.ticket_type') }}: {{ $model->type->name }}</span>
                                @if($model->priority)
                                    <span class="badge bg-{{ $model->priority == 'urgent' ? 'red' : ($model->priority == 'high' ? 'orange' : ($model->priority == 'medium' ? 'yellow' : 'green')) }} ms-2">
                                        {{ ucfirst($model->priority) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock me-1">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                    <path d="M12 7v5l3 3"></path>
                                </svg>
                                {{ mc_date_format($model->created_at) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="ticket-content">
                        {!! $model->content !!}
                    </div>
                    
                    @if($model->attachments && $model->attachments->count() > 0)
                        <div class="mt-3">
                            <h6>{{ trans('sticket::content.attachments') }}</h6>
                            <div class="row">
                                @foreach($model->attachments as $attachment)
                                    <div class="col-md-3 mb-2">
                                        <div class="attachment-item">
                                            <a href="{{ $attachment->file_url }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-paperclip">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a2 2 0 0 0 -3 -3z"></path>
                                                    <path d="M17 17v.01"></path>
                                                    <path d="M7 7v.01"></path>
                                                </svg>
                                                {{ $attachment->original_name }}
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('sticket::content.conversation') }}</h3>
                </div>
                <div class="card-body">
                    <div class="comments" id="comments">
                        @foreach($comments as $comment)
                            @component('sticket::backend.ticket_support.components.comment-template', [
                                'comment' => $comment,
                            ])
                            @endcomponent
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Reply Form -->
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('sticket::content.add_reply') }}</h3>
                </div>
                <div class="card-body">
                    <form
                        action="{{ route('admin.ticket-supports.comment', [$model->id]) }}"
                        method="post"
                        class="form-ajax"
                        id="form-reply"
                        data-success="reply_success_handle"
                        data-notify="true"
                    >
                        @component('cms::components.form_textarea', [
                            'name' => 'content',
                            'label' => trans('sticket::content.reply_content'),
                            'value' => '',
                            'rows' => 6,
                            'required' => true,
                            'placeholder' => trans('sticket::content.enter_your_reply'),
                            'class' => 'rich-editor',
                        ])
                        @endcomponent

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 14l11 -11"></path>
                                    <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5z"></path>
                                </svg>
                                {{ trans('sticket::content.send_reply') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Ticket Info Sidebar -->
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('sticket::content.ticket_info') }}</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">{{ trans('sticket::content.status') }}</label>
                        <div>
                            <span class="badge bg-{{ $model->status == 'open' ? 'green' : ($model->status == 'closed' ? 'red' : 'yellow') }}">
                                {{ ucfirst($model->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ trans('sticket::content.priority') }}</label>
                        <div>
                            @if($model->priority)
                                <span class="badge bg-{{ $model->priority == 'urgent' ? 'red' : ($model->priority == 'high' ? 'orange' : ($model->priority == 'medium' ? 'yellow' : 'green')) }}">
                                    {{ ucfirst($model->priority) }}
                                </span>
                            @else
                                <span class="text-muted">{{ trans('sticket::content.not_set') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ trans('sticket::content.created_at') }}</label>
                        <div class="text-muted">{{ mc_date_format($model->created_at) }}</div>
                    </div>

                    @if($model->updated_at != $model->created_at)
                        <div class="mb-3">
                            <label class="form-label">{{ trans('sticket::content.last_updated') }}</label>
                            <div class="text-muted">{{ mc_date_format($model->updated_at) }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Rating Section -->
            @if(get_config('enable_rating', 1) && $model->status == 'closed')
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('sticket::content.rating') }}</h3>
                    </div>
                    <div class="card-body">
                        @if($model->rating)
                            <div class="rating-display">
                                @for($i = 1; $i <= get_config('rating_scale', 5); $i++)
                                    <span class="star {{ $i <= $model->rating ? 'filled' : '' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="{{ $i <= $model->rating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-star">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                                        </svg>
                                    </span>
                                @endfor
                                <span class="ms-2">{{ $model->rating }}/{{ get_config('rating_scale', 5) }}</span>
                            </div>
                            @if($model->rating_feedback)
                                <div class="mt-2">
                                    <small class="text-muted">{{ $model->rating_feedback }}</small>
                                </div>
                            @endif
                        @else
                            <div class="text-muted">{{ trans('sticket::content.no_rating_yet') }}</div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('sticket::content.quick_actions') }}</h3>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($model->status != 'closed')
                            <button type="button" class="btn btn-tabler" onclick="closeTicket()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                </svg>
                                {{ trans('sticket::content.close_ticket') }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/html" id="comment-template">
    <div class="comment-item mb-3" data-comment-id="{COMMENT_ID}">
        <div class="d-flex">
            <div class="flex-shrink-0">
                <div class="avatar avatar-sm">
                    <span class="avatar-initials">
                        {COMMENT_USER_INITIAL}
                    </span>
                </div>
            </div>
            <div class="flex-grow-1 ms-3">
                <div class="comment-header d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <h6 class="mb-0">{COMMENT_USER_NAME}</h6>
                        <small class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock me-1">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                <path d="M12 7v5l3 3"></path>
                            </svg>
                            {COMMENT_DATE}
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
                            <li><a class="dropdown-item" href="#" onclick="editComment({COMMENT_ID})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit me-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                                {{ trans('sticket::content.edit') }}
                            </a></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="deleteComment({COMMENT_ID})">
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
                    {COMMENT_CONTENT}
                </div>
                
                {COMMENT_ATTACHMENTS}
            </div>
        </div>
    </div>
</script>

<script type="text/javascript">
    function reply_success_handle(form, response) {
        if (response.data && response.data.comment) {
            let temp = document.getElementById('comment-template').innerHTML;
            let comment = response.data.comment;
            
            // Replace template placeholders with actual data
            temp = temp.replace('{COMMENT_ID}', comment.id || '');
            temp = temp.replace('{COMMENT_USER_NAME}', comment.created_by_name || '{{ trans("sticket::content.unknown_user") }}');
            temp = temp.replace('{COMMENT_USER_INITIAL}', (comment.created_by_name || 'U').charAt(0));
            temp = temp.replace('{COMMENT_DATE}', comment.created_at_formatted || '');
            temp = temp.replace('{COMMENT_CONTENT}', comment.content || '');
            
            // Handle attachments if any
            let attachmentsHtml = '';
            if (comment.attachments && comment.attachments.length > 0) {
                attachmentsHtml = '<div class="comment-attachments mt-2">';
                attachmentsHtml += '<small class="text-muted">{{ trans("sticket::content.attachments") }}:</small>';
                attachmentsHtml += '<div class="mt-1">';
                comment.attachments.forEach(function(attachment) {
                    attachmentsHtml += '<a href="' + attachment.file_url + '" target="_blank" class="btn btn-outline-secondary btn-sm me-1 mb-1">';
                    attachmentsHtml += '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-paperclip">';
                    attachmentsHtml += '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>';
                    attachmentsHtml += '<path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a2 2 0 0 0 -3 -3z"></path>';
                    attachmentsHtml += '<path d="M17 17v.01"></path>';
                    attachmentsHtml += '<path d="M7 7v.01"></path>';
                    attachmentsHtml += '</svg>';
                    attachmentsHtml += attachment.original_name;
                    attachmentsHtml += '</a>';
                });
                attachmentsHtml += '</div></div>';
            }
            temp = temp.replace('{COMMENT_ATTACHMENTS}', attachmentsHtml);
            
            $('#comments').append(temp);
        }
        
        form.find('textarea').val(null);
        
        // Reinitialize rich editor for new comment
        @if(get_config('enable_rich_editor', 1))
            if (typeof tinymce !== 'undefined') {
                tinymce.remove('.rich-editor');
                tinymce.init({
                    selector: '.rich-editor',
                    height: {{ get_config('editor_height', 300) }},
                    plugins: 'link image code table lists',
                    toolbar: '{{ get_config('editor_toolbar_buttons', 'bold,italic,underline,strikethrough,|,bullist,numlist,|,link,unlink,|,image,|,undo,redo') }}',
                });
            }
        @endif
    }

    function closeTicket() {
        if (confirm('{{ trans('sticket::content.confirm_close_ticket') }}')) {
            // Add AJAX call to close ticket
            $.post('{{ route('admin.ticket-supports.close', $model->id) }}', {
                _token: '{{ csrf_token() }}'
            }).done(function(response) {
                if (response.status === 'success') {
                    location.reload();
                } else {
                    alert('Error: ' + response.message);
                }
            }).fail(function(xhr) {
                alert('Error closing ticket. Please try again.');
            });
        }
    }

    function editComment(commentId) {
        // Implement edit comment functionality
        console.log('Edit comment:', commentId);
        // You can implement a modal or inline editing here
    }

    function deleteComment(commentId) {
        if (confirm('{{ trans('sticket::content.confirm_delete_comment') }}')) {
            // Implement delete comment functionality
            $.post('{{ route('admin.ticket-supports.comment.delete') }}', {
                comment_id: commentId,
                _token: '{{ csrf_token() }}'
            }).done(function(response) {
                if (response.status === 'success') {
                    // Remove the comment from UI without page refresh
                    $('[data-comment-id="' + commentId + '"]').fadeOut(function() {
                        $(this).remove();
                    });
                } else {
                    alert('Error: ' + response.message);
                }
            }).fail(function(xhr) {
                alert('Error deleting comment. Please try again.');
            });
        }
    }

    $(document).ready(function() {
        // Initialize rich editor
        @if(get_config('enable_rich_editor', 1))
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: '.rich-editor',
                    height: {{ get_config('editor_height', 300) }},
                    plugins: 'link image code table lists',
                    toolbar: '{{ get_config('editor_toolbar_buttons', 'bold,italic,underline,strikethrough,|,bullist,numlist,|,link,unlink,|,image,|,undo,redo') }}',
                });
            }
        @endif
    });
</script>
