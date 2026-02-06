@extends('layouts.landing')

@section('content')
<style>
    :root {
        --ascon-orange: #FF5722;
        --ascon-dark-blue: #2391ff;
        /* Warna biru sesuai gambar 2 */
        --ascon-light-gray: #f8f9fa;
    }

    .sailing-schedule-card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 30px;
        background: #fff;
    }

    .service-box {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 100%;
    }

    .service-box.active {
        border-color: var(--ascon-orange);
        box-shadow: 0 0 0 1px var(--ascon-orange);
    }

    .service-box img {
        width: 50px;
        margin-bottom: 10px;
    }

    .form-label-custom {
        font-size: 0.85rem;
        font-weight: 600;
        color: #666;
        margin-bottom: 5px;
    }

    /* REVISI TOMBOL SEARCH */
    .btn-search {
        background-color: transparent;
        color: var(--ascon-orange);
        border: 2px solid var(--ascon-orange);
        padding: 10px;
        width: 100%;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .btn-search:hover {
        background-color: var(--ascon-orange);
        color: white;
    }

    /* REVISI WARNA TABEL */
    .table-schedule thead th {
        background-color: var(--ascon-dark-blue) !important;
        color: white !important;
        font-weight: 500;
        font-size: 0.85rem;
        border: none;
        padding: 12px;
    }

    .table-schedule tbody td {
        font-size: 0.85rem;
        vertical-align: middle;
        padding: 12px;
    }

    .table-schedule thead tr.sub-header-table th {
        background-color: #f2f2f2 !important;
        color: #272727 !important;
        border-left: none !important;
        border-right: none !important;
    }

    .port-badge-group .btn-outline-secondary {
        border-color: #dee2e6;
        color: #666;
        font-size: 0.85rem;
        margin-bottom: 5px;
    }

    .form-check-input:checked {
        background-color: var(--ascon-orange);
        border-color: var(--ascon-orange);
    }
</style>

<div class="container py-5" style="margin-top: 7em">
    <div class="row">
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">eService</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sailing Schedule</li>
                </ol>
            </nav>
            <h1 class="fw-bold" style="color: var(--ascon-orange);">Sailing Schedule</h1>
            <p class="text-muted" style="text-align: justify; font-size: 0.95rem;">
                PT. Asia Connexindo Internasional (Ascon) was established in 1999, to facilitate the needs of
                trustworthy freight forwarding agent in Jakarta. Two decades ago, it started with small team and handled
                only consolidation groupage, however we are now growing and serving wide spectrum of transportation
                needs.
            </p>
        </div>

        <div class="col-12">
            <div class="sailing-schedule-card shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0">Explore Sailing Schedule</h5>
                    <div class="d-flex align-items-center">
                        <span class="me-2 small fw-bold">Export</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="modeSwitch" checked>
                        </div>
                        <span class="ms-1 small text-muted">Import</span>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-12">
                        <label class="form-label-custom">Service Category</label>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="service-box active d-flex flex-column align-items-start">
                                    <img src="{{ asset('LCL.png') }}" alt="LCL">
                                    <span class="small fw-bold">Less than Container Load / LCL</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="service-box d-flex flex-column align-items-start">
                                    <img src="{{ asset('FCL.png') }}" alt="FCL">
                                    <span class="small fw-bold text-muted">Full Container Load / FCL</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Port of loading</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control border-start-0" placeholder="Search loading port">
                        </div>
                        <div class="port-badge-group">
                            <button class="btn btn-sm w-100 mb-1"
                                style="border: 1px solid var(--ascon-orange); color: var(--ascon-orange)">Jakarta</button>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-outline-secondary flex-grow-1">Surabaya</button>
                                <button class="btn btn-sm btn-outline-secondary flex-grow-1">Semarang</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Port of destination</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control border-start-0"
                                placeholder="Search destination port">
                        </div>
                        <div class="port-badge-group">
                            <button class="btn btn-sm w-100 mb-1"
                                style="border: 1px solid var(--ascon-orange); color: var(--ascon-orange)">LAEM CHABANG &
                                BANGKOK</button>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-outline-secondary flex-grow-1">Boston</button>
                                <button class="btn btn-sm btn-outline-secondary flex-grow-1">Bangkok</button>
                                <button class="btn btn-sm btn-outline-secondary flex-grow-1">Haiphong</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-2">
                    <div class="col-md-10">
                        <button class="btn-search fw-bold text-uppercase">Search</button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-secondary w-100" style="padding: 10px;">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="table-responsive rounded shadow-sm border">
                <table class="table table-hover table-schedule mb-0">
                    <thead class="text-center">
                        <tr>
                            <th colspan="6" class="py-3 text-uppercase">JAKARTA - LAEM CHABANG & BANGKOK</th>
                        </tr>
                        <tr class="sub-header-table">
                            <th class="text-dark">Vessel</th>
                            <th class="text-dark">Voy.</th>
                            <th class="text-dark">ETD JKT</th>
                            <th class="text-dark">ETA THLCH</th>
                            <th class="text-dark">ETA TH BKKPAT</th>
                            <th class="text-dark">Remarks</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>NATTHA BHUM</td>
                            <td>049N</td>
                            <td>2 - Feb</td>
                            <td>7 - Feb</td>
                            <td>+/- BY BARGE 2DAYS</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>LADY OF LUCK</td>
                            <td>282N</td>
                            <td>8 - Feb</td>
                            <td>14 - Feb</td>
                            <td>+/- BY BARGE 2DAYS</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>NATTHA BHUM</td>
                            <td>050N</td>
                            <td>15 - Feb</td>
                            <td>20 - Feb</td>
                            <td>+/- BY BARGE 2DAYS</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-12 mt-4 d-flex justify-content-between align-items-center bg-light p-3 rounded border">
            <h6 class="fw-bold m-0">Download This Schedule</h6>
            <button class="btn btn-danger btn-sm px-4">
                <i class="bi bi-download me-2"></i>Download
            </button>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.service-box').forEach(box => {
        box.addEventListener('click', function() {
            document.querySelectorAll('.service-box').forEach(b => {
                b.classList.remove('active');
                b.querySelector('span').classList.add('text-muted');
            });
            this.classList.add('active');
            this.querySelector('span').classList.remove('text-muted');
        });
    });
</script>
@endsection
