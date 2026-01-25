<!-- Most Visited Pages Widget -->
<div class="col-12 mt-3" style="padding: 0px !important;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('Your Clean Team::content.most_visited_pages') }}</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter">
                <thead>
                    <tr>
                        <th>{{ trans('cms::app.title') }}</th>
                        <th>{{ trans('Your Clean Team::content.page_type') }}</th>
                        <th>{{ trans('Your Clean Team::content.views') }}</th>
                        <th>{{ trans('Your Clean Team::content.last_visited') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mostVisitedPages ?? [] as $page)
                        <tr>
                            <td>
                                <a href="{{ $page['url'] ?? '#' }}" target="_blank">{{ $page['title'] ?? 'Unknown' }}</a>
                            </td>
                            <td>{{ $page['type'] ?? 'Page' }}</td>
                            <td>
                                <span class="badge bg-blue">{{ number_format($page['views'] ?? 0) }}</span>
                            </td>
                            <td>{{ $page['last_visited'] ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">{{ trans('Your Clean Team::content.no_data_available') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (!empty($mostVisitedPages) && auth()->user()->isAdmin())
            <div class="card-footer text-end">
                <a href="{{ route('admin.posts.index', ['pages']) }}" class="btn btn-primary">
                    {{ trans('Your Clean Team::content.view_all') }}
                </a>
            </div>
        @endif
    </div>
</div>
