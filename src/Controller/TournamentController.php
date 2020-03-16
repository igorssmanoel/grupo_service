<?php

namespace App\Controller;

use Exception;
use PDOException;
use App\Model\Team;
use App\Model\Tournament;
use App\Model\TeamTournament;
use App\Controller\Controller;
use App\Validators\TournamentValidator;


class TournamentController extends Controller
{

    public function insert()
    {
        $params = self::params();

        $validator = new TournamentValidator($params);

        try {
            if ($validator->is_valid()) {
                if (count($params['teams']) >  10) {
                    throw new Exception('A quantidade máxima de times é 10.', 1);
                }
                $tournament = Tournament::create($params);
                $tournament->teams()->sync($params['teams']);
            } else {

                throw new PDOException();
            }
        } catch (PDOException $e) {

            $_SESSION['ERROR'] = $validator->get_errors();
            self::redirect('/tournament/add');
        } catch (\Throwable $th) {

            $_SESSION['ERROR'] = $th->getMessage();
            self::redirect('/tournament/add');
        }

        $_SESSION['SUCCESS'] = "Torneio criado com sucesso";
        self::redirect('/');
    }

    // GET
    public function add()
    {
        $teams = Team::all();
        return self::view('tournament/add', ['teams' => $teams]);
    }

    public function show()
    {
        try {

            $id = self::params('id');
            $tournament = Tournament::with(
                'teams'
            )->find($id);

            if ($tournament->count() > 0) {
                return self::view('tournament/show', ['tournament' => $tournament]);
            }
            throw new Exception('Torneio inválido');
        } catch (\Throwable $th) {

            $_SESSION['ERROR'] = $th->getMessage();
            self::redirect('/');
        }
    }

    public function update_score()
    {
        $errors = array();
        try {
            $params = self::params();

            if (!isset($params)) {
                $error[] = 'Parâmetros inválidos';
                return json_encode($errors);
            }

            $tournament_id = $params['tournament_id'];
            $team_id = $params['team_id'];
            $score = $params['score'];
            TeamTournament::where('tournament_id', $tournament_id)
                ->where('team_id', $team_id)
                ->update(['score' => $score]);

            $tournament = Tournament::where('id', $tournament_id)->first();

            // Vencedor
            if ($score >= $tournament->score) {
                
                // Atualizar tabela tournament
                $tournament->update(['winner_id' => $team_id, 'status_id' => 3]);
                // Retornar modelo vencedor

                return json_encode([
                    'winner' => true,
                    'tournament' => $tournament
                ]);
            }

            return json_encode(true);
        } catch (\Throwable $th) {
            $error[] = $th->getMessage();
            return json_encode($error);
        }
    }
}
