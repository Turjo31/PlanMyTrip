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

    /* ── Loading Spinner ── */
    .spinner {
        display: inline-block;
        width: 18px;
        height: 18px;
        border: 2px solid #e0d9ce;
        border-top-color: #EF9F27;
        border-radius: 50%;
        animation: spin 0.7s linear infinite;
        vertical-align: middle;
        margin-right: 6px;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .loading-text {
        font-size: 13px;
        color: #aaa;
        display: flex;
        align-items: center;
    }

    /* ── Tourist Places ── */
    .places-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin-top: 4px;
    }

    .tourist-place {
        background: #f5f0e8;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 13px;
    }

    .tourist-place .place-name {
        font-weight: 500;
        color: #1a1a1a;
        margin-bottom: 2px;
        font-size: 13px;
    }

    .tourist-place .place-kind {
        font-size: 11px;
        color: #aaa;
        text-transform: capitalize;
    }
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
            <h2>{{ $trip->title }}</h2>
            <div class="meta">
                <span><i class="ti ti-map-pin" style="font-size:13px;"></i> {{ $trip->destination }}</span>
                <span><i class="ti ti-calendar" style="font-size:13px;"></i> {{ \Carbon\Carbon::parse($trip->start_date)->format('M d') }} – {{ \Carbon\Carbon::parse($trip->end_date)->format('M d, Y') }}</span>
                <span>
                    @if($trip->status === 'ongoing')
                        <span class="badge badge-ongoing">Ongoing</span>
                    @elseif($trip->status === 'planned')
                        <span class="badge badge-planned">Planned</span>
                    @else
                        <span class="badge badge-completed">Completed</span>
                    @endif
                </span>
            </div>
        </div>
        <div class="d-flex gap-2 mt-2">
            <a href="{{ route('trips.edit', $trip) }}" class="btn btn-outline-secondary btn-sm px-3">
                <i class="ti ti-edit me-1"></i> Edit
            </a>
            <form method="POST" action="{{ route('trips.destroy', $trip) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-secondary px-3" style="color:#e74c3c; border-color:#e74c3c;" onclick="return confirm('Delete this trip?')">
                    <i class="ti ti-trash me-1"></i> Delete
                </button>
            </form>
        </div>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success mb-3" style="font-size:13px; border-radius:8px;">{{ session('success') }}</div>
    @endif

    {{-- Info Row: Weather + Destination --}}
    <div class="info-row">

        {{-- Weather -- loaded async via JS --}}
        <div class="info-card">
            <div class="card-label">
                <i class="ti ti-cloud"></i> Live weather
            </div>
            <div id="weatherContent">
                <div class="loading-text">
                    <span class="spinner"></span> Fetching weather...
                </div>
            </div>
        </div>

        {{-- Destination Info -- loaded async via JS --}}
        <div class="info-card">
            <div class="card-label">
                <i class="ti ti-world"></i> Destination info
            </div>
            @if($countryInfo)
                <div class="dest-grid">
                    <div class="dest-item">
                        <div class="dest-label">Country</div>
                        <div class="dest-val">{{ $countryInfo['name']['common'] ?? 'N/A' }}</div>
                    </div>
                    <div class="dest-item">
                        <div class="dest-label">Currency</div>
                        <div class="dest-val">{{ implode(', ', array_keys($countryInfo['currencies'] ?? [])) }}</div>
                    </div>
                    <div class="dest-item">
                        <div class="dest-label">Language</div>
                        <div class="dest-val">{{ implode(', ', array_slice(array_values($countryInfo['languages'] ?? []), 0, 2)) }}</div>
                    </div>
                    <div class="dest-item">
                        <div class="dest-label">Timezone</div>
                        <div class="dest-val">{{ $countryInfo['timezones'][0] ?? 'N/A' }}</div>
                    </div>
                </div>
            @else
                <div style="font-size:13px; color:#aaa;">Destination info unavailable.</div>
            @endif
        </div>

    </div>

    {{-- Tourist Places -- loaded async via JS --}}
    <div class="info-card mb-4">
        <div class="card-label">
            <i class="ti ti-building-monument"></i> Tourist attractions nearby
        </div>
        <div id="touristPlaces">
            <div class="loading-text">
                <span class="spinner"></span> Finding nearby attractions...
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
            <span class="val">৳{{ number_format($trip->budget) }}</span>
        </div>
        <div class="budget-row">
            <span class="label">Estimated cost (places)</span>
            <span class="val">৳{{ number_format($totalEstimatedCost) }}</span>
        </div>
        <div class="budget-row">
            <span class="label">Remaining</span>
            <span class="val" style="color:{{ $remaining >= 0 ? '#3B6D11' : '#e74c3c' }};">৳{{ number_format($remaining) }}</span>
        </div>
        <div class="progress">
            <div class="progress-bar" style="width: {{ $budgetPercent }}%;"></div>
        </div>
        <div class="budget-note">{{ $budgetPercent }}% of budget used across all places</div>
    </div>

    {{-- Add Place Form --}}
    <div class="section-header">
        <h5>Places to visit</h5>
        <button class="btn btn-orange btn-sm px-3" type="button" data-bs-toggle="collapse" data-bs-target="#addPlaceForm">
            <i class="ti ti-plus me-1"></i> Add place
        </button>
    </div>

    <div class="collapse mb-3" id="addPlaceForm">
        <div class="info-card">
            <form method="POST" action="{{ route('places.store', $trip) }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-5">
                        <input type="text" name="name" class="form-control" placeholder="Place name" required style="background:#f5f0e8; border:1px solid #e0d9ce; border-radius:8px; font-size:14px; padding:10px 14px;">
                    </div>
                    <div class="col-md-3">
                        <select name="type" class="form-select" style="background:#f5f0e8; border:1px solid #e0d9ce; border-radius:8px; font-size:14px; padding:10px 14px;">
                            <option value="hotel">Hotel</option>
                            <option value="restaurant">Restaurant</option>
                            <option value="attraction">Attraction</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="estimated_cost" class="form-control" placeholder="Cost (৳)" min="0" required style="background:#f5f0e8; border:1px solid #e0d9ce; border-radius:8px; font-size:14px; padding:10px 14px;">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-orange w-100">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Places List --}}
    @forelse($places as $place)
        <div class="place-row">
            <div>
                <div class="place-name">{{ $place->name }}</div>
                <div class="place-meta">
                    <span class="type-badge">{{ ucfirst($place->type) }}</span>
                    @if($place->notes)
                        <span>{{ $place->notes }}</span>
                    @endif
                </div>
            </div>
            <div class="place-right">
                <div class="place-cost">৳{{ number_format($place->estimated_cost) }}</div>
                <form method="POST" action="{{ route('places.destroy', [$trip, $place]) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="icon-btn" onclick="return confirm('Delete this place?')"><i class="ti ti-trash"></i></button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i class="ti ti-map-off"></i>
            No places added yet. Add your first one above!
        </div>
    @endforelse

</div>

@section('scripts')
<script>
    // ── Trip destination passed from Blade to JS ──
    const destination = "{{ $trip->destination }}";

    /**
     * Fetch live weather for the trip destination asynchronously.
     * Updates the #weatherContent div with real data or an error message.
     */
    async function loadWeather() {
        try {
            const response = await fetch(`/api/weather?city=${encodeURIComponent(destination)}`);
            const data = await response.json();

            if (!response.ok) throw new Error(data.error || 'Failed to load weather');

            // Pick icon based on weather description
            const desc = data.desc.toLowerCase();
            let icon = 'sun';
            if (desc.includes('rain') || desc.includes('drizzle')) icon = 'cloud-rain';
            else if (desc.includes('cloud')) icon = 'cloud';
            else if (desc.includes('snow')) icon = 'snowflake';
            else if (desc.includes('thunder')) icon = 'storm';

            // Inject weather HTML into the page
            document.getElementById('weatherContent').innerHTML = `
                <div class="weather-content">
                    <div class="weather-left">
                        <i class="ti ti-${icon} weather-icon"></i>
                        <div>
                            <div class="weather-city">${destination}</div>
                            <div class="weather-desc">${data.desc}, feels like ${data.feels_like}°C</div>
                        </div>
                    </div>
                    <div class="weather-temp">${data.temp}°C</div>
                </div>
            `;
        } catch (error) {
            document.getElementById('weatherContent').innerHTML =
                `<div style="font-size:13px; color:#aaa;">Weather data unavailable.</div>`;
        }
    }

    /**
     * Fetch tourist attractions near the trip destination asynchronously.
     * Updates the #touristPlaces div with a grid of nearby places.
     */
    async function loadTouristPlaces() {
        try {
            const response = await fetch(`/api/places?city=${encodeURIComponent(destination)}`);
            const places = await response.json();

            if (!response.ok || places.length === 0) throw new Error('No places found');

            // Build a grid of tourist place cards
            const html = `
                <div class="places-grid">
                    ${places.map(place => `
                        <div class="tourist-place">
                            <div class="place-name">
                                <i class="ti ti-map-pin" style="font-size:12px; color:#EF9F27;"></i>
                                ${place.name}
                            </div>
                            <div class="place-kind">${place.category}${place.address ? ' · ' + place.address : ''}</div>
                        </div>
                    `).join('')}
                </div>
            `;

            document.getElementById('touristPlaces').innerHTML = html;
        } catch (error) {
            document.getElementById('touristPlaces').innerHTML =
                `<div style="font-size:13px; color:#aaa;">Tourist attractions unavailable for this destination.</div>`;
        }
    }

    // ── Run both fetches in parallel when the page loads ──
    // Uses Promise.all so both requests run simultaneously (two threads concept)
    document.addEventListener('DOMContentLoaded', async () => {
        await Promise.all([
            loadWeather(),
            loadTouristPlaces()
        ]);
    });
</script>
@endsection
@endsection