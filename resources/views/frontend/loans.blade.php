@extends('frontend.layouts.app')

@section('title', 'Our Loans')

@section('content')

    <section class="loans-modern-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="section-badge">Loan products</span>

                    <h1 class="hero-title mt-3">
                        Choose a loan product and move through a clear approval path.
                    </h1>

                    <p class="hero-text mt-4">
                        Whether you need personal funding, business capital, home finance, or vehicle support,
                        FinEase keeps the application, documents, verification, and decision stages organized.
                    </p>

                    <div class="hero-actions">
                        <a href="{{ route('frontend.apply-loan') }}" class="btn btn-primary btn-lg px-5">
                            Apply Now
                        </a>

                        <a href="#loan-products" class="btn btn-outline-dark btn-lg px-5">
                            View Products
                        </a>
                    </div>

                    <div class="loan-hero-points">
                        <span><i class="bi bi-check-circle-fill"></i> Quick initial review</span>
                        <span><i class="bi bi-check-circle-fill"></i> Clear document checklist</span>
                        <span><i class="bi bi-check-circle-fill"></i> Status-based workflow</span>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="loans-hero-card">
                        <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=900&q=80"
                             alt="Customer discussing home and business finance">

                        <div class="loans-hero-overlay">
                            <span>Popular route</span>
                            <div class="loans-mini-flow">
                                <strong>Apply</strong>
                                <i class="bi bi-arrow-right"></i>
                                <strong>Verify</strong>
                                <i class="bi bi-arrow-right"></i>
                                <strong>Approve</strong>
                                <i class="bi bi-arrow-right"></i>
                                <strong>Disburse</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="loan-products" class="loan-products-section py-5">
        <div class="container">
            <div class="section-heading text-center">
                <span class="section-badge">Our loan catalogue</span>
                <h2 class="section-title mt-3">Products for different financial needs</h2>
                <p class="section-description">
                    Select the loan category that matches your need. The exact amount, tenure, and approval depend on
                    eligibility, documents, and verification.
                </p>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-lg-4 col-md-6">
                    <div class="loan-product-card h-100">
                        <div class="loan-product-top">
                            <div class="loan-product-icon"><i class="bi bi-person-vcard"></i></div>
                            <span>Personal</span>
                        </div>

                        <h4>Personal Loan</h4>
                        <p>For medical needs, education, travel, wedding expenses, or planned purchases.</p>

                        <div class="loan-product-meta">
                            <div><strong>Up to Rs. 25L</strong><span>Loan amount</span></div>
                            <div><strong>12-60 months</strong><span>Tenure</span></div>
                        </div>

                        <ul class="loan-features">
                            <li><i class="bi bi-check-circle-fill"></i> Salary or income proof</li>
                            <li><i class="bi bi-check-circle-fill"></i> PAN and Aadhaar required</li>
                            <li><i class="bi bi-check-circle-fill"></i> Fast first response</li>
                        </ul>

                        <a href="{{ route('frontend.apply-loan') }}" class="btn btn-outline-primary w-100">
                            Apply Personal Loan
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="loan-product-card h-100 featured">
                        <div class="loan-product-top">
                            <div class="loan-product-icon"><i class="bi bi-briefcase"></i></div>
                            <span>Business</span>
                        </div>

                        <h4>Business Loan</h4>
                        <p>For working capital, business expansion, equipment, inventory, and cash flow support.</p>

                        <div class="loan-product-meta">
                            <div><strong>Up to Rs. 2Cr</strong><span>Loan amount</span></div>
                            <div><strong>12-84 months</strong><span>Tenure</span></div>
                        </div>

                        <ul class="loan-features">
                            <li><i class="bi bi-check-circle-fill"></i> Business proof or GST details</li>
                            <li><i class="bi bi-check-circle-fill"></i> Bank statement review</li>
                            <li><i class="bi bi-check-circle-fill"></i> Eligibility assessment</li>
                        </ul>

                        <a href="{{ route('frontend.apply-loan') }}" class="btn btn-primary w-100">
                            Apply Business Loan
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="loan-product-card h-100">
                        <div class="loan-product-top">
                            <div class="loan-product-icon"><i class="bi bi-house-door"></i></div>
                            <span>Property</span>
                        </div>

                        <h4>Home Loan</h4>
                        <p>For home purchase, construction, renovation, and property balance transfer requests.</p>

                        <div class="loan-product-meta">
                            <div><strong>Up to Rs. 5Cr</strong><span>Loan amount</span></div>
                            <div><strong>Up to 30 years</strong><span>Tenure</span></div>
                        </div>

                        <ul class="loan-features">
                            <li><i class="bi bi-check-circle-fill"></i> Property document review</li>
                            <li><i class="bi bi-check-circle-fill"></i> Income and liability check</li>
                            <li><i class="bi bi-check-circle-fill"></i> Sanction letter support</li>
                        </ul>

                        <a href="{{ route('frontend.apply-loan') }}" class="btn btn-outline-primary w-100">
                            Apply Home Loan
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="loan-product-card h-100">
                        <div class="loan-product-top">
                            <div class="loan-product-icon"><i class="bi bi-car-front"></i></div>
                            <span>Vehicle</span>
                        </div>

                        <h4>Vehicle Finance</h4>
                        <p>For cars, two-wheelers, commercial vehicles, and refinance requirements.</p>

                        <div class="loan-product-meta">
                            <div><strong>Up to 90%</strong><span>Funding</span></div>
                            <div><strong>12-72 months</strong><span>Tenure</span></div>
                        </div>

                        <ul class="loan-features">
                            <li><i class="bi bi-check-circle-fill"></i> Vehicle quotation or RC</li>
                            <li><i class="bi bi-check-circle-fill"></i> Income proof needed</li>
                            <li><i class="bi bi-check-circle-fill"></i> Quick processing route</li>
                        </ul>

                        <a href="{{ route('frontend.apply-loan') }}" class="btn btn-outline-primary w-100">
                            Apply Vehicle Finance
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="loan-product-card h-100">
                        <div class="loan-product-top">
                            <div class="loan-product-icon"><i class="bi bi-gem"></i></div>
                            <span>Secured</span>
                        </div>

                        <h4>Gold Loan</h4>
                        <p>For short-term liquidity against gold assets with simple processing.</p>

                        <div class="loan-product-meta">
                            <div><strong>High LTV</strong><span>Security based</span></div>
                            <div><strong>Flexible</strong><span>Repayment</span></div>
                        </div>

                        <ul class="loan-features">
                            <li><i class="bi bi-check-circle-fill"></i> Gold valuation required</li>
                            <li><i class="bi bi-check-circle-fill"></i> KYC document check</li>
                            <li><i class="bi bi-check-circle-fill"></i> Secure handling process</li>
                        </ul>

                        <a href="{{ route('frontend.apply-loan') }}" class="btn btn-outline-primary w-100">
                            Apply Gold Loan
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="loan-product-card h-100">
                        <div class="loan-product-top">
                            <div class="loan-product-icon"><i class="bi bi-mortarboard"></i></div>
                            <span>Education</span>
                        </div>

                        <h4>Education Loan</h4>
                        <p>For higher education, professional courses, and overseas study planning.</p>

                        <div class="loan-product-meta">
                            <div><strong>Course based</strong><span>Amount</span></div>
                            <div><strong>Flexible</strong><span>Moratorium</span></div>
                        </div>

                        <ul class="loan-features">
                            <li><i class="bi bi-check-circle-fill"></i> Admission proof needed</li>
                            <li><i class="bi bi-check-circle-fill"></i> Co-applicant review</li>
                            <li><i class="bi bi-check-circle-fill"></i> Document checklist support</li>
                        </ul>

                        <a href="{{ route('frontend.apply-loan') }}" class="btn btn-outline-primary w-100">
                            Apply Education Loan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="loan-support-section py-5">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-5">
                    <div class="loan-checklist-panel h-100">
                        <span class="section-badge">Before applying</span>
                        <h2>Keep your basic documents ready</h2>
                        <p>Having these ready helps the team start verification faster.</p>

                        <div class="document-checklist">
                            <div><i class="bi bi-person-badge"></i><span>PAN and Aadhaar</span></div>
                            <div><i class="bi bi-cash-stack"></i><span>Income proof</span></div>
                            <div><i class="bi bi-bank"></i><span>Bank statement</span></div>
                            <div><i class="bi bi-briefcase"></i><span>Employment or business details</span></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="loan-workflow-panel h-100">
                        <span class="section-badge">Approval journey</span>
                        <h2>Each loan moves through a visible workflow</h2>

                        <div class="loan-workflow-grid">
                            <div><strong>01</strong><span>New Lead</span><p>Application submitted online.</p></div>
                            <div><strong>02</strong><span>Verification</span><p>Contact and documents checked.</p></div>
                            <div><strong>03</strong><span>Assessment</span><p>Income and liabilities reviewed.</p></div>
                            <div><strong>04</strong><span>Decision</span><p>Approved, rejected, held, or clarified.</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="cta-card text-center">
                <span class="section-badge bg-white text-primary">Apply today</span>

                <h2 class="section-title mt-4 text-white">
                    Found the right loan product?
                </h2>

                <p class="section-description text-white mt-3">
                    Submit one application and let the team guide verification, eligibility, and next steps.
                </p>

                <a href="{{ route('frontend.apply-loan') }}" class="btn btn-light btn-lg px-5 mt-4">
                    Start Application
                </a>
            </div>
        </div>
    </section>

@endsection
