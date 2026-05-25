<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">

    <div class="container">

        <a class="navbar-brand fw-bold text-primary fs-3" href="/">
            FinEase
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="/">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/about-us">
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/loans">
                        Loans
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/contact-us">
                        Contact
                    </a>
                </li>

                <li class="nav-item ms-lg-3">
                    <a href="{{ route('frontend.apply-loan') }}" class="btn btn-primary px-4">
                        Apply Now
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>
