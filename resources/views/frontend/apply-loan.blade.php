@extends('frontend.layouts.app')

@section('title', 'Apply Loan')

@section('content')

    <section class="loan-form-section py-5">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="loan-form-card">

                        <!-- Header -->
                        <div class="text-center mb-5">

                        <span class="section-badge">
                            Apply Online
                        </span>

                            <h2 class="section-title mt-3">
                                Loan Application Form
                            </h2>

                            <p class="section-description">
                                Complete the steps below to apply for your loan.
                            </p>

                        </div>

                        <!-- Progress -->
                        <div class="step-progress mb-5">

                            <div class="progress">
                                <div class="progress-bar"
                                     id="progressBar"
                                     role="progressbar"
                                     style="width: 20%">
                                </div>
                            </div>

                            <div class="step-indicators mt-4">

                                <div class="step-item active">
                                    <div class="step-circle">1</div>
                                    <span>Loan</span>
                                </div>

                                <div class="step-item">
                                    <div class="step-circle">2</div>
                                    <span>Personal</span>
                                </div>

                                <div class="step-item">
                                    <div class="step-circle">3</div>
                                    <span>Employment</span>
                                </div>

                                <div class="step-item">
                                    <div class="step-circle">4</div>
                                    <span>Documents</span>
                                </div>

                                <div class="step-item">
                                    <div class="step-circle">5</div>
                                    <span>Submit</span>
                                </div>

                            </div>

                        </div>

                        <form>

                            <!-- STEP 1 -->
                            <div class="form-step active">

                                <div class="row g-4">

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Loan Type
                                        </label>

                                        <select class="form-select">

                                            <option>
                                                Select Loan Type
                                            </option>

                                            <option>
                                                Personal Loan
                                            </option>

                                            <option>
                                                Business Loan
                                            </option>

                                            <option>
                                                Home Loan
                                            </option>

                                        </select>

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Loan Amount
                                        </label>

                                        <input type="number"
                                               class="form-control"
                                               placeholder="Enter Loan Amount">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Loan Tenure
                                        </label>

                                        <select class="form-select">

                                            <option>
                                                Select Tenure
                                            </option>

                                            <option>
                                                1 Year
                                            </option>

                                            <option>
                                                3 Years
                                            </option>

                                            <option>
                                                5 Years
                                            </option>

                                        </select>

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Employment Type
                                        </label>

                                        <select class="form-select">

                                            <option>
                                                Salaried
                                            </option>

                                            <option>
                                                Self Employed
                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <!-- STEP 2 -->
                            <div class="form-step">

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

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Email Address
                                        </label>

                                        <input type="email"
                                               class="form-control"
                                               placeholder="Enter Email">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Date of Birth
                                        </label>

                                        <input type="date"
                                               class="form-control">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            PAN Number
                                        </label>

                                        <input type="text"
                                               class="form-control"
                                               placeholder="ABCDE1234F">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Aadhaar Number
                                        </label>

                                        <input type="text"
                                               class="form-control"
                                               placeholder="XXXX XXXX XXXX">

                                    </div>

                                </div>

                            </div>

                            <!-- STEP 3 -->
                            <div class="form-step">

                                <div class="row g-4">

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Company Name
                                        </label>

                                        <input type="text"
                                               class="form-control">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Designation
                                        </label>

                                        <input type="text"
                                               class="form-control">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Monthly Income
                                        </label>

                                        <input type="number"
                                               class="form-control">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Work Experience
                                        </label>

                                        <input type="text"
                                               class="form-control">

                                    </div>

                                </div>

                            </div>

                            <!-- STEP 4 -->
                            <div class="form-step">

                                <div class="row g-4">

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Upload PAN Card
                                        </label>

                                        <input type="file"
                                               class="form-control">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Upload Aadhaar Card
                                        </label>

                                        <input type="file"
                                               class="form-control">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Upload Salary Slip
                                        </label>

                                        <input type="file"
                                               class="form-control">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Upload Bank Statement
                                        </label>

                                        <input type="file"
                                               class="form-control">

                                    </div>

                                </div>

                            </div>

                            <!-- STEP 5 -->
                            <div class="form-step">

                                <div class="text-center py-5">

                                    <div class="success-icon mb-4">
                                        ✓
                                    </div>

                                    <h3 class="fw-bold">
                                        Ready To Submit
                                    </h3>

                                    <p class="text-muted mt-3">
                                        Please review all your details before submission.
                                    </p>

                                    <div class="form-check mt-4 d-inline-block">

                                        <input class="form-check-input"
                                               type="checkbox"
                                               id="terms">

                                        <label class="form-check-label" for="terms">
                                            I agree to terms & conditions
                                        </label>

                                    </div>

                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between mt-5">

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

            function updateSteps() {

                steps.forEach((step, index) => {
                    step.classList.toggle('active', index === currentStep);
                });

                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index <= currentStep);
                });

                prevBtn.style.display =
                    currentStep === 0 ? 'none' : 'inline-block';

                nextBtn.innerText =
                    currentStep === steps.length - 1
                        ? 'Submit'
                        : 'Next';

                const progress =
                    ((currentStep + 1) / steps.length) * 100;

                document.getElementById('progressBar')
                    .style.width = progress + '%';
            }

            nextBtn.addEventListener('click', () => {

                if(currentStep < steps.length - 1){

                    currentStep++;

                    updateSteps();

                }else{

                    alert('Form Submitted');

                }

            });

            prevBtn.addEventListener('click', () => {

                if(currentStep > 0){

                    currentStep--;

                    updateSteps();

                }

            });

            updateSteps();

        </script>

    @endpush
@endsection

