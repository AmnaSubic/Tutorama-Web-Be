<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'Tutor_ID',
        'Subject_ID',
        'Service_Level',
        'Service_Cost'
    ];
}
