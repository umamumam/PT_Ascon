@extends('layouts.landing')
@section('content')

<style>
    /* Styling khusus untuk input minimalis (underline) agar rapi */
    .contact-form .form-control {
        border: none;
        border-bottom: 1px solid #000;
        border-radius: 0;
        padding: 10px 0;
        background-color: transparent;
        font-size: 0.95rem;
    }

    .contact-form .form-control:focus {
        box-shadow: none;
        border-bottom: 2px solid #FF5722;
    }

    .contact-form label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0;
    }

    .btn-submit {
        background-color: #FF5722;
        color: white;
        border: none;
        padding: 12px 60px;
        border-radius: 0;
        /* Kotak tajam sesuai desain Wix */
        font-weight: 500;
        transition: 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #e64a19;
        color: white;
        box-shadow: 0 4px 12px rgba(255, 87, 34, 0.2);
    }

    .contact-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 4px;
    }

    .contact-image {
        width: 100%;
        height: 480px;
        object-fit: cover;
    }

    textarea.form-control {
        border: 1px solid #000 !important;
        margin-top: 10px;
        padding: 10px !important;
    }

    /* Penyesuaian ukuran teks agar selaras dengan LandingAbout */
    .contact-title {
        color: #FF5722;
        font-weight: 700;
        font-size: 2rem;
        /* Ukuran seimbang, tidak terlalu besar */
        line-height: 1.2;
    }
</style>

<section id="contactSection" class="section-py bg-white" style="padding-top: 180px !important;">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 mb-5 mb-lg-0 reveal-on-scroll">
                <div class="contact-header mb-5">
                    <h6 class="text-dark fw-bold mb-2">Contact Us</h6>
                    <h2 class="contact-title mb-4">For Inquiries or Questions</h2>
                    <p class="text-dark" style="font-size: 0.95rem; line-height: 1.6;">
                        Please use the form or call us on <strong>+62 21 83791179</strong> or Whatsapp <strong>+62 819
                            1000 1999</strong>
                    </p>
                </div>

                <form id="contactForm" action="{{ route('public.contact.store') }}" method="POST" class="contact-form">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="" required>
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label>Leave us a message...</label>
                        <textarea name="message" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="reveal-on-scroll delay-200">
                        <button type="submit"
                            class="btn btn-submit d-inline-flex align-items-center gap-2">Submit</button>
                    </div>
                </form>
            </div>

            <div class="col-lg-6 reveal-on-scroll delay-400">
                <div class="ps-lg-4">
                    <div class="contact-image-wrapper shadow-lg">
                        <img src="https://static.wixstatic.com/media/11062b_4c3a67aca05a44d3966c17c369745435~mv2.jpeg"
                            alt="Contact PT Asia Connexindo" class="contact-image">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SweetAlert2 Resources & Script -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contactForm');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            
            const btn = form.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;
            
            // Ubah tombol ke status loading
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Sending...';
            btn.disabled = true;
            
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Message Sent!',
                        text: 'Your message has been sent successfully. We will contact you soon.',
                        confirmButtonColor: '#FF5722',
                        customClass: {
                            confirmButton: 'btn btn-primary px-5'
                        }
                    });
                    form.reset();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonColor: '#FF5722'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred. Please check your connection and try again.',
                    confirmButtonColor: '#FF5722'
                });
            })
            .finally(() => {
                // Kembalikan tombol ke keadaan semula
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        });
    }
});
</script>

@endsection