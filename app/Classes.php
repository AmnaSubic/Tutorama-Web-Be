<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'Service_ID',
        'Student_ID',
        'Date',
        'Start_at',
        'End_at',
        'Place',
        'Price'
    ];
}
