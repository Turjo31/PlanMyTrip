@extends('layouts.app')

@section('title', 'Manage Users - PlanMyTrip')

@section('styles')
<style>
    .admin-wrapper {
        max-width: 960px;
        margin: 0 auto;
        padding: 2.5rem 1rem;
    }

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

    /* ── Search ── */
    .search-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 1.5rem;
    }

    .search-bar .form-control {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 8px;
        font-size: 14px;
        padding: 10px 14px;
        color: #1a1a1a;
        max-width: 320px;
    }

    .search-bar .form-control:focus {
        border-color: #EF9F27;
        box-shadow: 0 0 0 3px rgba(239, 159, 39, 0.15);
        outline: none;
    }

    /* ── Table ── */
    .admin-table {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 12px;
        overflow: hidden;
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
        font-size: 15px;
        cursor: pointer;
        padding: 2px 4px;
    }

    .icon-btn:hover {
        color: #888;
    }

    .action-btn {
        font-size: 12px;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid #e0d9ce;
        background: none;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
    }

    .action-btn.activate {
        color: #3B6D11;
        border-color: #3B6D11;
    }

    .action-btn.deactivate {
        color: #a94442;
        border-color: #a94442;
    }

    .action-btn:hover {
        opacity: 0.8;
    }
</style>
@endsection

@section('content')
<div class="admin-wrapper">

    {{-- Header --}}
    <div class="admin-header">
        <p class="section-label mb-1">Admin panel</p>
        <h2>Manage Users</h2>
        <p>View, activate, or deactivate user accounts</p>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success mb-3" style="font-size:13px; border-radius:8px;">{{ session('success') }}</div>
    @endif

    {{-- Search --}}
    <div class="search-bar">
        <input type="text" id="userSearch" class="form-control" placeholder="Search by name or email...">
    </div>

    {{-- Users Table --}}
    <div class="admin-table">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Trips</th>
                    <th>Joined</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->trips->count() }}</td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            @if($user->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.users.toggle', $user) }}" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button class="action-btn {{ $user->is_active ? 'deactivate' : 'activate' }}">
                                    {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; color:#aaa; padding:2rem;">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@section('scripts')
<script>
    // Live search filter for users table
    document.getElementById('userSearch').addEventListener('keyup', function () {
        const query = this.value.toLowerCase();
        const rows = document.querySelectorAll('#usersTableBody tr');

        rows.forEach(row => {
            const name = row.cells[0]?.textContent.toLowerCase() || '';
            const email = row.cells[1]?.textContent.toLowerCase() || '';
            row.style.display = (name.includes(query) || email.includes(query)) ? '' : 'none';
        });
    });
</script>
@endsection
@endsection