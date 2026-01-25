<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-star me-2">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
            </svg>
            Customer Satisfaction
        </h3>
    </div>
    <div class="card-body">
        <div class="text-center">
            <div class="h1 mb-0 text-warning">{{ number_format($averageRating, 1) }}</div>
            <div class="text-muted">Average Rating</div>
            
            <div class="mt-3">
                @for($i = 1; $i <= 5; $i++)
                    <span class="star {{ $i <= $averageRating ? 'filled' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="{{ $i <= $averageRating ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-star">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path>
                        </svg>
                    </span>
                @endfor
            </div>
            
            <div class="mt-3">
                <div class="text-muted">{{ $satisfactionRate }}% Satisfaction Rate</div>
                <small class="text-muted">{{ $ratedTickets }} of {{ $totalClosedTickets }} tickets rated</small>
            </div>
        </div>
    </div>
</div>

<style>
.star {
    color: #ddd;
}
.star.filled {
    color: #ffc107;
}
</style> 