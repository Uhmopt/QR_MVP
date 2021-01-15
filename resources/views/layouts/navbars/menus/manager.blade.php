<ul class="navbar-nav">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('branch.edit', auth()->user()->branch->id) }}">
            <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Branch') }}
        </a>
    </li> 
    <li class="nav-item">
        <a class="nav-link" href="{{ route('qr.show', auth()->user()->branch->id) }}">
            <i class="ni ni-mobile-button text-red"></i> {{ __('QR Builder') }}
        </a>
    </li>
</ul>