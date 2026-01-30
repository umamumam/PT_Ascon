<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-6 mb-6">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Ports</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $ports->count() }}</h4>
                                    <p class="text-success mb-0">(Total)</p>
                                </div>
                                <small class="mb-0">Total Ports Registered</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="ti ti-anchor ti-26px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">List Ports</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddPort">
                    <i class="ti ti-plus me-1"></i> Add New Port
                </button>
            </div>

            <div class="card-datatable table-responsive">
                <table class="datatables table">
                    <thead class="border-top">
                        <tr>
                            <th>Port Name</th>
                            <th>Port Code</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ports as $port)
                        <tr>
                            <td>
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-4">
                                            <span class="avatar-initial rounded-circle bg-label-secondary">
                                                {{ strtoupper(substr($port->port_name, 0, 2)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="fw-medium">{{ $port->port_name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-label-info">{{ $port->port_code }}</span></td>
                            <td>{{ $port->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-sm btn-icon text-primary"
                                        data-bs-toggle="modal" data-bs-target="#modalEditPort{{ $port->id }}">
                                        <i class="ti ti-edit"></i>
                                    </button>

                                    <form id="delete-form-{{ $port->id }}"
                                        action="{{ route('ports.destroy', $port->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-icon text-danger"
                                            onclick="confirmDelete('{{ $port->id }}')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="modal fade" id="modalEditPort{{ $port->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Port: {{ $port->port_name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('ports.update', $port->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-4">
                                                        <label class="form-label">Port Code</label>
                                                        <input type="text" class="form-control" name="port_code"
                                                            value="{{ $port->port_code }}" maxlength="10" required />
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Port Name</label>
                                                        <input type="text" class="form-control" name="port_name"
                                                            value="{{ $port->port_name }}" maxlength="100" required />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
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

    <div class="modal fade" id="modalAddPort" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Port</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('ports.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label">Port Code</label>
                            <input type="text" class="form-control" name="port_code" placeholder="IDJKT" maxlength="10" required />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Port Name</label>
                            <input type="text" class="form-control" name="port_name" placeholder="Tanjung Priok" maxlength="100" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Port</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
