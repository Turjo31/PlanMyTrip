@extends('layouts.app')

@section('title', 'Share a Story - PlanMyTrip')

@section('styles')
<style>
    .form-wrapper {
        max-width: 620px;
        margin: 0 auto;
        padding: 2.5rem 1rem;
    }

    .form-header {
        margin-bottom: 2rem;
    }

    .form-header h2 {
        font-size: 42px;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .form-header p {
        font-size: 14px;
        color: #aaa;
        margin: 0;
    }

    .form-card {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 16px;
        padding: 2rem;
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

    .form-text {
        font-size: 12px;
        color: #aaa;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 1.5rem;
    }
</style>
@endsection

@section('content')
<div class="form-wrapper">

    {{-- Header --}}
    <div class="form-header">
        <p class="section-label mb-1">Community</p>
        <h2>Share a Story</h2>
        <p>Tell fellow travelers about your experience</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mb-3" style="font-size:13px; border-radius:8px;">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form method="POST" action="#">
            @csrf

            {{-- Title --}}
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input
                    type="text"
                    name="title"
                    class="form-control"
                    placeholder="e.g. Cox's Bazar was absolutely worth it!"
                    value="{{ old('title') }}"
                    required
                >
            </div>

            {{-- Destination --}}
            <div class="mb-3">
                <label class="form-label">Destination <span style="color:#aaa; font-weight:400;">(optional)</span></label>
                <input
                    type="text"
                    name="destination"
                    class="form-control"
                    placeholder="e.g. Cox's Bazar, Bangladesh"
                    value="{{ old('destination') }}"
                >
                <div class="form-text mt-1">Helps other travelers find stories about specific places.</div>
            </div>

            {{-- Body --}}
            <div class="mb-3">
                <label class="form-label">Your story</label>
                <textarea
                    name="body"
                    class="form-control"
                    rows="6"
                    placeholder="Share your experience, tips, or highlights from your trip..."
                    required
                >{{ old('body') }}</textarea>
            </div>

            <div class="form-actions">
                <a href="#" class="btn btn-outline-secondary px-4">Cancel</a>
                <button type="submit" class="btn btn-orange px-4">Post story</button>
            </div>

        </form>
    </div>
</div>
@endsection