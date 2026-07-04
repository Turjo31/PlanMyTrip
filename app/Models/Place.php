<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'name',
        'type',
        'estimated_cost',
        'notes',
    ];

    // A place belongs to a trip
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}