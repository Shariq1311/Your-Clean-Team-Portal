<!-- Recent Content Widget -->
<div class="col-12 mt-3" style="padding: 0px !important;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('Your Clean Team::content.recent_content') }}</h3>
            <div class="card-actions">
                <div class="btn-group">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ trans('Your Clean Team::content.filter_by_type') }}
                    </button>
                    @if(auth()->user()->isAdmin())
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item content-filter" data-type="all"
                                href="#">{{ trans('Your Clean Team::content.all_content') }}</a></li>
                        <li><a class="dropdown-item content-filter" data-type="posts"
                                href="#">{{ trans('cms::app.posts') }}</a></li>
                        <li><a class="dropdown-item content-filter" data-type="pages"
                                href="#">{{ trans('cms::app.pages') }}</a></li>
                        <li><a class="dropdown-item content-filter" data-type="teams"
                                href="#">{{ trans('Your Clean Team::content.teams') }}</a></li>
                        <li><a class="dropdown-item content-filter" data-type="careers"
                                href="#">{{ trans('Your Clean Team::content.careers') }}</a></li>
                        <li><a class="dropdown-item content-filter" data-type="portfolios"
                                href="#">{{ trans('Your Clean Team::content.portfolios') }}</a></li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter" id="recent-content-table">
                <thead>
                    <tr>
                        <th>{{ trans('cms::app.title') }}</th>
                        <th>{{ trans('cms::app.type') }}</th>
                        <th>{{ trans('cms::app.status') }}</th>
                        <th>{{ trans('cms::app.author') }}</th>
                        <th>{{ trans('cms::app.created_at') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentContent ?? [] as $item)
                        <tr data-type="{{ $item['type'] ?? 'unknown' }}">
                            <td>
                                <a href="{{ $item['edit_url'] ?? '#' }}">{{ $item['title'] ?? 'Unknown' }}</a>
                            </td>
                            <td>{{ $item['type'] ?? 'Unknown' }}</td>
                            <td>
                                <span class="badge bg-{{ $item['status'] == 'publish' ? 'success' : 'warning' }}">
                                    {{ $item['status'] ?? 'draft' }}
                                </span>
                            </td>
                            <td>{{ $item['author'] ?? 'Unknown' }}</td>
                            <td>{{ $item['created_at'] ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr class="no-data-row">
                            <td colspan="6" class="text-center">{{ trans('Your Clean Team::content.no_data_available') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Content type filter functionality
        $('.content-filter').on('click', function(e) {
            e.preventDefault();
            const type = $(this).data('type');

            if (type === 'all') {
                $('#recent-content-table tbody tr').show();
                checkNoData();
                return;
            }

            $('#recent-content-table tbody tr').hide();
            $('#recent-content-table tbody tr[data-type="' + type + '"]').show();

            checkNoData();
        });

        function checkNoData() {
            const visibleRows = $('#recent-content-table tbody tr:visible').length;

            if (visibleRows === 0) {
                // If no visible rows after filtering, show no data message
                if ($('#recent-content-table tbody tr.no-data-filtered').length === 0) {
                    $('#recent-content-table tbody').append(
                        '<tr class="no-data-filtered"><td colspan="6" class="text-center">' +
                        '{{ trans('Your Clean Team::content.no_data_for_selected_filter') }}' +
                        '</td></tr>'
                    );
                } else {
                    $('.no-data-filtered').show();
                }
            } else {
                // If we have visible rows, hide the no data message
                $('.no-data-filtered').hide();
            }
        }
    });
</script>
