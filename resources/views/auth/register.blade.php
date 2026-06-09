@extends('layouts.app')

@section('title', 'Register - PlanMyTrip')

@section('styles')
<style>
    .auth-wrapper {
        min-height: calc(100vh - 140px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 0;
    }

    .auth-card {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 16px;
        padding: 2.5rem;
        width: 100%;
        max-width: 420px;
    }

    .auth-card h2 {
        font-size: 40px;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .auth-card .subtitle {
        font-size: 14px;
        color: #aaa;
        margin-bottom: 2rem;
    }

    .form-label {
        font-size: 13px;
        font-weight: 500;
        color: #555;
        margin-bottom: 6px;
    }

    .form-control {
        background: #f5f0e8;
        border: 1px solid #e0d9ce;
        border-radius: 8px;
        font-size: 14px;
        padding: 10px 14px;
        color: #1a1a1a;
    }

    .form-control:focus {
        background: #f5f0e8;
        border-color: #EF9F27;
        box-shadow: 0 0 0 3px rgba(239, 159, 39, 0.15);
        color: #1a1a1a;
    }

    .btn-orange {
        width: 100%;
        padding: 10px;
        font-size: 14px;
    }

    .auth-footer {
        text-align: center;
        margin-top: 1.25rem;
        font-size: 13px;
        color: #aaa;
    }

    .auth-footer a {
        color: #EF9F27;
        text-decoration: none;
        font-weight: 500;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <p class="section-label mb-1">Get started</p>
        <h2>Register</h2>
        <p class="subtitle">Create your free account and start planning</p>

        @if($errors->any())
            <div class="alert alert-danger" style="font-size:13px; border-radius:8px;">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="#">
            @csrf

            <div class="mb-3">
                <label class="form-label">Full name</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="John Doe"
                    value="{{ old('name') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="you@example.com"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="••••••••"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="••••••••"
                    required
                >
            </div>

            <button type="submit" class="btn btn-orange">Create account</button>
        </form>

        <div class="auth-footer mt-3">
            Already have an account? <a href="#">Login here</a>
        </div>
    </div>
</div>
@endsection