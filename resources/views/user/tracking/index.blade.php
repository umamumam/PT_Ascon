<x-app-user-layout>
    @push('styles')
    <style>
        /* ── Right Welcome Dashed Card ── */
        .welcome-dashed-card {
            background-color: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 16px;
            padding: 4rem 2rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 480px;
            transition: all 0.3s ease;
        }

        .welcome-dashed-card img.illustration {
            max-width: 280px;
            height: auto;
            margin-bottom: 2rem;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.05));
        }

        .not-found-dashed-card img.illustration {
            max-width: 120px;
            height: auto;
            margin-bottom: 2rem;
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.05));
        }

        .welcome-dashed-card h4 {
            color: #0f4c81;
            font-weight: 800;
            font-size: 1.35rem;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .welcome-dashed-card p {
            color: #64748b;
            font-size: 0.9rem;
            max-width: 480px;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* ── Welcome Badges / Pills ── */
        .welcome-pills-wrap {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .welcome-pill {
            background-color: #f1f5f9;
            color: #334155;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            border: 1px solid #e2e8f0;
        }

        .welcome-pill i {
            font-size: 0.85rem;
        }

        /* ── Not Found Dashed Card ── */
        .not-found-dashed-card {
            background-color: #fff8f8;
            border: 2px dashed #fecaca;
            border-radius: 16px;
            padding: 3.5rem 2rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 480px;
        }

        .not-found-dashed-card i {
            font-size: 3.5rem;
            color: #ef4444;
            margin-bottom: 1.5rem;
        }

        .not-found-dashed-card h4 {
            color: #991b1b;
            font-weight: 800;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
        }

        .not-found-dashed-card p {
            color: #b91c1c;
            font-size: 0.88rem;
            max-width: 480px;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* ── Result Detail Header Card ── */
        .result-header-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            background: white;
        }

        .result-header-card .card-header {
            background: linear-gradient(135deg, #0f4c81, #2391ff);
            color: white;
            padding: 1.25rem 1.5rem;
            border: none;
        }

        .result-header-card .card-header .badge-status {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 1.25rem;
            padding: 1.5rem;
        }

        .info-item label {
            font-size: 0.72rem;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 4px;
        }

        .info-item span {
            font-size: 0.92rem;
            font-weight: 600;
            color: #1e293b;
        }

        /* ── Connecting Vessels ── */
        .vessel-badge {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .vessel-badge i {
            font-size: 1.4rem;
            color: #ea580c;
        }

        .vessel-badge .vessel-name {
            font-weight: 700;
            font-size: 0.88rem;
            color: #1f2937;
        }

        .vessel-badge .vessel-dates {
            font-size: 0.78rem;
            color: #6c757d;
        }

        /* ── Timeline Progress ── */
        .timeline-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            background: white;
        }

        .timeline-card .card-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            font-weight: 700;
            font-size: 0.95rem;
            color: #0f4c81;
            border-radius: 12px 12px 0 0 !important;
        }

        /* ── Shipment Updates (Public Style matching) ── */
        .update-section {
            background: linear-gradient(135deg, #0f4c81, #2391ff);
            color: white;
            padding: 12px;
            border-radius: 12px 12px 0 0;
            font-weight: 600;
            font-size: 0.9rem;
            text-align: center;
        }

        .update-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
            font-weight: 600;
            font-size: 0.85rem;
            color: #666;
            border-bottom: 1px solid #dee2e6;
        }

        .update-row {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.85rem;
        }

        .update-row:last-child {
            border-bottom: none;
        }

        .status-label {
            font-weight: 600;
            color: #1e293b;
            min-width: 100px;
            display: inline-block;
        }
    </style>
    @endpush

    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Page Header & Search Bar (Gateway Style) -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="color: #0f4c81;">Shipment Tracking - {{ $type }} LCL</h4>
                <p class="text-dark mb-0" style="font-size: 0.9rem;">
                    Live tracking with arrival forecasts — concise, clear, and supply-chain friendly ({{ $type }} LCL).
                </p>
            </div>
            <div>
                <form method="GET" action="{{ route('user.tracking.index', ['type' => $type]) }}" class="d-flex gap-2">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <input type="text" name="bl_number" class="form-control" placeholder="Enter HBL Number..."
                        value="{{ $blNumber ?? '' }}"
                        style="width: 300px; border-radius: 8px; border: 1.5px solid #dee2e6; padding: 0.6rem 0.9rem; font-size: 0.9rem; background: white;"
                        required>
                    <button type="submit" class="btn btn-primary"
                        style="background: linear-gradient(135deg, #0f4c81, #2391ff); border: none; font-weight: 700; border-radius: 8px; padding: 0.6rem 1.5rem; text-transform: uppercase; font-size: 0.85rem;">
                        Track
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="mt-2">
            @if($searched)
            @if($tracking)
            {{-- ── Shipment Info Header ── --}}
            <div class="card result-header-card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div>
                        <h5 class="mb-1 fw-bold text-white" style="font-size: 1.1rem;">BL No: {{ $tracking->bl_number }}
                        </h5>
                        <div style="font-size: 0.85rem; opacity: 0.85;">
                            {{ $tracking->origin }} → {{ $tracking->destination }}
                        </div>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge-status">{{ $tracking->type }}</span>
                        <span class="badge-status">{{ $tracking->shipment_type }}</span>
                    </div>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <label>Shipper</label>
                        <span>{{ $tracking->shipper ?: '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>Consignee</label>
                        <span>{{ $tracking->consignee ?: '-' }}</span>
                    </div>
                    @if($tracking->container_number)
                    <div class="info-item">
                        <label>Container No</label>
                        <span>{{ $tracking->container_number }}</span>
                    </div>
                    @endif
                    @if($tracking->size_type)
                    <div class="info-item">
                        <label>Size / Type</label>
                        <span>{{ $tracking->size_type }}</span>
                    </div>
                    @endif
                    @if($tracking->total_packages)
                    <div class="info-item">
                        <label>Total Packages</label>
                        <span>{{ $tracking->total_packages }}</span>
                    </div>
                    @endif
                    @if($tracking->total_measurement)
                    <div class="info-item">
                        <label>Measurement</label>
                        <span>{{ $tracking->total_measurement }}</span>
                    </div>
                    @endif
                </div>

                <!-- Separator line -->
                <hr class="my-0" style="border-top: 1px dashed #dee2e6;">

                {{--
                <!-- Vessel Information Section Header -->
                <div class="card-header border-bottom d-flex align-items-center gap-2"
                    style="background: #f8fafc; padding: 1rem 1.5rem;">
                    <span class="fw-bold"
                        style="color: #0f4c81; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="ti ti-ship" style="font-size: 1.2rem;"></i> Vessel Information
                    </span>
                </div>

                <!-- Vessel Information Grid -->
                <div class="info-grid" style="background: white;">
                    <div class="info-item">
                        <label>Vessel / Voyage</label>
                        <span>{{ $tracking->vessel_voyage ?: '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>ETD {{ $tracking->origin }}</label>
                        <span>{{ $tracking->etd ? \Carbon\Carbon::parse($tracking->etd)->format('d/m/Y') : '-' }}</span>
                    </div>
                    <div class="info-item">
                        <label>ETA {{ $tracking->destination }}</label>
                        <span>{{ $tracking->eta ? \Carbon\Carbon::parse($tracking->eta)->format('d/m/Y') : '-' }}</span>
                    </div>
                </div> --}}
            </div>

            {{-- ── Connecting Vessels ── --}}
            @if(count($connectingVessels) > 0)
            <div class="card mb-4"
                style="border-radius: 12px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); background: white;">
                <div class="card-header"
                    style="background: #fff7ed; border-bottom: 1px solid #fed7aa; border-radius: 12px 12px 0 0 !important;">
                    <span class="fw-bold" style="color: #ea580c; font-size: 0.95rem;">
                        <i class="ti ti-transfer me-1"></i> Connecting Vessels
                    </span>
                </div>
                <div class="card-body p-3">
                    <div class="row g-3">
                        @foreach($connectingVessels as $cv)
                        <div class="col-md-4">
                            <div class="vessel-badge">
                                <i class="ti ti-ship"></i>
                                <div>
                                    <div class="vessel-name">{{ $cv['vessel'] }}</div>
                                    <div class="vessel-dates">
                                        ETD: {{ $cv['etd'] ? \Carbon\Carbon::parse($cv['etd'])->format('d M Y') : '-' }}
                                        &nbsp;|&nbsp;
                                        ETA: {{ $cv['eta'] ? \Carbon\Carbon::parse($cv['eta'])->format('d M Y') : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- ── Shipment Updates Section ── --}}
            @if($tracking->details && $tracking->details->count() > 0)
            @php
            $details = $tracking->sorted_details ?? collect();

            $mainDetail = $details->first(fn($d) => empty($d->sequence) || strtolower($d->sequence) === 'main') ??
            $details->first();

            $mainVessel = $mainDetail->vessel_information ?? $tracking->vessel_voyage;
            $mainPol = $mainDetail->place_of_activity ?? $tracking->origin;
            $mainEtd = $mainDetail->date_of_departure ?? null;
            $mainPod = $mainDetail->port_of_arrival ?? $tracking->destination;
            $mainEta = $mainDetail->date_of_arrival ?? null;
            $mainRemarks = $mainDetail->remarks ?? '-';

            $mainLeg = [
            'vessel' => $mainVessel ?: '-',
            'pol' => $mainPol ?: '-',
            'etd' => $mainEtd ? \Carbon\Carbon::parse($mainEtd)->format('d/m/Y') : '-',
            'pod' => $mainPod ?: '-',
            'eta' => $mainEta ? \Carbon\Carbon::parse($mainEta)->format('d/m/Y') : '-',
            'remarks' => $mainRemarks ?: '-',
            ];

            $sequences = ['1st', '2nd', '3rd'];
            $updateLegs = [];

            foreach ($sequences as $seq) {
            $seqDetail = $details->first(fn($d) => strtolower($d->sequence ?? '') === strtolower($seq));
            if ($seqDetail) {
            $rawVessel = $seqDetail->vessel_information ?: 'Connecting Vessel';
            $vesselDisplay = str_starts_with(strtolower($rawVessel), strtolower($seq))
            ? $rawVessel
            : $seq . ' ' . $rawVessel;

            $updateLegs[$seq] = [
            'vessel' => $vesselDisplay,
            'pol' => $seqDetail->place_of_activity ?: '-',
            'etd' => $seqDetail->date_of_departure ?
            \Carbon\Carbon::parse($seqDetail->date_of_departure)->format('d/m/Y') : '-',
            'pod' => $seqDetail->port_of_arrival ?: '-',
            'eta' => $seqDetail->date_of_arrival ? \Carbon\Carbon::parse($seqDetail->date_of_arrival)->format('d/m/Y') :
            '-',
            'remarks' => $seqDetail->remarks ?: '-',
            ];
            }
            }
            @endphp

            <div class="card mb-4"
                style="border-radius: 8px; border: 1px solid #4171c6; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                <div
                    style="background-color: #4171c6; color: white; text-align: center; font-weight: 700; padding: 10px 16px; font-size: 1.05rem; text-transform: uppercase; letter-spacing: 0.5px;">
                    Shipment Updates
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered mb-0 align-middle text-center"
                        style="font-size: 0.88rem; border-color: #cbd5e1;">
                        <thead style="background-color: #d9d9d9; color: #000; font-weight: 700;">
                            <tr>
                                <th
                                    style="background-color: #d9d9d9; color: #000; font-weight: 700; text-align: left; padding: 10px 12px; width: 22%;">
                                    Vessel Information</th>
                                <th
                                    style="background-color: #d9d9d9; color: #000; font-weight: 700; text-align: left; padding: 10px 12px; width: 17%;">
                                    Place of Activity</th>
                                <th
                                    style="background-color: #d9d9d9; color: #000; font-weight: 700; text-align: center; padding: 10px 12px; width: 15%;">
                                    Date of Depature</th>
                                <th
                                    style="background-color: #d9d9d9; color: #000; font-weight: 700; text-align: left; padding: 10px 12px; width: 17%;">
                                    Port of Arrival</th>
                                <th
                                    style="background-color: #d9d9d9; color: #000; font-weight: 700; text-align: center; padding: 10px 12px; width: 15%;">
                                    Date of Arrival</th>
                                <th
                                    style="background-color: #d9d9d9; color: #000; font-weight: 700; text-align: center; padding: 10px 12px; width: 14%;">
                                    Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Main Leg Row -->
                            <tr>
                                <td class="fw-bold text-start px-3" style="color: #1e293b;">{{ $mainLeg['vessel'] }}
                                </td>
                                <td class="text-start px-3">{{ $mainLeg['pol'] }}</td>
                                <td class="text-center">{{ $mainLeg['etd'] }}</td>
                                <td class="text-start px-3">{{ $mainLeg['pod'] }}</td>
                                <td class="text-center">{{ $mainLeg['eta'] }}</td>
                                <td class="text-center">{{ $mainLeg['remarks'] }}</td>
                            </tr>

                            <!-- Sequence Updates -->
                            @foreach(['1st', '2nd', '3rd'] as $seq)
                            @if(isset($updateLegs[$seq]))
                            <tr>
                                <td class="fw-bold text-start px-3" style="color: #1e293b;">{{
                                    $updateLegs[$seq]['vessel'] }}</td>
                                <td class="text-start px-3">{{ $updateLegs[$seq]['pol'] }}</td>
                                <td class="text-center">{{ $updateLegs[$seq]['etd'] }}</td>
                                <td class="text-start px-3">{{ $updateLegs[$seq]['pod'] }}</td>
                                <td class="text-center">{{ $updateLegs[$seq]['eta'] }}</td>
                                <td class="text-center">{{ $updateLegs[$seq]['remarks'] }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="card p-4 text-center text-dark shadow-sm mb-4" style="border-radius: 12px; border: none;">
                Belum ada detail progress untuk shipment ini.
            </div>
            @endif

            @else
            {{-- ── BL Tidak Ditemukan State (Dashed Card) ── --}}
            <div class="not-found-dashed-card">
                <img src="{{ asset('assets/img/illustrations/page-misc-error.png') }}" alt="Shipment Not Found"
                    class="illustration">
                <h4>Shipment Not Found</h4>
                <p>
                    BL Number <strong>{{ $blNumber }}</strong> could not be found in our active <strong>{{ $type }}
                        LCL</strong> database. Please make sure the BL Number belongs to <strong>{{ $type }}
                        LCL</strong> shipments.
                </p>
            </div>
            @endif
            @else
            {{-- ── Default Welcome State (Dashed Card dengan Image & Pills) ── --}}
            <div class="welcome-dashed-card">
                <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}" alt="Ready to Track"
                    class="illustration">
                <h4>Ready to Track</h4>
                <p>
                    Enter your HBL Number above to see real-time location, vessel details, and journey milestones.
                </p>
                <!-- Badge Pills -->
                <div class="welcome-pills-wrap">
                    <span class="welcome-pill">
                        <i class="ti ti-sparkles" style="color: #FF5722;"></i> Predictive Tracking
                    </span>
                    <span class="welcome-pill">
                        <i class="ti ti-ship" style="color: #2391ff;"></i> Vessel Details
                    </span>
                    <span class="welcome-pill">
                        <i class="ti ti-calendar" style="color: #10b981;"></i> ATD / ATA Updates
                    </span>
                </div>
            </div>
            @endif
        </div>

    </div>
</x-app-user-layout>