@extends('layouts.landing')

@section('content')
<style>
    :root {
        --ascon-orange: #FF5722;
        --ascon-dark-blue: #2391ff;
        --ascon-light-gray: #f8f9fa;
    }

    .page-header-bg {
        background-color: var(--ascon-light-gray);
        border-bottom: 1px solid #dee2e6;
        padding: 40px 0;
        margin-top: 140px;
    }

    .sailing-schedule-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 30px;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 40px;
    }

    .form-label-custom {
        font-size: 0.85rem;
        font-weight: 600;
        color: #666;
        margin-bottom: 5px;
    }

    .filter-select {
        height: 45px;
        font-size: 0.9rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        padding: 5px 10px;
        width: 100%;
        color: #272727;
        outline: none;
        transition: border-color 0.2s;
    }

    .filter-select:focus {
        border-color: var(--ascon-dark-blue);
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

    .btn-search-new {
        background-color: transparent;
        color: var(--ascon-orange);
        border: 2px solid var(--ascon-orange);
        font-weight: 600;
        height: 45px;
        border-radius: 5px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-search-new:hover {
        background-color: var(--ascon-orange);
        color: white;
    }

    .btn-reset-new {
        background-color: #fcd116;
        /* Kuning emas */
        color: #272727;
        font-weight: 600;
        height: 45px;
        border: none;
        border-radius: 5px;
        transition: background-color 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        width: 100%;
    }

    .btn-reset-new:hover {
        background-color: #e5be10;
        color: #272727;
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
</style>

<!-- Header -->
<div class="page-header-bg">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sailing Schedule {{ $type == 'Export' ? 'Export'
                    : 'Import' }}</li>
            </ol>
        </nav>
        <h2 class="fw-bold mb-0" style="color: var(--ascon-orange);">{{ $type == 'Export' ? 'Export' : 'Import' }} LCL
        </h2>
    </div>
</div>

<div class="container py-5">
    <!-- Filter Form -->
    {{-- hide sementara --}}
    {{-- <div class="sailing-schedule-card">
        <form id="sailingFilterForm" action="{{ route('sailing-schedule') }}" method="GET">
            <input type="hidden" name="type" value="{{ $type }}">
            <div class="row g-3 align-items-end">
                <!-- POL -->
                <div class="col-lg-3 col-md-6 col-12">
                    <label class="form-label-custom">Port of loading</label>
                    <select name="pol_id" class="filter-select" onchange="this.form.submit()">
                        <option value="">-- SELECT POL --</option>
                        @if($type == 'Export')
                        <optgroup label="Local Ports">
                            @foreach($localPorts as $port)
                            <option value="{{ $port->id }}" {{ $pol_id==$port->id ? 'selected' : '' }}>
                                {{ strtoupper($port->port_name) }} ({{ strtoupper($port->port_code) }})
                            </option>
                            @endforeach
                        </optgroup>
                        @else
                        <optgroup label="International Ports">
                            @foreach($internationalPorts as $port)
                            <option value="{{ $port->id }}" {{ $pol_id==$port->id ? 'selected' : '' }}>
                                {{ strtoupper($port->port_name) }} ({{ strtoupper($port->port_code) }})
                            </option>
                            @endforeach
                        </optgroup>
                        @endif
                    </select>
                </div>

                <!-- POD -->
                <div class="col-lg-3 col-md-6 col-12">
                    <label class="form-label-custom">Port of destination</label>
                    <select name="pod_id" class="filter-select">
                        <option value="">-- SELECT POD --</option>
                        @if($type == 'Export')
                        <optgroup label="International Ports">
                            @foreach($destinationInternationalPorts as $port)
                            <option value="{{ $port->id }}" {{ $pod_id==$port->id ? 'selected' : '' }}>
                                {{ strtoupper($port->port_name) }} ({{ strtoupper($port->port_code) }})
                            </option>
                            @endforeach
                        </optgroup>
                        @else
                        <optgroup label="Local Ports">
                            @foreach($destinationLocalPorts as $port)
                            <option value="{{ $port->id }}" {{ $pod_id==$port->id ? 'selected' : '' }}>
                                {{ strtoupper($port->port_name) }} ({{ strtoupper($port->port_code) }})
                            </option>
                            @endforeach
                        </optgroup>
                        @endif
                    </select>
                </div>

                <!-- ETD -->
                <div class="col-lg-3 col-md-6 col-12">
                    <label class="form-label-custom">Estimated Time Departure (ETD)</label>
                    <select name="etd_month" class="filter-select" onchange="this.form.submit()">
                        <option value="">-- SELECT ETD MONTH --</option>
                        @foreach($etdMonths as $m)
                        <option value="{{ $m->month_val }}" {{ $etd_month==$m->month_val ? 'selected' : '' }}>
                            {{ strtoupper($m->month_label) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-search-new text-uppercase">Search</button>
                        <a href="?type={{ $type }}" class="btn-reset-new text-uppercase">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div> --}}

    <!-- Grouped Schedules Display -->
    @if($groupedSchedules->count() > 0)
    @foreach($groupedSchedules as $route => $routeSchedules)
    @php
    $columns = $columnsPerRoute[$route];
    $hasConnecting = str_contains(strtoupper($route), 'JAPAN') ? false : $columns['has_connecting'];
    $hasEtaText = $columns['has_eta_text'];
    $hasRemarks = $columns['has_remarks'];
    $etaDestinations = $columns['eta_destinations'];
    $customLabels = $routeColumnLabels[$route] ?? [];
    $labelEtd = $customLabels['etd'] ?? 'ETD';
    $labelEta = $customLabels['eta_destination'] ?? 'ETA';

    $hasConnecting2 = $routeSchedules->contains(fn($s) => !empty($s->eta_nha) || !empty($s->connecting2_vessel) || !empty($s->connecting2_voyage) || !empty($s->connecting2_etd));
    $hasEtaKlf = $routeSchedules->contains(fn($s) => !empty($s->eta_klf));
    // Hitung total kolom
    $totalColumns = 3; // Vessel, Voy, ETD
    $totalColumns++; // ETA (eta_destination)
    $totalColumns += count($etaDestinations);
    if ($hasEtaText) $totalColumns++;
    if ($hasConnecting) {
        $totalColumns += 3; // 1st Connecting vessel, Voy, ETD
        if ($hasConnecting2) $totalColumns += 4; // ETA NHA, 2nd Connecting vessel, Voy, ETD NHA
        if ($hasEtaKlf) $totalColumns += 2; // ETA KLF, 3rd Connecting (connecting_klf)
        $totalColumns += 1; // ETA final (connecting_eta)
    }
    if ($hasRemarks) $totalColumns++;
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
                        $etaLabel = $customLabels[$etaFieldKey] ?? "ETA {$etaNum}";
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
                        <td class="fw-bold">{{ $schedule->vessel }}</td>
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
                        <td class="fw-bold text-primary">{{ $schedule->connecting_vessel ?? '-' }}</td>
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
                        <td class="fw-bold text-primary">{{ $schedule->connecting2_vessel ?? '-' }}</td>
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
        <a href="{{ route('sailing-schedule.download-pdf', ['type' => $type, 'service' => 'LCL', 'pol_id' => $pol_id, 'pod_id' => $pod_id]) }}"
            class="btn btn-danger btn-sm px-4" target="_blank">
            <i class="ti ti-download me-2"></i>Download PDF
        </a>
    </div>
    @else
    <div class="col-12 mt-5">
        <div class="no-data-message shadow-sm border rounded p-5 text-center bg-white">
            <p class="mb-0 text-muted">
                Oops! Sorry schedule you are looking for is not available right now.
            </p>
        </div>
    </div>
    @endif
</div>
@endsection