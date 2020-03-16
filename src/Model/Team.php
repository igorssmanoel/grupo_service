<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Team extends Eloquent
{
    /* protected $table = 'team'; */
    protected $fillable = [
        'id',
        'name',
        'first_player',
        'second_player',
    ];

    public function tournament()
    {
        return $this->belongsToMany(Tournament::class);
    }
}
