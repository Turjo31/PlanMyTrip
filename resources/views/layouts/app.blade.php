<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PlanMyTrip')</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Tabler Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" rel="stylesheet">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        /* ── Base ── */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f0e8;
            color: #1a1a1a;
        }

        h1, h2, h3, .display-font {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 1px;
        }

        /* ── Navbar ── */
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #e0d9ce;
            padding: 1rem 2rem;
        }

        .navbar-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            color: #1a1a1a !important;
            letter-spacing: 1px;
        }

        .navbar-brand span {
            color: #EF9F27;
        }

        .nav-link {
            color: #888 !important;
            font-size: 14px;
        }

        .nav-link:hover, .nav-link.active {
            color: #1a1a1a !important;
        }

        /* ── Buttons ── */
        .btn-orange {
            background-color: #EF9F27;
            color: #412402;
            border: none;
            font-weight: 500;
            font-size: 13px;
        }

        .btn-orange:hover {
            background-color: #d98e1f;
            color: #412402;
        }

        .btn-outline-secondary {
            border-color: #ccc;
            color: #555;
            font-size: 13px;
        }

        /* ── Forms ── */
        .form-control::placeholder,
        .form-select::placeholder {
            color: #c5bdb0;
            font-weight: 400;
        }
        .card {
            border: 1px solid #e0d9ce;
            border-radius: 12px;
            background: #fff;
        }

        .section-label {
            font-size: 12px;
            color: #EF9F27;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        /* ── Badges ── */
        .badge-ongoing {
            background-color: #FAEEDA;
            color: #854F0B;
            font-weight: 500;
        }

        .badge-planned {
            background-color: #EAF3DE;
            color: #3B6D11;
            font-weight: 500;
        }

        .badge-completed {
            background-color: #ece9e4;
            color: #888;
            font-weight: 500;
        }

        /* ── Footer ── */
        footer {
            background-color: #1a1a1a;
            color: #555;
        }

        footer .footer-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            color: #fff;
        }

        footer .footer-logo span {
            color: #EF9F27;
        }

        footer a {
            color: #666;
            text-decoration: none;
            font-size: 13px;
        }

        footer a:hover {
            color: #EF9F27;
        }
    </style>

    @yield('styles')
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Plan<span>My</span>Trip</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ms-4">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users') }}">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/announcements*') ? 'active' : '' }}" href="{{ route('admin.announcements') }}">Announcements</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('trips*') ? 'active' : '' }}" href="{{ route('trips.index') }}">My Trips</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('community*') ? 'active' : '' }}" href="{{ route('community.index') }}">Community</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('announcements*') ? 'active' : '' }}" href="{{ route('announcements.index') }}">Announcements</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('community*') ? 'active' : '' }}" href="{{ route('community.index') }}">Community</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('announcements*') ? 'active' : '' }}" href="{{ route('announcements.index') }}">Announcements</a>
                        </li>
                    @endauth
                </ul>

                <div class="d-flex gap-2">
                    @auth
                        <span class="nav-link text-muted" style="font-size:14px;">Hi, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-sm btn-orange">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    {{-- Global flash messages shown after any action --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-0 rounded-0" role="alert" style="font-size:13px; background:#EAF3DE; color:#3B6D11; border:none; border-bottom: 1px solid #c3e6a0; padding: 12px 2rem;">
            <i class="ti ti-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" style="font-size:11px;"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-0 rounded-0" role="alert" style="font-size:13px; background:#f5e6e6; color:#a94442; border:none; border-bottom: 1px solid #f0c0c0; padding: 12px 2rem;">
            <i class="ti ti-alert-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert" style="font-size:11px;"></button>
        </div>
    @endif

    @yield('content')

    {{-- Footer --}}
    <footer class="py-4 mt-5">
        <div class="container text-center">
            <div class="footer-logo mb-2">Plan<span>My</span>Trip</div>
            <div class="d-flex justify-content-center gap-4 mb-3">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('community.index') }}">Community</a>
                <a href="{{ route('announcements.index') }}">Announcements</a>
            </div>
            <small style="font-size:12px;">© {{ date('Y') }} PlanMyTrip. All rights reserved.</small>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>