<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'Subject_Name'
    ];
}
