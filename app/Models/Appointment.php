<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'appointments';

    /**
     * The attributes that should be mutated to dates.
     */
    protected $dates = [
        'created_at', 'updated_at', 'date_start', 'date_end', 'time_start', 'time_end'
    ];

    /**
     * Get contact associated to appointment.
     */
    public function contact()
    {
        return $this->belongsTo('App\Models\Contact');
    }

    /**
     * Get user associated to appointment.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
