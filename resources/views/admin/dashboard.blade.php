@extends('layouts.app')

@section('title', 'Admin Dashboard - PlanMyTrip')

@section('styles')
<style>
    .admin-wrapper {
        max-width: 960px;
        margin: 0 auto;
        padding: 2.5rem 1rem;
    }

    /* ── Header ── */
    .admin-header {
        margin-bottom: 2rem;
    }

    .admin-header h2 {
        font-size: 48px;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .admin-header p {
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
        margin-bottom: 2rem;
    }

    .stat {
        flex: 1;
    }

    .stat-val {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 30px;
        color: #1a1a1a;
    }

    .stat-label {
        font-size: 12px;
        color: #aaa;
    }

    .stat-divider {
        width: 1px;
        background: #e0d9ce;
        margin: 0 1.75rem;
    }

    /* ── Section ── */
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

    /* ── Table ── */
    .admin-table {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .admin-table table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .admin-table thead th {
        background: #f5f0e8;
        padding: 10px 16px;
        font-size: 12px;
        font-weight: 500;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 1px solid #e0d9ce;
        text-align: left;
    }

    .admin-table tbody td {
        padding: 12px 16px;
        color: #1a1a1a;
        border-bottom: 1px solid #f0ebe2;
    }

    .admin-table tbody tr:last-child td {
        border-bottom: none;
    }

    .admin-table tbody tr:hover td {
        background: #fdf9f3;
    }

    .badge {
        font-size: 11px;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 500;
    }

    .badge-active {
        background: #EAF3DE;
        color: #3B6D11;
    }

    .badge-inactive {
        background: #f5e6e6;
        color: #a94442;
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
</style>
@endsection

@section('content')
<div class="admin-wrapper">

    {{-- Header --}}
    <div class="admin-header">
        <p class="section-label mb-1">Admin panel</p>
        <h2>Dashboard</h2>
        <p>Overview of all site activity</p>
    </div>

    {{-- Stats --}}
    <div class="stats-box">
        <div class="stat">
            <div class="stat-val">{{ $totalUsers }}</div>
            <div class="stat-label">Total users</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat">
            <div class="stat-val">{{ $totalTrips }}</div>
            <div class="stat-label">Total trips</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat">
            <div class="stat-val">{{ $activeThisMonth }}</div>
            <div class="stat-label">New this month</div>
        </div>
        <div class="stat-divider"></div>
        <div class="stat">
            <div class="stat-val">{{ $totalAnnouncements }}</div>
            <div class="stat-label">Announcements</div>
        </div>
    </div>

    {{-- Recent Users --}}
    <div class="section-header">
        <h5>Recent users</h5>
        <a href="{{ route('admin.users') }}" style="font-size:13px; color:#EF9F27; text-decoration:none;">View all</a>
    </div>
    <div class="admin-table mb-4">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Trips</th>
                    <th>Status</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->trips->count() }}</td>
                        <td>
                            @if($user->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Recent Trips --}}
    <div class="section-header">
        <h5>Recent trips</h5>
    </div>
    <div class="admin-table">
        <table>
            <thead>
                <tr>
                    <th>Trip</th>
                    <th>User</th>
                    <th>Destination</th>
                    <th>Status</th>
                    <th>Budget</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentTrips as $trip)
                    <tr>
                        <td>{{ $trip->title }}</td>
                        <td>{{ $trip->user->name }}</td>
                        <td>{{ $trip->destination }}</td>
                        <td>
                            <span class="badge badge-{{ $trip->status }}">{{ ucfirst($trip->status) }}</span>
                        </td>
                        <td>৳{{ number_format($trip->budget) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection