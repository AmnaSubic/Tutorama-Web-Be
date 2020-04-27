<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    public $timestamps = false;

    protected $primaryKey = 'User_ID';

    protected $fillable = [
        'First_Name',
        'Last_Name',
        'Date_of_Birth',
        'Gender',
        'Address',
        'Town',
        'Country',
        'Phone_Number',
        'Description',
        'Email',
        'Username',
        'Password',
        'Is_Tutor',
        'Experience',
        'Availability'
    ];

    /**
     *Get the identifier that will be stored in the subject class of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function setPasswordAttribute($value) {
        $this->attributes['Password'] = Hash::make($value);
    }
}
