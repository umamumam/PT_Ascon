<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sailing Schedule</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #000;
            padding: 15px;
            margin: 1cm;
        }

        .header-container {
            border: 2px solid #000;
            padding: 8px 12px;
            margin-bottom: 20px;
            display: table;
            width: 100%;
        }

        .header-content {
            display: table-row;
        }

        .logo-cell {
            display: table-cell;
            width: 100px;
            vertical-align: middle;
            padding-right: 15px;
        }

        .logo {
            max-height: 60px;
            max-width: 90px;
        }

        .company-info-cell {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .company-name {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 2px;
        }

        .company-address {
            font-size: 10px;
            line-height: 1.4;
        }

        .title-section {
            text-align: center;
            margin: 25px 0 20px 0;
        }

        .main-title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .route-section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .route-header {
            background-color: #ff4545;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            margin-bottom: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th {
            background-color: #7eafeb;
            color: #000;
            padding: 5px 6px;
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            border: 1px solid #333;
        }

        td {
            padding: 4px 6px;
            text-align: center;
            border: 1px solid #333;
            font-size: 9px;
        }

        .text-left {
            text-align: left !important;
        }

        .text-nowrap {
            white-space: nowrap;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }

        .remarks-section,
        .warehouse-section {
            margin-top: 20px;
            page-break-inside: avoid;
            font-family: "Courier New", Courier, monospace;
        }

        .remarks-title,
        .warehouse-title {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .remark-item {
            margin-bottom: 5px;
            font-size: 10px;
            line-height: 1.2;
            letter-spacing: 0.2px;
            font-weight: bold;
        }

        .warehouse-info {
            font-size: 10px;
            line-height: 1.4;
        }

        .font-normal {
            font-weight: normal !important;
        }

        .indent-remarks {
            display: inline-block;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header-container">
        <div class="header-content">
            <div class="logo-cell">
                <img src="{{ public_path('Logo.png') }}" alt="Logo" class="logo">
            </div>
            <div class="company-info-cell">
                <div class="company-name">PT. Asia Connexindo Internasional</div>
                <div class="company-address">
                    Soepomo Office Park, Unit O<br>
                    Jl. Prof. Dr. Supomo No. 143 Tebet, Jakarta Selatan 12810<br>
                    Ph : 021-83791179 Fx : 021-83791180
                </div>
            </div>
        </div>
    </div>

    <!-- Title -->
    <div class="title-section">
        <div class="main-title">
            SAILING SCHEDULE {{ $service }} {{ $type }}
            @if($type == 'Export')
            @if($polName && $podName)
            FROM {{ strtoupper($polName) }} TO {{ strtoupper($podName) }}
            @elseif($polName)
            FROM {{ strtoupper($polName) }}
            @elseif($podName)
            TO {{ strtoupper($podName) }}
            @endif
            @else
            @if($polName && $podName)
            FROM {{ strtoupper($polName) }} TO {{ strtoupper($podName) }}
            @elseif($podName)
            TO {{ strtoupper($podName) }}
            @elseif($polName)
            FROM {{ strtoupper($polName) }}
            @endif
            @endif
            - {{ strtoupper($generatedDate) }}
        </div>
    </div>

    <!-- Schedules by Route (Destination) -->
    @forelse($groupedSchedules as $route => $schedules)
    <div class="route-section">
        @php
            $parts         = explode(' - ', $route);
            $destination   = $type == 'Export' ? $parts[1] : $parts[0];
            $firstSchedule = $schedules->first();
            $polCode       = $firstSchedule->pol->port_code ?? '';
            $podCode       = $firstSchedule->pod->port_code ?? '';
            $customLabels  = $routeColumnLabels[$route] ?? [];
            $labelEtd      = $customLabels['etd']             ?? "ETD " . strtoupper($polCode);
            $labelEta      = $customLabels['eta_destination']  ?? 'ETA';
            $labelConnEtd  = $customLabels['connecting_etd']   ?? 'ETD';
            $labelConnEta  = $customLabels['connecting_eta']   ?? "ETA " . strtoupper($podCode);
            $hasEtaText    = $schedules->contains(fn($s) => !empty($s->eta_text));
        @endphp

        <div class="route-header">{{ strtoupper($destination) }}</div>

        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">VESSEL</th>
                    <th style="width: 10%;">VOY.</th>
                    <th style="width: 12%;">{{ strtoupper($labelEtd) }}</th>
                    <th style="width: 12%;">{{ strtoupper($labelEta) }}</th>

                    @foreach($columnsPerRoute[$route]['eta_destinations'] as $destNum)
                    @php $etaLabel = $customLabels["eta_destination{$destNum}"] ?? "ETA DEST {$destNum}"; @endphp
                    <th style="width: 12%;">{{ strtoupper($etaLabel) }}</th>
                    @endforeach

                    @if($hasEtaText)
                    <th style="width: 15%;">ETA TEXT</th>
                    @endif

                    @if($columnsPerRoute[$route]['has_connecting'])
                    <th style="width: 15%;">CONNECTING</th>
                    <th style="width: 10%;">VOY</th>
                    <th style="width: 12%;">{{ strtoupper($labelConnEtd) }}</th>
                    <th style="width: 12%;">{{ strtoupper($labelConnEta) }}</th>
                    @endif

                    <th style="width: 15%;">REMARKS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td class="text-left">{{ strtoupper($schedule->vessel) }}</td>
                    <td>{{ $schedule->voyage }}</td>
                    <td class="text-nowrap">{{ \Carbon\Carbon::parse($schedule->etd)->format('d-M') }}</td>
                    <td class="text-nowrap">
                        {{ $schedule->eta_destination ? \Carbon\Carbon::parse($schedule->eta_destination)->format('d-M') : '-' }}
                    </td>

                    @foreach($columnsPerRoute[$route]['eta_destinations'] as $destNum)
                    @php $etaField = "eta_destination{$destNum}"; @endphp
                    <td class="text-nowrap">
                        {{ $schedule->$etaField ? \Carbon\Carbon::parse($schedule->$etaField)->format('d-M') : '-' }}
                    </td>
                    @endforeach

                    @if($hasEtaText)
                    <td>{{ $schedule->eta_text ?? '-' }}</td>
                    @endif

                    @if($columnsPerRoute[$route]['has_connecting'])
                    <td>{{ $schedule->connecting_vessel ?? '-' }}</td>
                    <td>{{ $schedule->connecting_voyage ?? '-' }}</td>
                    <td class="text-nowrap">
                        {{ $schedule->connecting_etd ? \Carbon\Carbon::parse($schedule->connecting_etd)->format('d-M') : '-' }}
                    </td>
                    <td class="text-nowrap">
                        {{ $schedule->connecting_eta ? \Carbon\Carbon::parse($schedule->connecting_eta)->format('d-M') : '-' }}
                    </td>
                    @endif

                    <td class="text-left">{{ $schedule->remarks_field ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @empty
    <div class="no-data">
        No sailing schedules found for the selected criteria.
    </div>
    @endforelse

    <!-- Global Remarks Section -->
    @php
    $allRemarks = collect();
    foreach($groupedSchedules as $schedules) {
    $remarksInGroup = $schedules->filter(function($schedule) {
    return !empty($schedule->remarks_field);
    });
    $allRemarks = $allRemarks->merge($remarksInGroup);
    }
    $allRemarks = $allRemarks->unique('id');
    @endphp

    <div class="remarks-section">
        <div class="remarks-title">REMARKS :</div>
        <div class="remark-item">*** Please send your booking instruction asap to check space availability.</div>
        <div class="remark-item">*** Cancellation Booking, sudden postpone & decreasing in big volume from initial
            booking subj to penalty charges</div>
        <div class="remark-item">*** Please enclose Original NPE, PEB, Packing List & Commercial Invoice when deliver
            your goods to our warehouse.</div>
        <div class="remark-item">*** Operational Warehouse asf :</div>
        <div class="remark-item">
            <span class="indent-remarks">Monday - Friday : 09.00 - 17.00 (overtime will charge IDR 150,000/hours if your
                cargo reached warehouse @ 17.01)</span>
        </div>
        <div class="remark-item">
            <span class="indent-remarks">Saturday : 09.00 - 12.00 (overtime will charge IDR 150,000/hours if your cargo
                reached warehouse @ 12.01)</span>
        </div>
    </div>

    <div class="warehouse-section">
        <div class="warehouse-title">WAREHOUSE ADDRESS :</div>
        <div class="warehouse-info">
            <strong>PT. BIMARUNA JAYA</strong><br>
            <span class="font-normal">
                JL. CAKUNG CILINCING RAYA KM 1.5<br>
                KEL. CAKUNG BARAT, KEC. CILINCING<br>
                KOTA JAKARTA TIMUR 13910
            </span><br>
            <br>
            <strong>Pic : Pak Djaffar / 081519121901</strong>
        </div>
    </div>

</body>

</html>
