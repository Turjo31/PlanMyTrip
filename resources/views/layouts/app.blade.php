<!DOCTYPE html>
<html lang="en" id="htmlRoot">
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
        /* ── CSS Variables: Light Mode (default) ── */
        :root {
            --bg:           #f5f0e8;
            --bg-card:      #fff;
            --bg-input:     #f5f0e8;
            --text:         #1a1a1a;
            --text-muted:   #888;
            --text-light:   #aaa;
            --border:       #e0d9ce;
            --navbar-bg:    #fff;
            --footer-bg:    #1a1a1a;
            --footer-text:  #555;
            --placeholder:  #c5bdb0;
            --accent:       #EF9F27;
            --accent-dark:  #d98e1f;
        }

        /* ── CSS Variables: Dark Mode ── */
        .dark-mode {
            --bg:           #0f1117;
            --bg-card:      #1a1d26;
            --bg-input:     #13151e;
            --text:         #e8e3d9;
            --text-muted:   #888;
            --text-light:   #666;
            --border:       #2a2d36;
            --navbar-bg:    #13151e;
            --footer-bg:    #0a0b10;
            --footer-text:  #444;
            --placeholder:  #444;
            --accent:       #EF9F27;
            --accent-dark:  #d98e1f;
        }

        /* ── Base ── */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            transition: background-color 0.3s, color 0.3s;
        }

        h1, h2, h3, .display-font {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 1px;
            color: var(--text);
        }

        /* ── Navbar ── */
        .navbar {
            background-color: var(--navbar-bg);
            border-bottom: 1px solid var(--border);
            padding: 1rem 2rem;
            transition: background-color 0.3s;
        }

        .navbar-brand {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            color: var(--text) !important;
            letter-spacing: 1px;
        }

        .navbar-brand span {
            color: var(--accent);
        }

        .nav-link {
            color: var(--text-muted) !important;
            font-size: 14px;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--text) !important;
        }

        /* ── Dark mode toggle button ── */
        .dark-toggle {
            background: none;
            border: 1px solid var(--border);
            color: var(--text-muted);
            border-radius: 8px;
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .dark-toggle:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        /* ── Buttons ── */
        .btn-orange {
            background-color: var(--accent);
            color: #412402;
            border: none;
            font-weight: 500;
            font-size: 13px;
        }

        .btn-orange:hover {
            background-color: var(--accent-dark);
            color: #412402;
        }

        .btn-outline-secondary {
            border-color: var(--border);
            color: var(--text-muted);
            font-size: 13px;
        }

        .btn-outline-secondary:hover {
            background-color: var(--bg-input);
            color: var(--text);
            border-color: var(--border);
        }

        /* ── Forms ── */
        .form-control, .form-select {
            background-color: var(--bg-input) !important;
            border-color: var(--border) !important;
            color: var(--text) !important;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 3px rgba(239, 159, 39, 0.15) !important;
        }

        .form-control::placeholder,
        .form-select::placeholder {
            color: var(--placeholder);
            font-weight: 400;
        }

        /* ── Cards ── */
        .card, .info-card, .ann-item, .post-card, .trip-card, .form-card, .admin-table, .stats-box, .auth-card {
            background-color: var(--bg-card) !important;
            border-color: var(--border) !important;
            color: var(--text) !important;
        }

        /* ── Section label ── */
        .section-label {
            font-size: 12px;
            color: var(--accent);
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

        /* ── Table ── */
        .admin-table table thead th {
            background-color: var(--bg) !important;
            color: var(--text-muted) !important;
            border-bottom-color: var(--border) !important;
        }

        .admin-table table tbody td {
            color: var(--text) !important;
            border-bottom-color: var(--border) !important;
        }

        .admin-table table tbody tr:hover td {
            background-color: var(--bg) !important;
        }

        /* ── Borders and dividers ── */
        .trip-row, .place-row, .ann-item {
            border-color: var(--border) !important;
        }

        /* ── Text colors ── */
        .text-muted, .trip-meta, .post-date, .ann-date, .weather-desc,
        .budget-note, .form-text, .stat-label, .dest-label, .place-kind {
            color: var(--text-muted) !important;
        }

        /* ── Footer ── */
        footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            transition: background-color 0.3s;
        }

        footer .footer-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 20px;
            color: #fff;
        }

        footer .footer-logo span {
            color: var(--accent);
        }

        footer a {
            color: var(--footer-text);
            text-decoration: none;
            font-size: 13px;
        }

        footer a:hover {
            color: var(--accent);
        }

        /* ── Dark mode overrides for hardcoded colors ── */
        .dark-mode .stat-val,
        .dark-mode .trip-name,
        .dark-mode .trip-budget,
        .dark-mode .place-name,
        .dark-mode .place-cost,
        .dark-mode .post-title,
        .dark-mode .post-author,
        .dark-mode .ann-title,
        .dark-mode .weather-city,
        .dark-mode .weather-temp,
        .dark-mode .dest-val,
        .dark-mode .budget-row .val,
        .dark-mode .form-header h2,
        .dark-mode .form-header p,
        .dark-mode .dash-header h2,
        .dark-mode .dash-header p,
        .dark-mode .trips-header h2,
        .dark-mode .details-header h2,
        .dark-mode .feed-header h2,
        .dark-mode .ann-header h2,
        .dark-mode .admin-header h2,
        .dark-mode .auth-card h2,
        .dark-mode .ann-body,
        .dark-mode .trip-name a,
        .dark-mode label,
        .dark-mode p,
        .dark-mode td,
        .dark-mode th {
            color: var(--text) !important;
        }

        .dark-mode .trip-meta,
        .dark-mode .post-date,
        .dark-mode .ann-date,
        .dark-mode .stat-label,
        .dark-mode .form-header p,
        .dark-mode .dash-header p,
        .dark-mode .budget-note,
        .dark-mode .form-text,
        .dark-mode .subtitle {
            color: var(--text-muted) !important;
        }

        .dark-mode .stat-divider {
            background: var(--border) !important;
        }

        .dark-mode .tourist-place .place-name,
        .dark-mode .tourist-place .place-kind {
            color: var(--text) !important;
        }

        .dark-mode .badge-ongoing {
            background-color: #3d2800 !important;
            color: #EF9F27 !important;
        }

        .dark-mode .badge-planned {
            background-color: #1a2d0a !important;
            color: #97C459 !important;
        }

        .dark-mode .badge-completed {
            background-color: #2a2d36 !important;
            color: #888 !important;
        }

        /* ── Tourist place and dest-item boxes ── */
        .tourist-place, .dest-item {
            background-color: var(--bg) !important;
            border-color: var(--border) !important;
        }
    </style>

    @yield('styles')

    {{-- Apply dark mode before page renders to avoid flash --}}
    <script>
        // Apply dark mode immediately from localStorage to avoid white flash
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>
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

                <div class="d-flex gap-2 align-items-center">
                    {{-- Dark mode toggle button --}}
                    <button class="dark-toggle" id="darkToggle" title="Toggle dark mode">
                        <i class="ti ti-moon" id="darkIcon"></i>
                    </button>

                    @auth
                        <span class="nav-link" style="font-size:14px; color:var(--text-muted);">Hi, {{ Auth::user()->name }}</span>
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

    {{-- Global flash messages --}}
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

    {{-- Page Content --}}
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
            <small style="font-size:12px; color:var(--footer-text);">© {{ date('Y') }} PlanMyTrip. All rights reserved.</small>
        </div>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ── Dark mode toggle logic ──
        const toggle = document.getElementById('darkToggle');
        const icon   = document.getElementById('darkIcon');
        const html   = document.documentElement;

        // Set correct icon on page load based on saved preference
        function updateIcon() {
            if (html.classList.contains('dark-mode')) {
                icon.className = 'ti ti-sun';
            } else {
                icon.className = 'ti ti-moon';
            }
        }

        updateIcon();

        // Toggle dark mode on button click and save to localStorage
        toggle.addEventListener('click', () => {
            html.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', html.classList.contains('dark-mode'));
            updateIcon();
        });
    </script>

    @yield('scripts')
</body>
</html>