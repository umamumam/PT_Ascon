<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Stats Cards --}}
        <div class="row g-6 mb-6">
            <div class="col-sm-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Sailing Schedules</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $totalSchedules ?? 0 }}</h4>
                                    <p class="text-success mb-0">(Total)</p>
                                </div>
                                <small class="mb-0">All Active Schedules</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="ti ti-calendar-event ti-26px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Export Schedules</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $totalExport ?? 0 }}</h4>
                                    <span class="badge bg-label-success rounded-pill ms-1">Export</span>
                                </div>
                                <small class="mb-0 text-muted">
                                    @if($totalSchedules > 0)
                                        {{ number_format(($totalExport/$totalSchedules)*100, 1) }}% of total
                                    @else
                                        0% of total
                                    @endif
                                </small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="ti ti-upload ti-26px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Import Schedules</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $totalImport ?? 0 }}</h4>
                                    <span class="badge bg-label-info rounded-pill ms-1">Import</span>
                                </div>
                                <small class="mb-0 text-muted">
                                    @if($totalSchedules > 0)
                                        {{ number_format(($totalImport/$totalSchedules)*100, 1) }}% of total
                                    @else
                                        0% of total
                                    @endif
                                </small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-info">
                                    <i class="ti ti-download ti-26px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="content-left">
                            <span class="text-heading">Service Type</span>
                            <div class="mt-2">
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted small">LCL</span>
                                        <span class="fw-medium">{{ $totalLCL ?? 0 }}</span>
                                    </div>
                                    <div class="progress mb-2" style="height: 6px">
                                        <div class="progress-bar bg-primary"
                                            style="width: {{ $totalSchedules > 0 ? ($totalLCL/$totalSchedules)*100 : 0 }}%">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span class="text-muted small">FCL</span>
                                        <span class="fw-medium">{{ $totalFCL ?? 0 }}</span>
                                    </div>
                                    <div class="progress" style="height: 6px">
                                        <div class="progress-bar bg-warning"
                                            style="width: {{ $totalSchedules > 0 ? ($totalFCL/$totalSchedules)*100 : 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Filter Sailing Schedule</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('schedules.index') }}" method="GET" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select" onchange="this.form.submit()">
                                <option value="">All Types</option>
                                <option value="Export" {{ request('type') == 'Export' ? 'selected' : '' }}>Export</option>
                                <option value="Import" {{ request('type') == 'Import' ? 'selected' : '' }}>Import</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Service Category</label>
                            <select name="service" class="form-select" onchange="this.form.submit()">
                                <option value="">All Services</option>
                                <option value="LCL" {{ request('service') == 'LCL' ? 'selected' : '' }}>Less than Container Load (LCL)</option>
                                <option value="FCL" {{ request('service') == 'FCL' ? 'selected' : '' }}>Full Container Load (FCL)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">From Date</label>
                            <input type="date" name="from_date" class="form-control"
                                value="{{ $fromDate }}" onchange="this.form.submit()">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">To Date</label>
                            <input type="date" name="to_date" class="form-control"
                                value="{{ $toDate }}" onchange="this.form.submit()">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Port of Loading</label>
                            <select name="pol_id" class="form-select select2" onchange="this.form.submit()">
                                <option value="">Search loading port</option>
                                @foreach($ports as $port)
                                    <option value="{{ $port->id }}" {{ request('pol_id') == $port->id ? 'selected' : '' }}>
                                        {{ $port->port_code }} - {{ $port->port_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Port of Destination</label>
                            <select name="pod_id" class="form-select select2" onchange="this.form.submit()">
                                <option value="">Search destination port</option>
                                @foreach($ports as $port)
                                    <option value="{{ $port->id }}" {{ request('pod_id') == $port->id ? 'selected' : '' }}>
                                        {{ $port->port_code }} - {{ $port->port_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 d-flex justify-content-between">
                            <div>
                                <small class="text-muted">
                                    @if(request()->hasAny(['type', 'service', 'pol_id', 'pod_id', 'from_date', 'to_date']))
                                        Showing {{ $schedules->count() }} filtered results
                                    @else
                                        Showing all {{ $schedules->count() }} results
                                    @endif
                                </small>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="ti ti-search me-1"></i> Search
                                </button>
                                <a href="{{ route('schedules.index') }}" class="btn btn-label-secondary">
                                    <i class="ti ti-refresh me-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Table --}}
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="card-title mb-0">List Sailing Schedules</h5>
                <div class="d-flex gap-2 flex-wrap">
                    <button class="btn btn-label-danger" data-bs-toggle="modal" data-bs-target="#modalBulkDeleteSchedule">
                        <i class="ti ti-trash me-1"></i> Hapus per Periode
                    </button>
                    <a href="{{ route('schedules.export.excel', request()->all()) }}" class="btn btn-label-info">
                        <i class="ti ti-file-export me-1"></i> Export Excel
                    </a>
                    <button class="btn btn-label-success" data-bs-toggle="modal" data-bs-target="#modalImportExcel">
                        <i class="ti ti-file-import me-1"></i> Import Excel
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddSchedule">
                        <i class="ti ti-plus me-1"></i> Add New Schedule
                    </button>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables table">
                    <thead class="border-top">
                        <tr>
                            <th>Type/Service</th>
                            <th>Vessel / Voyage</th>
                            <th>POL (ETD)</th>
                            <th>POD (ETA)</th>
                            <th>Connecting</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schedules as $item)
                        <tr>
                            <td>
                                <span class="badge {{ $item->type === 'Export' ? 'bg-label-success' : 'bg-label-info' }}">
                                    {{ $item->type }}
                                </span><br>
                                <small class="text-muted">{{ $item->service }}</small>
                            </td>
                            <td>
                                <span class="fw-medium">{{ $item->vessel }}</span><br>
                                <small>Voy: {{ $item->voyage }}</small>
                            </td>
                            <td>
                                <span class="text-primary">{{ $item->pol->port_code }}</span><br>
                                <small>{{ \Carbon\Carbon::parse($item->etd)->format('d M Y') }}</small>
                            </td>
                            <td>
                                <span class="text-success">{{ $item->pod->port_code }}</span><br>
                                <small>{{ \Carbon\Carbon::parse($item->eta_destination)->format('d M Y') }}</small>
                            </td>
                            <td>
                                @if($item->connecting_vessel)
                                    <small class="fw-bold text-primary">{{ $item->connecting_vessel }}</small>
                                    @if($item->connecting_voyage)<small class="text-muted"> ({{ $item->connecting_voyage }})</small>@endif
                                    @if($item->connecting_etd)<br><small class="text-muted">ETD: {{ \Carbon\Carbon::parse($item->connecting_etd)->format('d M') }}</small>@endif
                                @endif
                                @if($item->eta_nha || $item->connecting2_vessel)
                                    <br><small class="fw-bold text-info">2nd: {{ $item->connecting2_vessel ?? 'NHA' }}</small>
                                    @if($item->connecting2_voyage)<small class="text-muted"> ({{ $item->connecting2_voyage }})</small>@endif
                                    @if($item->connecting2_etd)<br><small class="text-muted">ETD NHA: {{ \Carbon\Carbon::parse($item->connecting2_etd)->format('d M') }}</small>@endif
                                @endif
                                @if($item->eta_klf || $item->connecting_klf)
                                    <br><small class="fw-bold text-warning">3rd: {{ $item->connecting_klf ?? 'By Truck' }}</small>
                                    @if($item->connecting_eta)<br><small class="text-muted">ETA: {{ \Carbon\Carbon::parse($item->connecting_eta)->format('d M') }}</small>@endif
                                @endif
                                @if(!$item->connecting_vessel && !$item->connecting2_vessel && !$item->connecting_klf && !$item->eta_nha && !$item->eta_klf)
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-sm btn-icon text-primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditSchedule{{ $item->id }}">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('schedules.destroy', $item->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-icon text-danger"
                                            onclick="confirmDelete('{{ $item->id }}', '{{ $item->vessel }} - {{ $item->voyage }}')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="modalEditSchedule{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Schedule: {{ $item->vessel }} - {{ $item->voyage }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('schedules.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Type</label>
                                                            <select name="type" class="form-select" required>
                                                                <option value="Export" {{ $item->type == 'Export' ? 'selected' : '' }}>Export</option>
                                                                <option value="Import" {{ $item->type == 'Import' ? 'selected' : '' }}>Import</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Service</label>
                                                            <select name="service" class="form-select" required>
                                                                <option value="LCL" {{ $item->service == 'LCL' ? 'selected' : '' }}>LCL</option>
                                                                <option value="FCL" {{ $item->service == 'FCL' ? 'selected' : '' }}>FCL</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Vessel</label>
                                                            <input type="text" name="vessel" class="form-control"
                                                                value="{{ $item->vessel }}" required>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">POL (Port of Loading)</label>
                                                            <select name="pol_id" class="select2 form-select"
                                                                data-placeholder="Select POL" required>
                                                                @foreach($ports as $p)
                                                                    <option value="{{ $p->id }}" {{ $item->pol_id == $p->id ? 'selected' : '' }}>
                                                                        {{ $p->port_code }} - {{ $p->port_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">POD (Port of Discharge)</label>
                                                            <select name="pod_id" class="select2 form-select"
                                                                data-placeholder="Select POD" required>
                                                                @foreach($ports as $p)
                                                                    <option value="{{ $p->id }}" {{ $item->pod_id == $p->id ? 'selected' : '' }}>
                                                                        {{ $p->port_code }} - {{ $p->port_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label">Voyage</label>
                                                            <input type="text" name="voyage" class="form-control"
                                                                required value="{{ $item->voyage }}" placeholder="Ex: 001N">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">ETD</label>
                                                            <input type="date" name="etd" class="form-control"
                                                                required value="{{ $item->etd }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">ETA Destination</label>
                                                            <input type="date" name="eta_destination"
                                                                class="form-control" required
                                                                value="{{ $item->eta_destination }}">
                                                        </div>

                                                        {{-- ETA Code Connecting --}}
                                                        <div class="col-md-4">
                                                            <label class="form-label">ETA Code Connecting</label>
                                                            <input type="text" name="eta_code_connecting"
                                                                class="form-control"
                                                                value="{{ $item->eta_code_connecting }}"
                                                                placeholder="Ex: SIN, TPP">
                                                            <small class="text-muted">Kode port transit setelah ETA Destination</small>
                                                        </div>

                                                        <div class="col-12 text-muted">
                                                            <hr class="my-1">
                                                            <small class="fw-bold">Additional ETA / Transit Points</small>
                                                        </div>

                                                        @for($i = 1; $i <= 7; $i++)
                                                            @php
                                                                $etaField = 'eta_destination' . $i;
                                                                $etaValue = $item->$etaField;
                                                            @endphp
                                                            <div class="col-md-3 col-6">
                                                                <label class="form-label small">ETA {{ $i }}</label>
                                                                <input type="date" name="eta_destination{{ $i }}"
                                                                    class="form-control form-control-sm"
                                                                    value="{{ $etaValue }}">
                                                            </div>
                                                        @endfor

                                                        <div class="col-md-12">
                                                            <label class="form-label">ETA Text (Keterangan)</label>
                                                            <textarea name="eta_text" class="form-control" rows="2"
                                                                placeholder="Ex: Delayed due to weather">{{ $item->eta_text }}</textarea>
                                                        </div>

                                                        <div class="col-12 text-muted">
                                                            <hr class="my-1">
                                                            <small class="fw-bold">Connecting Vessel Info</small>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">Connecting Vessel</label>
                                                            <input type="text" name="connecting_vessel"
                                                                class="form-control"
                                                                value="{{ $item->connecting_vessel }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Connecting Voyage</label>
                                                            <input type="text" name="connecting_voyage"
                                                                class="form-control"
                                                                value="{{ $item->connecting_voyage }}"
                                                                placeholder="Connecting voyage">
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label">Connecting ETD</label>
                                                            <input type="date" name="connecting_etd"
                                                                class="form-control"
                                                                value="{{ $item->connecting_etd }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">ETD Code Connecting</label>
                                                            <input type="text" name="etd_code_connecting"
                                                                class="form-control"
                                                                value="{{ $item->etd_code_connecting }}"
                                                                placeholder="Ex: SIN, TPP">
                                                            <small class="text-muted">Kode port transit setelah Connecting ETD</small>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">ETA NHA</label>
                                                            <input type="date" name="eta_nha"
                                                                class="form-control"
                                                                value="{{ $item->eta_nha }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">2nd Connecting Vessel</label>
                                                            <input type="text" name="connecting2_vessel"
                                                                class="form-control"
                                                                value="{{ $item->connecting2_vessel }}"
                                                                placeholder="2nd Connecting vessel">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">2nd Connecting Voyage</label>
                                                            <input type="text" name="connecting2_voyage"
                                                                class="form-control"
                                                                value="{{ $item->connecting2_voyage }}"
                                                                placeholder="2nd Connecting voyage">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">ETD NHA</label>
                                                            <input type="date" name="connecting2_etd"
                                                                class="form-control"
                                                                value="{{ $item->connecting2_etd }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">ETA KLF</label>
                                                            <input type="date" name="eta_klf"
                                                                class="form-control"
                                                                value="{{ $item->eta_klf }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Connecting (KLF)</label>
                                                            <input type="text" name="connecting_klf"
                                                                class="form-control"
                                                                value="{{ $item->connecting_klf }}"
                                                                placeholder="Ex: By Truck">
                                                            <small class="text-muted">Otomatis 'By Truck' jika ETA KLF terisi</small>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Connecting ETA</label>
                                                            <input type="date" name="connecting_eta"
                                                                class="form-control"
                                                                value="{{ $item->connecting_eta }}">
                                                        </div>

                                                        <div class="col-12">
                                                            <label class="form-label">Remarks</label>
                                                            <textarea name="remarks_field" class="form-control"
                                                                rows="2">{{ $item->remarks_field }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-label-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Schedule</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Add --}}
    <div class="modal fade" id="modalAddSchedule" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Sailing Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('schedules.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-select" required>
                                    <option value="Export">Export</option>
                                    <option value="Import">Import</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Service</label>
                                <select name="service" class="form-select" required>
                                    <option value="LCL">LCL</option>
                                    <option value="FCL">FCL</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Vessel</label>
                                <input type="text" name="vessel" class="form-control"
                                    placeholder="Enter vessel name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">POL (Port of Loading)</label>
                                <select name="pol_id" class="select2 form-select"
                                    data-placeholder="Select POL" required>
                                    @foreach($ports as $p)
                                        <option value="{{ $p->id }}">{{ $p->port_code }} - {{ $p->port_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">POD (Port of Discharge)</label>
                                <select name="pod_id" class="select2 form-select"
                                    data-placeholder="Select POD" required>
                                    @foreach($ports as $p)
                                        <option value="{{ $p->id }}">{{ $p->port_code }} - {{ $p->port_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Voyage</label>
                                <input type="text" name="voyage" class="form-control"
                                    required placeholder="Ex: 001N">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ETD</label>
                                <input type="date" name="etd" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ETA Destination</label>
                                <input type="date" name="eta_destination" class="form-control" required>
                            </div>

                            {{-- ETA Code Connecting --}}
                            <div class="col-md-4">
                                <label class="form-label">ETA Code Connecting</label>
                                <input type="text" name="eta_code_connecting" class="form-control"
                                    placeholder="Ex: SIN, TPP">
                                <small class="text-muted">Kode port transit setelah ETA Destination</small>
                            </div>

                            <div class="col-12 text-muted">
                                <hr class="my-1">
                                <small class="fw-bold">Additional ETA / Transit Points</small>
                            </div>

                            @for($i = 1; $i <= 7; $i++)
                                <div class="col-md-3 col-6">
                                    <label class="form-label small">ETA {{ $i }}</label>
                                    <input type="date" name="eta_destination{{ $i }}"
                                        class="form-control form-control-sm">
                                </div>
                            @endfor

                            <div class="col-md-12">
                                <label class="form-label">ETA Text (Keterangan)</label>
                                <textarea name="eta_text" class="form-control" rows="2"
                                    placeholder="Ex: Delayed due to weather"></textarea>
                            </div>

                            <div class="col-12 text-muted">
                                <hr class="my-1">
                                <small class="fw-bold">Connecting Vessel Info</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Connecting Vessel</label>
                                <input type="text" name="connecting_vessel" class="form-control"
                                    placeholder="Connecting vessel">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Connecting Voyage</label>
                                <input type="text" name="connecting_voyage" class="form-control"
                                    placeholder="Connecting voyage">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Connecting ETD</label>
                                <input type="date" name="connecting_etd" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ETD Code Connecting</label>
                                <input type="text" name="etd_code_connecting" class="form-control"
                                    placeholder="Ex: SIN, TPP">
                                <small class="text-muted">Kode port transit setelah Connecting ETD</small>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ETA NHA</label>
                                <input type="date" name="eta_nha" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">2nd Connecting Vessel</label>
                                <input type="text" name="connecting2_vessel" class="form-control"
                                    placeholder="2nd Connecting vessel">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">2nd Connecting Voyage</label>
                                <input type="text" name="connecting2_voyage" class="form-control"
                                    placeholder="2nd Connecting voyage">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">ETD NHA</label>
                                <input type="date" name="connecting2_etd" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">ETA KLF</label>
                                <input type="date" name="eta_klf" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Connecting (KLF)</label>
                                <input type="text" name="connecting_klf" class="form-control"
                                    placeholder="Ex: By Truck">
                                <small class="text-muted">Otomatis 'By Truck' jika ETA KLF terisi</small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Connecting ETA</label>
                                <input type="date" name="connecting_eta" class="form-control">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Remarks</label>
                                <textarea name="remarks_field" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Import --}}
    <div class="modal fade" id="modalImportExcel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Excel Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('schedules.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <h6>Template Format Excel</h6>
                            <p class="text-muted mb-2">Pilih dan download template sesuai dengan jenis rute / data jadwal:</p>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('schedules.template.download', ['template' => 'direct']) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="ti ti-download me-1"></i> 1. Tanpa Connecting (Direct)
                                </a>
                                <a href="{{ route('schedules.template.download', ['template' => 'connecting']) }}" class="btn btn-outline-info btn-sm">
                                    <i class="ti ti-download me-1"></i> 2. Dengan Connecting
                                </a>
                                <a href="{{ route('schedules.template.download', ['template' => 'japan']) }}" class="btn btn-outline-success btn-sm">
                                    <i class="ti ti-download me-1"></i> 3. Rute Japan
                                </a>
                                <a href="{{ route('schedules.template.download', ['template' => 'jebel_ali']) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="ti ti-download me-1"></i> 4. Rute Jebel Ali
                                </a>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Pilih File Excel *</label>
                            <input type="file" class="form-control" name="excel_file"
                                accept=".xlsx,.xls,.csv" required>
                            <small class="text-muted">Format file: .xlsx, .xls, .csv (maksimal 5MB)</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Pilih Default Type</label>
                                <select class="form-select" name="default_type">
                                    <option value="">-- Kosongkan --</option>
                                    <option value="Export" selected>Export</option>
                                    <option value="Import">Import</option>
                                </select>
                                <small class="text-muted">Jika kolom "type" kosong di Excel, akan menggunakan nilai ini</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Pilih Default Service</label>
                                <select class="form-select" name="default_service">
                                    <option value="">-- Kosongkan --</option>
                                    <option value="LCL" selected>LCL</option>
                                    <option value="FCL">FCL</option>
                                </select>
                                <small class="text-muted">Jika kolom "service" kosong di Excel, akan menggunakan nilai ini</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Import Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Bulk Delete Schedule --}}
    <div class="modal fade" id="modalBulkDeleteSchedule" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-label-danger">
                    <h5 class="modal-title text-danger">
                        <i class="ti ti-trash me-1"></i> Hapus Jadwal Berdasarkan Periode
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formBulkDeleteSchedule" action="{{ route('schedules.bulk-delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="alert alert-warning mb-4" role="alert">
                            Data pada periode tanggal dan jenis yang dipilih akan dihapus secara permanen.
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Dari Tanggal (ETD) <span class="text-danger">*</span></label>
                                <input type="date" name="from_date" class="form-control" required value="{{ $fromDate ?? date('Y-m-01') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Sampai Tanggal (ETD) <span class="text-danger">*</span></label>
                                <input type="date" name="to_date" class="form-control" required value="{{ $toDate ?? date('Y-m-t') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Jenis Jadwal (Type)</label>
                                <select name="type" class="form-select">
                                    <option value="">Semua Jenis (Export & Import)</option>
                                    <option value="Export">Export</option>
                                    <option value="Import">Import</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" onclick="confirmBulkDeleteSchedule()">
                            <i class="ti ti-trash me-1"></i> Hapus Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('change', function(e) {
            if (e.target && e.target.matches('input[name="eta_klf"]')) {
                const form = e.target.closest('form');
                if (form) {
                    const connectingInput = form.querySelector('input[name="connecting_klf"]');
                    if (connectingInput && !connectingInput.value.trim() && e.target.value) {
                        connectingInput.value = 'By Truck';
                    }
                }
            }
        });

        function confirmBulkDeleteSchedule() {
            const form = document.getElementById('formBulkDeleteSchedule');
            const fromDate = form.querySelector('[name="from_date"]').value;
            const toDate = form.querySelector('[name="to_date"]').value;

            if (!fromDate || !toDate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Harap isi periode tanggal dari dan sampai!',
                    customClass: { confirmButton: 'btn btn-primary' },
                    buttonsStyling: false
                });
                return;
            }

            if (fromDate > toDate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: 'Tanggal awal tidak boleh lebih besar dari tanggal akhir!',
                    customClass: { confirmButton: 'btn btn-primary' },
                    buttonsStyling: false
                });
                return;
            }

            Swal.fire({
                title: 'Yakin hapus data ini?',
                text: 'Data pada periode dan jenis yang dipilih akan dihapus permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'btn btn-danger me-3',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
</x-app-layout>
