<!-- EMI Calculator Section -->
<section class="emi-section py-5">

    <div class="container">

        <div class="row align-items-center">

            <!-- Left Content -->
            <div class="col-lg-6 mb-5 mb-lg-0">

                <span class="section-badge">
                    EMI Calculator
                </span>

                <h2 class="section-title mt-3">
                    Calculate Your Monthly EMI
                </h2>

                <p class="section-description mt-4">
                    Estimate your monthly EMI instantly based on loan amount,
                    interest rate, and loan tenure.
                </p>

                <div class="emi-visual mt-4">
                    <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=900&q=80"
                         class="img-fluid emi-image"
                         alt="Loan officer calculating EMI with financial documents">

                    <div class="emi-visual-badge">
                        <i class="bi bi-calculator"></i>
                        <span>Plan EMI before applying</span>
                    </div>
                </div>

            </div>

            <!-- Calculator -->
            <div class="col-lg-6">

                <div class="emi-card">

                    <div class="mb-4">

                        <label class="form-label">
                            Loan Amount
                        </label>

                        <input type="range"
                               class="form-range"
                               min="10000"
                               max="5000000"
                               step="10000"
                               id="loanAmount"
                               value="500000">

                        <div class="d-flex justify-content-between">

                            <span>
                                ₹10K
                            </span>

                            <strong id="loanAmountValue">
                                ₹5,00,000
                            </strong>

                            <span>
                                ₹50L
                            </span>

                        </div>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Interest Rate (%)
                        </label>

                        <input type="range"
                               class="form-range"
                               min="1"
                               max="30"
                               step="0.1"
                               id="interestRate"
                               value="10">

                        <div class="d-flex justify-content-between">

                            <span>
                                1%
                            </span>

                            <strong id="interestRateValue">
                                10%
                            </strong>

                            <span>
                                30%
                            </span>

                        </div>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Loan Tenure (Years)
                        </label>

                        <input type="range"
                               class="form-range"
                               min="1"
                               max="30"
                               step="1"
                               id="loanTenure"
                               value="5">

                        <div class="d-flex justify-content-between">

                            <span>
                                1 Year
                            </span>

                            <strong id="loanTenureValue">
                                5 Years
                            </strong>

                            <span>
                                30 Years
                            </span>

                        </div>

                    </div>

                    <hr>

                    <div class="text-center mt-4">

                        <h6 class="text-muted">
                            Monthly EMI
                        </h6>

                        <h1 class="emi-result" id="emiResult">
                            ₹10,624
                        </h1>

                    </div>

                    <!-- EMI Breakdown -->
                    <div class="emi-breakdown mt-4">

                        <div class="emi-item">

        <span>
            Principal Amount
        </span>

                            <strong id="principalAmount">
                                ₹5,00,000
                            </strong>

                        </div>

                        <div class="emi-item">

        <span>
            Total Interest
        </span>

                            <strong id="totalInterest">
                                ₹1,37,411
                            </strong>

                        </div>

                        <div class="emi-item border-0">

        <span>
            Total Payable
        </span>

                            <strong class="text-primary" id="totalPayable">
                                ₹6,37,411
                            </strong>

                        </div>

                    </div>

                    <div class="text-center mt-4">

                        <a href="{{ route('frontend.apply-loan') }}" class="btn btn-primary btn-lg px-5">
                            Apply Loan
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<script>

    const loanAmount = document.getElementById('loanAmount');
    const interestRate = document.getElementById('interestRate');
    const loanTenure = document.getElementById('loanTenure');

    const loanAmountValue = document.getElementById('loanAmountValue');
    const interestRateValue = document.getElementById('interestRateValue');
    const loanTenureValue = document.getElementById('loanTenureValue');

    const emiResult = document.getElementById('emiResult');

    function calculateEMI() {

        const P = parseFloat(loanAmount.value);
        const annualRate = parseFloat(interestRate.value);
        const years = parseFloat(loanTenure.value);

        const R = annualRate / 12 / 100;
        const N = years * 12;

        const EMI =
            (P * R * Math.pow(1 + R, N)) /
            (Math.pow(1 + R, N) - 1);

        const totalPayment = EMI * N;
        const totalInterest = totalPayment - P;

        // EMI
        emiResult.innerText =
            '₹' + Math.round(EMI).toLocaleString();

        // Values
        loanAmountValue.innerText =
            '₹' + Number(P).toLocaleString();

        interestRateValue.innerText =
            annualRate + '%';

        loanTenureValue.innerText =
            years + ' Years';

        // Breakdown
        document.getElementById('principalAmount').innerText =
            '₹' + Math.round(P).toLocaleString();

        document.getElementById('totalInterest').innerText =
            '₹' + Math.round(totalInterest).toLocaleString();

        document.getElementById('totalPayable').innerText =
            '₹' + Math.round(totalPayment).toLocaleString();
    }

    loanAmount.addEventListener('input', calculateEMI);
    interestRate.addEventListener('input', calculateEMI);
    loanTenure.addEventListener('input', calculateEMI);

    calculateEMI();

</script>
