<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar me-2">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M3 3m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z"></path>
                <path d="M12 8l0 8"></path>
                <path d="M8 12l0 4"></path>
                <path d="M16 10l0 6"></path>
            </svg>
            Ticket Statistics
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="text-center">
                    <div class="h1 mb-0">{{ $totalTickets }}</div>
                    <div class="text-muted">Total Tickets</div>
                </div>
            </div>
            <div class="col-6">
                <div class="text-center">
                    <div class="h1 mb-0 text-warning">{{ $openTickets }}</div>
                    <div class="text-muted">Open Tickets</div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <div class="text-center">
                    <div class="h1 mb-0 text-success">{{ $closedTickets }}</div>
                    <div class="text-muted">Closed Tickets</div>
                </div>
            </div>
            <div class="col-6">
                <div class="text-center">
                    <div class="h1 mb-0 text-danger">{{ $urgentTickets }}</div>
                    <div class="text-muted">Urgent Tickets</div>
                </div>
            </div>
        </div>
    </div>
</div> 