@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')

    <section class="hero-section modern-hero">
        <div class="container">
            <div class="row align-items-center hero-row">
                <div class="col-lg-6">
                    <span class="hero-badge">Digital loan approval desk</span>

                    <h1 class="hero-title">
                        From loan enquiry to disbursement, managed with clarity.
                    </h1>

                    <p class="hero-text">
                        Apply online, upload your documents, complete verification, and track each step of your loan
                        application with a transparent approval process.
                    </p>

                    <div class="hero-actions">
                        <a href="{{ route('frontend.apply-loan') }}" class="btn btn-primary btn-lg px-5">
                            Start Application
                        </a>

                        <a href="/loans" class="btn btn-outline-dark btn-lg px-5">
                            Explore Loans
                        </a>
                    </div>

                    <div class="hero-metrics">
                        <div>
                            <strong>24 hrs</strong>
                            <span>Initial review</span>
                        </div>

                        <div>
                            <strong>10+</strong>
                            <span>Loan products</span>
                        </div>

                        <div>
                            <strong>100%</strong>
                            <span>Process tracking</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="approval-panel">
                        <div class="approval-panel-header">
                            <div>
                                <span class="panel-label">Application</span>
                                <h5>LN-2026-0048</h5>
                            </div>

                            <span class="status-pill">Under Review</span>
                        </div>

                        <div class="applicant-card">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=240&q=80"
                                 alt="Loan applicant">
                            <div>
                                <h6>Rahul Sharma</h6>
                                <p>Business Loan - Rs. 12,00,000</p>
                            </div>
                        </div>

                        <div class="approval-timeline">
                            <div class="timeline-step is-done">
                                <span></span>
                                <div>
                                    <strong>Lead submitted</strong>
                                    <p>Application number generated</p>
                                </div>
                            </div>

                            <div class="timeline-step is-done">
                                <span></span>
                                <div>
                                    <strong>Documents received</strong>
                                    <p>PAN, Aadhaar, bank statement uploaded</p>
                                </div>
                            </div>

                            <div class="timeline-step is-active">
                                <span></span>
                                <div>
                                    <strong>Financial verification</strong>
                                    <p>Income, liabilities, and eligibility review</p>
                                </div>
                            </div>

                            <div class="timeline-step">
                                <span></span>
                                <div>
                                    <strong>Decision and sanction</strong>
                                    <p>Approval, hold, reject, or clarification</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="trust-strip">
        <div class="container">
            <div class="trust-strip-inner">
                <div class="trust-marquee">
                    <div class="trust-marquee-track">
                        <span><i class="bi bi-check-circle-fill"></i> Mobile and email verification</span>
                        <span><i class="bi bi-check-circle-fill"></i> Document checklist</span>
                        <span><i class="bi bi-check-circle-fill"></i> Eligibility review</span>
                        <span><i class="bi bi-check-circle-fill"></i> Sanction and disbursement</span>
                        <span><i class="bi bi-check-circle-fill"></i> EMI reminders</span>
                        <span><i class="bi bi-check-circle-fill"></i> Follow-up support</span>
                    </div>

                    <div class="trust-marquee-track" aria-hidden="true">
                        <span><i class="bi bi-check-circle-fill"></i> Mobile and email verification</span>
                        <span><i class="bi bi-check-circle-fill"></i> Document checklist</span>
                        <span><i class="bi bi-check-circle-fill"></i> Eligibility review</span>
                        <span><i class="bi bi-check-circle-fill"></i> Sanction and disbursement</span>
                        <span><i class="bi bi-check-circle-fill"></i> EMI reminders</span>
                        <span><i class="bi bi-check-circle-fill"></i> Follow-up support</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="section-heading text-center">
                <span class="section-badge">Loan products</span>
                <h2 class="section-title mt-3">Choose the finance that fits your need</h2>
                <p class="section-description">
                    Start with the right product and our team will guide the application through verification,
                    approval, agreement, and disbursement.
                </p>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-6 col-lg-3">
                    <div class="loan-card modern-card">
                        <div class="loan-icon"><i class="bi bi-person-vcard"></i></div>
                        <h5>Personal Loan</h5>
                        <p>For education, travel, medical needs, or planned personal expenses.</p>
                        <a href="{{ route('frontend.apply-loan') }}">Apply now</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="loan-card modern-card">
                        <div class="loan-icon"><i class="bi bi-briefcase"></i></div>
                        <h5>Business Loan</h5>
                        <p>Working capital, expansion, inventory, and business growth funding.</p>
                        <a href="{{ route('frontend.apply-loan') }}">Apply now</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="loan-card modern-card">
                        <div class="loan-icon"><i class="bi bi-house-door"></i></div>
                        <h5>Home Loan</h5>
                        <p>Property purchase, construction, renovation, and balance transfers.</p>
                        <a href="{{ route('frontend.apply-loan') }}">Apply now</a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="loan-card modern-card">
                        <div class="loan-icon"><i class="bi bi-car-front"></i></div>
                        <h5>Vehicle Finance</h5>
                        <p>Two-wheeler, car, commercial vehicle, and refinancing options.</p>
                        <a href="{{ route('frontend.apply-loan') }}">Apply now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="process-section py-5">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col-lg-7">
                    <span class="section-badge">Approval workflow</span>
                    <h2 class="section-title mt-3">A clear process from lead to disbursement</h2>
                </div>

                <div class="col-lg-5">
                    <p class="section-description mb-0">
                        Every application moves through defined stages so customers and internal teams know exactly
                        what is pending and what comes next.
                    </p>
                </div>
            </div>

            <div class="process-grid">
                <div class="process-card">
                    <span>01</span>
                    <h5>Apply online</h5>
                    <p>Customer submits loan details, personal information, employment data, and documents.</p>
                </div>

                <div class="process-card">
                    <span>02</span>
                    <h5>Initial verification</h5>
                    <p>Mobile, email, duplicate application, and basic eligibility checks are completed.</p>
                </div>

                <div class="process-card">
                    <span>03</span>
                    <h5>Document review</h5>
                    <p>PAN, Aadhaar, salary slips, bank statements, and other files are verified.</p>
                </div>

                <div class="process-card">
                    <span>04</span>
                    <h5>Financial assessment</h5>
                    <p>Income, liabilities, current EMIs, and credit profile are reviewed for eligibility.</p>
                </div>

                <div class="process-card">
                    <span>05</span>
                    <h5>Decision and sanction</h5>
                    <p>The application is approved, rejected, held, or sent back for clarification.</p>
                </div>

                <div class="process-card">
                    <span>06</span>
                    <h5>Agreement and disbursement</h5>
                    <p>Sanction letter, agreement signing, payment reference, and final disbursement are managed.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="why-choose-section py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="section-badge">Why customers choose us</span>
                    <h2 class="section-title mt-3">Loan assistance that feels organized, human, and fast.</h2>
                    <p class="section-description mt-4">
                        We combine a simple online application with structured follow-ups, document tracking, and
                        transparent status updates.
                    </p>

                    <div class="row mt-4 g-4">
                        <div class="col-md-6">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                                <h5>Quick first response</h5>
                                <p>Executives can review new leads and contact customers quickly.</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="bi bi-file-earmark-check"></i></div>
                                <h5>Document clarity</h5>
                                <p>Customers know which files are submitted, pending, or verified.</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="bi bi-diagram-3"></i></div>
                                <h5>Stage tracking</h5>
                                <p>Applications move through a defined loan approval workflow.</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="bi bi-headset"></i></div>
                                <h5>Follow-up support</h5>
                                <p>Sales and verification teams can keep the customer updated.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="insight-card">
                        <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=900&q=80"
                             alt="Loan team reviewing documents">
                        <div class="insight-content">
                            <span class="insight-eyebrow">Live application desk</span>
                            <div class="status-flow" aria-label="Loan status flow">
                                <strong class="status-new">New Lead</strong>
                                <i class="bi bi-arrow-right"></i>
                                <strong class="status-docs">Documents Verified</strong>
                                <i class="bi bi-arrow-right"></i>
                                <strong class="status-approved">Approved</strong>
                                <i class="bi bi-arrow-right"></i>
                                <strong class="status-disbursed">Disbursed</strong>
                            </div>
                            <p>Designed around the same workflow your loan team follows every day.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials._emi-calculator')

    <section class="cta-section py-5">
        <div class="container">
            <div class="cta-card text-center">
                <span class="section-badge bg-white text-primary">Ready to begin</span>
                <h2 class="section-title mt-4 text-white">Submit your loan application in minutes.</h2>
                <p class="section-description text-white mt-3">
                    Keep your PAN, Aadhaar, income proof, and bank statement ready for a smoother review.
                </p>
                <a href="{{ route('frontend.apply-loan') }}" class="btn btn-light btn-lg px-5 mt-4">
                    Apply Loan
                </a>
            </div>
        </div>
    </section>

@endsection
