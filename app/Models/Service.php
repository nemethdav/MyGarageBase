<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'vehicle_id', 'service_name', 'service_title', 'service_date', 'km_operatinghour',
        'description', 'price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function serviceImages()
    {
        return $this->hasMany(ServiceImages::class);
    }
}
