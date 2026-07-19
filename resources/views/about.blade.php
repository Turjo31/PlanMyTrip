@extends('layouts.app')

@section('title', 'About - PlanMyTrip')

@section('styles')
<style>
    .about-wrapper {
        max-width: 760px;
        margin: 0 auto;
        padding: 2.5rem 1rem;
    }

    /* ── Header ── */
    .about-header {
        margin-bottom: 2.5rem;
    }

    .about-header h2 {
        font-size: 52px;
        color: var(--text);
        margin-bottom: 4px;
    }

    .about-header p {
        font-size: 14px;
        color: var(--text-muted);
        margin: 0;
    }

    /* ── Section card ── */
    .about-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.75rem 2rem;
        margin-bottom: 16px;
    }

    .about-card .card-label {
        font-size: 11px;
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .about-card h4 {
        font-size: 20px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 10px;
    }

    .about-card p {
        font-size: 14px;
        color: var(--text-muted);
        line-height: 1.8;
        margin: 0;
    }

    /* ── Developer card ── */
    .dev-card {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .dev-avatar {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: var(--accent);
        color: #412402;
        font-size: 28px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-family: 'Bebas Neue', sans-serif;
        letter-spacing: 1px;
    }

    .dev-info h5 {
        font-size: 18px;
        font-weight: 600;
        color: var(--text);
        margin-bottom: 4px;
    }

    .dev-info .dev-role {
        font-size: 13px;
        color: var(--accent);
        font-weight: 500;
        margin-bottom: 8px;
    }

    .dev-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 13px;
        color: var(--text-muted);
    }

    .dev-meta span {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ── Social links ── */
    .social-links {
        display: flex;
        gap: 10px;
        margin-top: 14px;
    }

    .social-btn {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 8px;
        border: 1px solid var(--border);
        font-size: 13px;
        color: var(--text-muted);
        text-decoration: none;
        transition: all 0.15s;
        background: var(--bg);
    }

    .social-btn:hover {
        border-color: var(--accent);
        color: var(--accent);
    }

    /* ── Contact form ── */
    .contact-form .form-label {
        font-size: 13px;
        font-weight: 500;
        color: var(--text-muted);
        margin-bottom: 6px;
    }

    .contact-form .form-control {
        background: var(--bg-input);
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 14px;
        padding: 10px 14px;
        color: var(--text);
    }

    .contact-form .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(239, 159, 39, 0.15);
    }

    .contact-form .form-control::placeholder {
        color: var(--placeholder);
    }

    /* ── Feature list ── */
    .feature-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-top: 12px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: var(--text-muted);
    }

    .feature-item i {
        color: var(--accent);
        font-size: 15px;
        flex-shrink: 0;
    }
</style>
@endsection

@section('content')
<div class="about-wrapper">

    {{-- Header --}}
    <div class="about-header">
        <p class="section-label mb-1">Who we are</p>
        <h2>About</h2>
        <p>Learn more about PlanMyTrip and the person behind it</p>
    </div>

    {{-- Project Info --}}
    <div class="about-card">
        <div class="card-label">
            <i class="ti ti-info-circle"></i> About PlanMyTrip
        </div>
        <h4>Your personal travel planning hub</h4>
        <p>PlanMyTrip is a full-stack travel planning web application built with Laravel and MySQL. It was designed to help travelers organize their trips, track budgets, discover tourist attractions, and share their experiences with a community of fellow travelers. Whether you're planning a weekend getaway or a long holiday, PlanMyTrip gives you everything you need in one place — from live weather updates and destination info to a downloadable PDF summary of your trip.</p>

        <div class="feature-list">
            <div class="feature-item"><i class="ti ti-check"></i> Trip planning & management</div>
            <div class="feature-item"><i class="ti ti-check"></i> Budget tracking</div>
            <div class="feature-item"><i class="ti ti-check"></i> Live weather updates</div>
            <div class="feature-item"><i class="ti ti-check"></i> Tourist attractions nearby</div>
            <div class="feature-item"><i class="ti ti-check"></i> Community travel feed</div>
            <div class="feature-item"><i class="ti ti-check"></i> PDF trip summary export</div>
            <div class="feature-item"><i class="ti ti-check"></i> Dark mode support</div>
            <div class="feature-item"><i class="ti ti-check"></i> Admin panel</div>
        </div>
    </div>

    {{-- Developer --}}
    <div class="about-card">
        <div class="card-label">
            <i class="ti ti-user"></i> Developer
        </div>
        <div class="dev-card">
            <div class="dev-avatar">T</div>
            <div class="dev-info">
                <h5>Sabyasachi Sadhu Turjo</h5>
                <div class="dev-role">Full Stack Developer</div>
                <div class="dev-meta">
                    <span><i class="ti ti-id-badge" style="font-size:13px;"></i> Roll: 2207093</span>
                    <span><i class="ti ti-building" style="font-size:13px;"></i> Dept. of CSE, KUET</span>
                    <span><i class="ti ti-school" style="font-size:13px;"></i> 3rd Year, 1st Semester</span>
                </div>
                <div class="social-links">
                    <a href="mailto:ssturjo.2003@gmail.com" class="social-btn">
                        <i class="ti ti-mail"></i> ssturjo.2003@gmail.com
                    </a>
                    <a href="https://github.com/Turjo31" target="_blank" class="social-btn">
                        <i class="ti ti-brand-github"></i> Turjo31
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Contact --}}
    <div class="about-card">
        <div class="card-label">
            <i class="ti ti-mail"></i> Contact Us
        </div>
        <h4>Get in touch</h4>
        <p style="margin-bottom: 1.25rem;">Have a question, suggestion, or just want to say hello? Fill out the form below or reach out directly via email or GitHub.</p>

        <form class="contact-form" onsubmit="handleContact(event)">
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Your name</label>
                    <input type="text" class="form-control" placeholder="John Doe" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Your email</label>
                    <input type="email" id="contactEmail" class="form-control" placeholder="you@example.com" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea class="form-control" rows="4" placeholder="Write your message here..." required></textarea>
            </div>
            <button type="submit" class="btn btn-orange px-4">
                <i class="ti ti-send me-1"></i> Send message
            </button>
            <span id="contactSuccess" style="display:none; margin-left:12px; font-size:13px; color:#3B6D11;">
                <i class="ti ti-circle-check"></i> Message sent! We'll get back to you soon.
            </span>
        </form>
    </div>

</div>
@endsection

@section('scripts')
<script>
    /**
     * Handle contact form submission.
     * Opens the user's default email client with a pre-filled message.
     */
    function handleContact(e) {
        e.preventDefault();
        const email = document.getElementById('contactEmail').value;

        // Open mail client with pre-filled recipient
        window.location.href = `mailto:ssturjo.2003@gmail.com?subject=PlanMyTrip Contact&body=From: ${email}`;

        // Show success message
        document.getElementById('contactSuccess').style.display = 'inline';
    }
</script>
@endsection