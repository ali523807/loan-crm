@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

    <!-- Hero Section -->
    <section class="hero-section">

        <div class="container">

            <div class="row align-items-center min-vh-100">

                <div class="col-lg-6">

                <span class="hero-badge">
                    Fast Loan Approval
                </span>

                    <h1 class="hero-title">
                        Get Instant Loan Approval For Your Needs
                    </h1>

                    <p class="hero-text">
                        Apply online for personal, business, and home loans with quick approval and minimum documentation.
                    </p>

                    <div class="mt-4">

                        <a href="{{ route('frontend.apply-loan') }}" class="btn btn-primary btn-lg px-5 me-3">
                            Apply Loan
                        </a>

                        <a href="#" class="btn btn-outline-dark btn-lg px-5">
                            Learn More
                        </a>

                    </div>

                </div>

                <div class="col-lg-6 text-center">

                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                         class="img-fluid hero-image">

                </div>

            </div>

        </div>

    </section>

    <!-- MARQUEE -->
    <section class="marquee-section">

        <div class="marquee-content">

        <span>
            <i class="bi bi-check-circle-fill"></i>
            Low Rate Of Interest
        </span>

            <span>
            <i class="bi bi-check-circle-fill"></i>
            Minimum Documentation
        </span>

            <span>
            <i class="bi bi-check-circle-fill"></i>
            Safe & Secure
        </span>

            <span>
            <i class="bi bi-check-circle-fill"></i>
            Doorstep Service
        </span>

            <span>
            <i class="bi bi-check-circle-fill"></i>
            Fast Processing
        </span>

            <span>
            <i class="bi bi-check-circle-fill"></i>
            Instant Loan Approval
        </span>

            <span>
            <i class="bi bi-check-circle-fill"></i>
            No Hidden Charges
        </span>

            <span>
            <i class="bi bi-check-circle-fill"></i>
            Flexible EMI
        </span>

        </div>

    </section>

    <!-- Loan Services -->
    <section class="py-5 bg-light">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="section-title">
                    Our Loan Services
                </h2>

            </div>

            <div class="row g-4">

                <div class="col-md-6 col-lg-3">

                    <div class="loan-card">

                        <div class="loan-icon">
                            💳
                        </div>

                        <h5>
                            Personal Loan
                        </h5>

                        <p>
                            Quick personal finance with easy approvals.
                        </p>

                    </div>

                </div>

                <div class="col-md-6 col-lg-3">

                    <div class="loan-card">

                        <div class="loan-icon">
                            🏢
                        </div>

                        <h5>
                            Business Loan
                        </h5>

                        <p>
                            Grow your business with financial support.
                        </p>

                    </div>

                </div>

                <div class="col-md-6 col-lg-3">

                    <div class="loan-card">

                        <div class="loan-icon">
                            🏠
                        </div>

                        <h5>
                            Home Loan
                        </h5>

                        <p>
                            Affordable home loans with flexible EMIs.
                        </p>

                    </div>

                </div>

                <div class="col-md-6 col-lg-3">

                    <div class="loan-card">

                        <div class="loan-icon">
                            💰
                        </div>

                        <h5>
                            Gold Loan
                        </h5>

                        <p>
                            Instant loans against your gold assets.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Why Choose Us -->
    <section class="why-choose-section py-5">

        <div class="container">

            <div class="row align-items-center">

                <!-- Left Content -->
                <div class="col-lg-6 mb-5 mb-lg-0">

                <span class="section-badge">
                    Why Choose Us
                </span>

                    <h2 class="section-title mt-3">
                        We Help You Get Loans Easily & Quickly
                    </h2>

                    <p class="section-description mt-4">
                        We provide fast approval, transparent processes, secure documentation,
                        and flexible repayment options for all your financial needs.
                    </p>

                    <div class="row mt-5 g-4">

                        <div class="col-md-6">

                            <div class="feature-box">

                                <div class="feature-icon">
                                    <i class="bi bi-lightning-charge-fill"></i>
                                </div>

                                <h5>
                                    Fast Approval
                                </h5>

                                <p>
                                    Get your loan approved within 24 hours.
                                </p>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="feature-box">

                                <div class="feature-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>

                                <h5>
                                    Secure Process
                                </h5>

                                <p>
                                    Your documents and data remain fully protected.
                                </p>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="feature-box">

                                <div class="feature-icon">
                                    <i class="bi bi-currency-rupee"></i>
                                </div>

                                <h5>
                                    Low Interest
                                </h5>

                                <p>
                                    Affordable interest rates for every customer.
                                </p>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="feature-box">

                                <div class="feature-icon">
                                    <i class="bi bi-headset"></i>
                                </div>

                                <h5>
                                    24/7 Support
                                </h5>

                                <p>
                                    Dedicated support team to assist anytime.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Right Image -->
                <div class="col-lg-6 text-center">

                    <img src="https://cdn-icons-png.flaticon.com/512/2489/2489756.png"
                         class="img-fluid why-image">

                </div>

            </div>

        </div>

    </section>

    <!--EMI Calculator-->
    @include('frontend.partials._emi-calculator')

@endsection
