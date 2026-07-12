@extends('layouts.app')

@section('title', 'Dashboard - PlanMyTrip')

@section('styles')
    <style>
        .dashboard-wrapper {
            max-width: 860px;
            margin: 0 auto;
            padding: 2.5rem 1rem;
        }

        /* ── Header ── */
        .dash-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .dash-header h2 {
            font-size: 42px;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .dash-header p {
            font-size: 14px;
            color: #aaa;
            margin: 0;
        }

        /* ── Stats Box ── */
        .stats-box {
            background: #fff;
            border: 1px solid #e0d9ce;
            border-radius: 12px;
            padding: 1.25rem 1.75rem;
            display: flex;
            gap: 0;
            margin-bottom: 2rem;
        }

        .stats-box .stat {
            flex: 1;
        }

        .stats-box .stat-val {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 30px;
            color: #1a1a1a;
        }

        .stats-box .stat-label {
            font-size: 12px;
            color: #aaa;
        }

        .stats-box .stat-divider {
            width: 1px;
            background: #e0d9ce;
            margin: 0 1.75rem;
        }

        /* ── Weather Card ── */
        .weather-card {
            background: #fff;
            border: 1px solid #e0d9ce;
            border-radius: 12px;
            padding: 1.25rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .weather-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .weather-icon {
            font-size: 36px;
            color: #EF9F27;
        }

        .weather-city {
            font-size: 16px;
            font-weight: 500;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .weather-desc {
            font-size: 13px;
            color: #aaa;
        }

        .weather-temp {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            color: #1a1a1a;
        }

        .weather-trip-label {
            font-size: 12px;
            color: #aaa;
            text-align: right;
        }

        /* ── Trips ── */
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

        .trip-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #e0d9ce;
        }

        .trip-row:last-child {
            border-bottom: none;
        }

        .trip-name {
            font-size: 15px;
            font-weight: 500;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .trip-meta {
            font-size: 12px;
            color: #aaa;
            display: flex;
            gap: 12px;
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
            min-width: 70px;
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
            padding: 3rem 0;
            color: #aaa;
            font-size: 14px;
        }

        .empty-state i {
            font-size: 36px;
            color: #e0d9ce;
            margin-bottom: 12px;
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-wrapper">

        {{-- Header --}}
        <div class="dash-header">
            <div>
                <p class="section-label mb-1">Your travel hub</p>
                <h2>Welcome, {{ Auth::user()->name }} 👋</h2>
                <p>Here's an overview of your trips</p>
            </div>
            <a href="{{ route('trips.create') }}" class="btn btn-orange px-4 py-2 mt-2">
                <i class="ti ti-plus me-1"></i> New Trip
            </a>
        </div>

        {{-- Stats Box --}}
        <div class="stats-box">
            <div class="stat">
                <div class="stat-val">{{ $totalTrips }}</div>
                <div class="stat-label">Total trips</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <div class="stat-val">{{ $upcomingCount }}</div>
                <div class="stat-label">Upcoming</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat">
                <div class="stat-val">৳{{ number_format($totalBudget) }}</div>
                <div class="stat-label">Total budget</div>
            </div>
        </div>

        {{-- Weather Preview --}}
        @if($weatherTrip)
            <div class="weather-card">
                <div class="weather-left">
                    <i class="ti ti-{{ $weatherIcon }} weather-icon"></i>
                    <div>
                        <div class="weather-city">{{ $weatherTrip->destination }}</div>
                        <div class="weather-desc">{{ $weatherDesc ?? 'Loading...' }}</div>
                    </div>
                </div>
                <div>
                    <div class="weather-temp">{{ $weatherTemp ?? '--' }}°C</div>
                    <div class="weather-trip-label">
                        <i class="ti ti-map-pin" style="font-size:12px;"></i>
                        Next trip: {{ $weatherTrip->title }}
                    </div>
                </div>
            </div>
        @endif

        {{-- Trip List --}}
        <div class="section-header">
            <h5>Your trips</h5>
            <a href="{{ route('trips.index') }}" style="font-size:13px; color:#EF9F27; text-decoration:none;">View all</a>
        </div>

        @forelse($trips as $trip)
            <div class="trip-row">
                <div>
                    <a href="{{ route('trips.show', $trip) }}" style="text-decoration:none; color:inherit;">
                        <div class="trip-name">{{ $trip->title }}</div>
                    </a>
                    <div class="trip-meta">
                        <span><i class="ti ti-map-pin" style="font-size:12px;"></i> {{ $trip->destination }}</span>
                        <span><i class="ti ti-calendar" style="font-size:12px;"></i>
                            {{ \Carbon\Carbon::parse($trip->start_date)->format('M d') }} –
                            {{ \Carbon\Carbon::parse($trip->end_date)->format('M d, Y') }}</span>
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
                    <a href="{{ route('trips.edit', $trip) }}" class="icon-btn"><i class="ti ti-edit"></i></a>
                    <form method="POST" action="{{ route('trips.destroy', $trip) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="icon-btn" onclick="return confirm('Delete this trip?')"><i
                                class="ti ti-trash"></i></button>
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