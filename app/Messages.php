<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'Message_ID',
        'Sent_by',
        'Sent_to',
        'Message',
        'Date_Time'
    ];
}
