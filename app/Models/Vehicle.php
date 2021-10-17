<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vehicleNickName', 'vehicle_type', 'vehicle_image', 'manufacturer', 'type',
        'license_plate_number', 'year_of_manufacture', 'chassis_number', 'motor_number', 'motor_code',
        'cylinder_capacity', 'performance_kw', 'performance_le', 'validity_of_technical_Examination', 'date_of_purchase', 'date_of_sale'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicleType()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function refuelings(){
        return $this->hasMany(Refueling::class);
    }

    public function motorwayVignettes(){
        return $this->hasMany(MotorwayVignette::class);
    }

    public function yearKMs(){
        return $this->hasMany(YearKM::class);
    }

    public function otherCosts(){
        return $this->hasMany(OtherCosts::class);
    }
}
