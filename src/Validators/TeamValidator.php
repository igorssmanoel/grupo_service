<?php

namespace App\Validators;

use App\Validators\Validator;

class TeamValidator extends Validator
{
    protected $table = 'Team';

    public function __construct($params = [])
    {
        $this->params = $params;
        $this->validate();
    }

    protected $rules = [

        'name' => 'required:unique',
        'first_player' => 'required',
        'second_player' => 'required'
    ];

    protected $translated = [

        'name' => 'Nome',
        'first_player' => 'Primeiro Jogador',
        'second_player' => 'Segundo Jogador'
    ];
}
