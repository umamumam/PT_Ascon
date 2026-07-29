<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('user.tracking.index') }}" class="app-brand-link">
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
        {{-- Menu Header --}}
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="My Shipment">My Shipment</span>
        </li>

        {{-- Tracking --}}
        <li
            class="menu-item {{ (request()->is('user/tracking/Export*') || request('type') == 'Export' || (request()->is('user/tracking*') && !request()->is('user/tracking/Import*') && !request('type'))) ? 'active' : '' }}">
            <a href="{{ route('user.tracking.index', ['type' => 'Export']) }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-ship"></i>
                <div data-i18n="Tracking Export LCL">Tracking Export LCL</div>
            </a>
        </li>
        <li
            class="menu-item {{ (request()->is('user/tracking/Import*') || request('type') == 'Import') ? 'active' : '' }}">
            <a href="{{ route('user.tracking.index', ['type' => 'Import']) }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-ship"></i>
                <div data-i18n="Tracking Import LCL">Tracking Import LCL</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('rates*') ? 'active' : '' }}">
            <a href="/rates" class="menu-link">
                <i class="menu-icon tf-icons ti ti-calculator"></i>
                <div data-i18n="Rates/Tarif">Rates/Tarif</div>
            </a>
        </li>

        {{-- Registration & Support --}}
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Account Registration">Account Registration</span>
        </li>
        <li
            class="menu-item {{ (request()->is('customer-registration*') || request()->is('register')) ? 'active' : '' }}">
            <a href="{{ route('public.customer-registration.form') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-mail-fast"></i>
                <div data-i18n="Customer Registration">Customer Registration</div>
            </a>
        </li>
    </ul>
</aside>