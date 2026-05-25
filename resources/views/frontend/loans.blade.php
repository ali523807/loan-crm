@extends('frontend.layouts.app')

@section('title', 'Our Loans')

@section('content')

    <!-- Hero Section -->
    <section class="loan-page-hero position-relative overflow-hidden">

        <div class="bg-shape-1"></div>
        <div class="bg-shape-2"></div>

        <div class="container">

            <div class="row align-items-center min-vh-100">

                <div class="col-lg-6">

                <span class="section-badge">
                    Loan Services
                </span>

                    <h1 class="hero-title mt-4">
                        Find The Perfect Loan For Your Financial Needs
                    </h1>

                    <p class="hero-text mt-4">
                        We provide flexible and affordable loan solutions with
                        fast approval and minimum documentation.
                    </p>

                    <a href="/apply-loan" class="btn btn-primary btn-lg px-5 mt-4">
                        Apply Now
                    </a>

                </div>

                <div class="col-lg-6 text-center">

                    <img src="https://cdn-icons-png.flaticon.com/512/2489/2489756.png"
                         class="img-fluid loans-hero-image">

                </div>

            </div>

        </div>

    </section>

    <!-- Loan Categories -->
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

            <span class="section-badge">
                Our Loans
            </span>

                <h2 class="section-title mt-3">
                    Choose Your Loan Type
                </h2>

                <p class="section-description mt-3">
                    Simple, fast and secure financial solutions.
                </p>

            </div>

            <div class="row g-4">

                <!-- Personal Loan -->
                <div class="col-lg-4 col-md-6">

                    <div class="loan-service-card h-100">

                        <div class="loan-service-icon">
                            <i class="bi bi-person-fill"></i>
                        </div>

                        <h4 class="mt-4">
                            Personal Loan
                        </h4>

                        <p class="mt-3">
                            Instant personal loans for travel, education,
                            medical emergencies, and lifestyle needs.
                        </p>

                        <ul class="loan-features">

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Up to ₹25 Lakhs
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Low Interest Rates
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Quick Approval
                            </li>

                        </ul>

                        <a href="/apply-loan"
                           class="btn btn-outline-primary mt-4 w-100">

                            Apply Now

                        </a>

                    </div>

                </div>

                <!-- Business Loan -->
                <div class="col-lg-4 col-md-6">

                    <div class="loan-service-card h-100">

                        <div class="loan-service-icon">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>

                        <h4 class="mt-4">
                            Business Loan
                        </h4>

                        <p class="mt-3">
                            Expand your business with flexible funding
                            and affordable repayment plans.
                        </p>

                        <ul class="loan-features">

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Up to ₹2 Crore
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Flexible EMI
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Minimal Documentation
                            </li>

                        </ul>

                        <a href="/apply-loan"
                           class="btn btn-outline-primary mt-4 w-100">

                            Apply Now

                        </a>

                    </div>

                </div>

                <!-- Home Loan -->
                <div class="col-lg-4 col-md-6">

                    <div class="loan-service-card h-100">

                        <div class="loan-service-icon">
                            <i class="bi bi-house-door-fill"></i>
                        </div>

                        <h4 class="mt-4">
                            Home Loan
                        </h4>

                        <p class="mt-3">
                            Buy your dream home with affordable interest
                            rates and long-term repayment options.
                        </p>

                        <ul class="loan-features">

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Up to ₹5 Crore
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Tenure Up To 30 Years
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Lowest EMI
                            </li>

                        </ul>

                        <a href="/apply-loan"
                           class="btn btn-outline-primary mt-4 w-100">

                            Apply Now

                        </a>

                    </div>

                </div>

                <!-- Gold Loan -->
                <div class="col-lg-4 col-md-6">

                    <div class="loan-service-card h-100">

                        <div class="loan-service-icon">
                            <i class="bi bi-gem"></i>
                        </div>

                        <h4 class="mt-4">
                            Gold Loan
                        </h4>

                        <p class="mt-3">
                            Get instant cash against your gold
                            with secure storage and fast processing.
                        </p>

                        <ul class="loan-features">

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Instant Disbursal
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Secure Gold Storage
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Low Processing Fees
                            </li>

                        </ul>

                        <a href="/apply-loan"
                           class="btn btn-outline-primary mt-4 w-100">

                            Apply Now

                        </a>

                    </div>

                </div>

                <!-- Car Loan -->
                <div class="col-lg-4 col-md-6">

                    <div class="loan-service-card h-100">

                        <div class="loan-service-icon">
                            <i class="bi bi-car-front-fill"></i>
                        </div>

                        <h4 class="mt-4">
                            Car Loan
                        </h4>

                        <p class="mt-3">
                            Drive your dream car with easy
                            financing and attractive interest rates.
                        </p>

                        <ul class="loan-features">

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                90% Financing
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Quick Processing
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Flexible EMI
                            </li>

                        </ul>

                        <a href="/apply-loan"
                           class="btn btn-outline-primary mt-4 w-100">

                            Apply Now

                        </a>

                    </div>

                </div>

                <!-- Education Loan -->
                <div class="col-lg-4 col-md-6">

                    <div class="loan-service-card h-100">

                        <div class="loan-service-icon">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>

                        <h4 class="mt-4">
                            Education Loan
                        </h4>

                        <p class="mt-3">
                            Fund your education in India or abroad
                            with student-friendly repayment plans.
                        </p>

                        <ul class="loan-features">

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Abroad Studies
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Moratorium Facility
                            </li>

                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                Low Interest
                            </li>

                        </ul>

                        <a href="/apply-loan"
                           class="btn btn-outline-primary mt-4 w-100">

                            Apply Now

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="py-5">

        <div class="container">

            <div class="cta-card text-center">

            <span class="section-badge bg-white text-primary">
                Apply Today
            </span>

                <h2 class="section-title mt-4 text-white">
                    Need Financial Support?
                </h2>

                <p class="section-description text-white mt-3">
                    Apply online now and get quick approval with minimal documentation.
                </p>

                <a href="/apply-loan"
                   class="btn btn-light btn-lg px-5 mt-4">

                    Start Application

                </a>

            </div>

        </div>

    </section>

@endsection
