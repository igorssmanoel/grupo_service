<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model as Eloquent;

class Status extends Eloquent
{
    protected $table = 'status';
    protected $fillable = [
        'id',
        'description'
    ];
}
