<ul class="navbar-nav">
    @if (!config('app.isqrsaas'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
        </a>
    </li>
    <!-- <li class="nav-item">
        <a class="nav-link" href="/live">
            <i class="ni ni-basket text-success"></i> {{ __('Live Orders') }}<div class="blob red"></div>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index') }}">
            <i class="ni ni-basket text-orange"></i> {{ __('Orders') }}
        </a>
    </li> -->
    @endif

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.restaurants.edit',  auth()->user()->restorant->id) }}">
            <i class="ni ni-shop text-info"></i> {{ __('Restaurant') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('items.index') }}">
            <i class="ni ni-collection text-pink"></i> {{ __('Menu') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('branch.index') }}">
            <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Branch') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('qr') }}">
            <i class="ni ni-mobile-button text-red"></i> {{ __('QR Builder') }}
        </a>
    </li>
    @if (config('app.isqrsaas'))
    @endif

    @if(env('ENABLE_PRICING',false))
    <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('plans.current') }}">
            <i class="ni ni-credit-card text-orange"></i> {{ __('Plan') }}
        </a>
    </li> -->
    @endif
    @if (!config('app.isqrsaas'))
    @if(env('ENABLE_FINANCES_OWNER',true))
    <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('finances.owner') }}">
            <i class="ni ni-money-coins text-blue"></i> {{ __('Finances') }}
        </a>
    </li> -->
    @endif
    @endif
</ul>