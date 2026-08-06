@extends('layouts.landing')

@section('content')
<style>
    :root {
        --ascon-orange: #FF5722;
        --ascon-dark-blue: #2391ff;
        --ascon-light-gray: #f8f9fa;
    }

    .sailing-schedule-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 30px;
        background: #fff;
    }

    .service-box {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 100%;
    }

    .service-box.active {
        border-color: var(--ascon-orange);
        box-shadow: 0 0 0 1px var(--ascon-orange);
    }

    .service-box img {
        width: 50px;
        margin-bottom: 10px;
    }

    .form-label-custom {
        font-size: 0.85rem;
        font-weight: 600;
        color: #666;
        margin-bottom: 5px;
    }

    .btn-search {
        background-color: transparent;
        color: var(--ascon-orange);
        border: 2px solid var(--ascon-orange);
        padding: 10px;
        width: 100%;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-search:hover {
        background-color: var(--ascon-orange);
        color: white;
    }

    .table-schedule thead th {
        background-color: var(--ascon-dark-blue) !important;
        color: white !important;
        font-weight: 500;
        font-size: 0.85rem;
        border: none;
        padding: 12px;
    }

    .table-schedule tbody td {
        font-size: 0.85rem;
        vertical-align: middle;
        padding: 12px;
    }

    .table-schedule thead tr.sub-header-table th {
        background-color: #f2f2f2 !important;
        color: #272727 !important;
        border-left: none !important;
        border-right: none !important;
    }

    .port-badge {
        border: 1px solid #dee2e6;
        color: #666;
        font-size: 0.85rem;
        padding: 5px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        white-space: nowrap;
    }

    .port-badge:hover {
        border-color: var(--ascon-orange);
        color: var(--ascon-orange);
    }

    .port-badge.active {
        border-color: var(--ascon-orange);
        color: var(--ascon-orange);
        background: white;
    }

    .port-badge-group {
        min-height: 40px;
    }

    .form-check-input:checked {
        background-color: var(--ascon-orange);
        border-color: var(--ascon-orange);
    }

    .no-data-message {
        text-align: center;
        padding: 40px;
        color: #999;
    }

    .search-results-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .search-result-item {
        padding: 10px 15px;
        cursor: pointer;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s;
    }

    .search-result-item:last-child {
        border-bottom: none;
    }

    .search-result-item:hover {
        background-color: #f8f9fa;
    }

    .search-result-item.active {
        background-color: #fff5f2;
        border-left: 3px solid var(--ascon-orange);
    }

    .port-name {
        font-weight: 600;
        color: #333;
    }

    .port-code {
        font-size: 0.8rem;
        color: #999;
        margin-left: 5px;
    }

    .no-results {
        padding: 15px;
        text-align: center;
        color: #999;
        font-size: 0.9rem;
    }
</style>

<div class="container py-5 mb-5" style="margin-top: 140px;">
    <div class="row">
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">eService</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sailing Schedule</li>
                </ol>
            </nav>
            <h1 class="fw-bold" style="color: var(--ascon-orange);">Sailing Schedule</h1>
            <p class="text-muted" style="text-align: justify; font-size: 0.95rem;">
                PT. Asia Connexindo Internasional (Ascon) was established in 1999, to facilitate the needs of
                trustworthy freight forwarding agent in Jakarta. Two decades ago, it started with small team and handled
                only consolidation groupage, however we are now growing and serving wide spectrum of transportation
                needs.
            </p>
        </div>

        <div class="col-12">
            <form id="filterForm" action="{{ route('sailing-schedule') }}" method="GET">
                <div class="sailing-schedule-card shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold m-0">Explore Sailing Schedule</h5>
                        <div class="d-flex align-items-center">
                            <span id="exportLabel" class="me-2 small {{ $type == 'Export' ? 'fw-bold' : 'text-muted' }}"
                                style="{{ $type == 'Export' ? 'color: var(--ascon-orange);' : '' }}">Export</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="modeSwitch" {{ $type=='Import' ? 'checked' : '' }}>
                                <input type="hidden" name="type" id="typeInput" value="{{ $type }}">
                            </div>
                            <span id="importLabel" class="ms-1 small {{ $type == 'Import' ? 'fw-bold' : 'text-muted' }}"
                                style="{{ $type == 'Import' ? 'color: var(--ascon-orange);' : '' }}">Import</span>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label-custom">Service Category</label>
                            <input type="hidden" name="service" id="serviceInput" value="{{ $service }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="service-box {{ $service == 'LCL' ? 'active' : '' }} d-flex flex-column align-items-start"
                                        data-service="LCL">
                                        <img src="{{ asset('LCL.png') }}" alt="LCL">
                                        <span class="small fw-bold {{ $service != 'LCL' ? 'text-muted' : '' }}">Less than Container Load / LCL</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="service-box {{ $service == 'FCL' ? 'active' : '' }} d-flex flex-column align-items-start"
                                        data-service="FCL">
                                        <img src="{{ asset('FCL.png') }}" alt="FCL">
                                        <span class="small fw-bold {{ $service != 'FCL' ? 'text-muted' : '' }}">Full Container Load / FCL</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Port of Loading --}}
                        <div class="col-md-6">
                            <label class="form-label-custom">Port of loading</label>
                            <input type="hidden" name="pol_id" id="polInput" value="{{ $pol_id }}">
                            <div class="input-group mb-2 position-relative">
                                <span class="input-group-text bg-white border-end-0"><i class="ti ti-search"></i></span>
                                <input type="text" id="polSearchInput" class="form-control border-start-0"
                                    placeholder="Search loading port" autocomplete="off">
                                <div id="polSearchResults" class="search-results-dropdown" style="display: none;"></div>
                            </div>
                            <div id="polBadgeGroup" class="port-badge-group">
                                @if($type == 'Export')
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($localPorts as $port)
                                    <button type="button"
                                        class="btn btn-sm port-badge pol-badge {{ $pol_id == $port->id ? 'active' : '' }}"
                                        data-port-id="{{ $port->id }}" data-port-name="{{ $port->port_name }}">
                                        {{ $port->port_name }}
                                    </button>
                                    @endforeach
                                </div>
                                @else
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($internationalPorts as $port)
                                    <button type="button"
                                        class="btn btn-sm port-badge pol-badge {{ $pol_id == $port->id ? 'active' : '' }}"
                                        data-port-id="{{ $port->id }}" data-port-name="{{ $port->port_name }}">
                                        {{ $port->port_name }}
                                    </button>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Port of Destination --}}
                        <div class="col-md-6">
                            <label class="form-label-custom">Port of destination</label>
                            <input type="hidden" name="pod_id" id="podInput" value="{{ $pod_id }}">
                            <div class="input-group mb-2 position-relative">
                                <span class="input-group-text bg-white border-end-0"><i class="ti ti-search"></i></span>
                                <input type="text" id="podSearchInput" class="form-control border-start-0"
                                    placeholder="Search destination port" autocomplete="off">
                                <div id="podSearchResults" class="search-results-dropdown" style="display: none;"></div>
                            </div>
                            <div id="podBadgeGroup" class="port-badge-group">
                                @if($type == 'Export')
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($internationalPorts as $port)
                                    <button type="button"
                                        class="btn btn-sm port-badge pod-badge {{ $pod_id == $port->id ? 'active' : '' }}"
                                        data-port-id="{{ $port->id }}" data-port-name="{{ $port->port_name }}">
                                        {{ $port->port_name }}
                                    </button>
                                    @endforeach
                                </div>
                                @else
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($localPorts as $port)
                                    <button type="button"
                                        class="btn btn-sm port-badge pod-badge {{ $pod_id == $port->id ? 'active' : '' }}"
                                        data-port-id="{{ $port->id }}" data-port-name="{{ $port->port_name }}">
                                        {{ $port->port_name }}
                                    </button>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-md-10">
                            <button type="submit" class="btn-search fw-bold text-uppercase">Search</button>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="resetBtn" class="btn btn-outline-secondary w-100"
                                style="padding: 10px;">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Display Schedules --}}
        @if($groupedSchedules->count() > 0)
        @foreach($groupedSchedules as $route => $routeSchedules)
        @php
            $columns       = $columnsPerRoute[$route];
            $hasConnecting = $columns['has_connecting'];
            $hasEtaText    = $columns['has_eta_text'];
            $hasRemarks    = $columns['has_remarks'];
            $etaDestinations = $columns['eta_destinations'];
            $customLabels  = $routeColumnLabels[$route] ?? [];
            $labelEtd      = $customLabels['etd']             ?? 'ETD';
            $labelEta      = $customLabels['eta_destination']  ?? 'ETA';

            $hasConnecting2 = $routeSchedules->contains(fn($s) => !empty($s->eta_nha) || !empty($s->connecting2_vessel) || !empty($s->connecting2_voyage) || !empty($s->connecting2_etd));
            $hasEtaKlf = $routeSchedules->contains(fn($s) => !empty($s->eta_klf));

            // Hitung total kolom
            $totalColumns = 3; // Vessel, Voy, ETD
            $totalColumns++;   // ETA (eta_destination)
            $totalColumns += count($etaDestinations);
            if ($hasEtaText)    $totalColumns++;
            if ($hasConnecting) {
                $totalColumns += 3; // 1st connecting
                if ($hasConnecting2) $totalColumns += 4; // ETA NHA, 2nd connecting, voy, ETD NHA
                if ($hasEtaKlf) $totalColumns += 2; // ETA KLF, 3rd connecting
                $totalColumns += 1; // ETA final
            }
            if ($hasRemarks)    $totalColumns++;
        @endphp
        <div class="col-12 mt-5">
            <div class="table-responsive rounded shadow-sm border">
                <table class="table table-hover table-schedule mb-0">
                    <thead class="text-center">
                        <tr>
                            <th colspan="{{ $totalColumns }}" class="py-3 text-uppercase">{{ $route }}</th>
                        </tr>
                        <tr class="sub-header-table">
                            <th class="text-dark">Vessel</th>
                            <th class="text-dark">Voy.</th>

                            {{-- ETD dengan label kustom --}}
                            <th class="text-dark">{{ $labelEtd }}</th>

                            {{-- ETA utama dengan label kustom --}}
                            <th class="text-dark">{{ $labelEta }}</th>

                            {{-- ETA destination tambahan (1,2,3,...) dengan label kustom --}}
                            @foreach($etaDestinations as $etaNum)
                            @php
                                $etaFieldKey = "eta_destination{$etaNum}";
                                $etaLabel    = $customLabels[$etaFieldKey] ?? "ETA {$etaNum}";
                            @endphp
                            <th class="text-dark">{{ $etaLabel }}</th>
                            @endforeach

                            @if($hasEtaText)
                            <th class="text-dark">ETA TH BKKPAT</th>
                            @endif

                            @if($hasConnecting)
                            <th class="text-dark">{{ $hasConnecting2 ? '1st Connecting' : 'Connecting' }}</th>
                            <th class="text-dark">Voy</th>
                            <th class="text-dark">{{ $customLabels['connecting_etd'] ?? 'ETD' }}</th>
                            @if($hasConnecting2)
                            <th class="text-dark">ETA NHA</th>
                            <th class="text-dark">2nd Connecting</th>
                            <th class="text-dark">Voy</th>
                            <th class="text-dark">ETD NHA</th>
                            @endif
                            @if($hasEtaKlf)
                            <th class="text-dark">ETA KLF</th>
                            <th class="text-dark">{{ $hasConnecting2 ? '3rd Connecting' : 'Connecting' }}</th>
                            @endif
                            <th class="text-dark">{{ $customLabels['connecting_eta'] ?? 'ETA' }}</th>
                            @endif

                            @if($hasRemarks)
                            <th class="text-dark">Remarks</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($routeSchedules as $schedule)
                        <tr>
                            <td>{{ $schedule->vessel }}</td>
                            <td>{{ $schedule->voyage }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->etd)->format('d - M') }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->eta_destination)->format('d - M') }}</td>

                            @foreach($etaDestinations as $etaNum)
                            @php $etaField = "eta_destination{$etaNum}"; @endphp
                            <td>
                                @if(!empty($schedule->$etaField))
                                    {{ \Carbon\Carbon::parse($schedule->$etaField)->format('d - M') }}
                                @else
                                    -
                                @endif
                            </td>
                            @endforeach

                            @if($hasEtaText)
                            <td>{{ $schedule->eta_text ?? '-' }}</td>
                            @endif

                            @if($hasConnecting)
                            <td>{{ $schedule->connecting_vessel ?? '-' }}</td>
                            <td>{{ $schedule->connecting_voyage ?? '-' }}</td>
                            <td>
                                @if($schedule->connecting_etd)
                                    {{ \Carbon\Carbon::parse($schedule->connecting_etd)->format('d - M') }}
                                @else -
                                @endif
                            </td>
                            @if($hasConnecting2)
                            <td>
                                @if($schedule->eta_nha)
                                    {{ \Carbon\Carbon::parse($schedule->eta_nha)->format('d - M') }}
                                @else -
                                @endif
                            </td>
                            <td>{{ $schedule->connecting2_vessel ?? '-' }}</td>
                            <td>{{ $schedule->connecting2_voyage ?? '-' }}</td>
                            <td>
                                @if($schedule->connecting2_etd)
                                    {{ \Carbon\Carbon::parse($schedule->connecting2_etd)->format('d - M') }}
                                @else -
                                @endif
                            </td>
                            @endif
                            @if($hasEtaKlf)
                            <td>
                                @if($schedule->eta_klf)
                                    {{ \Carbon\Carbon::parse($schedule->eta_klf)->format('d - M') }}
                                @else -
                                @endif
                            </td>
                            <td>{{ $schedule->connecting_klf ?? ($schedule->eta_klf ? 'By Truck' : '-') }}</td>
                            @endif
                            <td>
                                @if($schedule->connecting_eta)
                                    {{ \Carbon\Carbon::parse($schedule->connecting_eta)->format('d - M') }}
                                @else -
                                @endif
                            </td>
                            @endif

                            @if($hasRemarks)
                            <td>{{ $schedule->remarks_field ?? '-' }}</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach

        <div class="col-12 mt-4 d-flex justify-content-between align-items-center bg-light p-3 rounded border">
            <h6 class="fw-bold m-0">Download All Schedule</h6>
            <a href="{{ route('sailing-schedule.download-pdf', ['type' => $type, 'service' => $service, 'pol_id' => $pol_id, 'pod_id' => $pod_id]) }}"
                class="btn btn-danger btn-sm px-4" target="_blank">
                <i class="ti ti-download me-2"></i>Download PDF
            </a>
        </div>
        @else
        <div class="col-12 mt-5">
            <div class="no-data-message shadow-sm border rounded p-5 text-center">
                <img src="{{ asset('undraw.png') }}" alt="No Data" style="width:250px;">
                <p class="mb-5 mt-4">
                    Oops! Sorry schedule you are looking for is not available right now.
                </p>
            </div>
        </div>
        <script>
            document.getElementById('resetBtnEmpty')?.addEventListener('click', function() {
                window.location.href = '{{ route('sailing-schedule') }}';
            });
        </script>
        @endif
    </div>
</div>

<script>
    let polSearchTimeout;
    let podSearchTimeout;

    document.querySelectorAll('.service-box').forEach(box => {
        box.addEventListener('click', function() {
            const service = this.dataset.service;
            document.getElementById('serviceInput').value = service;
            document.querySelectorAll('.service-box').forEach(b => {
                b.classList.remove('active');
                b.querySelector('span').classList.add('text-muted');
            });
            this.classList.add('active');
            this.querySelector('span').classList.remove('text-muted');
        });
    });

    document.getElementById('modeSwitch').addEventListener('change', function() {
        const exportLabel = document.getElementById('exportLabel');
        const importLabel = document.getElementById('importLabel');
        const typeInput   = document.getElementById('typeInput');

        if (this.checked) {
            importLabel.classList.remove('text-muted'); importLabel.classList.add('fw-bold');
            importLabel.style.color = 'var(--ascon-orange)';
            exportLabel.classList.remove('fw-bold'); exportLabel.classList.add('text-muted');
            exportLabel.style.color = '';
            typeInput.value = 'Import';
        } else {
            exportLabel.classList.remove('text-muted'); exportLabel.classList.add('fw-bold');
            exportLabel.style.color = 'var(--ascon-orange)';
            importLabel.classList.remove('fw-bold'); importLabel.classList.add('text-muted');
            importLabel.style.color = '';
            typeInput.value = 'Export';
        }
        document.getElementById('filterForm').submit();
    });

    document.getElementById('polSearchInput').addEventListener('input', function() {
        const searchValue    = this.value.trim();
        const resultsContainer = document.getElementById('polSearchResults');
        const mode           = document.getElementById('typeInput').value;
        clearTimeout(polSearchTimeout);
        if (searchValue.length < 2) {
            resultsContainer.style.display = 'none';
            document.querySelectorAll('.pol-badge').forEach(b => b.style.display = 'inline-block');
            return;
        }
        document.querySelectorAll('.pol-badge').forEach(b => b.style.display = 'none');
        polSearchTimeout = setTimeout(() => {
            fetch(`{{ route('sailing-schedule.search-ports') }}?query=${encodeURIComponent(searchValue)}&type=pol&mode=${mode}`)
                .then(r => r.json())
                .then(data => {
                    if (data.length > 0) {
                        let html = '';
                        data.forEach(port => {
                            const isActive = '{{ $pol_id }}' == port.id ? 'active' : '';
                            html += `<div class="search-result-item ${isActive}" onclick="selectPOL(${port.id}, '${port.port_name}')">
                                        <span class="port-name">${port.port_name}</span>
                                        <span class="port-code">(${port.port_code})</span>
                                     </div>`;
                        });
                        resultsContainer.innerHTML = html;
                    } else {
                        resultsContainer.innerHTML = '<div class="no-results">No ports found</div>';
                    }
                    resultsContainer.style.display = 'block';
                })
                .catch(() => resultsContainer.style.display = 'none');
        }, 300);
    });

    document.getElementById('podSearchInput').addEventListener('input', function() {
        const searchValue    = this.value.trim();
        const resultsContainer = document.getElementById('podSearchResults');
        const mode           = document.getElementById('typeInput').value;
        clearTimeout(podSearchTimeout);
        if (searchValue.length < 2) {
            resultsContainer.style.display = 'none';
            document.querySelectorAll('.pod-badge').forEach(b => b.style.display = 'inline-block');
            return;
        }
        document.querySelectorAll('.pod-badge').forEach(b => b.style.display = 'none');
        podSearchTimeout = setTimeout(() => {
            fetch(`{{ route('sailing-schedule.search-ports') }}?query=${encodeURIComponent(searchValue)}&type=pod&mode=${mode}`)
                .then(r => r.json())
                .then(data => {
                    if (data.length > 0) {
                        let html = '';
                        data.forEach(port => {
                            const isActive = '{{ $pod_id }}' == port.id ? 'active' : '';
                            html += `<div class="search-result-item ${isActive}" onclick="selectPOD(${port.id}, '${port.port_name}')">
                                        <span class="port-name">${port.port_name}</span>
                                        <span class="port-code">(${port.port_code})</span>
                                     </div>`;
                        });
                        resultsContainer.innerHTML = html;
                    } else {
                        resultsContainer.innerHTML = '<div class="no-results">No ports found</div>';
                    }
                    resultsContainer.style.display = 'block';
                })
                .catch(() => resultsContainer.style.display = 'none');
        }, 300);
    });

    function selectPOL(portId, portName) {
        document.getElementById('polInput').value = portId;
        document.getElementById('polSearchInput').value = portName;
        document.getElementById('polSearchResults').style.display = 'none';
        document.querySelectorAll('.pol-badge').forEach(b => {
            b.classList.remove('active');
            if (b.dataset.portId == portId) b.classList.add('active');
            b.style.display = 'inline-block';
        });
    }

    function selectPOD(portId, portName) {
        document.getElementById('podInput').value = portId;
        document.getElementById('podSearchInput').value = portName;
        document.getElementById('podSearchResults').style.display = 'none';
        document.querySelectorAll('.pod-badge').forEach(b => {
            b.classList.remove('active');
            if (b.dataset.portId == portId) b.classList.add('active');
            b.style.display = 'inline-block';
        });
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.input-group')) {
            document.getElementById('polSearchResults').style.display = 'none';
            document.getElementById('podSearchResults').style.display = 'none';
        }
    });

    document.querySelectorAll('.pol-badge').forEach(badge => {
        badge.addEventListener('click', function() {
            document.getElementById('polInput').value = this.dataset.portId;
            document.getElementById('polSearchInput').value = this.dataset.portName;
            document.querySelectorAll('.pol-badge').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('polSearchResults').style.display = 'none';
        });
    });

    document.querySelectorAll('.pod-badge').forEach(badge => {
        badge.addEventListener('click', function() {
            document.getElementById('podInput').value = this.dataset.portId;
            document.getElementById('podSearchInput').value = this.dataset.portName;
            document.querySelectorAll('.pod-badge').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('podSearchResults').style.display = 'none';
        });
    });

    document.getElementById('resetBtn').addEventListener('click', function() {
        window.location.href = '{{ route('sailing-schedule') }}';
    });
</script>
@endsection
