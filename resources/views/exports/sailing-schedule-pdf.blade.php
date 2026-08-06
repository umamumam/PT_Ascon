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
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .header-content {
            display: table-row;
        }

        .logo-cell {
            display: table-cell;
            width: 100px;
            vertical-align: middle;
            padding-right: 5px;
        }

        .logo {
            max-height: 100px;
            max-width: 250px;
            width: auto;
            height: auto;
            display: block;
        }

        .company-info-cell {
            display: table-cell;
            vertical-align: left;
        }

        .company-box {
            border: 1.5px solid #000;
            padding: 6px 10px;
            text-align: center;
        }

        .company-name {
            font-weight: bold;
            font-size: 22px;
            margin-bottom: 2px;
            color: #000;
        }

        .company-address {
            font-size: 14px;
            line-height: 1.4;
        }

        .title-section {
            text-align: center;
            margin: 20px 0 15px 0;
        }

        .main-title {
            font-size: 17px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .route-section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .route-header {
            background-color: #ff0000;
            color: #ffffff;
            padding: 4px 8px;
            font-weight: bold;
            font-size: 9.5px;
            text-transform: uppercase;
            margin-bottom: 0;
            border: 1px solid #000;
            border-bottom: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th {
            background-color: #a4c2f4;
            color: #000000;
            padding: 4px 5px;
            text-align: center;
            font-size: 9px;
            font-weight: bold;
            border: 1px solid #000;
        }

        td {
            padding: 4px 5px;
            text-align: center;
            border: 1px solid #000;
            font-size: 8.5px;
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
                <img src="{{ public_path('logoascon.png') }}" alt="Logo" class="logo">
            </div>
            <div class="company-info-cell">
                <div class="company-box">
                    <div class="company-name">PT. Asia Connexindo Internasional</div>
                    <div class="company-address">
                        Soepomo Office Park, Unit O<br>
                        Jl. Prof. Dr. Supomo No. 143 Tebet, Jakarta Selatan 12810<br>
                        Ph : 021-83791179 Fx : 021-83791180
                    </div>
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
        @php
        $parts = explode(' - ', $route);
        $destination = $type == 'Export' ? $parts[1] : $parts[0];
        $firstSchedule = $schedules->first();
        $polCode = $firstSchedule->pol->port_code ?? '';
        $podCode = $firstSchedule->pod->port_code ?? '';
        $customLabels = $routeColumnLabels[$route] ?? [];
        $labelEtd = $customLabels['etd'] ?? "ETD " . strtoupper($polCode);
        $labelEta = $customLabels['eta_destination'] ?? 'ETA';
        $labelConnEtd = $customLabels['connecting_etd'] ?? 'ETD';
        $labelConnEta = $customLabels['connecting_eta'] ?? "ETA " . strtoupper($podCode);
        $hasEtaText = $schedules->contains(fn($s) => !empty($s->eta_text));
        $hasRemarks = $columnsPerRoute[$route]['has_remarks'];

        $totalCols = 4 + count($columnsPerRoute[$route]['eta_destinations']);
        if ($hasEtaText) $totalCols++;
        if ($columnsPerRoute[$route]['has_connecting']) {
            $hasEtaKlf = $schedules->contains(fn($s) => !empty($s->eta_klf));
            $totalCols += ($hasEtaKlf ? 6 : 4);
        }
        if ($hasRemarks) $totalCols++;

        $sectionWidth = '100%';
        if ($totalCols <= 4) {
            $sectionWidth = '50%';
        } elseif ($totalCols == 5) {
            $sectionWidth = '60%';
        } elseif ($totalCols == 6) {
            $sectionWidth = '75%';
        }
        @endphp
    <div class="route-section" style="width: {{ $sectionWidth }};">

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
                    @php $hasEtaKlf = $schedules->contains(fn($s) => !empty($s->eta_klf)); @endphp
                    <th style="width: 15%;">CONNECTING</th>
                    <th style="width: 10%;">VOY</th>
                    <th style="width: 12%;">{{ strtoupper($labelConnEtd) }}</th>
                    @if($hasEtaKlf)
                    <th style="width: 12%;">ETA KLF</th>
                    <th style="width: 12%;">CONNECTING</th>
                    @endif
                    <th style="width: 12%;">{{ strtoupper($labelConnEta) }}</th>
                    @endif

                    @if($hasRemarks)
                    <th style="width: 15%;">REMARKS</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td>{{ strtoupper($schedule->vessel) }}</td>
                    <td>{{ $schedule->voyage }}</td>
                    <td class="text-nowrap">{{ \Carbon\Carbon::parse($schedule->etd)->format('d-M') }}</td>
                    <td class="text-nowrap">
                        {{ $schedule->eta_destination ? \Carbon\Carbon::parse($schedule->eta_destination)->format('d-M')
                        : '-' }}
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
                        {{ $schedule->connecting_etd ? \Carbon\Carbon::parse($schedule->connecting_etd)->format('d-M') :
                        '-' }}
                    </td>
                    @if($hasEtaKlf)
                    <td class="text-nowrap">
                        {{ $schedule->eta_klf ? \Carbon\Carbon::parse($schedule->eta_klf)->format('d-M') : '-' }}
                    </td>
                    <td>{{ $schedule->connecting_klf ?? ($schedule->eta_klf ? 'By Truck' : '-') }}</td>
                    @endif
                    <td class="text-nowrap">
                        {{ $schedule->connecting_eta ? \Carbon\Carbon::parse($schedule->connecting_eta)->format('d-M') :
                        '-' }}
                    </td>
                    @endif

                    @if($hasRemarks)
                    <td class="text-left">{{ $schedule->remarks_field ?? '-' }}</td>
                    @endif
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