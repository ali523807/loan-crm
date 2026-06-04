<nav class="navbar navbar-expand-lg frontend-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <span class="brand-mark">
                <i class="bi bi-shield-check"></i>
            </span>
            <span class="brand-text">FinEase</span>
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="/about-us">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('loans') ? 'active' : '' }}" href="/loans">Loans</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}" href="/contact-us">Contact</a>
                </li>

                <li class="nav-item ms-lg-3">
                    <a href="{{ route('frontend.apply-loan') }}" class="btn btn-primary btn-nav">
                        Apply Now
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
