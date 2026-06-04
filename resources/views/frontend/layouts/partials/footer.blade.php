<footer class="footer-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h4 class="text-white">FinEase</h4>
                <p class="mt-3 text-light">
                    A loan CRM experience for customers who need clear guidance and teams who need a structured approval process.
                </p>
            </div>

            <div class="col-lg-2 col-md-4">
                <h5 class="text-white">Company</h5>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2"><a href="/">Home</a></li>
                    <li class="mb-2"><a href="/about-us">About</a></li>
                    <li class="mb-2"><a href="/loans">Loans</a></li>
                    <li class="mb-2"><a href="/contact-us">Contact</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4">
                <h5 class="text-white">Loan Types</h5>
                <ul class="list-unstyled mt-3">
                    <li class="mb-2"><a href="{{ route('frontend.apply-loan') }}">Personal Loan</a></li>
                    <li class="mb-2"><a href="{{ route('frontend.apply-loan') }}">Business Loan</a></li>
                    <li class="mb-2"><a href="{{ route('frontend.apply-loan') }}">Home Loan</a></li>
                    <li class="mb-2"><a href="{{ route('frontend.apply-loan') }}">Vehicle Finance</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4">
                <h5 class="text-white">Contact</h5>
                <p class="text-light mt-3 mb-2">Mumbai, India</p>
                <p class="text-light mb-2">+91 9876543210</p>
                <a href="{{ route('frontend.apply-loan') }}" class="btn btn-light btn-sm rounded-pill px-4 mt-2">
                    Apply Now
                </a>
            </div>
        </div>

        <hr class="border-secondary my-4">

        <div class="d-flex flex-column flex-md-row justify-content-between gap-2 text-light">
            <p class="mb-0">Copyright 2026 FinEase Finance. All rights reserved.</p>
            <p class="mb-0">Lead verification. Document review. Loan disbursement.</p>
        </div>
    </div>
</footer>
