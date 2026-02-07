<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row g-6 mb-6">
            <div class="col-sm-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Total Trackings</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $totalTrackings }}</h4>
                                    <p class="text-primary mb-0">(Shipments)</p>
                                </div>
                                <small class="mb-0">Monitoring active shipments</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="ti ti-ship ti-26px"></i>
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
                                <span class="text-heading">FCL Shipments</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $totalFCL }}</h4>
                                    <span class="badge bg-label-success rounded-pill">FCL</span>
                                </div>
                                <small class="mb-0 text-muted">{{ number_format($fclPercentage, 1) }}% of total</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="ti ti-box ti-26px"></i>
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
                                <span class="text-heading">LCL Shipments</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $totalLCL }}</h4>
                                    <span class="badge bg-label-warning rounded-pill">LCL</span>
                                </div>
                                <small class="mb-0 text-muted">{{ number_format($lclPercentage, 1) }}% of total</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="ti ti-boxes ti-26px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xl-3">
                <div class="card h-100">
                    <div class="card-body">
                        <span class="text-heading">Service Distribution</span>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted">FCL</small>
                                <small class="fw-medium">{{ $totalFCL }}</small>
                            </div>
                            <div class="progress mb-3" style="height: 8px">
                                <div class="progress-bar bg-success" style="width: {{ $fclPercentage }}%"></div>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted">LCL</small>
                                <small class="fw-medium">{{ $totalLCL }}</small>
                            </div>
                            <div class="progress" style="height: 8px">
                                <div class="progress-bar bg-warning" style="width: {{ $lclPercentage }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-6">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Filter Trackings</h5>
            </div>
            <div class="card-body pt-4">
                <form action="{{ route('trackings.index') }}" method="GET">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select" onchange="this.form.submit()">
                                <option value="">All (Export & Import)</option>
                                <option value="Export" {{ request('type')=='Export' ? 'selected' : '' }}>Export</option>
                                <option value="Import" {{ request('type')=='Import' ? 'selected' : '' }}>Import</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Shipment Type</label>
                            <select name="shipment_type" class="form-select" onchange="this.form.submit()">
                                <option value="">All Types</option>
                                <option value="FCL" {{ request('shipment_type')=='FCL' ? 'selected' : '' }}>Full
                                    Container Load (FCL)</option>
                                <option value="LCL" {{ request('shipment_type')=='LCL' ? 'selected' : '' }}>Less
                                    Container Load (LCL)</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">From Date</label>
                            <input type="date" name="from_date" class="form-control" value="{{ $fromDate }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">To Date</label>
                            <input type="date" name="to_date" class="form-control" value="{{ $toDate }}">
                        </div>

                        <div class="col-12 d-flex justify-content-end gap-2">
                            <a href="{{ route('trackings.index') }}" class="btn btn-label-secondary">
                                <i class="ti ti-refresh me-1"></i> Reset
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-search me-1"></i> Filter Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">List Trackings</h5>
                <div>
                    <button class="btn btn-label-success  me-2" data-bs-toggle="modal"
                        data-bs-target="#modalImportTracking">
                        <i class="ti ti-file-import me-1"></i> Import Excel
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddTracking">
                        <i class="ti ti-plus me-1"></i> Add New Tracking
                    </button>
                </div>
            </div>

            <div class="card-datatable table-responsive">
                <table class="datatables table">
                    <thead class="border-top">
                        <tr>
                            <th>BL Number</th>
                            <th>Shipper / Consignee</th>
                            <th>Route (Org - Dest)</th>
                            <th>Type</th>
                            <th>Vessel / Voyage</th>
                            <th>ETA</th>
                            <th width="70">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trackings as $tracking)
                        <tr>
                            <td>
                                <span class="fw-medium text-primary">{{ $tracking->bl_number }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <small class="text-truncate fw-bold">S: {{ $tracking->shipper }}</small>
                                    <small class="text-truncate text-muted">C: {{ $tracking->consignee }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-label-secondary">{{ $tracking->origin }}</span>
                                    <i class="ti ti-arrow-right mx-1"></i>
                                    <span class="badge bg-label-secondary">{{ $tracking->destination }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column gap-1">
                                    <span
                                        class="badge {{ $tracking->type == 'Import' ? 'bg-label-info' : 'bg-label-success' }}">
                                        {{ $tracking->type }}
                                    </span>
                                    <span
                                        class="badge {{ $tracking->shipment_type == 'FCL' ? 'bg-label-success' : 'bg-label-warning' }}">
                                        {{ $tracking->shipment_type }}
                                    </span>
                                </div>
                            </td>
                            <td>{{ $tracking->vessel_voyage }}</td>
                            <td>{{ $tracking->eta->format('d M') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-icon" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <!-- Add Status -->
                                        <li>
                                            <button type="button" class="dropdown-item text-success"
                                                data-bs-toggle="modal" data-bs-target="#modalStatus{{ $tracking->id }}">
                                                <i class="ti ti-circle-plus me-2"></i> Add Status
                                            </button>
                                        </li>

                                        <!-- View Details -->
                                        <li>
                                            <button type="button" class="dropdown-item text-info" data-bs-toggle="modal"
                                                data-bs-target="#modalShow{{ $tracking->id }}">
                                                <i class="ti ti-eye me-2"></i> View Details
                                            </button>
                                        </li>

                                        <!-- Edit -->
                                        <li>
                                            <button type="button" class="dropdown-item text-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEditTracking{{ $tracking->id }}">
                                                <i class="ti ti-edit me-2"></i> Edit
                                            </button>
                                        </li>

                                        <!-- Delete -->
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item text-danger"
                                                onclick="confirmDelete('{{ $tracking->id }}')">
                                                <i class="ti ti-trash me-2"></i> Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Form Delete (tetap tersembunyi) -->
                                <form id="delete-form-{{ $tracking->id }}"
                                    action="{{ route('trackings.destroy', $tracking->id) }}" method="POST"
                                    class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <div class="modal fade" id="modalStatus{{ $tracking->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Status: {{ $tracking->bl_number }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('tracking_details.store', $tracking->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Status Update</label>
                                                            <select name="status" class="form-select" required>
                                                                <option value="departed">Departed</option>
                                                                <option value="discharge">Discharge</option>
                                                                <option value="connecting">Connecting</option>
                                                                <option value="arrival">Arrival</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Place of Activity</label>
                                                            <input type="text" name="place_of_activity"
                                                                class="form-control" placeholder="Enter location..."
                                                                required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Date</label>
                                                            <input type="date" name="date" class="form-control"
                                                                value="{{ date('Y-m-d') }}" required>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Vessel Information
                                                                (Optional)</label>
                                                            <input type="text" name="vessel_information"
                                                                class="form-control"
                                                                placeholder="e.g. MV. Ocean Star V.12">
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Remarks</label>
                                                            <textarea name="remarks" class="form-control" rows="2"
                                                                placeholder="Optional notes..."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-label-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Save Status</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalShow{{ $tracking->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-label-info">
                                                <h5 class="modal-title">Shipment History: {{ $tracking->bl_number }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <small class="text-muted d-block">Origin - Destination</small>
                                                        <strong>{{ $tracking->origin }} <i
                                                                class="ti ti-arrow-right"></i> {{ $tracking->destination
                                                            }}</strong>
                                                    </div>
                                                    <div class="col-md-6 text-md-end">
                                                        <small class="text-muted d-block">Vessel</small>
                                                        <strong>{{ $tracking->vessel_voyage }}</strong>
                                                    </div>
                                                </div>

                                                <div class="table-responsive border rounded">
                                                    <table class="table mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Status</th>
                                                                <th>Place of Activity</th>
                                                                <th>Date</th>
                                                                <th>Vessel Info</th>
                                                                <th class="text-center">Indirect</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($tracking->details->sortBy('id') as $detail)
                                                            <tr class="border-top">
                                                                <td>
                                                                    <span class="badge bg-label-{{
                                                                            $detail->status == 'arrival' ? 'success' :
                                                                            ($detail->status == 'departed' ? 'primary' : 'warning')
                                                                        }}">
                                                                        {{ strtoupper($detail->status) }}
                                                                    </span>
                                                                </td>
                                                                <td>{{ $detail->place_of_activity }}</td>
                                                                <td>{{ $detail->date->format('d M Y') }}</td>
                                                                <td>{{ $detail->vessel_information ?? '-' }}</td>
                                                                <td class="text-center">
                                                                    @if($detail->sequence)
                                                                    <span
                                                                        class="badge badge-center rounded-pill bg-label-secondary">
                                                                        {{ $detail->sequence }}
                                                                    </span>
                                                                    @else
                                                                    -
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @if($detail->remarks)
                                                            <tr>
                                                                <td colspan="5" class="py-1 ps-4 border-0">
                                                                    <small class="text-muted italic">Note: {{
                                                                        $detail->remarks }}</small>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center py-4 text-muted">
                                                                    No tracking history available yet.
                                                                </td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-label-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="modalEditTracking{{ $tracking->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Tracking: {{ $tracking->bl_number }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('trackings.update', $tracking->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">BL Number</label>
                                                            <input type="text" class="form-control" name="bl_number"
                                                                value="{{ $tracking->bl_number }}" required />
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">Type</label>
                                                            <select class="form-select" name="type" required>
                                                                <option value="Export" {{ $tracking->type == 'Export' ?
                                                                    'selected' : '' }}>Export</option>
                                                                <option value="Import" {{ $tracking->type == 'Import' ?
                                                                    'selected' : '' }}>Import</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">Shipment Type</label>
                                                            <select class="form-select" name="shipment_type"
                                                                id="shipmentType{{ $tracking->id }}" required
                                                                onchange="toggleShipmentFields({{ $tracking->id }})">
                                                                <option value="LCL" {{ $tracking->shipment_type == 'LCL'
                                                                    ? 'selected' : '' }}>LCL</option>
                                                                <option value="FCL" {{ $tracking->shipment_type == 'FCL'
                                                                    ? 'selected' : '' }}>FCL</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Shipper</label>
                                                            <input type="text" class="form-control" name="shipper"
                                                                value="{{ $tracking->shipper }}" required />
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Consignee</label>
                                                            <input type="text" class="form-control" name="consignee"
                                                                value="{{ $tracking->consignee }}" required />
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Origin</label>
                                                            <input type="text" class="form-control" name="origin"
                                                                value="{{ $tracking->origin }}" required />
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Destination</label>
                                                            <input type="text" class="form-control" name="destination"
                                                                value="{{ $tracking->destination }}" required />
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Vessel / Voyage</label>
                                                            <input type="text" class="form-control" name="vessel_voyage"
                                                                value="{{ $tracking->vessel_voyage }}" required />
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">ETD</label>
                                                            <input type="date" class="form-control" name="etd"
                                                                value="{{ $tracking->etd->format('Y-m-d') }}"
                                                                required />
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label class="form-label">ETA</label>
                                                            <input type="date" class="form-control" name="eta"
                                                                value="{{ $tracking->eta->format('Y-m-d') }}"
                                                                required />
                                                        </div>

                                                        <hr>

                                                        <!-- FCL Fields (Container) -->
                                                        <div id="fclFields{{ $tracking->id }}" class="row"
                                                            style="display: {{ $tracking->shipment_type == 'FCL' ? 'flex' : 'none' }}">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Container Number</label>
                                                                <input type="text" class="form-control"
                                                                    name="container_number"
                                                                    value="{{ $tracking->container_number }}" />
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Size/Type</label>
                                                                <input type="text" class="form-control" name="size_type"
                                                                    value="{{ $tracking->size_type }}" />
                                                            </div>
                                                        </div>

                                                        <!-- LCL Fields (Measurement & Packages) -->
                                                        <div id="lclFields{{ $tracking->id }}" class="row"
                                                            style="display: {{ $tracking->shipment_type == 'LCL' ? 'flex' : 'none' }}">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Total Measurement</label>
                                                                <input type="text" class="form-control"
                                                                    name="total_measurement"
                                                                    value="{{ $tracking->total_measurement }}" />
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Total Packages</label>
                                                                <input type="text" class="form-control"
                                                                    name="total_packages"
                                                                    value="{{ $tracking->total_packages }}" />
                                                            </div>
                                                        </div>

                                                        <hr>

                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Connecting Vessel</label>
                                                            <input type="text" class="form-control"
                                                                name="connecting_vessel"
                                                                value="{{ $tracking->connecting_vessel }}" />
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Conn. ETD</label>
                                                            <input type="date" class="form-control"
                                                                name="connecting_etd"
                                                                value="{{ $tracking->connecting_etd ? $tracking->connecting_etd->format('Y-m-d') : '' }}" />
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label">Conn. ETA</label>
                                                            <input type="date" class="form-control"
                                                                name="connecting_eta"
                                                                value="{{ $tracking->connecting_eta ? $tracking->connecting_eta->format('Y-m-d') : '' }}" />
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label">Remarks</label>
                                                            <textarea class="form-control" name="remarks"
                                                                rows="2">{{ $tracking->remarks }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-label-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Data</button>
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

    <!-- Modal Add New -->
    <div class="modal fade" id="modalAddTracking" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Tracking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('trackings.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">BL Number</label>
                                <input type="text" class="form-control" name="bl_number" placeholder="Enter BL Number"
                                    required />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Type</label>
                                <select class="form-select" name="type" required>
                                    <option value="Export">Export</option>
                                    <option value="Import">Import</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Shipment Type</label>
                                <select class="form-select" name="shipment_type" id="shipmentTypeAdd" required
                                    onchange="toggleShipmentFields('Add')">
                                    <option value="LCL">LCL</option>
                                    <option value="FCL">FCL</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Shipper</label>
                                <input type="text" class="form-control" name="shipper" placeholder="Shipper Name"
                                    required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Consignee</label>
                                <input type="text" class="form-control" name="consignee" placeholder="Consignee Name"
                                    required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Origin</label>
                                <input type="text" class="form-control" name="origin" placeholder="Origin Port"
                                    required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Destination</label>
                                <input type="text" class="form-control" name="destination"
                                    placeholder="Destination Port" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Vessel / Voyage</label>
                                <input type="text" class="form-control" name="vessel_voyage"
                                    placeholder="Ex: MV. EVERGREEN V.123" required />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">ETD</label>
                                <input type="date" class="form-control" name="etd" required />
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">ETA</label>
                                <input type="date" class="form-control" name="eta" required />
                            </div>

                            <hr>

                            <!-- FCL Fields (Container) -->
                            <div id="fclFieldsAdd" class="row" style="display: none;">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Container Number</label>
                                    <input type="text" class="form-control" name="container_number"
                                        placeholder="TCNU1234567" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Size/Type</label>
                                    <input type="text" class="form-control" name="size_type" placeholder="40HC" />
                                </div>
                            </div>

                            <!-- LCL Fields (Measurement & Packages) -->
                            <div id="lclFieldsAdd" class="row" style="display: flex;">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Total Measurement</label>
                                    <input type="text" class="form-control" name="total_measurement"
                                        placeholder="15.5 CBM" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Total Packages</label>
                                    <input type="text" class="form-control" name="total_packages"
                                        placeholder="100 Cartons" />
                                </div>
                            </div>

                            <hr>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Connecting Vessel</label>
                                <input type="text" class="form-control" name="connecting_vessel" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Conn. ETD</label>
                                <input type="date" class="form-control" name="connecting_etd" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Conn. ETA</label>
                                <input type="date" class="form-control" name="connecting_eta" />
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Remarks</label>
                                <textarea class="form-control" name="remarks" rows="2"
                                    placeholder="Notes..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Tracking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Import Excel -->
    <div class="modal fade" id="modalImportTracking" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Tracking Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('trackings.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Bagian Template -->
                        <div class="mb-4">
                            <h6>Template Format Excel</h6>
                            <p class="text-muted">Download template untuk memastikan format data sesuai:</p>
                            <a href="{{ route('trackings.template.download') }}" class="btn btn-outline-primary btn-sm">
                                <i class="ti ti-download me-1"></i> Download Template
                            </a>
                        </div>

                        <hr class="my-4">

                        <!-- Input File -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Pilih File Excel *</label>
                            <input type="file" class="form-control" name="excel_file" accept=".xlsx,.xls,.csv" required>
                            <small class="text-muted">Format file: .xlsx, .xls, .csv (maksimal 5MB)</small>
                        </div>

                        <!-- Dropdown Pilihan Default -->
                        <div class="row">
                            <!-- Default Type -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Pilih Default Type</label>
                                <select class="form-select" name="default_type">
                                    <option value="">-- Kosongkan --</option>
                                    <option value="Export" selected>Export</option>
                                    <option value="Import">Import</option>
                                </select>
                                <small class="text-muted">Jika kolom "type" kosong di Excel, akan menggunakan nilai
                                    ini</small>
                            </div>

                            <!-- Default Shipment Type -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Pilih Default Shipment Type</label>
                                <select class="form-select" name="default_shipment_type">
                                    <option value="">-- Kosongkan --</option>
                                    <option value="LCL" selected>LCL</option>
                                    <option value="FCL">FCL</option>
                                </select>
                                <small class="text-muted">Jika kolom "shipment_type" kosong di Excel, akan menggunakan
                                    nilai ini</small>
                            </div>
                        </div>

                        <!-- Informasi Format -->
                        <div class="alert alert-info mt-4">
                            <h6 class="alert-heading mb-2">Format Data yang Diperlukan:</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="15%">Kolom</th>
                                            <th width="20%">Contoh</th>
                                            <th width="65%">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>bl_number</td>
                                            <td>TRK-001</td>
                                            <td>Nomor BL (Wajib diisi, harus unik)</td>
                                        </tr>
                                        <tr>
                                            <td>type</td>
                                            <td>Export</td>
                                            <td>
                                                <span class="text-primary">Export / Import</span><br>
                                                <small class="text-muted">(Opsional - gunakan default di atas jika
                                                    kosong)</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>shipment_type</td>
                                            <td>FCL</td>
                                            <td>
                                                <span class="text-primary">LCL / FCL</span><br>
                                                <small class="text-muted">(Opsional - gunakan default di atas jika
                                                    kosong)</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>shipper</td>
                                            <td>PT. Supplier Indonesia</td>
                                            <td>Nama Shipper (Wajib diisi)</td>
                                        </tr>
                                        <tr>
                                            <td>consignee</td>
                                            <td>PT. Buyer Singapore</td>
                                            <td>Nama Consignee (Wajib diisi)</td>
                                        </tr>
                                        <tr>
                                            <td>origin</td>
                                            <td>Jakarta</td>
                                            <td>Port of Origin (Wajib diisi)</td>
                                        </tr>
                                        <tr>
                                            <td>destination</td>
                                            <td>Singapore</td>
                                            <td>Port of Destination (Wajib diisi)</td>
                                        </tr>
                                        <tr>
                                            <td>total_measurement</td>
                                            <td>15.5 CBM</td>
                                            <td>Total Measurement (Opsional, khusus LCL)</td>
                                        </tr>
                                        <tr>
                                            <td>total_packages</td>
                                            <td>100 Cartons</td>
                                            <td>Total Packages (Opsional, khusus LCL)</td>
                                        </tr>
                                        <tr>
                                            <td>container_number</td>
                                            <td>CMAU1234567</td>
                                            <td>Container Number (Opsional, khusus FCL)</td>
                                        </tr>
                                        <tr>
                                            <td>size_type</td>
                                            <td>40HC</td>
                                            <td>Container Size/Type (Opsional, khusus FCL)</td>
                                        </tr>
                                        <tr>
                                            <td>vessel_voyage</td>
                                            <td>MV. EVERGREEN 123E</td>
                                            <td>Vessel dan Voyage (Wajib diisi)</td>
                                        </tr>
                                        <tr>
                                            <td>etd</td>
                                            <td>2024-03-15</td>
                                            <td>Format: YYYY-MM-DD (Wajib diisi)</td>
                                        </tr>
                                        <tr>
                                            <td>eta</td>
                                            <td>2024-03-20</td>
                                            <td>Format: YYYY-MM-DD (Wajib diisi)</td>
                                        </tr>
                                        <tr>
                                            <td>connecting_vessel</td>
                                            <td>MV. CONNECTING 456W</td>
                                            <td>Connecting Vessel (Opsional)</td>
                                        </tr>
                                        <tr>
                                            <td>connecting_etd</td>
                                            <td>2024-03-21</td>
                                            <td>Format: YYYY-MM-DD (Opsional)</td>
                                        </tr>
                                        <tr>
                                            <td>connecting_eta</td>
                                            <td>2024-03-25</td>
                                            <td>Format: YYYY-MM-DD (Opsional)</td>
                                        </tr>
                                        <tr>
                                            <td>remarks</td>
                                            <td>Shipment on time</td>
                                            <td>Catatan tambahan (Opsional)</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="mt-2 mb-0">
                                <small>
                                    <strong>Note:</strong><br>
                                    1. Untuk LCL: isi total_measurement dan total_packages<br>
                                    2. Untuk FCL: isi container_number dan size_type<br>
                                    3. Kolom dengan format tanggal harus menggunakan format YYYY-MM-DD<br>
                                    4. BL Number harus unik, tidak boleh duplikat
                                </small>
                            </p>
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

    <script>
        // Fungsi untuk toggle fields berdasarkan shipment type
        function toggleShipmentFields(id) {
            const shipmentType = document.getElementById('shipmentType' + id).value;
            const fclFields = document.getElementById('fclFields' + id);
            const lclFields = document.getElementById('lclFields' + id);

            if (shipmentType === 'FCL') {
                fclFields.style.display = 'flex';
                lclFields.style.display = 'none';
            } else {
                fclFields.style.display = 'none';
                lclFields.style.display = 'flex';
            }
        }

        // Inisialisasi untuk modal edit yang sudah ada data
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($trackings as $tracking)
                toggleShipmentFields({{ $tracking->id }});
            @endforeach
        });

        // Fungsi konfirmasi delete dengan SweetAlert
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-app-layout>
