<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearKM extends Model
{
    use HasFactory;

    protected $fillable= [
        'user_id',
        'vehicle_id',
        'year',
        'start_km_operating_hour',
        'end_km_operating_hour',
        'year_km_operating_hour'
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
