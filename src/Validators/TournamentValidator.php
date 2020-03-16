<?php

namespace App\Validators;

use App\Validators\Validator;

class TournamentValidator extends Validator
{
    protected $table = 'Tournament';

    public function __construct($params = [])
    {
        $this->params = $params;
        $this->validate();
    }

    protected $rules = [

        'name' => 'required:unique',
        'prize' => 'required',
        'score' => 'required:numeric',
        'rule' => 'required',
    ];

    protected $translated = [

        'name' => 'Nome',
        'prize' => 'Prêmio',
        'score' => 'Pontuação',
        'rule' => 'Regra',
    ];
}
