<?php

namespace App\Controller;

use PDOException;
use App\Model\Team;
use App\Validators\TeamValidator;

class TeamController extends Controller
{

    // POST
    public function insert()
    {
        $params = self::params();

        $validator = new TeamValidator($params);

        try {
            if ($validator->is_valid()) {

                Team::create($params);
            } else {

                throw new PDOException('ERROR', 1);
            }
        } catch (PDOException $e) {

            $_SESSION['ERROR'] = $validator->get_errors();
            self::redirect('/team/add');
        } catch (\Throwable $th) {

            $_SESSION['ERROR'] = $th->getMessage();
            self::redirect('/team/add');
        }

        $_SESSION['SUCCESS'] = "Time criado com sucesso";
        self::redirect('/');
    }

    // GET
    public function add()
    {
        return self::view('team/add');
    }
}
