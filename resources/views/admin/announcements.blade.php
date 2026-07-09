@extends('layouts.app')

@section('title', 'Manage Announcements - PlanMyTrip')

@section('styles')
<style>
    .admin-wrapper {
        max-width: 860px;
        margin: 0 auto;
        padding: 2.5rem 1rem;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
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

    /* ── Form Card ── */
    .form-card {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .form-card h5 {
        font-size: 13px;
        font-weight: 500;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 1rem;
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

    .form-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 1rem;
    }

    /* ── Announcements List ── */
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

    .ann-item {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1rem;
    }

    .ann-title {
        font-size: 15px;
        font-weight: 500;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .ann-body {
        font-size: 13px;
        color: #888;
        line-height: 1.6;
        margin: 0;
    }

    .ann-date {
        font-size: 12px;
        color: #aaa;
        white-space: nowrap;
    }

    .ann-actions {
        display: flex;
        gap: 6px;
        margin-top: 6px;
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
        margin-bottom: 10px;
        display: block;
    }
</style>
@endsection

@section('content')
<div class="admin-wrapper">

    {{-- Header --}}
    <div class="admin-header">
        <div>
            <p class="section-label mb-1">Admin panel</p>
            <h2>Announcements</h2>
            <p>Create and manage site announcements</p>
        </div>
    </div>

    {{-- New Announcement Form --}}
    <div class="form-card">
        <h5>New Announcement</h5>

        @if(session('success'))
            <div class="alert alert-success mb-3" style="font-size:13px; border-radius:8px;">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.announcements.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input
                    type="text"
                    name="title"
                    class="form-control"
                    placeholder="e.g. New feature released"
                    value="{{ old('title') }}"
                    required
                >
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea
                    name="body"
                    class="form-control"
                    rows="3"
                    placeholder="Write the announcement details..."
                    required
                >{{ old('body') }}</textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-orange px-4">Post announcement</button>
            </div>
        </form>
    </div>

    {{-- Announcements List --}}
    <div class="section-header">
        <h5>Posted announcements</h5>
    </div>

    @forelse($announcements as $announcement)
        <div class="ann-item">
            <div>
                <div class="ann-title">{{ $announcement->title }}</div>
                <p class="ann-body">{{ $announcement->body }}</p>
                <div class="ann-actions">
                    <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="icon-btn" style="color:#e74c3c;" onclick="return confirm('Delete this announcement?')">
                            <i class="ti ti-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="ann-date">{{ $announcement->created_at->format('M d, Y') }}</div>
        </div>
    @empty
        <div class="empty-state">
            <i class="ti ti-speakerphone"></i>
            No announcements posted yet.
        </div>
    @endforelse

</div>
@endsection
                </form>
            </div>
        </div>
        <div class="ann-date">May 20, 2026</div>
    </div>

</div>
@endsection