<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailableTimes extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'Tutor_ID',
        'Day',
        'Start_Time',
        'End_Time',
        'Is_Free'
    ];
}
