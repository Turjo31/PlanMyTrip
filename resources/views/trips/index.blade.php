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
        <a href="{{ route('trips.create') }}" class="btn btn-orange px-4 py-2 mt-2">
            <i class="ti ti-plus me-1"></i> New Trip
        </a>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success mb-3" style="font-size:13px; border-radius:8px;">{{ session('success') }}</div>
    @endif

    {{-- Filters --}}
    <div class="filters">
        <a href="{{ route('trips.index') }}" class="filter-btn {{ !request('status') ? 'active' : '' }}">All</a>
        <a href="{{ route('trips.index', ['status' => 'planned']) }}" class="filter-btn {{ request('status') === 'planned' ? 'active' : '' }}">Planned</a>
        <a href="{{ route('trips.index', ['status' => 'ongoing']) }}" class="filter-btn {{ request('status') === 'ongoing' ? 'active' : '' }}">Ongoing</a>
        <a href="{{ route('trips.index', ['status' => 'completed']) }}" class="filter-btn {{ request('status') === 'completed' ? 'active' : '' }}">Completed</a>
    </div>

    @forelse($trips as $trip)
        <div class="trip-row">
            <div>
                <div class="trip-name">{{ $trip->title }}</div>
                <div class="trip-meta">
                    <span><i class="ti ti-map-pin" style="font-size:12px;"></i> {{ $trip->destination }}</span>
                    <span><i class="ti ti-calendar" style="font-size:12px;"></i> {{ \Carbon\Carbon::parse($trip->start_date)->format('M d') }} – {{ \Carbon\Carbon::parse($trip->end_date)->format('M d, Y') }}</span>
                </div>
            </div>
            <div class="trip-right">
                @if($trip->status === 'ongoing')
                    <span class="badge badge-ongoing">Ongoing</span>
                @elseif($trip->status === 'planned')
                    <span class="badge badge-planned">Planned</span>
                @else
                    <span class="badge badge-completed">Completed</span>
                @endif
                <div class="trip-budget">৳{{ number_format($trip->budget) }}</div>
                <a href="{{ route('trips.show', $trip) }}" class="icon-btn"><i class="ti ti-eye"></i></a>
                <a href="{{ route('trips.edit', $trip) }}" class="icon-btn"><i class="ti ti-edit"></i></a>
                <form method="POST" action="{{ route('trips.destroy', $trip) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="icon-btn" onclick="return confirm('Delete this trip?')"><i class="ti ti-trash"></i></button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i class="ti ti-map-off"></i>
            No trips yet. Start by creating your first one!
        </div>
    @endforelse

</div>
@endsection