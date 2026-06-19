@extends('layouts.app')

@section('title', 'Announcements - PlanMyTrip')

@section('styles')
<style>
    .ann-wrapper {
        max-width: 720px;
        margin: 0 auto;
        padding: 2.5rem 1rem;
    }

    /* ── Header ── */
    .ann-header {
        margin-bottom: 2rem;
    }

    .ann-header h2 {
        font-size: 48px;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .ann-header p {
        font-size: 14px;
        color: #aaa;
        margin: 0;
    }

    /* ── Announcement Item ── */
    .ann-item {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
    }

    .ann-item .ann-title {
        font-size: 15px;
        font-weight: 500;
        color: #1a1a1a;
        margin-bottom: 6px;
    }

    .ann-item .ann-body {
        font-size: 13px;
        color: #888;
        line-height: 1.6;
        margin: 0;
    }

    .ann-item .ann-date {
        font-size: 12px;
        color: #aaa;
        white-space: nowrap;
        margin-top: 2px;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 0;
        color: #aaa;
        font-size: 14px;
    }

    .empty-state i {
        font-size: 40px;
        color: #e0d9ce;
        margin-bottom: 12px;
        display: block;
    }
</style>
@endsection

@section('content')
<div class="ann-wrapper">

    {{-- Header --}}
    <div class="ann-header">
        <p class="section-label mb-1">Latest updates</p>
        <h2>Announcements</h2>
        <p>Stay up to date with the latest news and site updates</p>
    </div>

    {{-- Announcement List -- replace with @forelse($announcements as $announcement) when controller is ready --}}
    <div class="ann-item">
        <div>
            <div class="ann-title">Weather feature is now live</div>
            <p class="ann-body">You can now see real-time weather for any destination directly on your trip details page. Powered by live weather data.</p>
        </div>
        <div class="ann-date">Jun 5, 2026</div>
    </div>

    <div class="ann-item">
        <div>
            <div class="ann-title">Budget tracking update</div>
            <p class="ann-body">Track your actual vs estimated costs for every place you plan to visit. The budget summary is now visible on each trip's details page.</p>
        </div>
        <div class="ann-date">May 28, 2026</div>
    </div>

    <div class="ann-item">
        <div>
            <div class="ann-title">Welcome to PlanMyTrip</div>
            <p class="ann-body">We're officially live! Start planning your trips, exploring destinations, and tracking your travel budget — all in one place.</p>
        </div>
        <div class="ann-date">May 20, 2026</div>
    </div>

</div>
@endsection