<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $trip->title }} - Trip Summary</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            color: #1a1a1a;
            background: #fff;
            padding: 40px;
        }

        /* ── Header ── */
        .header {
            border-bottom: 3px solid #EF9F27;
            padding-bottom: 16px;
            margin-bottom: 24px;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #1a1a1a;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .logo span {
            color: #EF9F27;
        }

        .trip-title {
            font-size: 26px;
            font-weight: bold;
            color: #1a1a1a;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .trip-meta {
            margin-top: 6px;
            color: #888;
            font-size: 12px;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            margin-left: 8px;
        }

        .badge-ongoing   { background: #FAEEDA; color: #854F0B; }
        .badge-planned   { background: #EAF3DE; color: #3B6D11; }
        .badge-completed { background: #ece9e4; color: #888; }

        /* ── Section ── */
        .section {
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #EF9F27;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            border-bottom: 1px solid #f0ebe2;
            padding-bottom: 6px;
        }

        /* ── Info Grid ── */
        .info-grid {
            width: 100%;
            border-collapse: collapse;
        }

        .info-grid td {
            padding: 8px 12px;
            background: #f5f0e8;
            border-radius: 6px;
            width: 25%;
            vertical-align: top;
        }

        .info-label {
            font-size: 10px;
            color: #EF9F27;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
            font-weight: bold;
        }

        .info-val {
            font-size: 14px;
            font-weight: bold;
            color: #1a1a1a;
        }

        /* ── Budget Summary ── */
        .budget-table {
            width: 100%;
            border-collapse: collapse;
        }

        .budget-table tr {
            border-bottom: 1px solid #f0ebe2;
        }

        .budget-table td {
            padding: 8px 0;
            font-size: 13px;
        }

        .budget-table td:last-child {
            text-align: right;
            font-weight: bold;
        }

        .budget-remaining {
            color: #3B6D11;
        }

        .budget-over {
            color: #e74c3c;
        }

        /* ── Progress Bar ── */
        .progress-wrap {
            background: #f0ebe2;
            border-radius: 10px;
            height: 8px;
            margin-top: 10px;
        }

        .progress-fill {
            background: #EF9F27;
            border-radius: 10px;
            height: 8px;
        }

        .progress-note {
            font-size: 11px;
            color: #aaa;
            margin-top: 4px;
        }

        /* ── Places Table ── */
        .places-table {
            width: 100%;
            border-collapse: collapse;
        }

        .places-table th {
            background: #f5f0e8;
            padding: 8px 12px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            text-align: left;
            font-weight: bold;
        }

        .places-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #f0ebe2;
            font-size: 13px;
        }

        .places-table td:last-child {
            text-align: right;
            font-weight: bold;
        }

        .type-badge {
            display: inline-block;
            background: #f0ebe2;
            color: #888;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 10px;
        }

        /* ── Footer ── */
        .footer {
            margin-top: 40px;
            border-top: 1px solid #f0ebe2;
            padding-top: 12px;
            font-size: 11px;
            color: #aaa;
            text-align: center;
        }

        /* ── Notes ── */
        .notes-box {
            background: #f5f0e8;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 13px;
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <div class="logo">Plan<span>My</span>Trip</div>
        <div class="trip-title">
            {{ $trip->title }}
            <span class="badge badge-{{ $trip->status }}">{{ ucfirst($trip->status) }}</span>
        </div>
        <div class="trip-meta">
             {{ $trip->destination }} &nbsp;|&nbsp;
             {{ \Carbon\Carbon::parse($trip->start_date)->format('M d, Y') }} – {{ \Carbon\Carbon::parse($trip->end_date)->format('M d, Y') }} &nbsp;|&nbsp;
            Generated on {{ now()->format('M d, Y h:i A') }}
        </div>
    </div>

    {{-- Trip Info --}}
    @if($countryInfo)
    <div class="section">
        <div class="section-title">Destination Info</div>
        <table class="info-grid">
            <tr>
                <td>
                    <div class="info-label">Country</div>
                    <div class="info-val">{{ $countryInfo['country'] }}</div>
                </td>
                <td>
                    <div class="info-label">City</div>
                    <div class="info-val">{{ $countryInfo['city'] }}</div>
                </td>
                <td>
                    <div class="info-label">Timezone</div>
                    <div class="info-val">{{ $countryInfo['timezone'] }}</div>
                </td>
                <td>
                    <div class="info-label">Currency</div>
                    <div class="info-val">{{ $countryInfo['currency'] }}</div>
                </td>
            </tr>
        </table>
    </div>
    @endif

    {{-- Budget Summary --}}
    <div class="section">
        <div class="section-title">Budget Summary (BDT)</div>
        <table class="budget-table">
            <tr>
                <td>Total budget</td>
                <td>{{ number_format($trip->budget) }}</td>
            </tr>
            <tr>
                <td>Estimated cost (places)</td>
                <td>{{ number_format($totalEstimatedCost) }}</td>
            </tr>
            <tr>
                <td>Remaining</td>
                <td class="{{ $remaining >= 0 ? 'budget-remaining' : 'budget-over' }}">
                    {{ number_format($remaining) }}
                </td>
            </tr>
        </table>
        <div class="progress-wrap">
            <div class="progress-fill" style="width: {{ $budgetPercent }}%;"></div>
        </div>
        <div class="progress-note">{{ $budgetPercent }}% of budget used across all places</div>
    </div>

    {{-- Places --}}
    @if($places->count() > 0)
    <div class="section">
        <div class="section-title">Places to Visit</div>
        <table class="places-table">
            <thead>
                <tr>
                    <th>Place</th>
                    <th>Type</th>
                    <th>Notes</th>
                    <th>Estimated Cost (BDT)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($places as $place)
                    <tr>
                        <td>{{ $place->name }}</td>
                        <td><span class="type-badge">{{ ucfirst($place->type) }}</span></td>
                        <td>{{ $place->notes ?? '—' }}</td>
                        <td>{{ number_format($place->estimated_cost) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    {{-- Notes --}}
    @if($trip->notes)
    <div class="section">
        <div class="section-title">Trip Notes</div>
        <div class="notes-box">{{ $trip->notes }}</div>
    </div>
    @endif

    {{-- Footer --}}
    <div class="footer">
        PlanMyTrip — Travel Planning System &nbsp;|&nbsp; {{ Auth::user()->name }} &nbsp;|&nbsp; {{ now()->format('Y') }}
    </div>

</body>
</html>