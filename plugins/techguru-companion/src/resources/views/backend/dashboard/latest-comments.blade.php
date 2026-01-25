<!-- Latest Comments Widget -->
<div class="col-12 mt-3" style="padding: 0px !important;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('Your Clean Team::content.latest_comments') }}</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table card-table table-vcenter">
                    <thead>
                        <tr>
                            <th>{{ trans('Your Clean Team::content.comment_content') }}</th>
                            <th>{{ trans('cms::app.author') }}</th>
                            <th>{{ trans('cms::app.post') }}</th>
                            <th>{{ trans('Your Clean Team::content.comment_status') }}</th>
                            <th class="w-1">{{ trans('cms::app.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestComments ?? [] as $comment)
                            <tr>
                                <td>
                                    <div class="text-truncate" style="max-width: 300px;">
                                        {{ $comment['content'] }}
                                    </div>
                                    @if($comment['is_review'])
                                        <div class="mt-1">
                                            <span class="badge bg-yellow text-dark">
                                                {{ trans('Your Clean Team::content.rating') }}: {{ $comment['rating'] }}/5
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="avatar avatar-xs me-2" style="background-image: url({{ $comment['user_avatar'] }})"></span>
                                        <div>{{ $comment['user_name'] }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-secondary">{{ $comment['post_type'] }}:</span>
                                    <strong>{{ $comment['post_title'] }}</strong>
                                </td>
                                <td>
                                    @php
                                        $statusColor = match($comment['status']) {
                                            'approved' => 'success',
                                            'pending' => 'warning',
                                            'deny' => 'danger',
                                            default => 'secondary'
                                        };
                                        $statusLabel = match($comment['status']) {
                                            'approved' => trans('Your Clean Team::content.approved'),
                                            'pending' => trans('Your Clean Team::content.pending'),
                                            'deny' => trans('Your Clean Team::content.denied'),
                                            default => $comment['status']
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusColor }}">{{ $statusLabel }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ $comment['edit_url'] }}" class="btn btn-sm btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">{{ trans('Your Clean Team::content.no_recent_comments') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if (!empty($latestComments) && count($latestComments) > 3)
            <div class="card-footer text-end">
                <a href="{{ route('admin.comments.index', ['type' => 'posts']) }}" class="btn btn-primary">
                    {{ trans('Your Clean Team::content.view_all_comments') }}
                </a>
            </div>
        @endif
    </div>
</div>
