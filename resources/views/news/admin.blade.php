<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">CMS /</span> News Update Management
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
                <h5 class="card-title mb-0">List News Articles</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddNews">
                    <i class="ti ti-plus me-1"></i> Add News Article
                </button>
            </div>

            <div class="card-datatable table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Read Time</th>
                            <th>Image</th>
                            <th>Stats</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $article)
                            <tr>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ $article->title }}</span>
                                        <small class="text-muted text-truncate" style="max-width: 250px;">{{ Str::limit($article->content, 60) }}</small>
                                    </div>
                                </td>
                                <td>{{ $article->author }}</td>
                                <td><span class="badge bg-label-info">{{ $article->read_time }} min read</span></td>
                                <td>
                                    @if($article->image_path)
                                        <img src="{{ asset($article->image_path) }}" alt="news img" class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="d-block"><i class="ti ti-eye me-1"></i>{{ $article->views_count }}</small>
                                    <small class="d-block"><i class="ti ti-heart me-1"></i>{{ $article->likes_count }}</small>
                                </td>
                                <td>{{ $article->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-sm btn-icon text-primary" data-bs-toggle="modal" data-bs-target="#modalEditNews{{ $article->id }}">
                                            <i class="ti ti-edit"></i>
                                        </button>

                                        <form id="delete-news-form-{{ $article->id }}" action="{{ route('cms.news.destroy', $article->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-icon text-danger" onclick="confirmDeleteNews('{{ $article->id }}')">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No news articles registered.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add News Modal -->
    <div class="modal fade" id="modalAddNews" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New News Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cms.news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label">Article Title</label>
                            <input type="text" class="form-control" name="title" placeholder="e.g. Welcome to our new and improved website" required />
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <label class="form-label">Author Name</label>
                                <input type="text" class="form-control" name="author" placeholder="Admin" />
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label class="form-label">Read Time (minutes)</label>
                                <input type="number" class="form-control" name="read_time" value="1" min="1" required />
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Header Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*" required />
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Content</label>
                            <textarea class="form-control" name="content" rows="10" placeholder="Write article content here..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Publish Article</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($news as $article)
        <!-- Edit News Modal -->
        <div class="modal fade" id="modalEditNews{{ $article->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit News Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('cms.news.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-4">
                                <label class="form-label">Article Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $article->title }}" required />
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-4">
                                    <label class="form-label">Author Name</label>
                                    <input type="text" class="form-control" name="author" value="{{ $article->author }}" />
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <label class="form-label">Read Time (minutes)</label>
                                    <input type="number" class="form-control" name="read_time" value="{{ $article->read_time }}" min="1" required />
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Header Image (leave empty to keep current)</label>
                                <input type="file" class="form-control" name="image" accept="image/*" />
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Content</label>
                                <textarea class="form-control" name="content" rows="10" required>{{ $article->content }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Article</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function confirmDeleteNews(id) {
            if (confirm("Are you sure you want to delete this news article?")) {
                document.getElementById('delete-news-form-' + id).submit();
            }
        }
    </script>
</x-app-layout>
