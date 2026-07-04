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
        <a href="#" class="btn btn-orange px-4 py-2 mt-2">
            <i class="ti ti-plus me-1"></i> Share a story
        </a>
    </div>

    {{-- Posts -- replace with @forelse($posts as $post) when controller is ready --}}
    <div class="post-card">
        <div class="post-meta">
            <div class="post-avatar">R</div>
            <div>
                <div class="post-author">Rahim Uddin</div>
                <div class="post-date">Jun 10, 2026</div>
            </div>
        </div>
        <div class="post-title">Cox's Bazar was absolutely worth it!</div>
        <p class="post-body">Just got back from a 3-day trip to Cox's Bazar and it was one of the best experiences of my life. The beach at sunrise is something else entirely. Highly recommend staying near Inani Beach — much less crowded than the main beach.</p>
        <div class="post-footer">
            <div class="post-destination">
                <i class="ti ti-map-pin" style="font-size:12px;"></i> Cox's Bazar, Bangladesh
            </div>
            <div class="post-actions">
                <button class="icon-btn"><i class="ti ti-edit"></i></button>
                <button class="icon-btn"><i class="ti ti-trash"></i></button>
            </div>
        </div>
    </div>

    <div class="post-card">
        <div class="post-meta">
            <div class="post-avatar">K</div>
            <div>
                <div class="post-author">Karim Hossain</div>
                <div class="post-date">Jun 5, 2026</div>
            </div>
        </div>
        <div class="post-title">Sylhet tea gardens — a hidden gem</div>
        <p class="post-body">Visited the tea gardens in Sylhet last weekend. The views are stunning and the weather was perfect. If you're planning a trip, make sure to visit Ratargul Swamp Forest as well — it's only an hour away and completely magical.</p>
        <div class="post-footer">
            <div class="post-destination">
                <i class="ti ti-map-pin" style="font-size:12px;"></i> Sylhet, Bangladesh
            </div>
            <div class="post-actions">
                <button class="icon-btn"><i class="ti ti-edit"></i></button>
                <button class="icon-btn"><i class="ti ti-trash"></i></button>
            </div>
        </div>
    </div>

    <div class="post-card">
        <div class="post-meta">
            <div class="post-avatar">N</div>
            <div>
                <div class="post-author">Nadia Islam</div>
                <div class="post-date">May 30, 2026</div>
            </div>
        </div>
        <div class="post-title">First time in the Sundarbans</div>
        <p class="post-body">Did a day trip to the Sundarbans from Khulna and it was surreal. Spotted a deer and some crocodiles from the boat. The forest is incredibly dense and peaceful. Would love to go back for a longer stay.</p>
        <div class="post-footer">
            <div class="post-destination">
                <i class="ti ti-map-pin" style="font-size:12px;"></i> Khulna, Bangladesh
            </div>
            <div class="post-actions">
                <button class="icon-btn"><i class="ti ti-edit"></i></button>
                <button class="icon-btn"><i class="ti ti-trash"></i></button>
            </div>
        </div>
    </div>

</div>
@endsection