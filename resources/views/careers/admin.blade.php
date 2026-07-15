<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">CMS /</span> Career Vacancies Management
        </h4>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">List Job Vacancies</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddCareer">
                    <i class="ti ti-plus me-1"></i> Add Vacancy
                </button>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Job Type</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($careers as $job)
                            <tr>
                                <td><strong>{{ $job->title }}</strong></td>
                                <td>{{ $job->department ?? '-' }}</td>
                                <td>{{ $job->location }}</td>
                                <td><span class="badge bg-label-secondary">{{ $job->type }}</span></td>
                                <td>
                                    @if($job->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $job->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-sm btn-icon text-primary" data-bs-toggle="modal" data-bs-target="#modalEditCareer{{ $job->id }}">
                                            <i class="ti ti-edit"></i>
                                        </button>

                                        <form id="delete-career-form-{{ $job->id }}" action="{{ route('cms.careers.destroy', $job->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-icon text-danger" onclick="confirmDeleteCareer('{{ $job->id }}')">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No career vacancies found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Career Modal -->
    <div class="modal fade" id="modalAddCareer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Job Vacancy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cms.careers.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label">Job Title</label>
                            <input type="text" class="form-control" name="title" placeholder="e.g. Senior Logistics Coordinator" required />
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <label class="form-label">Department</label>
                                <input type="text" class="form-control" name="department" placeholder="e.g. Operations / Logistics" />
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" value="Jakarta" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <label class="form-label">Job Type</label>
                                <input type="text" class="form-control" name="type" value="Full-time" required />
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="1">Active (Show on Site)</option>
                                    <option value="0">Inactive (Hide)</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Job Description</label>
                            <textarea class="form-control" name="description" rows="4" placeholder="Brief details about the job role..."></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Requirements</label>
                            <textarea class="form-control" name="requirements" rows="4" placeholder="Enter bulleted lists or text representing qualifications..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Publish Vacancy</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($careers as $job)
        <!-- Edit Career Modal -->
        <div class="modal fade" id="modalEditCareer{{ $job->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Job Vacancy</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('cms.careers.update', $job->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-4">
                                <label class="form-label">Job Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $job->title }}" required />
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-4">
                                    <label class="form-label">Department</label>
                                    <input type="text" class="form-control" name="department" value="{{ $job->department }}" />
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" name="location" value="{{ $job->location }}" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-4">
                                    <label class="form-label">Job Type</label>
                                    <input type="text" class="form-control" name="type" value="{{ $job->type }}" placeholder="e.g. Full-time, Internship" required />
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status" required>
                                        <option value="1" {{ $job->status ? 'selected' : '' }}>Active (Show on Site)</option>
                                        <option value="0" {{ !$job->status ? 'selected' : '' }}>Inactive (Hide)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Job Description</label>
                                <textarea class="form-control" name="description" rows="4">{{ $job->description }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Requirements</label>
                                <textarea class="form-control" name="requirements" rows="4" placeholder="Enter list of requirements...">{{ $job->requirements }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Vacancy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function confirmDeleteCareer(id) {
            if (confirm("Are you sure you want to delete this job vacancy?")) {
                document.getElementById('delete-career-form-' + id).submit();
            }
        }
    </script>
</x-app-layout>
