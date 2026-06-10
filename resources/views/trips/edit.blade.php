@extends('layouts.app')

@section('title', 'Edit Trip - PlanMyTrip')

@section('styles')
<style>
    .form-wrapper {
        max-width: 620px;
        margin: 0 auto;
        padding: 2.5rem 1rem;
    }

    .form-header {
        margin-bottom: 2rem;
    }

    .form-header h2 {
        font-size: 42px;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .form-header p {
        font-size: 14px;
        color: #aaa;
        margin: 0;
    }

    .form-card {
        background: #fff;
        border: 1px solid #e0d9ce;
        border-radius: 16px;
        padding: 2rem;
    }

    .form-label {
        font-size: 13px;
        font-weight: 500;
        color: #555;
        margin-bottom: 6px;
    }

    .form-control, .form-select {
        background: #f5f0e8;
        border: 1px solid #e0d9ce;
        border-radius: 8px;
        font-size: 14px;
        padding: 10px 14px;
        color: #1a1a1a;
    }

    .form-control:focus, .form-select:focus {
        background: #f5f0e8;
        border-color: #EF9F27;
        box-shadow: 0 0 0 3px rgba(239, 159, 39, 0.15);
        color: #1a1a1a;
    }

    .form-text {
        font-size: 12px;
        color: #aaa;
    }

    .section-divider {
        border: none;
        border-top: 1px solid #e0d9ce;
        margin: 1.5rem 0;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 1.5rem;
    }
</style>
@endsection

@section('content')
<div class="form-wrapper">

    {{-- Header --}}
    <div class="form-header">
        <p class="section-label mb-1">Update trip</p>
        <h2>Edit Trip</h2>
        <p>Make changes to your trip details</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mb-3" style="font-size:13px; border-radius:8px;">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <form method="POST" action="#">
            @csrf
            @method('PUT')

            {{-- Trip Title --}}
            <div class="mb-3">
                <label class="form-label">Trip title</label>
                <input
                    type="text"
                    name="title"
                    class="form-control"
                    placeholder="e.g. Cox's Bazar Getaway"
                    value="Cox's Bazar Getaway"
                    required
                >
            </div>

            {{-- Destination --}}
            <div class="mb-3">
                <label class="form-label">Destination</label>
                <input
                    type="text"
                    name="destination"
                    class="form-control"
                    placeholder="e.g. Cox's Bazar, Bangladesh"
                    value="Cox's Bazar, Bangladesh"
                    required
                >
                <div class="form-text mt-1">Weather and destination info will be fetched based on this.</div>
            </div>

            <hr class="section-divider">

            {{-- Dates --}}
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Start date</label>
                    <input
                        type="date"
                        name="start_date"
                        class="form-control"
                        value="2026-06-15"
                        required
                    >
                </div>
                <div class="col-md-6">
                    <label class="form-label">End date</label>
                    <input
                        type="date"
                        name="end_date"
                        class="form-control"
                        value="2026-06-18"
                        required
                    >
                </div>
            </div>

            {{-- Budget --}}
            <div class="mb-3">
                <label class="form-label">Budget (৳)</label>
                <input
                    type="number"
                    name="budget"
                    class="form-control"
                    placeholder="e.g. 12000"
                    value="12000"
                    min="0"
                    required
                >
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="planned">Planned</option>
                    <option value="ongoing" selected>Ongoing</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            {{-- Notes --}}
            <div class="mb-3">
                <label class="form-label">Notes <span style="color:#aaa; font-weight:400;">(optional)</span></label>
                <textarea
                    name="notes"
                    class="form-control"
                    rows="3"
                    placeholder="Any extra details about this trip..."
                >Visiting the main beach and Inani Beach.</textarea>
            </div>

            <div class="form-actions">
                <a href="#" class="btn btn-outline-secondary px-4">Cancel</a>
                <button type="submit" class="btn btn-orange px-4">Save changes</button>
            </div>

        </form>
    </div>
</div>
@endsection