<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'Tutor_ID',
        'Student_ID',
        'Rating',
        'Date',
        'Description',
        'Is_Tutor'
    ];
}
