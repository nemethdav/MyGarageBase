<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorwayVignette extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_id', 'user_id', 'type', 'category', 'location', 'start_date', 'end_date',
        'date_of_purchase', 'price', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
