@extends('layouts.landing')
@section('content')

<section id="landingCareers" class="section-py bg-white">
    <div class="container">
        <div class="row mb-5 mt-10 reveal-on-scroll">
            <div class="col-lg-12">
                <h6 class="text-dark fw-bold mb-2">Join the Success</h6>
                <h2 class="display-5 fw-bold mb-4" style="color: #FF5722; line-height: 1.2;">
                    We Are Hiring a Range<br>of Positions
                </h2>
            </div>
        </div>

        <div class="row g-4 reveal-on-scroll delay-200">
            @forelse($jobs as $job)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-5" style="background-color: #ffffff; border-radius: 4px; min-height: 380px;">
                        <div class="card-body p-0 d-flex flex-column h-100">
                            <div>
                                <span class="badge bg-label-primary mb-2">{{ $job->type }}</span>
                                <h4 class="fw-bold text-dark mb-2">{{ $job->title }}</h4>
                                <div class="text-muted mb-4 small">
                                    <i class="ti ti-map-pin me-1"></i>{{ $job->location }} 
                                    @if($job->department)
                                        • <i class="ti ti-briefcase ms-1 me-1"></i>{{ $job->department }}
                                    @endif
                                </div>
                                <p class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">
                                    {{ Str::limit($job->description, 180) }}
                                </p>
                            </div>
                            <div class="mt-auto pt-4">
                                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalJobDetail{{ $job->id }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Detail Modal -->
                <div class="modal fade" id="modalJobDetail{{ $job->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div>
                                    <h4 class="modal-title fw-bold text-dark">{{ $job->title }}</h4>
                                    <small class="text-muted">{{ $job->location }} • {{ $job->type }}</small>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-muted" style="line-height: 1.8;">
                                @if($job->description)
                                    <h5 class="fw-bold text-dark mb-2">Job Description</h5>
                                    <p class="mb-4" style="white-space: pre-line;">{{ $job->description }}</p>
                                @endif

                                @if($job->requirements)
                                    <h5 class="fw-bold text-dark mb-2">Requirements</h5>
                                    <p style="white-space: pre-line;">{{ $job->requirements }}</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <a href="/contact" class="btn btn-primary">Apply Now</a>
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm p-5" style="background-color: #ffffff; border-radius: 4px; min-height: 400px;">
                        <div class="card-body p-0">
                            <h4 class="fw-bold text-dark mb-3">No Vacancy</h4>
                            <p class="text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                                There are no roles available right now.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-none d-md-block">
                    <div class="h-100 border-0" style="background-color: #fcfcfc; min-height: 400px; border-radius: 4px;"></div>
                </div>
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="h-100 border-0" style="background-color: #fcfcfc; min-height: 400px; border-radius: 4px;"></div>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
