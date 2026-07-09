@extends('layouts.app')

@section('title', 'Community - PlanMyTrip')

@section('styles')
<style>
    .feed-wrapper {
        max-width: 720px;
        margin: 0 auto;
        padding: 2.5rem 1rem;
    }

    /* ── Header ── */
    .feed-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
    }

    .feed-header h2 {
        font-size: 48px;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .feed-header p {
        font-size: 14px;
        color: #aaa;
        margin: 0;
    }

    /* ── Post Card ── */
    .post-card {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 12px;
    }

    .post-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .post-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #EF9F27;
        color: #412402;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .post-author {
        font-size: 14px;
        font-weight: 500;
        color: #1a1a1a;
    }

    .post-date {
        font-size: 12px;
        color: #aaa;
    }

    .post-title {
        font-size: 17px;
        font-weight: 500;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .post-body {
        font-size: 14px;
        color: #666;
        line-height: 1.7;
        margin: 0;
    }

    .post-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px solid #f0ebe2;
    }

    .post-destination {
        font-size: 12px;
        color: #aaa;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .post-actions {
        display: flex;
        gap: 8px;
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
<div class="feed-wrapper">

    {{-- Header --}}
    <div class="feed-header">
        <div>
            <p class="section-label mb-1">Travel stories</p>
            <h2>Community</h2>
            <p>See what fellow travelers are sharing</p>
        </div>
        @auth
            <a href="{{ route('community.create') }}" class="btn btn-orange px-4 py-2 mt-2">
                <i class="ti ti-plus me-1"></i> Share a story
            </a>
        @endauth
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success mb-3" style="font-size:13px; border-radius:8px;">{{ session('success') }}</div>
    @endif

    {{-- Posts --}}
    @forelse($posts as $post)
        <div class="post-card">
            <div class="post-meta">
                <div class="post-avatar">{{ strtoupper(substr($post->user->name, 0, 1)) }}</div>
                <div>
                    <div class="post-author">{{ $post->user->name }}</div>
                    <div class="post-date">{{ $post->created_at->format('M d, Y') }}</div>
                </div>
            </div>
            <div class="post-title">{{ $post->title }}</div>
            <p class="post-body">{{ $post->body }}</p>
            <div class="post-footer">
                @if($post->destination)
                    <div class="post-destination">
                        <i class="ti ti-map-pin" style="font-size:12px;"></i> {{ $post->destination }}
                    </div>
                @else
                    <div></div>
                @endif
                @auth
                    @if(Auth::id() === $post->user_id)
                        <div class="post-actions">
                            <form method="POST" action="{{ route('community.destroy', $post) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-btn" onclick="return confirm('Delete this post?')"><i class="ti ti-trash"></i></button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i class="ti ti-writing"></i>
            No stories yet. Be the first to share one!
        </div>
    @endforelse

</div>
@endsection