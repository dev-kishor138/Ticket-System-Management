<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'id');
    } //
    public function travelRoute()
    {
        return $this->belongsTo(TravelRoute::class, 'route_id', 'id');
    } //
}
