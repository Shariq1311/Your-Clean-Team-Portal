<!-- Recent User Activities Widget -->
<div class="col-12 mt-3" style="padding: 0px !important;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('Your Clean Team::content.user_activities') }}</h3>
        </div>
        <div class="card-body user-activities">
            <div class="divide-y">
                @forelse($userActivities ?? [] as $activity)
                    <div>
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar" style="background-image: url({{ $activity['avatar'] ?? '' }})">
                                    @if (empty($activity['avatar']))
                                        {{ strtoupper(substr($activity['name'] ?? 'U', 0, 1)) }}
                                    @endif
                                </span>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>{{ $activity['name'] ?? 'Unknown User' }}</strong>
                                    {{ $activity['action'] ?? 'performed an action' }}
                                    @if (!empty($activity['item']))
                                        <strong>{{ $activity['item'] }}</strong>
                                    @endif
                                </div>
                                <div class="text-muted">{{ $activity['time'] ?? 'N/A' }}</div>
                            </div>
                            <div class="col-auto align-self-center d-none">
                                @if (!empty($activity['icon']))
                                    <div class="badge bg-{{ $activity['icon_bg'] ?? 'primary' }}">
                                        {!! $activity['icon'] !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">{{ trans('Your Clean Team::content.no_recent_activities') }}</div>
                @endforelse
            </div>
        </div>
        @if (!empty($userActivities) && count($userActivities) > 5)
            <div class="card-footer text-end">
                <a href="{{ route('admin.users.index') }}"
                    class="btn btn-primary">{{ trans('Your Clean Team::content.view_all_activities') }}</a>
            </div>
        @endif
    </div>
</div>
