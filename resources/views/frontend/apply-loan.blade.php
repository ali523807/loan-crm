@extends('frontend.layouts.app')

@section('title', 'Apply Loan')

@section('content')

    <section class="application-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="section-badge">Online application</span>
                    <h1 class="hero-title mt-3">Start your loan request with the right details.</h1>
                    <p class="hero-text">
                        Complete the form below so our team can verify your eligibility, documents, and next steps
                        without unnecessary back-and-forth.
                    </p>
                </div>

                <div class="col-lg-5">
                    <div class="application-summary-card">
                        <h5>Before you begin</h5>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> PAN and Aadhaar details</li>
                            <li><i class="bi bi-check-circle-fill"></i> Income and employment information</li>
                            <li><i class="bi bi-check-circle-fill"></i> Salary slip or business proof</li>
                            <li><i class="bi bi-check-circle-fill"></i> Latest bank statement</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="loan-form-section py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="application-sidebar">
                        <span class="section-badge">Application stages</span>
                        <h3>What happens after submission?</h3>

                        <div class="mini-timeline">
                            <div>
                                <span></span>
                                <p>Application number generated</p>
                            </div>

                            <div>
                                <span></span>
                                <p>Initial eligibility check</p>
                            </div>

                            <div>
                                <span></span>
                                <p>Document verification</p>
                            </div>

                            <div>
                                <span></span>
                                <p>Financial assessment</p>
                            </div>

                            <div>
                                <span></span>
                                <p>Decision, sanction, and disbursement</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="loan-form-card modern-form-card">
                        <div class="form-card-header">
                            <div>
                                <span class="section-badge">Secure form</span>
                                <h2 class="section-title mt-3">Loan Application Form</h2>
                                <p class="section-description mb-0">
                                    Fill each step carefully. Required documents can be reviewed by the verification team later.
                                </p>
                            </div>
                        </div>

                        @if(session('application_submitted'))
                            <div class="alert alert-success rounded-4 mb-4">
                                Your application has been submitted successfully. Application number:
                                <strong>{{ session('application_submitted') }}</strong>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger rounded-4 mb-4">
                                Please review the highlighted details and submit again.
                            </div>
                        @endif

                        <div class="step-progress">
                            <div class="progress">
                                <div class="progress-bar"
                                     id="progressBar"
                                     role="progressbar"
                                     style="width: 20%"></div>
                            </div>

                            <div class="step-indicators">
                                <div class="step-item active">
                                    <div class="step-circle">1</div>
                                    <span>Loan</span>
                                </div>

                                <div class="step-item">
                                    <div class="step-circle">2</div>
                                    <span>Applicant</span>
                                </div>

                                <div class="step-item">
                                    <div class="step-circle">3</div>
                                    <span>Income</span>
                                </div>

                                <div class="step-item">
                                    <div class="step-circle">4</div>
                                    <span>Documents</span>
                                </div>

                                <div class="step-item">
                                    <div class="step-circle">5</div>
                                    <span>Review</span>
                                </div>
                            </div>
                        </div>

                        <form id="loanApplicationForm"
                              action="{{ route('frontend.apply-loan.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-step active">
                                <div class="step-heading">
                                    <h4>Loan requirement</h4>
                                    <p>Tell us what type of funding you need.</p>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Loan Type</label>
                                        <select class="form-select @error('loan_type') is-invalid @enderror" name="loan_type">
                                            <option value="">Select Loan Type</option>
                                            <option @selected(old('loan_type') === 'Personal Loan')>Personal Loan</option>
                                            <option @selected(old('loan_type') === 'Business Loan')>Business Loan</option>
                                            <option @selected(old('loan_type') === 'Home Loan')>Home Loan</option>
                                            <option @selected(old('loan_type') === 'Vehicle Finance')>Vehicle Finance</option>
                                            <option @selected(old('loan_type') === 'Gold Loan')>Gold Loan</option>
                                        </select>
                                        @error('loan_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Requested Amount</label>
                                        <input type="number"
                                               class="form-control"
                                               name="loan_amount"
                                               value="{{ old('loan_amount') }}"
                                               placeholder="Example: 500000">
                                        @error('loan_amount') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Preferred Tenure</label>
                                        <select class="form-select" name="loan_tenure">
                                            <option value="">Select Tenure</option>
                                            <option @selected(old('loan_tenure') === '12 Months')>12 Months</option>
                                            <option @selected(old('loan_tenure') === '24 Months')>24 Months</option>
                                            <option @selected(old('loan_tenure') === '36 Months')>36 Months</option>
                                            <option @selected(old('loan_tenure') === '60 Months')>60 Months</option>
                                            <option @selected(old('loan_tenure') === '120 Months')>120 Months</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Purpose of Loan</label>
                                        <input type="text"
                                               class="form-control"
                                               name="loan_purpose"
                                               value="{{ old('loan_purpose') }}"
                                               placeholder="Business expansion, medical, home purchase">
                                    </div>
                                </div>
                            </div>

                            <div class="form-step">
                                <div class="step-heading">
                                    <h4>Applicant details</h4>
                                    <p>These details help us create your customer profile and avoid duplicate applications.</p>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" placeholder="Enter full name">
                                        @error('full_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Mobile Number</label>
                                        <input type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" placeholder="10 digit mobile number">
                                        @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">PAN Number</label>
                                        <input type="text" class="form-control" name="pan_number" value="{{ old('pan_number') }}" placeholder="ABCDE1234F">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Aadhaar Number</label>
                                        <input type="text" class="form-control" name="aadhaar_number" value="{{ old('aadhaar_number') }}" placeholder="XXXX XXXX XXXX">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Current Address</label>
                                        <textarea class="form-control form-textarea" name="address" placeholder="House, area, city, state, pincode">{{ old('address') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-step">
                                <div class="step-heading">
                                    <h4>Employment and financials</h4>
                                    <p>Income and liabilities help the team evaluate eligibility and EMI capacity.</p>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Employment Type</label>
                                        <select class="form-select" name="employment_type">
                                            <option value="">Select Employment Type</option>
                                            <option @selected(old('employment_type') === 'Salaried')>Salaried</option>
                                            <option @selected(old('employment_type') === 'Self Employed')>Self Employed</option>
                                            <option @selected(old('employment_type') === 'Business Owner')>Business Owner</option>
                                            <option @selected(old('employment_type') === 'Professional')>Professional</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Company / Business Name</label>
                                        <input type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" placeholder="Enter organization name">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Monthly Income</label>
                                        <input type="number" class="form-control" name="monthly_income" value="{{ old('monthly_income') }}" placeholder="Example: 65000">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Existing Monthly EMI</label>
                                        <input type="number" class="form-control" name="existing_emi" value="{{ old('existing_emi') }}" placeholder="Enter 0 if none">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Work Experience</label>
                                        <input type="text" class="form-control" name="work_experience" value="{{ old('work_experience') }}" placeholder="Example: 4 years">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Preferred Contact Time</label>
                                        <select class="form-select" name="contact_time">
                                            <option @selected(old('contact_time') === 'Morning')>Morning</option>
                                            <option @selected(old('contact_time') === 'Afternoon')>Afternoon</option>
                                            <option @selected(old('contact_time') === 'Evening')>Evening</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-step">
                                <div class="step-heading">
                                    <h4>Document upload</h4>
                                    <p>Upload clear scans or photos. Missing files can be requested later by the verification team.</p>
                                </div>

                                <div class="document-grid">
                                    <label class="document-upload">
                                        <i class="bi bi-person-badge"></i>
                                        <strong>PAN Card</strong>
                                        <span>PDF, JPG, or PNG</span>
                                        <input type="file" name="pan_card" accept=".pdf,.jpg,.jpeg,.png">
                                    </label>

                                    <label class="document-upload">
                                        <i class="bi bi-fingerprint"></i>
                                        <strong>Aadhaar Card</strong>
                                        <span>Front and back copy</span>
                                        <input type="file" name="aadhaar_card" accept=".pdf,.jpg,.jpeg,.png">
                                    </label>

                                    <label class="document-upload">
                                        <i class="bi bi-receipt"></i>
                                        <strong>Income Proof</strong>
                                        <span>Salary slip or ITR</span>
                                        <input type="file" name="income_proof" accept=".pdf,.jpg,.jpeg,.png">
                                    </label>

                                    <label class="document-upload">
                                        <i class="bi bi-bank"></i>
                                        <strong>Bank Statement</strong>
                                        <span>Latest 6 months</span>
                                        <input type="file" name="bank_statement" accept=".pdf,.jpg,.jpeg,.png">
                                    </label>
                                </div>
                            </div>

                            <div class="form-step">
                                <div class="step-heading text-center">
                                    <h4>Review and consent</h4>
                                    <p>Please confirm your details are correct before submitting the application.</p>
                                </div>

                                <div class="review-box">
                                    <div class="review-icon">
                                        <i class="bi bi-clipboard2-check"></i>
                                    </div>

                                    <h3>Ready for initial verification</h3>
                                    <p>
                                        After submission, your application will enter New Lead status. The team will verify
                                        your contact details, check eligibility, and request any missing documents.
                                    </p>

                                    <div class="form-check consent-check">
                                        <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms" value="1" @checked(old('terms'))>
                                        <label class="form-check-label" for="terms">
                                            I confirm the information is accurate and authorize contact for loan processing.
                                        </label>
                                        @error('terms') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5 gap-3 flex-wrap">
                                <button type="button"
                                        class="btn btn-outline-primary px-5"
                                        id="prevBtn">
                                    Previous
                                </button>

                                <button type="button"
                                        class="btn btn-primary px-5"
                                        id="nextBtn">
                                    Next
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            let currentStep = 0;

            const steps = document.querySelectorAll('.form-step');
            const indicators = document.querySelectorAll('.step-item');
            const nextBtn = document.getElementById('nextBtn');
            const prevBtn = document.getElementById('prevBtn');
            const form = document.getElementById('loanApplicationForm');

            function updateSteps() {
                steps.forEach((step, index) => {
                    step.classList.toggle('active', index === currentStep);
                });

                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index <= currentStep);
                });

                prevBtn.style.display = currentStep === 0 ? 'none' : 'inline-flex';
                nextBtn.innerText = currentStep === steps.length - 1 ? 'Submit Application' : 'Next Step';

                const progress = (currentStep / (steps.length - 1)) * 100;
                document.getElementById('progressBar').style.width = progress + '%';
            }

            nextBtn.addEventListener('click', () => {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    updateSteps();
                    form.scrollIntoView({behavior: 'smooth', block: 'start'});

                    return;
                }

                form.submit();
            });

            prevBtn.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    updateSteps();
                    form.scrollIntoView({behavior: 'smooth', block: 'start'});
                }
            });

            updateSteps();
        </script>
    @endpush
@endsection
