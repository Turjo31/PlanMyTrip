<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'destination',
        'start_date',
        'end_date',
        'budget',
        'status',
        'notes',
    ];

    // A trip belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A trip has many places
    public function places()
    {
        return $this->hasMany(Place::class);
    }

    // Total estimated cost of all places
    public function totalEstimatedCost()
    {
        return $this->places->sum('estimated_cost');
    }
}