@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')

    <section class="about-modern-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="section-badge">About FinEase</span>

                    <h1 class="hero-title mt-3">
                        Built for loan journeys that need speed, trust, and proper follow-up.
                    </h1>

                    <p class="hero-text mt-4">
                        FinEase helps customers apply with confidence and helps loan teams manage every stage clearly,
                        from first enquiry to verification, approval, agreement, and disbursement.
                    </p>

                    <div class="hero-actions">
                        <a href="{{ route('frontend.apply-loan') }}" class="btn btn-primary btn-lg px-5">
                            Apply Loan
                        </a>

                        <a href="/contact-us" class="btn btn-outline-dark btn-lg px-5">
                            Talk To Us
                        </a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-hero-panel">
                        <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=900&q=80"
                             alt="Loan advisory team reviewing a customer application">

                        <div class="about-hero-card">
                            <span>Current focus</span>
                            <div class="about-mini-flow">
                                <strong>New Lead</strong>
                                <i class="bi bi-arrow-right"></i>
                                <strong>Verification</strong>
                                <i class="bi bi-arrow-right"></i>
                                <strong>Approval</strong>
                                <i class="bi bi-arrow-right"></i>
                                <strong>Disbursement</strong>
                            </div>
                            <p>Every application deserves clear ownership and a visible next step.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-story-section py-5 bg-white">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <div class="about-photo-stack">
                        <img class="about-photo-main"
                             src="https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=900&q=80"
                             alt="Loan consultant shaking hands with a customer">

                        <div class="about-floating-stat">
                            <strong>Structured CRM</strong>
                            <span>for loan teams, customers, and follow-ups</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <span class="section-badge">Who we are</span>

                    <h2 class="section-title mt-3">
                        A customer-first loan service with a process-first mindset.
                    </h2>

                    <p class="section-description mt-4">
                        Loan processing can become confusing when documents, calls, approvals, and status updates live
                        in different places. FinEase is designed around a simple idea: every customer should know what
                        has been submitted, what is being checked, and what needs attention next.
                    </p>

                    <div class="about-points">
                        <div>
                            <i class="bi bi-person-check"></i>
                            <div>
                                <h5>Guided applications</h5>
                                <p>Customers submit the right personal, income, and document details from the start.</p>
                            </div>
                        </div>

                        <div>
                            <i class="bi bi-folder-check"></i>
                            <div>
                                <h5>Document clarity</h5>
                                <p>Verification teams can identify missing, pending, and approved files faster.</p>
                            </div>
                        </div>

                        <div>
                            <i class="bi bi-diagram-3"></i>
                            <div>
                                <h5>Workflow visibility</h5>
                                <p>Applications move through clear stages instead of getting lost between teams.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-stats-section py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h2>24 hr</h2>
                        <p>Initial review target</p>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="bi bi-diagram-3"></i>
                        </div>
                        <h2>6</h2>
                        <p>Core approval stages</p>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="bi bi-collection"></i>
                        </div>
                        <h2>5+</h2>
                        <p>Loan categories</p>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="bi bi-eye"></i>
                        </div>
                        <h2>100%</h2>
                        <p>Status visibility</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-values-section py-5 bg-white">
        <div class="container">
            <div class="section-heading text-center">
                <span class="section-badge">Our principles</span>
                <h2 class="section-title mt-3">The way we want loan processing to feel</h2>
                <p class="section-description">
                    Fast matters, but accuracy matters too. Our process balances customer convenience with proper
                    verification and responsible decision-making.
                </p>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-lg-4">
                    <div class="value-card h-100">
                        <i class="bi bi-shield-check"></i>
                        <h4>Trust through transparency</h4>
                        <p>Customers should understand the process, documents required, and possible decision stages.</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="value-card h-100">
                        <i class="bi bi-speedometer2"></i>
                        <h4>Speed with structure</h4>
                        <p>Quick follow-up is useful only when every team knows the current status and next action.</p>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="value-card h-100">
                        <i class="bi bi-people"></i>
                        <h4>Human support</h4>
                        <p>Loan journeys still need human guidance, especially during verification and clarification.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-workflow-section py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="section-badge">How we work</span>
                    <h2 class="section-title mt-3">A practical workflow for every application</h2>
                    <p class="section-description mt-4">
                        The process follows the same operational rhythm your CRM will manage: lead submission, initial
                        verification, document review, financial assessment, decision, agreement, and disbursement.
                    </p>
                </div>

                <div class="col-lg-6">
                    <div class="workflow-list">
                        <div><span>01</span><strong>New lead captured</strong></div>
                        <div><span>02</span><strong>Contact and eligibility checked</strong></div>
                        <div><span>03</span><strong>Documents verified</strong></div>
                        <div><span>04</span><strong>Financial assessment completed</strong></div>
                        <div><span>05</span><strong>Decision, sanction, and agreement</strong></div>
                        <div><span>06</span><strong>Disbursement and post-loan follow-up</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="cta-card text-center">
                <span class="section-badge bg-white text-primary">Ready to begin</span>

                <h2 class="section-title mt-4 text-white">
                    Start your loan application with a clear next step.
                </h2>

                <p class="section-description text-white mt-3">
                    Submit your details online and keep your PAN, Aadhaar, income proof, and bank statement ready.
                </p>

                <a href="{{ route('frontend.apply-loan') }}" class="btn btn-light btn-lg px-5 mt-4">
                    Apply Now
                </a>
            </div>
        </div>
    </section>

@endsection
