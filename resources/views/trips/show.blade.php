@extends('layouts.app')

@section('title', 'Trip Details - PlanMyTrip')

@section('styles')
<style>
    .details-wrapper {
        max-width: 860px;
        margin: 0 auto;
        padding: 2.5rem 1rem;
    }

    /* ── Header ── */
    .details-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
    }

    .details-header h2 {
        font-size: 48px;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .details-header .meta {
        font-size: 13px;
        color: #aaa;
        display: flex;
        gap: 16px;
        margin-top: 6px;
    }

    .details-header .meta span {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ── Info Row ── */
    .info-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 2rem;
    }

    .info-card {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
    }

    .info-card .card-label {
        font-size: 12px;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* ── Weather ── */
    .weather-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .weather-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .weather-icon {
        font-size: 36px;
        color: #EF9F27;
    }

    .weather-city {
        font-size: 15px;
        font-weight: 500;
        color: #1a1a1a;
    }

    .weather-desc {
        font-size: 13px;
        color: #aaa;
    }

    .weather-temp {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 46px;
        color: #1a1a1a;
    }

    /* ── Destination Info ── */
    .dest-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .dest-item .dest-label {
        font-size: 11px;
        color: #aaa;
        margin-bottom: 2px;
    }

    .dest-item .dest-val {
        font-size: 14px;
        font-weight: 500;
        color: #1a1a1a;
    }

    /* ── Budget ── */
    .budget-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .budget-row .label {
        color: #888;
    }

    .budget-row .val {
        font-weight: 500;
        color: #1a1a1a;
    }

    .progress {
        height: 6px;
        border-radius: 10px;
        background: #f5f0e8;
        margin-top: 10px;
    }

    .progress-bar {
        background: #EF9F27;
        border-radius: 10px;
    }

    .budget-note {
        font-size: 12px;
        color: #aaa;
        margin-top: 8px;
    }

    /* ── Places ── */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .section-header h5 {
        font-size: 13px;
        font-weight: 500;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0;
    }

    .place-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #e0d9ce;
    }

    .place-row:last-child {
        border-bottom: none;
    }

    .place-name {
        font-size: 15px;
        font-weight: 500;
        color: #1a1a1a;
        margin-bottom: 3px;
    }

    .place-meta {
        font-size: 12px;
        color: #aaa;
        display: flex;
        gap: 10px;
    }

    .place-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .place-cost {
        font-size: 13px;
        font-weight: 500;
        color: #1a1a1a;
        min-width: 70px;
        text-align: right;
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
        padding: 2.5rem 0;
        color: #aaa;
        font-size: 14px;
    }

    .empty-state i {
        font-size: 32px;
        color: #e0d9ce;
        margin-bottom: 10px;
        display: block;
    }

    .type-badge {
        font-size: 11px;
        padding: 2px 8px;
        border-radius: 20px;
        background: #f5f0e8;
        color: #888;
    }
</style>
@endsection

@section('content')
<div class="details-wrapper">

    {{-- Header --}}
    <div class="details-header">
        <div>
            <p class="section-label mb-1">Trip details</p>
            <h2>Cox's Bazar Getaway</h2>
            <div class="meta">
                <span><i class="ti ti-map-pin" style="font-size:13px;"></i> Cox's Bazar, Bangladesh</span>
                <span><i class="ti ti-calendar" style="font-size:13px;"></i> Jun 15 – Jun 18, 2026</span>
                <span><span class="badge badge-ongoing">Ongoing</span></span>
            </div>
        </div>
        <div class="d-flex gap-2 mt-2">
            <a href="#" class="btn btn-outline-secondary btn-sm px-3">
                <i class="ti ti-edit me-1"></i> Edit
            </a>
            <form method="POST" action="#">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-secondary px-3" style="color:#e74c3c; border-color:#e74c3c;">
                    <i class="ti ti-trash me-1"></i> Delete
                </button>
            </form>
        </div>
    </div>

    {{-- Info Row: Weather + Destination --}}
    <div class="info-row">

        {{-- Weather --}}
        <div class="info-card">
            <div class="card-label">
                <i class="ti ti-cloud"></i> Live weather
            </div>
            <div class="weather-content">
                <div class="weather-left">
                    <i class="ti ti-sun weather-icon"></i>
                    <div>
                        <div class="weather-city">Cox's Bazar</div>
                        <div class="weather-desc">Sunny, feels like 33°C</div>
                    </div>
                </div>
                <div class="weather-temp">31°C</div>
            </div>
        </div>

        {{-- Destination Info --}}
        <div class="info-card">
            <div class="card-label">
                <i class="ti ti-world"></i> Destination info
            </div>
            <div class="dest-grid">
                <div class="dest-item">
                    <div class="dest-label">Country</div>
                    <div class="dest-val">Bangladesh</div>
                </div>
                <div class="dest-item">
                    <div class="dest-label">Currency</div>
                    <div class="dest-val">BDT (৳)</div>
                </div>
                <div class="dest-item">
                    <div class="dest-label">Language</div>
                    <div class="dest-val">Bengali</div>
                </div>
                <div class="dest-item">
                    <div class="dest-label">Timezone</div>
                    <div class="dest-val">UTC+6</div>
                </div>
            </div>
        </div>

    </div>

    {{-- Budget Summary --}}
    <div class="info-card mb-4">
        <div class="card-label">
            <i class="ti ti-coin"></i> Budget summary
        </div>
        <div class="budget-row">
            <span class="label">Total budget</span>
            <span class="val">৳12,000</span>
        </div>
        <div class="budget-row">
            <span class="label">Estimated cost (places)</span>
            <span class="val">৳7,500</span>
        </div>
        <div class="budget-row">
            <span class="label">Remaining</span>
            <span class="val" style="color:#3B6D11;">৳4,500</span>
        </div>
        <div class="progress">
            <div class="progress-bar" style="width: 62%;"></div>
        </div>
        <div class="budget-note">62% of budget used across all places</div>
    </div>

    {{-- Places --}}
    <div class="section-header">
        <h5>Places to visit</h5>
        <a href="#" class="btn btn-orange btn-sm px-3">
            <i class="ti ti-plus me-1"></i> Add place
        </a>
    </div>

    {{-- Place rows -- replace with @forelse($places as $place) when controller is ready --}}
    <div class="place-row">
        <div>
            <div class="place-name">Sea Beach Hotel</div>
            <div class="place-meta">
                <span class="type-badge">Hotel</span>
                <span>3 nights</span>
            </div>
        </div>
        <div class="place-right">
            <div class="place-cost">৳5,000</div>
            <button class="icon-btn"><i class="ti ti-edit"></i></button>
            <button class="icon-btn"><i class="ti ti-trash"></i></button>
        </div>
    </div>
    <div class="place-row">
        <div>
            <div class="place-name">Boat ride at Inani Beach</div>
            <div class="place-meta">
                <span class="type-badge">Attraction</span>
            </div>
        </div>
        <div class="place-right">
            <div class="place-cost">৳500</div>
            <button class="icon-btn"><i class="ti ti-edit"></i></button>
            <button class="icon-btn"><i class="ti ti-trash"></i></button>
        </div>
    </div>
    <div class="place-row">
        <div>
            <div class="place-name">Local seafood restaurant</div>
            <div class="place-meta">
                <span class="type-badge">Restaurant</span>
            </div>
        </div>
        <div class="place-right">
            <div class="place-cost">৳2,000</div>
            <button class="icon-btn"><i class="ti ti-edit"></i></button>
            <button class="icon-btn"><i class="ti ti-trash"></i></button>
        </div>
    </div>

</div>
@endsection