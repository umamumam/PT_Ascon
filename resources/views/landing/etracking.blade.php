@extends('layouts.landing')

@section('content')
<style>
    :root {
        --ascon-orange: #FF5722;
        --ascon-dark-blue: #2391ff;
        --ascon-light-gray: #f8f9fa;
    }

    .tracking-card {
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

    .btn-search {
        background-color: transparent;
        color: var(--ascon-orange);
        border: 2px solid var(--ascon-orange);
        padding: 10px;
        width: 100%;
        border-radius: 5px;
        transition: all 0.3s ease;
        font-weight: bold;
    }

    .btn-search:hover {
        background-color: var(--ascon-orange);
        color: white;
    }

    .info-table {
        background-color: var(--ascon-dark-blue);
        color: white;
    }

    .info-table th {
        font-weight: 500;
        font-size: 0.85rem;
        padding: 12px;
        text-align: center;
        border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .info-table th:last-child {
        border-right: none;
    }

    .info-table td {
        padding: 12px;
        text-align: center;
        background-color: white;
        color: #333;
        font-size: 0.85rem;
        border-right: 1px solid #dee2e6;
    }

    .info-table td:last-child {
        border-right: none;
    }

    .info-table td.highlight {
        color: var(--ascon-orange);
        font-weight: 600;
    }

    .update-section {
        background-color: var(--ascon-dark-blue);
        color: white;
        padding: 12px;
        border-radius: 5px 5px 0 0;
        font-weight: 600;
        font-size: 0.9rem;
        text-align: center;
    }

    .update-header {
        background-color: #f8f9fa;
        padding: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        color: #666;
        border-bottom: 1px solid #dee2e6;
    }

    .update-row {
        padding: 10px;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.85rem;
    }

    .update-row:last-child {
        border-bottom: none;
    }

    .status-label {
        font-weight: 600;
        color: #666;
        min-width: 100px;
        display: inline-block;
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
                    <li class="breadcrumb-item active" aria-current="page">Tracking</li>
                </ol>
            </nav>
            <h1 class="fw-bold" style="color: var(--ascon-orange);">Tracking</h1>
            <p class="text-muted" style="text-align: justify; font-size: 0.95rem;">
                PT. Asia Connexindo Internasional (Ascon) was established in 1999, to facilitate the needs of
                trustworthy freight forwarding agent in Jakarta. Two decades ago, it started with small team and handled
                only consolidation groupage, however we are now growing and serving wide spectrum of transportation
                needs.
            </p>
        </div>

        <div class="col-12">
            <div class="tracking-card shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold m-0">Trace your package</h5>
                    <div class="d-flex align-items-center">
                        <span class="me-2 small fw-bold" style="color: var(--ascon-orange);">Export</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="modeSwitch">
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

                    <div class="col-md-12">
                        <label class="form-label-custom">Track your BL number</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control bl-input border-start-0"
                                placeholder="Enter BL number">
                        </div>
                    </div>
                </div>

                <div class="row pt-2">
                    <div class="col-md-10">
                        <button class="btn-search text-uppercase">Search</button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-outline-secondary w-100" style="padding: 12px;">Reset</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- BL Number Information Section -->
        <div class="col-12 mt-5">
            <div class="shadow-sm border rounded">
                <div class="update-section">
                    BL Number Information
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 info-table">
                        <thead class="bg-light">
                            <tr>
                                <th>Shipper</th>
                                <th>Consignee</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Booking/BL Number</th>
                                <th>Shipment Type</th>
                                <th>Total Measurement</th>
                                <th>Total Packages</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PT MASAKO JAYA<br><small class="text-muted">SEAMATRIX</small></td>
                                <td>SKY GOLD<br><small class="text-muted">GENERAL<br>TRADING LLC</small></td>
                                <td>Jakarta, Indonesia</td>
                                <td>Jebel Ali, UAE</td>
                                <td class="highlight">JEA-2035217590</td>
                                <td>LCL</td>
                                <td>10.00 m3</td>
                                <td>86 Cartons</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Shipment Updates Section -->
        <div class="col-12 mt-4">
            <div class="shadow-sm border rounded">
                <div class="update-section">
                    Shipment Updates
                </div>

                <!-- Update Header -->
                <div class="row update-header m-0 bg-light">
                    <div class="col-md-3">STATUS</div>
                    <div class="col-md-3">Place of Activity</div>
                    <div class="col-md-2">Date</div>
                    <div class="col-md-3">Vessel Information</div>
                    <div class="col-md-1">Remarks</div>
                </div>

                <!-- 1st Update -->
                <div class="bg-white p-3">
                    <div class="row update-row align-items-center">
                        <div class="col-md-3"><span class="status-label">Departed</span></div>
                        <div class="col-md-3">Jakarta, Indonesia</div>
                        <div class="col-md-2">1/8/2026</div>
                        <div class="col-md-3">SINAR SAMUJA V.1234</div>
                        <div class="col-md-1 text-center">-</div>
                    </div>
                    <div class="row update-row align-items-center">
                        <div class="col-md-3"><span class="status-label">Discharge</span></div>
                        <div class="col-md-3">Tanjung Pelepas</div>
                        <div class="col-md-2">1/8/2026</div>
                        <div class="col-md-3">SINAR SAMUJA V.1234</div>
                        <div class="col-md-1 text-center">-</div>
                    </div>
                    <div class="row update-row align-items-center">
                        <div class="col-md-3"><span class="status-label">Connecting</span></div>
                        <div class="col-md-3">Tanjung Pelepas</div>
                        <div class="col-md-2">1/8/2026</div>
                        <div class="col-md-3">SINAR SAMUJA V.1234</div>
                        <div class="col-md-1 text-center">-</div>
                    </div>
                    <div class="row update-row align-items-center">
                        <div class="col-md-3"><span class="status-label">Arrival</span></div>
                        <div class="col-md-3">Jebel Ali</div>
                        <div class="col-md-2">1/12/2026</div>
                        <div class="col-md-3">SINAR SAMUJA V.1234</div>
                        <div class="col-md-1 text-center">-</div>
                    </div>
                </div>

                <!-- 1st Update Label -->
                <div class="bg-light py-2 px-3 border-top border-bottom">
                    <strong>1st Update</strong>
                </div>

                <!-- Repeated Updates -->
                <div class="bg-white p-3">
                    <div class="row update-row align-items-center">
                        <div class="col-md-3"><span class="status-label">Departure</span></div>
                        <div class="col-md-3">Tanjung Pelepas</div>
                        <div class="col-md-2">1/12/2026</div>
                        <div class="col-md-3">SINAR SAMUJA V.1234</div>
                        <div class="col-md-1 text-center">-</div>
                    </div>
                    <div class="row update-row align-items-center">
                        <div class="col-md-3"><span class="status-label">Arrival</span></div>
                        <div class="col-md-3">Jebel Ali</div>
                        <div class="col-md-2">1/12/2026</div>
                        <div class="col-md-3">SINAR SAMUJA V.1234</div>
                        <div class="col-md-1 text-center">-</div>
                    </div>
                </div>

                <!-- 2nd Update Label -->
                <div class="bg-light py-2 px-3 border-top border-bottom">
                    <strong>2nd Update</strong>
                </div>

                <!-- Final Updates -->
                <div class="bg-white p-3">
                    <div class="row update-row align-items-center">
                        <div class="col-md-3"><span class="status-label">Departure</span></div>
                        <div class="col-md-3">Tanjung Pelepas</div>
                        <div class="col-md-2">1/12/2026</div>
                        <div class="col-md-3">SINAR SAMUJA V.1234</div>
                        <div class="col-md-1 text-center">-</div>
                    </div>
                    <div class="row update-row align-items-center">
                        <div class="col-md-3"><span class="status-label">Arrival</span></div>
                        <div class="col-md-3">Jebel Ali</div>
                        <div class="col-md-2">1/12/2026</div>
                        <div class="col-md-3">SINAR SAMUJA V.1234</div>
                        <div class="col-md-1 text-center">-</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Service box selection
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

    // Mode switch functionality
    document.getElementById('modeSwitch').addEventListener('change', function() {
        const exportLabel = this.previousElementSibling.previousElementSibling;
        const importLabel = this.nextElementSibling;

        if(this.checked) {
            importLabel.classList.remove('text-muted');
            importLabel.classList.add('fw-bold');
            importLabel.style.color = 'var(--ascon-orange)';
            exportLabel.classList.remove('fw-bold');
            exportLabel.classList.add('text-muted');
            exportLabel.style.color = '';
        } else {
            exportLabel.classList.remove('text-muted');
            exportLabel.classList.add('fw-bold');
            exportLabel.style.color = 'var(--ascon-orange)';
            importLabel.classList.remove('fw-bold');
            importLabel.classList.add('text-muted');
            importLabel.style.color = '';
        }
    });
</script>
@endsection
