<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-md"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        {{-- <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                    <i class="ti ti-search ti-md me-2 me-lg-4 ti-lg"></i>
                    <span class="d-none d-md-inline-block text-muted fw-normal">Search (Ctrl+/)</span>
                </a>
            </div>
        </div> --}}
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- / Style Switcher-->

            <!-- Quick links  -->

            <!-- Notification (Lonceng) -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-4">
                @php
                $unreadInquiries = \App\Models\Inquiry::where('is_read', false)->latest()->take(5)->get();
                $unreadInquiriesCount = \App\Models\Inquiry::where('is_read', false)->count();
                @endphp
                <a class="nav-link btn btn-text-secondary btn-icon rounded-pill dropdown-toggle hide-arrow"
                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    aria-expanded="false">
                    <span class="position-relative">
                        <i class="ti ti-bell ti-md"></i>
                        @if($unreadInquiriesCount > 0)
                        <span class="badge rounded-pill bg-danger border"
                            style="font-size: 0.55rem; padding: 2px 4px; position: absolute; top: -4px; right: -4px; min-width: 13px; height: 13px; display: flex; align-items: center; justify-content: center;">
                            {{ $unreadInquiriesCount }}
                        </span>
                        @endif
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-0">
                    <li class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="mb-0 me-auto">Inquiry Messages</h6>
                            <div class="d-flex align-items-center h6 mb-0">
                                <span class="badge bg-label-primary me-2">{{ $unreadInquiriesCount }} New</span>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush">
                            @forelse($unreadInquiries as $inq)
                            @php
                            $initials = strtoupper(substr($inq->first_name, 0, 1) . substr($inq->last_name ?? '', 0,
                            1));
                            $colors = ['bg-primary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info',
                            'bg-dark'];
                            $colorClass = $colors[$inq->id % count($colors)];
                            @endphp
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <a href="{{ route('cms.inquiries.index') }}" class="d-flex text-decoration-none">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <span class="avatar-initial rounded-circle {{ $colorClass }}">{{ $initials
                                                }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 small text-dark fw-bold">{{ $inq->first_name }} {{
                                            $inq->last_name }}</h6>
                                        <small class="mb-1 d-block text-body text-truncate" style="max-width: 200px;">{{
                                            $inq->subject ?? 'New message' }}</small>
                                        <small class="text-muted">{{ $inq->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                        <span class="badge badge-dot bg-danger"></span>
                                    </div>
                                </a>
                            </li>
                            @empty
                            <li class="text-center py-4 text-muted small">No new messages.</li>
                            @endforelse
                        </ul>
                    </li>
                    <li class="border-top">
                        <div class="d-grid p-4">
                            <a class="btn btn-primary btn-sm d-flex justify-content-center align-items-center gap-1"
                                href="{{ route('cms.inquiries.index') }}">
                                <i class="ti ti-mail-opened small"></i>
                                <small class="align-middle">View all messages</small>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item mt-0" href="{{ route('profile.setting') }}">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-2">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1 mx-n2"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="ti ti-user me-3 ti-md"></i><span class="align-middle">My
                                Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.setting') }}">
                            <i class="ti ti-settings me-3 ti-md"></i><span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="pages-account-settings-billing.html">
                            <span class="d-flex align-items-center align-middle">
                                <i class="flex-shrink-0 ti ti-file-dollar me-3 ti-md"></i><span
                                    class="flex-grow-1 align-middle">Billing</span>
                                <span
                                    class="flex-shrink-0 badge bg-danger d-flex align-items-center justify-content-center">4</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1 mx-n2"></div>
                    </li>
                    <li>
                        <div class="d-grid px-2 pt-2 pb-1">
                            <a class="btn btn-sm btn-danger d-flex" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <small class="align-middle">Logout</small>
                                <i class="ti ti-logout ms-2 ti-14px"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search..." />
        <i class="ti ti-x search-toggler cursor-pointer"></i>
    </div>
</nav>