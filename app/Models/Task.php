<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'task';

    /**
     * This update the value of 'complete'.
     */
    public function completed()
    {
        $this->complete = $this->complete ? false : true;
        $this->save();
    }

    protected $dates = ['created_at', 'updated_at', 'due_date'];

}
