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
        border-radius: 0; /* Kotak tajam sesuai desain Wix */
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
        height: auto;
        min-height: 550px;
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
        font-size: 2.5rem; /* Ukuran seimbang, tidak sebesar display-5 */
        line-height: 1.2;
    }
</style>

<section id="contactSection" class="section-py bg-white">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-5 mb-5 mt-10 mb-lg-0 reveal-on-scroll">
                <div class="contact-header mb-5">
                    <h6 class="text-dark fw-bold mb-2">Contact Us</h6>
                    <h2 class="contact-title mb-4">For Inquiries or Questions</h2>
                    <p class="text-muted" style="font-size: 0.95rem; line-height: 1.6;">
                        Please use the form or call us on <strong>+62 21 83791179</strong> or Whatsapp <strong>+62 819 1000 1999</strong>
                    </p>
                </div>

                <form action="#" class="contact-form">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label>First Name</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label>Email *</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Subject</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label>Leave us a message...</label>
                        <textarea class="form-control" rows="4"></textarea>
                    </div>

                    <div class="reveal-on-scroll delay-200">
                        <button type="submit" class="btn btn-submit">Submit</button>
                    </div>
                </form>
            </div>

            <div class="col-lg-7 reveal-on-scroll delay-400">
                <div class="ps-lg-5"> <div class="contact-image-wrapper shadow-lg">
                        <img src="https://static.wixstatic.com/media/11062b_4c3a67aca05a44d3966c17c369745435~mv2.jpeg"
                            alt="Contact PT Asia Connexindo" class="contact-image">
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
