@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')

    <section class="contact-modern-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="section-badge">Contact FinEase</span>

                    <h1 class="hero-title mt-3">
                        Talk to our loan team before you apply.
                    </h1>

                    <p class="hero-text mt-4">
                        Have a question about eligibility, documents, EMI, approval status, or the right loan product?
                        Share your details and our team will guide the next step.
                    </p>

                    <div class="contact-quick-grid">
                        <a href="tel:+919876543210" class="contact-quick-card">
                            <i class="bi bi-telephone"></i>
                            <span>Call us</span>
                            <strong>+91 9876543210</strong>
                        </a>

                        <a href="mailto:info@yourcompany.com" class="contact-quick-card">
                            <i class="bi bi-envelope"></i>
                            <span>Email us</span>
                            <strong>info@yourcompany.com</strong>
                        </a>

                        <div class="contact-quick-card">
                            <i class="bi bi-clock"></i>
                            <span>Working hours</span>
                            <strong>Mon-Sat, 10 AM-7 PM</strong>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="contact-hero-card">
                        <img src="https://images.unsplash.com/photo-1556745757-8d76bdb6984b?auto=format&fit=crop&w=900&q=80"
                             alt="Loan support team speaking with a customer">

                        <div class="contact-hero-note">
                            <span>Support promise</span>
                            <div class="contact-mini-flow">
                                <strong>Lead captured</strong>
                                <i class="bi bi-arrow-right"></i>
                                <strong>Team follow-up</strong>
                                <i class="bi bi-arrow-right"></i>
                                <strong>Document guidance</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-form-section py-5">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-5">
                    <div class="contact-guidance-panel h-100">
                        <span class="section-badge">What to expect</span>
                        <h2>We route your enquiry to the right team.</h2>
                        <p>
                            Your message helps us understand whether you need product guidance, document support,
                            application tracking, or a new loan consultation.
                        </p>

                        <div class="contact-timeline">
                            <div>
                                <span>01</span>
                                <strong>Share your loan query</strong>
                                <p>Tell us the product, amount, or issue you need help with.</p>
                            </div>

                            <div>
                                <span>02</span>
                                <strong>Team reviews details</strong>
                                <p>We check whether this is a new application or support request.</p>
                            </div>

                            <div>
                                <span>03</span>
                                <strong>Executive follows up</strong>
                                <p>You get guidance on documents, eligibility, or next action.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-form-card modern-contact-form h-100">
                        <div class="form-card-header">
                            <span class="section-badge">Send enquiry</span>
                            <h2 class="section-title mt-3">How can we help?</h2>
                            <p class="section-description mb-0">
                                This form is ready for the frontend experience. Backend enquiry saving can be connected with the leads module.
                            </p>
                        </div>

                        <form>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" placeholder="Enter full name">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="tel" class="form-control" placeholder="10 digit mobile number">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" placeholder="name@example.com">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Loan Interest</label>
                                    <select class="form-select">
                                        <option>Personal Loan</option>
                                        <option>Business Loan</option>
                                        <option>Home Loan</option>
                                        <option>Vehicle Finance</option>
                                        <option>Gold Loan</option>
                                        <option>Existing Application Support</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Subject</label>
                                    <input type="text" class="form-control" placeholder="Eligibility, documents, EMI, status...">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control contact-textarea"
                                              rows="5"
                                              placeholder="Write your message..."></textarea>
                                </div>

                                <div class="col-12">
                                    <button type="button" class="btn btn-primary btn-lg w-100">
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

    <section class="contact-branches-section py-5">
        <div class="container">
            <div class="section-heading text-center">
                <span class="section-badge">Branch support</span>
                <h2 class="section-title mt-3">Visit or call your nearest team</h2>
                <p class="section-description">
                    Branch details are shown as service locations for consultation, document support, and follow-up.
                </p>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-lg-4 col-md-6">
                    <div class="branch-card modern-branch-card">
                        <div class="branch-icon"><i class="bi bi-building"></i></div>
                        <span>Main Branch</span>
                        <h5>Mumbai Office</h5>
                        <p>Andheri East, Mumbai, Maharashtra</p>
                        <a href="tel:+919876543210" class="btn btn-outline-primary mt-3">Call Branch</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="branch-card modern-branch-card">
                        <div class="branch-icon"><i class="bi bi-briefcase"></i></div>
                        <span>Business Desk</span>
                        <h5>Pune Office</h5>
                        <p>Hinjewadi, Pune, Maharashtra</p>
                        <a href="tel:+919876543210" class="btn btn-outline-primary mt-3">Call Branch</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="branch-card modern-branch-card">
                        <div class="branch-icon"><i class="bi bi-headset"></i></div>
                        <span>Support Desk</span>
                        <h5>Delhi Office</h5>
                        <p>Connaught Place, New Delhi</p>
                        <a href="tel:+919876543210" class="btn btn-outline-primary mt-3">Call Branch</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-map-section py-5">
        <div class="container">
            <div class="contact-map-card">
                <div>
                    <span class="section-badge">Service area</span>
                    <h2>Loan support across major cities</h2>
                    <p>
                        Our CRM workflow supports online applications, document follow-up, and branch-assisted
                        consultation for customers who prefer direct support.
                    </p>

                    <a href="{{ route('frontend.apply-loan') }}" class="btn btn-light btn-lg px-5 mt-3">
                        Apply Online
                    </a>
                </div>

                <div class="service-area-grid">
                    <span>Mumbai</span>
                    <span>Pune</span>
                    <span>Delhi</span>
                    <span>Online Support</span>
                </div>
            </div>
        </div>
    </section>

@endsection
