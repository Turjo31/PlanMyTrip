@extends('layouts.app')

@section('title', 'PlanMyTrip - Travel Planning System')

@section('styles')
<style>
    /* ── Hero ── */
    .hero {
        padding: 5rem 0 3rem;
        text-align: center;
    }

    .hero h1 {
        font-size: 72px;
        line-height: 1.05;
        color: #1a1a1a;
    }

    .hero h1 span {
        color: #EF9F27;
    }

    .hero p {
        font-size: 15px;
        color: #888;
        line-height: 1.7;
        max-width: 480px;
        margin: 0 auto 2rem;
    }

    /* ── Hero Stats ── */
    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #e0d9ce;
        margin-top: 2rem;
    }

    .hero-stats .stat-val {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 34px;
        color: #1a1a1a;
    }

    .hero-stats .stat-label {
        font-size: 12px;
        color: #aaa;
    }

    /* ── Features ── */
    .features-section {
        background: #fff;
        border-top: 1px solid #e0d9ce;
        border-bottom: 1px solid #e0d9ce;
        padding: 4rem 0;
    }

    .feature-box {
        background: #f5f0e8;
        border-radius: 12px;
        padding: 1.25rem;
    }

    .feature-box .icon {
        font-size: 24px;
        color: #EF9F27;
        margin-bottom: 10px;
    }

    .feature-box h6 {
        font-size: 14px;
        font-weight: 500;
        color: #1a1a1a;
        margin-bottom: 6px;
    }

    .feature-box p {
        font-size: 13px;
        color: #888;
        line-height: 1.6;
        margin: 0;
    }

    /* ── Announcements ── */
    .announcements-section {
        padding: 4rem 0;
    }

    .ann-item {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
    }

    .ann-item .ann-title {
        font-size: 14px;
        font-weight: 500;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .ann-item .ann-desc {
        font-size: 13px;
        color: #888;
        margin: 0;
    }

    .ann-item .ann-date {
        font-size: 12px;
        color: #aaa;
        white-space: nowrap;
        margin-left: 1rem;
    }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="hero">
    <div class="container">
        <p class="section-label mb-2">Your travel hub</p>
        <h1>Plan your next<br><span>adventure</span></h1>
        <p class="mt-3">Organize trips, track your budget, and explore destinations — all in one place. Built for travelers who love to plan.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('register') }}" class="btn btn-orange px-4 py-2">Get started — it's free</a>
            <a href="#features" class="btn btn-outline-secondary px-4 py-2">Learn more</a>
        </div>
        <div class="hero-stats">
            <div>
                <div class="stat-val">500+</div>
                <div class="stat-label">Trips planned</div>
            </div>
            <div>
                <div class="stat-val">120+</div>
                <div class="stat-label">Happy travelers</div>
            </div>
            <div>
                <div class="stat-val">30+</div>
                <div class="stat-label">Destinations</div>
            </div>
        </div>
    </div>
</section>

{{-- Features --}}
<section class="features-section" id="features">
    <div class="container">
        <p class="section-label text-center mb-2">What you get</p>
        <h2 class="text-center mb-4" style="font-size:40px;">Everything you need to travel smart</h2>
        <div class="row g-3" style="max-width:720px; margin:0 auto;">
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="icon"><i class="ti ti-map-pin"></i></div>
                    <h6>Trip planning</h6>
                    <p>Create and manage trips with destinations, dates, and budgets.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="icon"><i class="ti ti-cloud"></i></div>
                    <h6>Live weather</h6>
                    <p>See real-time weather for your destination before you go.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="icon"><i class="ti ti-coin"></i></div>
                    <h6>Budget tracking</h6>
                    <p>Track estimated vs actual spending for every trip.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="icon"><i class="ti ti-world"></i></div>
                    <h6>Destination info</h6>
                    <p>Get currency, language, and timezone details instantly.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="icon"><i class="ti ti-history"></i></div>
                    <h6>Trip history</h6>
                    <p>Keep a record of all your past and upcoming adventures.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="icon"><i class="ti ti-bell"></i></div>
                    <h6>Announcements</h6>
                    <p>Stay updated with the latest news and site updates.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Announcements --}}
<section class="announcements-section">
    <div class="container" style="max-width:720px;">
        <p class="section-label mb-2">Latest updates</p>
        <h2 style="font-size:40px;" class="mb-4">Announcements</h2>

        @forelse($announcements as $announcement)
            <div class="ann-item">
                <div>
                    <div class="ann-title">{{ $announcement->title }}</div>
                    <p class="ann-desc">{{ $announcement->body }}</p>
                </div>
                <div class="ann-date">{{ $announcement->created_at->format('M d, Y') }}</div>
            </div>
        @empty
            <div class="ann-item">
                <div>
                    <div class="ann-title">No announcements yet</div>
                    <p class="ann-desc">Check back soon for updates.</p>
                </div>
            </div>
        @endforelse
    </div>
</section>

@endsection