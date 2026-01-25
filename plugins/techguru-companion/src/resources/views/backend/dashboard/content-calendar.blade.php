<!-- Modern Content Calendar Widget -->
<div class="col-12 mt-3 d-none" style="padding: 0px !important;">
    <div class="card">
        <!-- Calendar Header -->
            <div class="card-header">
                <h3 class="card-title mb-0 fw-bold text-dark">
                    <span class="text-primary">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                    </span>
                    {{ trans('Your Clean Team::content.content_calendar') }}
                </h3>
                <div class="card-actions">
                    <div class="btn-group rounded-pill border">
                        <a href="{{ route('admin.dashboard') }}?calendar_month={{ $contentCalendar['prev_month'] }}" 
                           class="btn btn-ghost-primary btn-sm px-3" 
                           title="{{ trans('Your Clean Team::content.previous_month') }}">
                            <span class="content-calendar-icon">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
                            </span>
                        </a>
                        <span class="btn btn-ghost-primary btn-sm px-4 fw-semibold border-0">
                            {{ $contentCalendar['month_name'] }}
                        </span>
                        <a href="{{ route('admin.dashboard') }}?calendar_month={{ $contentCalendar['next_month'] }}" 
                           class="btn btn-ghost-primary btn-sm px-3" 
                           title="{{ trans('Your Clean Team::content.next_month') }}">
                            <span class="content-calendar-icon">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-right"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        <!-- Calendar Body -->
        <div class="card-body p-0">
            <div class="calendar-modern">
                <!-- Day Headers -->
                <div class="calendar-header">
                    @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                        <div class="day-header">
                            <span class="d-none d-md-inline">{{ $day }}</span>
                            <span class="d-md-none">{{ substr($day, 0, 1) }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Calendar Grid -->
                <div class="calendar-grid">
                    @php
                        $firstDayOfMonth = date('N', strtotime($contentCalendar['days'][0]['date']));
                        $dayCounter = 1;
                        $weeksInMonth = ceil((count($contentCalendar['days']) + $firstDayOfMonth - 1) / 7);
                    @endphp

                    @for($week = 0; $week < $weeksInMonth; $week++)
                        <div class="calendar-week">
                            @for($dayOfWeek = 1; $dayOfWeek <= 7; $dayOfWeek++)
                                @if(($week === 0 && $dayOfWeek < $firstDayOfMonth) || ($dayCounter > count($contentCalendar['days'])))
                                    <div class="calendar-day empty-day"></div>
                                @else
                                    @php
                                        $day = $contentCalendar['days'][$dayCounter - 1];
                                        $hasContent = count($day['posts']) > 0;
                                        $isToday = $day['date'] === date('Y-m-d');
                                        $isWeekend = $day['is_weekend'];
                                        $postCount = count($day['posts']);
                                    @endphp
                                    
                                    <div class="calendar-day {{ $isWeekend ? 'weekend' : '' }} {{ $isToday ? 'today' : '' }} {{ $hasContent ? 'has-content' : '' }}">
                                        <div class="day-content">
                                            <!-- Day Number -->
                                            <div class="day-number-container">
                                                <span class="day-number {{ $isToday ? 'today-number' : '' }}">
                                                    {{ $day['day'] }}
                                                </span>
                                                @if($hasContent)
                                                    <div class="post-indicator">
                                                        <span class="badge bg-primary rounded-pill">{{ $postCount }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Posts List -->
                                            @if($hasContent)
                                                <div class="posts-container">
                                                    @foreach($day['posts'] as $index => $post)
                                                        @if($index < 3)
                                                            @php
                                                                $statusClass = $post['is_published'] ? 'published' : 'draft';
                                                                $statusColor = $post['is_published'] ? 'success' : 'warning';
                                                            @endphp
                                                            <div class="post-item {{ $statusClass }}" 
                                                                 title="{{ $post['title'] }} ({{ $post['is_published'] ? 'Published' : 'Draft' }})">
                                                                <div class="post-indicator-dot bg-{{ $statusColor }}"></div>
                                                                <span class="post-title">{{ Str::limit($post['title'], 25) }}</span>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    @if($postCount > 3)
                                                        <div class="more-posts">
                                                            <small class="text-muted">+{{ $postCount - 3 }} more</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    @php $dayCounter++; @endphp
                                @endif
                            @endfor
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Calendar Footer with Legend -->
        <div class="card-footer bg-light border-top-0 py-3">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex flex-wrap gap-3 small">
                        <div class="d-flex align-items-center">
                            <div class="legend-dot bg-success me-2"></div>
                            <span class="text-muted">Published</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="legend-dot bg-warning me-2"></div>
                            <span class="text-muted">Draft</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="today-indicator me-2"></div>
                            <span class="text-muted">Today</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-end mt-2 mt-md-0">
                    <small class="text-muted">
                        @php
                            $totalPosts = collect($contentCalendar['days'])->sum(function($day) { return count($day['posts']); });
                            $publishedPosts = collect($contentCalendar['days'])->sum(function($day) { 
                                return collect($day['posts'])->where('is_published', true)->count(); 
                            });
                        @endphp
                        {{ $totalPosts }} posts this month ({{ $publishedPosts }} published)
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Calendar Styles */
.calendar-modern {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #fff;
    border-radius: 0 0 8px 8px;
    overflow: hidden;
}

/* Calendar Header */
.calendar-header {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
}

.day-header {
    padding: 1rem 0;
    text-align: center;
    border-right: 1px solid rgba(255, 255, 255, 0.1);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.day-header:last-child {
    border-right: none;
}

/* Calendar Grid */
.calendar-grid {
    display: flex;
    flex-direction: column;
}

.calendar-week {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    border-bottom: 1px solid #e9ecef;
}

.calendar-week:last-child {
    border-bottom: none;
}

/* Calendar Day Cells */
.calendar-day {
    min-height: 120px;
    border-right: 1px solid #e9ecef;
    background: #fff;
    transition: all 0.2s ease;
    position: relative;
    overflow: hidden;
}

.calendar-day:last-child {
    border-right: none;
}

.calendar-day:hover {
    background: #f8f9fa;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.calendar-day.empty-day {
    background: #f8f9fa;
    cursor: default;
}

.calendar-day.empty-day:hover {
    transform: none;
    box-shadow: none;
}

.calendar-day.weekend {
    background: rgba(108, 117, 125, 0.03);
}

.calendar-day.today {
    background: linear-gradient(135deg, rgba(32, 107, 196, 0.1) 0%, rgba(32, 107, 196, 0.05) 100%);
    border: 2px solid rgba(32, 107, 196, 0.3);
}

.calendar-day.has-content {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.05) 0%, rgba(32, 107, 196, 0.05) 100%);
}

/* Day Content */
.day-content {
    padding: 0.75rem;
    height: 100%;
    display: flex;
    flex-direction: column;
}

/* Day Number */
.day-number-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 0.5rem;
}

.day-number {
    font-size: 1.1rem;
    font-weight: 600;
    color: #495057;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    transition: all 0.2s ease;
}

.today-number {
    background: linear-gradient(135deg, #206bc4 0%, #1a5ba8 100%);
    color: white !important;
    box-shadow: 0 2px 8px rgba(32, 107, 196, 0.3);
}

.post-indicator {
    position: relative;
}

.post-indicator .badge {
    font-size: 0.7rem;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Posts Container */
.posts-container {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    overflow: hidden;
}

/* Post Items */
.post-item {
    display: flex;
    align-items: center;
    padding: 0.375rem 0.5rem;
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 6px;
    font-size: 0.75rem;
    line-height: 1.2;
    transition: all 0.2s ease;
    cursor: pointer;
}

.post-item:hover {
    background: rgba(255, 255, 255, 0.95);
    border-color: rgba(32, 107, 196, 0.2);
    transform: translateX(2px);
}

.post-item.published {
    border-left: 3px solid #28a745;
}

.post-item.draft {
    border-left: 3px solid #ffc107;
}

.post-indicator-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    margin-right: 0.5rem;
    flex-shrink: 0;
}

.post-title {
    flex: 1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    color: #495057;
    font-weight: 500;
}

.more-posts {
    text-align: center;
    padding: 0.25rem;
    margin-top: 0.25rem;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

/* Legend */
.legend-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
}

.today-indicator {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: linear-gradient(135deg, #206bc4 0%, #1a5ba8 100%);
    display: inline-block;
}

.content-calendar-icon {
    margin: 0 !important;
    align-items: center;
    justify-content: center;
    display: flex;
}

/* Responsive Design */
@media (max-width: 768px) {
    .calendar-day {
        min-height: 80px;
    }
    
    .day-content {
        padding: 0.5rem;
    }
    
    .day-number {
        font-size: 0.9rem;
        width: 24px;
        height: 24px;
    }
    
    .post-item {
        font-size: 0.7rem;
        padding: 0.25rem 0.375rem;
    }
    
    .posts-container {
        gap: 0.125rem;
    }
    
    .card-footer {
        padding: 1rem !important;
    }
    
    .card-footer .row > div {
        text-align: center !important;
    }
}

@media (max-width: 576px) {
    .calendar-day {
        min-height: 60px;
    }
    
    .day-content {
        padding: 0.375rem;
    }
    
    .posts-container .post-item:nth-child(n+3) {
        display: none;
    }
    
    .btn-group .btn {
        padding: 0.375rem 0.75rem !important;
        font-size: 0.875rem;
    }
    
    .card-title {
        font-size: 1.1rem;
    }
}

/* Dark mode support (if your admin panel has it) */
@media (prefers-color-scheme: dark) {
    .calendar-day {
        background: #2d3748;
        border-color: #4a5568;
        color: #e2e8f0;
    }
    
    .calendar-day.empty-day {
        background: #1a202c;
    }
    
    .calendar-day:hover {
        background: #4a5568;
    }
    
    .post-item {
        background: rgba(45, 55, 72, 0.8);
        border-color: rgba(255, 255, 255, 0.1);
        color: #e2e8f0;
    }
    
    .day-number {
        color: #e2e8f0;
    }
}

/* Print styles */
@media print {
    .calendar-day {
        min-height: 80px;
        border: 1px solid #ccc !important;
    }
    
    .card-footer {
        display: none;
    }
    
    .btn-group {
        display: none;
    }
}
</style>