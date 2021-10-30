<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\VerifyEmail as VerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'role_id',
        'avatar',
        'email',
        'password',
        'facebook_id',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Send the verification e-mail.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function owns($thing){
        return (auth()->user()->id == $thing->user_id);
    }

    public function ownImage($user_id){
        return (auth()->user()->id == $user_id);
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
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

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function serviceImages(){
        return $this->hasMany(ServiceImages::class);
    }
}
