@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')

    <!-- Hero Section -->
    <section class="contact-hero-section position-relative overflow-hidden">

        <div class="bg-shape-1"></div>
        <div class="bg-shape-2"></div>

        <div class="container">

            <div class="row align-items-center min-vh-100">

                <div class="col-lg-6">

                <span class="section-badge">
                    Contact Us
                </span>

                    <h1 class="hero-title mt-4">
                        We’re Here To Help You With Your Financial Needs
                    </h1>

                    <p class="hero-text mt-4">
                        Have questions about loans, eligibility, EMI, or documentation?
                        Our team is ready to assist you anytime.
                    </p>

                    <div class="contact-info-list mt-5">

                        <div class="contact-info-item">

                            <div class="contact-info-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>

                            <div>
                                <h6>
                                    Call Us
                                </h6>

                                <p>
                                    +91 9876543210
                                </p>
                            </div>

                        </div>

                        <div class="contact-info-item">

                            <div class="contact-info-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>

                            <div>
                                <h6>
                                    Email Address
                                </h6>

                                <p>
                                    info@yourcompany.com
                                </p>
                            </div>

                        </div>

                        <div class="contact-info-item">

                            <div class="contact-info-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>

                            <div>
                                <h6>
                                    Office Address
                                </h6>

                                <p>
                                    Mumbai, Maharashtra, India
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="contact-form-card">

                        <h3 class="fw-bold mb-4">
                            Send Us Message
                        </h3>

                        <form>

                            <div class="row g-4">

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Full Name
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           placeholder="Enter Full Name">

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label">
                                        Mobile Number
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           placeholder="Enter Mobile Number">

                                </div>

                                <div class="col-12">

                                    <label class="form-label">
                                        Email Address
                                    </label>

                                    <input type="email"
                                           class="form-control"
                                           placeholder="Enter Email Address">

                                </div>

                                <div class="col-12">

                                    <label class="form-label">
                                        Subject
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           placeholder="Enter Subject">

                                </div>

                                <div class="col-12">

                                    <label class="form-label">
                                        Message
                                    </label>

                                    <textarea class="form-control contact-textarea"
                                              rows="5"
                                              placeholder="Write your message..."></textarea>

                                </div>

                                <div class="col-12">

                                    <button class="btn btn-primary btn-lg w-100">
                                        Send Message
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Branches -->
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

            <span class="section-badge">
                Our Offices
            </span>

                <h2 class="section-title mt-3">
                    Visit Our Branches
                </h2>

                <p class="section-description mt-3">
                    We are available across multiple cities to support your financial journey.
                </p>

            </div>

            <div class="row g-4">

                <div class="col-lg-4 col-md-6">

                    <div class="branch-card">

                        <div class="branch-icon">
                            <i class="bi bi-building"></i>
                        </div>

                        <h5 class="mt-4">
                            Mumbai Office
                        </h5>

                        <p class="mt-3">
                            Andheri East, Mumbai, Maharashtra
                        </p>

                        <a href="#" class="btn btn-outline-primary mt-3">
                            Get Directions
                        </a>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="branch-card">

                        <div class="branch-icon">
                            <i class="bi bi-building"></i>
                        </div>

                        <h5 class="mt-4">
                            Pune Office
                        </h5>

                        <p class="mt-3">
                            Hinjewadi, Pune, Maharashtra
                        </p>

                        <a href="#" class="btn btn-outline-primary mt-3">
                            Get Directions
                        </a>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="branch-card">

                        <div class="branch-icon">
                            <i class="bi bi-building"></i>
                        </div>

                        <h5 class="mt-4">
                            Delhi Office
                        </h5>

                        <p class="mt-3">
                            Connaught Place, New Delhi
                        </p>

                        <a href="#" class="btn btn-outline-primary mt-3">
                            Get Directions
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Google Map -->
    <section class="pb-5">

        <div class="container">

            <div class="map-card overflow-hidden">

{{--                <iframe--}}
{{--                    src="https://www.google.com/maps/embed?pb=!1m18"--}}
{{--                    width="100%"--}}
{{--                    height="450"--}}
{{--                    style="border:0;"--}}
{{--                    allowfullscreen=""--}}
{{--                    loading="lazy">--}}
{{--                </iframe>--}}

            </div>

        </div>

    </section>

@endsection
