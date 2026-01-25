<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock me-2">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                <path d="M12 7v5l3 3"></path>
            </svg>
            Response Time
        </h3>
    </div>
    <div class="card-body">
        <div class="text-center">
            <div class="h1 mb-0 text-primary">{{ $averageResponseTime }}</div>
            <div class="text-muted">Average Hours</div>
            <div class="progress mt-2" style="height: 6px;">
                @php
                    $percentage = min(100, ($averageResponseTime / 24) * 100);
                @endphp
                <div class="progress-bar bg-primary" style="width: {{ $percentage }}%"></div>
            </div>
            <small class="text-muted mt-2 d-block">
                @if($averageResponseTime <= 4)
                    <span class="text-success">Excellent Response Time</span>
                @elseif($averageResponseTime <= 8)
                    <span class="text-warning">Good Response Time</span>
                @else
                    <span class="text-danger">Needs Improvement</span>
                @endif
            </small>
        </div>
    </div>
</div> 