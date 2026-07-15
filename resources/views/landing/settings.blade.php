<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">CMS /</span> Landing Page & Global Settings
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

        <div class="row">
            <div class="col-12">
                <div class="nav-align-top mb-6">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ request('tab') != 'feeds' ? 'active' : '' }}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-settings" aria-controls="navs-settings" aria-selected="true">
                                <i class="ti ti-settings me-1_5"></i> Global Settings & Info
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ request('tab') == 'feeds' ? 'active' : '' }}" role="tab" data-bs-toggle="tab" data-bs-target="#navs-feeds" aria-controls="navs-feeds" aria-selected="false">
                                <i class="ti ti-layout-grid me-1_5"></i> Social Grid (Follow Us)
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Tab 1: Global Settings -->
                        <div class="tab-pane fade {{ request('tab') != 'feeds' ? 'show active' : '' }}" id="navs-settings" role="tabpanel">
                            <form action="{{ route('cms.settings.update') }}" method="POST">
                                @csrf
                                <div class="row g-6">
                                    <div class="col-12">
                                        <h5 class="mb-4">Hero Section</h5>
                                        <div class="mb-4">
                                            <label class="form-label" for="hero_title">Hero Title</label>
                                            <textarea class="form-control" id="hero_title" name="hero_title" rows="3" required>{{ $settings['hero_title'] ?? '' }}</textarea>
                                            <small class="text-muted">Use newlines to break text (renders as &lt;br&gt; on the frontend).</small>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="hero_subtitle">Hero Subtitle</label>
                                            <textarea class="form-control" id="hero_subtitle" name="hero_subtitle" rows="4" required>{{ $settings['hero_subtitle'] ?? '' }}</textarea>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="col-md-6">
                                        <h5 class="mb-4">Office Addresses</h5>
                                        <div class="mb-4">
                                            <label class="form-label" for="head_office_address">Head Office Address</label>
                                            <textarea class="form-control" id="head_office_address" name="head_office_address" rows="4" required>{{ $settings['head_office_address'] ?? '' }}</textarea>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="semarang_office_address">Semarang Office Address</label>
                                            <textarea class="form-control" id="semarang_office_address" name="semarang_office_address" rows="4" required>{{ $settings['semarang_office_address'] ?? '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="mb-4">Contact Info & Socials</h5>
                                        <div class="row">
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label" for="phone">Phone 1 (Jakarta)</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $settings['phone'] ?? '' }}" required>
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label" for="phone_2">Phone 2 (Jakarta)</label>
                                                <input type="text" class="form-control" id="phone_2" name="phone_2" value="{{ $settings['phone_2'] ?? '' }}">
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label" for="phone_semarang">Phone 1 (Semarang)</label>
                                                <input type="text" class="form-control" id="phone_semarang" name="phone_semarang" value="{{ $settings['phone_semarang'] ?? '' }}">
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label" for="phone_semarang_2">Phone 2 (Semarang)</label>
                                                <input type="text" class="form-control" id="phone_semarang_2" name="phone_semarang_2" value="{{ $settings['phone_semarang_2'] ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="email">Admin Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $settings['email'] ?? '' }}" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="whatsapp">WhatsApp Number</label>
                                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="facebook_link">Facebook Link</label>
                                            <input type="text" class="form-control" id="facebook_link" name="facebook_link" value="{{ $settings['facebook_link'] ?? '' }}">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="instagram_link">Instagram Link</label>
                                            <input type="text" class="form-control" id="instagram_link" name="instagram_link" value="{{ $settings['instagram_link'] ?? '' }}">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="linkedin_link">LinkedIn Link</label>
                                            <input type="text" class="form-control" id="linkedin_link" name="linkedin_link" value="{{ $settings['linkedin_link'] ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 text-end">
                                        <button type="submit" class="btn btn-primary px-5">Save Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Tab 2: Social Grid / Feeds -->
                        <div class="tab-pane fade {{ request('tab') == 'feeds' ? 'show active' : '' }}" id="navs-feeds" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">List Social Grid Feeds</h5>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddFeed">
                                    <i class="ti ti-plus me-1"></i> Add Feed Card
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Card Title</th>
                                            <th>Tag Name</th>
                                            <th>Image</th>
                                            <th>Link Redirect</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($feeds as $feed)
                                            <tr>
                                                <td><strong>{{ $feed->title }}</strong></td>
                                                <td><span class="badge bg-label-primary">{{ $feed->tag }}</span></td>
                                                <td>
                                                    <img src="{{ str_starts_with($feed->image_path, 'http') ? $feed->image_path : asset($feed->image_path) }}" alt="feed img" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                                </td>
                                                <td>
                                                    @if($feed->link)
                                                        <a href="{{ $feed->link }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 150px;">{{ $feed->link }}</a>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <button type="button" class="btn btn-sm btn-icon text-primary" data-bs-toggle="modal" data-bs-target="#modalEditFeed{{ $feed->id }}">
                                                            <i class="ti ti-edit"></i>
                                                        </button>

                                                        <form id="delete-feed-form-{{ $feed->id }}" action="{{ route('cms.feeds.destroy', $feed->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-icon text-danger" onclick="confirmDeleteFeed('{{ $feed->id }}')">
                                                                <i class="ti ti-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No social grid items found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Feed Modal -->
    <div class="modal fade" id="modalAddFeed" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Social Feed Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cms.feeds.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label">Title / Description</label>
                            <input type="text" class="form-control" name="title" required placeholder="e.g. Top 10 Commodities" />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Tag Name (e.g. Event, Announcement)</label>
                            <input type="text" class="form-control" name="tag" required placeholder="e.g. Top Commodities" />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Image File</label>
                            <input type="file" class="form-control" name="image" accept="image/*" required />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Redirect Link (Instagram/Facebook URL)</label>
                            <input type="url" class="form-control" name="link" placeholder="https://instagram.com/..." />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Feed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($feeds as $feed)
        <!-- Edit Feed Modal -->
        <div class="modal fade" id="modalEditFeed{{ $feed->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Feed Card</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('cms.feeds.update', $feed->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-4">
                                <label class="form-label">Title / Description</label>
                                <input type="text" class="form-control" name="title" value="{{ $feed->title }}" required />
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Tag (e.g. Event, New Year, Merry Christmas)</label>
                                <input type="text" class="form-control" name="tag" value="{{ $feed->tag }}" required />
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Image File (leave empty to keep current)</label>
                                <input type="file" class="form-control" name="image" accept="image/*" />
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Redirect Link (Instagram/Facebook URL)</label>
                                <input type="url" class="form-control" name="link" value="{{ $feed->link }}" placeholder="https://instagram.com/..." />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Feed</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function confirmDeleteFeed(id) {
            if (confirm("Are you sure you want to delete this social feed card?")) {
                document.getElementById('delete-feed-form-' + id).submit();
            }
        }
    </script>
</x-app-layout>
