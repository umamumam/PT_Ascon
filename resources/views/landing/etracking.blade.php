@extends('layouts.landing')

@section('content')
<style>
    :root {
        --ascon-orange: #FF5722;
        --ascon-dark-blue: #2391ff;
        --ascon-light-gray: #f8f9fa;
    }

    .tracking-card {
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
        font-weight: bold;
    }

    .btn-search:hover {
        background-color: var(--ascon-orange);
        color: white;
    }

    .info-table {
        background-color: var(--ascon-dark-blue);
        color: white;
    }

    .info-table th {
        font-weight: 500;
        font-size: 0.85rem;
        padding: 12px;
        text-align: center;
        border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .info-table th:last-child {
        border-right: none;
    }

    .info-table td {
        padding: 12px;
        text-align: center;
        background-color: white;
        color: #333;
        font-size: 0.85rem;
        border-right: 1px solid #dee2e6;
    }

    .info-table td:last-child {
        border-right: none;
    }

    .info-table td.highlight {
        color: var(--ascon-orange);
        font-weight: 600;
    }

    .update-section {
        background-color: var(--ascon-dark-blue);
        color: white;
        padding: 12px;
        border-radius: 5px 5px 0 0;
        font-weight: 600;
        font-size: 0.9rem;
        text-align: center;
    }

    .update-header {
        background-color: #f8f9fa;
        padding: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        color: #666;
        border-bottom: 1px solid #dee2e6;
    }

    .update-row {
        padding: 10px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.85rem;
    }

    .update-row:last-child {
        border-bottom: none;
    }

    .status-label {
        font-weight: 600;
        color: #666;
        min-width: 100px;
        display: inline-block;
    }

    .form-check-input:checked {
        background-color: var(--ascon-orange);
        border-color: var(--ascon-orange);
    }
</style>

<div class="container py-5 mb-5" style="margin-top: 7em;">
    <div class="row">
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">eService</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tracking</li>
                </ol>
            </nav>
            <h1 class="fw-bold" style="color: var(--ascon-orange);">Tracking</h1>
            <p class="text-muted" style="text-align: justify; font-size: 0.95rem;">
                PT. Asia Connexindo Internasional (Ascon) was established in 1999, to facilitate the needs of
                trustworthy freight forwarding agent in Jakarta. Two decades ago, it started with small team and handled
                only consolidation groupage, however we are now growing and serving wide spectrum of transportation
                needs.
            </p>
        </div>

        <div class="col-12">
            <form method="GET" action="{{ route('public.tracking') }}" id="trackingForm">
                <div class="tracking-card shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold m-0">Trace your package</h5>
                        <div class="d-flex align-items-center">
                            <span class="me-2 small fw-bold" style="color: var(--ascon-orange);"
                                id="exportLabel">Export</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="modeSwitch" name="type_switch" {{
                                    $type=='Import' ? 'checked' : '' }}>
                            </div>
                            <span class="ms-1 small text-muted" id="importLabel">Import</span>
                        </div>
                        <input type="hidden" name="type" id="typeInput" value="{{ $type }}">
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label-custom">Service Category</label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="service-box {{ $shipmentType == 'LCL' ? 'active' : '' }} d-flex flex-column align-items-start"
                                        data-type="LCL">
                                        <img src="{{ asset('LCL.png') }}" alt="LCL">
                                        <span
                                            class="small fw-bold {{ $shipmentType == 'LCL' ? '' : 'text-muted' }}">Less
                                            than Container Load / LCL</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="service-box {{ $shipmentType == 'FCL' ? 'active' : '' }} d-flex flex-column align-items-start"
                                        data-type="FCL">
                                        <img src="{{ asset('FCL.png') }}" alt="FCL">
                                        <span
                                            class="small fw-bold {{ $shipmentType == 'FCL' ? '' : 'text-muted' }}">Full
                                            Container Load / FCL</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="shipment_type" id="shipmentTypeInput"
                                value="{{ $shipmentType }}">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label-custom">Track your BL number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="ti ti-search"></i></span>
                                <input type="text" name="bl_number" class="form-control bl-input border-start-0"
                                    placeholder="Enter BL number" value="{{ $blNumber ?? '' }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-md-10">
                            <button type="submit" class="btn-search text-uppercase">Search</button>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-secondary w-100" style="padding: 12px;"
                                onclick="window.location.href='{{ route('public.tracking') }}'">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @if(!$blNumber)
        <!-- Empty State - Before Search -->
        <div class="col-12 mt-5">
            <div class="text-center py-5" style="background: #fff; border-radius: 8px; border: 1px solid #e0e0e0;">
                <div class="mb-4">
                    <img src="{{ asset('undraw.png') }}" alt="No Data" style="width:250px;">
                </div>
                {{-- <h5 class="fw-bold mb-3" style="color: #333;">Track Your Shipment</h5> --}}
                <p class="mb-0" style="max-width: 500px; margin: 0 auto; font-size: 0.95rem;">
                    Enter your Bill of Lading (BL) number to track your shipment and view the latest package
                    status in real time.
                </p>
            </div>
        </div>
        @endif

        @if($tracking)
        <!-- BL Number Information Section -->
        <div class="col-12 mt-5">
            <div class="shadow-sm border rounded">
                <div class="update-section">
                    BL Number Information
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 info-table">
                        <thead class="bg-light">
                            <tr>
                                <th>Shipper</th>
                                <th>Consignee</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Booking/BL Number</th>
                                <th>Shipment Type</th>
                                @if($tracking->shipment_type == 'LCL')
                                <th>Total Measurement</th>
                                <th>Total Packages</th>
                                @else
                                <th>Container Number</th>
                                <th>Size Type</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $tracking->shipper }}</td>
                                <td>{{ $tracking->consignee }}</td>
                                <td>{{ $tracking->origin }}</td>
                                <td>{{ $tracking->destination }}</td>
                                <td class="highlight">{{ $tracking->bl_number }}</td>
                                <td>{{ $tracking->shipment_type }}</td>
                                @if($tracking->shipment_type == 'LCL')
                                <td>{{ $tracking->total_measurement ?? '-' }}</td>
                                <td>{{ $tracking->total_packages ?? '-' }}</td>
                                @else
                                <td>{{ $tracking->container_number ?? '-' }}</td>
                                <td>{{ $tracking->size_type ?? '-' }}</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Vessel Information Section -->
        {{-- <div class="col-12 mt-4">
            <div class="shadow-sm border rounded">
                <div class="update-section">
                    Vessel Information
                </div>
                <div class="p-3">
                    <div class="d-flex flex-wrap align-items-stretch gap-2">

                        <div class="flex-fill" style="min-width: 200px;">
                            <div class="border rounded p-3 h-100"
                                style="background: #f8fbff; border-color: #2391ff !important;">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge me-2"
                                        style="background-color: #2391ff; font-size: 0.75rem;">Main</span>
                                    <small class="text-muted fw-bold">Vessel</small>
                                </div>
                                <div class="fw-bold mb-2" style="font-size: 0.9rem;">{{ $tracking->vessel_voyage }}
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="text-muted" style="font-size: 0.75rem;">ETD {{ $tracking->origin }}
                                        </div>
                                        <div class="fw-medium" style="font-size: 0.85rem;">{{
                                            \Carbon\Carbon::parse($tracking->etd)->format('d M Y') }}</div>
                                    </div>
                                    <div class="text-end">
                                        <div class="text-muted" style="font-size: 0.75rem;">ETA {{
                                            $tracking->destination }}</div>
                                        <div class="fw-medium" style="font-size: 0.85rem;">{{
                                            \Carbon\Carbon::parse($tracking->eta)->format('d M Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach($connectingVessels as $index => $conn)
                        <div class="d-flex align-items-center">
                            <div class="text-center px-1">
                                <i class="ti ti-arrow-right" style="color: #FF5722; font-size: 1.2rem;"></i>
                            </div>
                        </div>
                        <div class="flex-fill" style="min-width: 200px;">
                            <div class="border rounded p-3 h-100"
                                style="background: #fff8f6; border-color: #FF5722 !important;">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge me-2"
                                        style="background-color: #FF5722; font-size: 0.75rem;">Connecting {{ $index + 1
                                        }}</span>
                                    <small class="text-muted fw-bold">Vessel</small>
                                </div>
                                <div class="fw-bold mb-2" style="font-size: 0.9rem;">{{ $conn['vessel'] }}</div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="text-muted" style="font-size: 0.75rem;">ETD</div>
                                        <div class="fw-medium" style="font-size: 0.85rem;">
                                            {{ $conn['etd'] ? \Carbon\Carbon::parse($conn['etd'])->format('d M Y') : '-'
                                            }}
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <div class="text-muted" style="font-size: 0.75rem;">ETA</div>
                                        <div class="fw-medium" style="font-size: 0.85rem;">
                                            {{ $conn['eta'] ? \Carbon\Carbon::parse($conn['eta'])->format('d M Y') : '-'
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Vessel Information Section -->
        <div class="col-12 mt-4">
            <div class="shadow-sm border rounded">
                <div class="update-section">
                    Vessel Information
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center" style="font-weight: 600; font-size: 0.85rem; padding: 12px;">
                                    Vessel Voyage</th>
                                <th class="text-center" style="font-weight: 600; font-size: 0.85rem; padding: 12px;">ETD
                                    {{ $tracking->origin }}</th>
                                <th class="text-center" style="font-weight: 600; font-size: 0.85rem; padding: 12px;">ETA
                                    {{ $tracking->destination }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center" style="padding: 12px; font-size: 0.85rem;">{{
                                    $tracking->vessel_voyage }}</td>
                                <td class="text-center" style="padding: 12px; font-size: 0.85rem;">{{
                                    \Carbon\Carbon::parse($tracking->etd)->format('d/m/Y') }}</td>
                                <td class="text-center" style="padding: 12px; font-size: 0.85rem;">{{
                                    \Carbon\Carbon::parse($tracking->eta)->format('d/m/Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if(count($connectingVessels) > 0)
        <div class="col-12 mt-3">
            <div class="shadow-sm border rounded">
                <div class="update-section">
                    Connecting Vessel Information
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center" style="font-weight: 600; font-size: 0.85rem; padding: 12px;">#
                                </th>
                                <th class="text-center" style="font-weight: 600; font-size: 0.85rem; padding: 12px;">
                                    Connecting Vessel</th>
                                <th class="text-center" style="font-weight: 600; font-size: 0.85rem; padding: 12px;">ETD
                                </th>
                                <th class="text-center" style="font-weight: 600; font-size: 0.85rem; padding: 12px;">ETA
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $ordinals = ['1st', '2nd', '3rd'];
                            @endphp

                            @foreach($connectingVessels as $index => $conn)
                            <tr>
                                <td class="text-center" style="padding: 12px; font-size: 0.85rem;">
                                    <span class="badge" style="background-color: #FF5722;">
                                        {{ $ordinals[$index] ?? ($index + 1) . 'th' }}
                                    </span>
                                </td>
                                <td class="text-center" style="padding: 12px; font-size: 0.85rem;">{{ $conn['vessel'] }}
                                </td>
                                <td class="text-center" style="padding: 12px; font-size: 0.85rem;">
                                    {{ $conn['etd'] ? \Carbon\Carbon::parse($conn['etd'])->format('d/m/Y') : '-' }}
                                </td>
                                <td class="text-center" style="padding: 12px; font-size: 0.85rem;">
                                    {{ $conn['eta'] ? \Carbon\Carbon::parse($conn['eta'])->format('d/m/Y') : '-' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Shipment Updates Section -->
        @if($tracking->details && $tracking->details->count() > 0)
        <div class="col-12 mt-4">
            <div class="shadow-sm border rounded">
                <div class="update-section">
                    Shipment Updates
                </div>

                <!-- Update Header -->
                <div class="row update-header m-0 bg-light">
                    <div class="col-md-3">STATUS</div>
                    <div class="col-md-3">Place of Activity</div>
                    <div class="col-md-2">Date</div>
                    <div class="col-md-3">Vessel Information</div>
                    <div class="col-md-1">Remarks</div>
                </div>

                @php
                $nullSequenceDetails = $tracking->details->whereNull('sequence');
                $hasNullSequence = $nullSequenceDetails->count() > 0;
                @endphp

                @if($hasNullSequence)
                <!-- Data tanpa sequence (null) ditampilkan pertama -->
                <div class="bg-white p-3">
                    @foreach($nullSequenceDetails as $detail)
                    <div class="row update-row align-items-center">
                        <div class="col-md-3"><span class="status-label">{{ ucfirst($detail->status) }}</span></div>
                        <div class="col-md-3">{{ $detail->place_of_activity }}</div>
                        <div class="col-md-2">{{ \Carbon\Carbon::parse($detail->date)->format('d/m/Y') }}</div>
                        <div class="col-md-3">{{ $detail->vessel_information ?? '-' }}</div>
                        <div class="col-md-1 text-center">{{ $detail->remarks ?? '-' }}</div>
                    </div>
                    @endforeach
                </div>
                @endif

                @foreach($groupedDetails as $sequence => $details)
                <!-- Sequence Label -->
                <div class="bg-light py-2 px-3 border-top border-bottom">
                    <strong>{{ $sequence }} Update</strong>
                </div>

                <!-- Updates dengan sequence -->
                <div class="bg-white p-3">
                    @foreach($details as $detail)
                    <div class="row update-row align-items-center">
                        <div class="col-md-3"><span class="status-label">{{ ucfirst($detail->status) }}</span></div>
                        <div class="col-md-3">{{ $detail->place_of_activity }}</div>
                        <div class="col-md-2">{{ \Carbon\Carbon::parse($detail->date)->format('d/m/Y') }}</div>
                        <div class="col-md-3">{{ $detail->vessel_information ?? '-' }}</div>
                        <div class="col-md-1 text-center">{{ $detail->remarks ?? '-' }}</div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @elseif($blNumber)
        <div class="col-12 mt-5 mb-5">
            <div class="text-center py-5" style="background: #fff3e0; border-radius: 8px; border: 2px solid #FF5722;">
                <div class="mb-4">
                    <svg width="180" height="180" viewBox="0 0 180 180" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Folder -->
                        <path
                            d="M30 50 L30 140 C30 145 35 150 40 150 L140 150 C145 150 150 145 150 140 L150 60 C150 55 145 50 140 50 L100 50 L90 40 L40 40 C35 40 30 45 30 50 Z"
                            fill="#f8f9fa" stroke="#dee2e6" stroke-width="2" />

                        <!-- Folder tab -->
                        <path d="M30 50 L30 55 L150 55 L150 50" fill="#e0e0e0" />

                        <!-- Search icon in folder -->
                        <circle cx="90" cy="95" r="22" fill="none" stroke="#FF5722" stroke-width="3" />
                        <line x1="107" y1="112" x2="120" y2="125" stroke="#FF5722" stroke-width="3"
                            stroke-linecap="round" />

                        <!-- X mark inside search -->
                        <line x1="82" y1="87" x2="98" y2="103" stroke="#FF5722" stroke-width="2.5"
                            stroke-linecap="round" />
                        <line x1="98" y1="87" x2="82" y2="103" stroke="#FF5722" stroke-width="2.5"
                            stroke-linecap="round" />

                        <!-- Question marks floating -->
                        <text x="35" y="80" font-family="Arial" font-size="20" fill="#FF5722" opacity="0.6">?</text>
                        <text x="130" y="75" font-family="Arial" font-size="18" fill="#FF5722" opacity="0.5">?</text>
                        <text x="125" y="120" font-family="Arial" font-size="16" fill="#FF5722" opacity="0.4">?</text>
                    </svg>
                </div>
                <div style="max-width: 600px; margin: 0 auto;">
                    <h5 class="fw-bold mb-3" style="color: #FF5722;">
                        <i class="ti ti-alert-circle"></i> Data Not Found
                    </h5>
                    <p class="mb-2" style="color: #666; font-size: 0.95rem;">
                        Tracking data for BL Number <strong style="color: #FF5722;">{{ $blNumber }}</strong> could not
                        be found for:
                    </p>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-2"
                        style="background: white; border-radius: 6px; border: 1px solid #FF5722;">
                        <span class="badge" style="background-color: #FF5722; font-size: 0.85rem;">{{ $type }}</span>
                        <span style="color: #999;">•</span>
                        <span class="badge" style="background-color: #2391ff; font-size: 0.85rem;">{{ $shipmentType
                            }}</span>
                    </div>
                    <p class="text-muted mt-3 mb-0" style="font-size: 0.85rem;">
                        Please ensure the BL Number, Type (Export/Import), and Shipment Type (LCL/FCL) are correct.
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    // Service box selection
    document.querySelectorAll('.service-box').forEach(box => {
        box.addEventListener('click', function() {
            const selectedType = this.getAttribute('data-type');
            document.getElementById('shipmentTypeInput').value = selectedType;

            document.querySelectorAll('.service-box').forEach(b => {
                b.classList.remove('active');
                b.querySelector('span').classList.add('text-muted');
            });
            this.classList.add('active');
            this.querySelector('span').classList.remove('text-muted');
        });
    });

    // Mode switch functionality
    document.getElementById('modeSwitch').addEventListener('change', function() {
        const exportLabel = document.getElementById('exportLabel');
        const importLabel = document.getElementById('importLabel');
        const typeInput = document.getElementById('typeInput');

        if(this.checked) {
            typeInput.value = 'Import';
            importLabel.classList.remove('text-muted');
            importLabel.classList.add('fw-bold');
            importLabel.style.color = 'var(--ascon-orange)';
            exportLabel.classList.remove('fw-bold');
            exportLabel.classList.add('text-muted');
            exportLabel.style.color = '';
        } else {
            typeInput.value = 'Export';
            exportLabel.classList.remove('text-muted');
            exportLabel.classList.add('fw-bold');
            exportLabel.style.color = 'var(--ascon-orange)';
            importLabel.classList.remove('fw-bold');
            importLabel.classList.add('text-muted');
            importLabel.style.color = '';
        }
    });

    // Set initial state on page load
    window.addEventListener('DOMContentLoaded', function() {
        const modeSwitch = document.getElementById('modeSwitch');
        const exportLabel = document.getElementById('exportLabel');
        const importLabel = document.getElementById('importLabel');

        if(modeSwitch.checked) {
            importLabel.classList.remove('text-muted');
            importLabel.classList.add('fw-bold');
            importLabel.style.color = 'var(--ascon-orange)';
            exportLabel.classList.remove('fw-bold');
            exportLabel.classList.add('text-muted');
            exportLabel.style.color = '';
        } else {
            exportLabel.classList.remove('text-muted');
            exportLabel.classList.add('fw-bold');
            exportLabel.style.color = 'var(--ascon-orange)';
            importLabel.classList.remove('fw-bold');
            importLabel.classList.add('text-muted');
            importLabel.style.color = '';
        }
    });
</script>
@endsection
