@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')

    <!-- Hero Section -->
    <section class="about-hero-section position-relative overflow-hidden">

        <div class="bg-shape-1"></div>
        <div class="bg-shape-2"></div>

        <div class="container">

            <div class="row align-items-center min-vh-100">

                <div class="col-lg-6">

                <span class="section-badge">
                    About Our Company
                </span>

                    <h1 class="hero-title mt-4">
                        Trusted Financial Solutions For Your Future
                    </h1>

                    <p class="hero-text mt-4">
                        We help individuals and businesses achieve their financial goals
                        with fast loan approvals, transparent processes, and reliable support.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mt-5">

                        <a href="#" class="btn btn-primary btn-lg px-5">
                            Apply Loan
                        </a>

                        <a href="#" class="btn btn-outline-dark btn-lg px-5">
                            Contact Us
                        </a>

                    </div>

                </div>

                <div class="col-lg-6 text-center">

                    <img src="https://cdn-icons-png.flaticon.com/512/4086/4086679.png"
                         class="img-fluid about-hero-image">

                </div>

            </div>

        </div>

    </section>

    <!-- About Company -->
    <section class="py-5">

        <div class="container">

            <div class="row align-items-center g-5">

                <div class="col-lg-6">

                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                         class="img-fluid about-image">

                </div>

                <div class="col-lg-6">

                <span class="section-badge">
                    Who We Are
                </span>

                    <h2 class="section-title mt-3">
                        Helping Customers With Reliable Loan Services
                    </h2>

                    <p class="section-description mt-4">
                        Our mission is to make financial services simple, transparent,
                        and accessible for everyone. We provide personal, business,
                        and home loans with quick processing and flexible repayment options.
                    </p>

                    <div class="row mt-5 g-4">

                        <div class="col-md-6">

                            <div class="about-feature-card">

                                <div class="about-feature-icon">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>

                                <h5>
                                    Trusted Company
                                </h5>

                                <p>
                                    Thousands of happy customers trust our services.
                                </p>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="about-feature-card">

                                <div class="about-feature-icon">
                                    <i class="bi bi-lightning-charge-fill"></i>
                                </div>

                                <h5>
                                    Fast Approval
                                </h5>

                                <p>
                                    Loan approvals with minimum documentation.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Statistics -->
    <section class="stats-section py-5">

        <div class="container">

            <div class="row text-center g-4">

                <div class="col-md-3">

                    <div class="stats-card">

                        <h2>
                            25K+
                        </h2>

                        <p>
                            Happy Customers
                        </p>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="stats-card">

                        <h2>
                            ₹150Cr+
                        </h2>

                        <p>
                            Loans Disbursed
                        </p>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="stats-card">

                        <h2>
                            98%
                        </h2>

                        <p>
                            Approval Rate
                        </p>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="stats-card">

                        <h2>
                            24/7
                        </h2>

                        <p>
                            Customer Support
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- Vision Mission -->
    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

            <span class="section-badge">
                Our Vision
            </span>

                <h2 class="section-title mt-3">
                    Building Financial Freedom For Everyone
                </h2>

            </div>

            <div class="row g-4">

                <div class="col-lg-6">

                    <div class="vision-card h-100">

                        <div class="vision-icon">
                            <i class="bi bi-eye-fill"></i>
                        </div>

                        <h3 class="mt-4">
                            Our Vision
                        </h3>

                        <p class="mt-3">
                            To become one of the most trusted financial service providers
                            by offering transparent and customer-focused loan solutions.
                        </p>

                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="vision-card h-100">

                        <div class="vision-icon">
                            <i class="bi bi-bullseye"></i>
                        </div>

                        <h3 class="mt-4">
                            Our Mission
                        </h3>

                        <p class="mt-3">
                            To simplify access to finance with fast approvals,
                            innovative technology, and exceptional customer service.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CTA -->
    <section class="py-5">

        <div class="container">

            <div class="cta-card text-center">

            <span class="section-badge">
                Get Started
            </span>

                <h2 class="section-title mt-4">
                    Apply For Your Loan Today
                </h2>

                <p class="section-description mt-3">
                    Fast approvals, flexible EMI options, and trusted support.
                </p>

                <a href="#" class="btn btn-primary btn-lg px-5 mt-4">
                    Apply Now
                </a>

            </div>

        </div>

    </section>

@endsection
