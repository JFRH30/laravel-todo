<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = [
        'birthday', 'created_at', 'updated_at'
    ];

    /**
     * Get contacts associated to the user.
     */
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

    /**
     * Get tasks associated with the user.
     */
    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    /**
     * Get appointments associated with the contact.
     */
    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }
}
