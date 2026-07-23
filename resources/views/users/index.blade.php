<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-6 mb-6">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Session</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">{{ $users->count() }}</h4>
                                    <p class="text-success mb-0">(Total)</p>
                                </div>
                                <small class="mb-0">Total Users Registered</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="ti ti-users ti-26px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Paid Users</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">4,567</h4>
                                    <p class="text-success mb-0">(+18%)</p>
                                </div>
                                <small class="mb-0">Last week analytics </small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-danger">
                                    <i class="ti ti-user-plus ti-26px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Active Users</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">19,860</h4>
                                    <p class="text-danger mb-0">(-14%)</p>
                                </div>
                                <small class="mb-0">Last week analytics</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="ti ti-user-check ti-26px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span class="text-heading">Pending Users</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">237</h4>
                                    <p class="text-success mb-0">(+42%)</p>
                                </div>
                                <small class="mb-0">Last week analytics</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="ti ti-user-search ti-26px"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">List Users</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddUser">
                    <i class="ti ti-plus me-1"></i> Add New User
                </button>
            </div>

            <div class="card-datatable table-responsive">
                <table class="datatables table">
                    <thead class="border-top">
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-4">
                                            <span class="avatar-initial rounded-circle bg-label-secondary">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="fw-medium">{{ $user->name }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge bg-label-primary">Admin</span>
                                @else
                                    <span class="badge bg-label-info">Client</span>
                                @endif
                            </td>
                            <td><span class="badge bg-label-success">Active</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-sm btn-icon text-primary"
                                        data-bs-toggle="modal" data-bs-target="#modalEditUser{{ $user->id }}">
                                        <i class="ti ti-edit"></i>
                                    </button>

                                    <form id="delete-form-{{ $user->id }}"
                                        action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-icon text-danger"
                                            onclick="confirmDelete('{{ $user->id }}')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="modal fade" id="modalEditUser{{ $user->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit User: {{ $user->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-4">
                                                        <label class="form-label">Full Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ $user->name }}" required />
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            value="{{ $user->email }}" required />
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Role</label>
                                                        <select class="form-select" name="role" required>
                                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Client (User)</option>
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    <small class="text-muted d-block mb-3">Kosongkan password jika tidak
                                                        ingin mengubahnya.</small>
                                                    <div class="mb-4">
                                                        <label class="form-label">New Password</label>
                                                        <input type="password" class="form-control" name="password" />
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label">Confirm New Password</label>
                                                        <input type="password" class="form-control"
                                                            name="password_confirmation" />
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

    <div class="modal fade" id="modalAddUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="John Doe" required />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="john@example.com"
                                required />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Role</label>
                            <select class="form-select" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="user">Client (User)</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
