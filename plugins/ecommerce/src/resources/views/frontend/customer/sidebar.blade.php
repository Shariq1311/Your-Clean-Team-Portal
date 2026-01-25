<div class="card">
    <div class="card-header">
        <h5 class="card-title">{{ trans('ecomm::content.my_account') }}</h5>
    </div>
    <div class="list-group list-group-flush">
        <a href="{{ route('customer.dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-2"></i> {{ trans('ecomm::content.dashboard') }}
        </a>
        <a href="{{ url('admin/ecommerce/orders') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.orders.*') ? 'active' : '' }}">
            <i class="fas fa-shopping-bag me-2"></i> {{ trans('ecomm::content.my_orders') }}
        </a>
        <a href="{{ route('customer.downloads') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.downloads') ? 'active' : '' }}">
            <i class="fas fa-download me-2"></i> {{ trans('ecomm::content.my_downloads') }}
        </a>
        <a href="{{ route('customer.wishlist') }}" class="list-group-item list-group-item-action {{ request()->routeIs('customer.wishlist') ? 'active' : '' }}">
            <i class="fas fa-heart me-2"></i> {{ trans('ecomm::content.my_wishlist') }}
        </a>
        <a href="{{ route('profile.index') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-user-edit me-2"></i> {{ trans('ecomm::content.edit_profile') }}
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action text-danger">
                <i class="fas fa-sign-out-alt me-2"></i> {{ trans('ecomm::content.logout') }}
            </button>
        </form>
    </div>
</div>
