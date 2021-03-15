<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name', 
        'email',
        'password',
        'cpf', 
        'phone', 
        'postcode', 
        'address', 
        'number', 
        'district', 
        'address_additional', 
        'city', 
        'state', 
        'country', 
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Returns a string with all 
     * address informations.
     *
     * @return string
     */
    public function getAddressCompleteAttribute()
    {
        return $this->address . ', N ' . $this->numer . ' - ' . $this->district;
    }

    /**
     * Return the a URL for the 
     * given resource.
     *
     * @return string
     */
     public function path()
     {
         return route('users.show', ['user' => $this->id]);
     }
}
