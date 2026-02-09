<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo">
                <img src="{{ asset('Logo2.png') }}" alt="Logo" style="height: 35px; width: auto; object-fit: contain;">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        {{-- <li class="menu-item {{ request()->is('dashboard*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard" class="menu-link">
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->is('fleet*') ? 'active' : '' }}">
                    <a href="/fleet" class="menu-link">
                        <div data-i18n="Fleet">Fleet</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        <li class="menu-item {{ request()->is('ports*') ? 'active' : '' }}">
            <a href="/ports" class="menu-link">
                <i class="menu-icon tf-icons ti ti-anchor"></i>
                <div data-i18n="Ports">Ports</div>
            </a>
        </li>
        {{-- <li class="menu-item {{ request()->is('vessels*') ? 'active' : '' }}">
            <a href="/vessels" class="menu-link">
                <i class="menu-icon tf-icons ti ti-ship"></i>
                <div data-i18n="Vessels">Vessels</div>
            </a>
        </li> --}}
        <li class="menu-item {{ request()->is('schedules*') ? 'active' : '' }}">
            <a href="/schedules" class="menu-link">
                <i class="menu-icon tf-icons ti ti-calendar-event"></i>
                <div data-i18n="Sailing Schedule">Sailing Schedule</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('trackings*') ? 'active' : '' }}">
            <a href="/trackings" class="menu-link">
                <i class="menu-icon tf-icons ti ti-ship"></i>
                <div data-i18n="Tracking">Tracking</div>
            </a>
        </li>

        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Account">Account</span>
        </li>
        <li class="menu-item {{ request()->is('users*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="menu-link">
                        <div data-i18n="List User">List User</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
