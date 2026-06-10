@extends('layouts.app')

@section('title', 'My Trips - PlanMyTrip')

@section('styles')
<style>
    .trips-wrapper {
        max-width: 860px;
        margin: 0 auto;
        padding: 2.5rem 1rem;
    }

    /* ── Header ── */
    .trips-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
    }

    .trips-header h2 {
        font-size: 48px;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .trips-header p {
        font-size: 14px;
        color: #aaa;
        margin: 0;
    }

    /* ── Filters ── */
    .filters {
        display: flex;
        gap: 8px;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .filter-btn {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 20px;
        padding: 6px 16px;
        font-size: 13px;
        color: #888;
        cursor: pointer;
        transition: all 0.15s;
    }

    .filter-btn:hover, .filter-btn.active {
        background: #EF9F27;
        border-color: #EF9F27;
        color: #412402;
        font-weight: 500;
    }

    /* ── Trip Cards ── */
    .trip-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid #e0d9ce;
        cursor: pointer;
        transition: background 0.1s;
    }

    .trip-row:last-child {
        border-bottom: none;
    }

    .trip-row:hover .trip-name {
        color: #EF9F27;
    }

    .trip-name {
        font-size: 15px;
        font-weight: 500;
        color: #1a1a1a;
        margin-bottom: 4px;
        transition: color 0.15s;
    }

    .trip-meta {
        font-size: 12px;
        color: #aaa;
        display: flex;
        gap: 14px;
    }

    .trip-right {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .trip-budget {
        font-size: 13px;
        font-weight: 500;
        color: #1a1a1a;
        min-width: 80px;
        text-align: right;
    }

    .badge {
        font-size: 11px;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 500;
    }

    .icon-btn {
        background: none;
        border: none;
        color: #ccc;
        font-size: 16px;
        cursor: pointer;
        padding: 2px 4px;
    }

    .icon-btn:hover {
        color: #888;
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
<div class="trips-wrapper">

    {{-- Header --}}
    <div class="trips-header">
        <div>
            <p class="section-label mb-1">All trips</p>
            <h2>My Trips</h2>
            <p>Browse and manage all your trips</p>
        </div>
        <a href="#" class="btn btn-orange px-4 py-2 mt-2">
            <i class="ti ti-plus me-1"></i> New Trip
        </a>
    </div>

    {{-- Filters --}}
    <div class="filters">
        <button class="filter-btn active">All</button>
        <button class="filter-btn">Planned</button>
        <button class="filter-btn">Ongoing</button>
        <button class="filter-btn">Completed</button>
    </div>

    {{-- Trip List -- replace with @forelse($trips as $trip) when controller is ready --}}
    <div class="trip-row">
        <div>
            <div class="trip-name">Cox's Bazar Getaway</div>
            <div class="trip-meta">
                <span><i class="ti ti-map-pin" style="font-size:12px;"></i> Cox's Bazar, Bangladesh</span>
                <span><i class="ti ti-calendar" style="font-size:12px;"></i> Jun 15 – Jun 18, 2026</span>
            </div>
        </div>
        <div class="trip-right">
            <span class="badge badge-ongoing">Ongoing</span>
            <div class="trip-budget">৳12,000</div>
            <a href="#" class="icon-btn"><i class="ti ti-eye"></i></a>
            <a href="#" class="icon-btn"><i class="ti ti-edit"></i></a>
            <button class="icon-btn"><i class="ti ti-trash"></i></button>
        </div>
    </div>

    <div class="trip-row">
        <div>
            <div class="trip-name">Sylhet Tea Tour</div>
            <div class="trip-meta">
                <span><i class="ti ti-map-pin" style="font-size:12px;"></i> Sylhet, Bangladesh</span>
                <span><i class="ti ti-calendar" style="font-size:12px;"></i> Jul 5 – Jul 8, 2026</span>
            </div>
        </div>
        <div class="trip-right">
            <span class="badge badge-planned">Planned</span>
            <div class="trip-budget">৳8,500</div>
            <a href="#" class="icon-btn"><i class="ti ti-eye"></i></a>
            <a href="#" class="icon-btn"><i class="ti ti-edit"></i></a>
            <button class="icon-btn"><i class="ti ti-trash"></i></button>
        </div>
    </div>

    <div class="trip-row">
        <div>
            <div class="trip-name">Sundarbans Day Trip</div>
            <div class="trip-meta">
                <span><i class="ti ti-map-pin" style="font-size:12px;"></i> Khulna, Bangladesh</span>
                <span><i class="ti ti-calendar" style="font-size:12px;"></i> May 1 – May 2, 2026</span>
            </div>
        </div>
        <div class="trip-right">
            <span class="badge badge-completed">Completed</span>
            <div class="trip-budget">৳5,000</div>
            <a href="#" class="icon-btn"><i class="ti ti-eye"></i></a>
            <a href="#" class="icon-btn"><i class="ti ti-edit"></i></a>
            <button class="icon-btn"><i class="ti ti-trash"></i></button>
        </div>
    </div>

</div>
@endsection