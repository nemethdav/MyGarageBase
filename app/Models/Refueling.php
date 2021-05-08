<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refueling extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_id', 'user_id', 'date_time', 'km_operating_hour', 'trip1', 'trip2',
        'refueled_quantity', 'fuel_cost', 'refuelling_cost', 'average_consumption', 'fuel_type', 'discount'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
