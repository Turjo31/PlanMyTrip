<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    // Store new place
    public function store(Request $request, Trip $trip)
    {
        // Make sure user owns the trip
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name'           => 'required|string|max:255',
            'type'           => 'required|in:hotel,restaurant,attraction,other',
            'estimated_cost' => 'required|numeric|min:0',
            'notes'          => 'nullable|string',
        ]);

        Place::create([
            'trip_id'        => $trip->id,
            'name'           => $request->name,
            'type'           => $request->type,
            'estimated_cost' => $request->estimated_cost,
            'notes'          => $request->notes,
        ]);

        return redirect()->route('trips.show', $trip)->with('success', 'Place added successfully!');
    }

    // Update place
    public function update(Request $request, Trip $trip, Place $place)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name'           => 'required|string|max:255',
            'type'           => 'required|in:hotel,restaurant,attraction,other',
            'estimated_cost' => 'required|numeric|min:0',
            'notes'          => 'nullable|string',
        ]);

        $place->update($request->all());

        return redirect()->route('trips.show', $trip)->with('success', 'Place updated successfully!');
    }

    // Delete place
    public function destroy(Trip $trip, Place $place)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $place->delete();

        return redirect()->route('trips.show', $trip)->with('success', 'Place deleted successfully!');
    }
}