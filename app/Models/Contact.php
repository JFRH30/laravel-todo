<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'contacts';

    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Get user associated to contact.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get appointments associated with the contact.
     */
    public function appointments()
    {
        return $this->hasMany('App\Models\Appointment');
    }
}
