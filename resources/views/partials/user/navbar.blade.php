<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('user.dashboard') }}">E-Hotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'text-primary fw-bold' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'text-primary fw-bold' : '' }}" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('services') ? 'text-primary fw-bold' : '' }}" href="/services">Services</a>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        <!-- Foto Profil -->
                        <img src="{{ Auth::user()->photo ?? 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
                             alt="avatar"
                             class="rounded-circle me-2"
                             width="32" height="32">

                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">

                        <li>
                            <a class="dropdown-item" href="{{ route('user.reservation.history') }}">
                                <i class="bi bi-cart-check-fill me-2"></i> Riwayat Pemesanan
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
