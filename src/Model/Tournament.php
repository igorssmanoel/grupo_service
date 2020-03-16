<?php

namespace App\Model;

use App\Model\Team;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Tournament extends Eloquent
{
    protected $fillable = [
        'id',
        'name',
        'prize',
        'score',
        'rule',
        'winner_id',
        'status_id',
        'created_at',
        'updated_at'
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class)->withPivot('score');
    }

    public function winner()
    {
        return $this->hasOne(Team::class, 'id', 'winner_id');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
