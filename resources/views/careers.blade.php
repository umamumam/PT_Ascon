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
        </div>
    </div>
</section>

@endsection
