<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class TeamTournament extends Eloquent
{
    protected $table = 'team_tournament';
    protected $fillable = [
        'tournament_id',
        'team_id',
        'score',
        'created_at',
        'updated_at'
    ];
}
