<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 23/7/2017
 * Time: 11:41
 */

namespace App\Controller;

use App\Models\Country;
use App\Models\Player;
use App\Models\Team;
use App\Models\TeamPlayer;
use Illuminate\Database\Capsule\Manager as DB;
use Slim\Http\Request;
use Slim\Http\Response;

class PlayerController extends Controller
{
    public function getPlayer(Request $request, Response $response){
        /*
         *  $teams = Team::query()
            ->leftJoin('category as c','c.category_id','=','team.category_id')
            ->leftJoin('country as co','co.country_id','=', 'team.country_id')
            ->get(
                [
                    'team.team_id',
                    'team.name as team',
                    'team.active',
                    'c.name as category',
                    'co.name as country'
                ]
            );
         * */
        $players = Player::query()
            ->leftJoin('country as c','c.country_id','=','player.country_id')
            ->get([
                'player.player_id',
                DB::raw('concat(player.first_name," ",player.last_name) as name'),
                'c.name as country'
            ]);
        return $this->view->render($response,'player/players.twig',[
            "data"=>json_encode($players)
        ]);
    }

    public function getPlayerCreate(Request $request, Response $response){
        $countries = Country::all()->toArray();
        $teams = Team::all()->toArray();
        return $this->view->render($response,'player/player-create.twig',[
            "countries"=>$countries,
            "teams"=>$teams
        ]);
    }

    public function postPlayerCreate(Request $request, Response $response){
        $teams = $request->getParam('teams');
        $fName = $request->getParam('firstName');
        $lName = $request->getParam('lastName');
        $country = $request->getParam('country');

        $player = Player::create([
            'first_name' => $fName,
            'last_name' => $lName,
            'country_id' => $country
        ]);

        if(is_array($teams) && !empty($teams)){
            foreach ($teams as $team){
                TeamPlayer::create([
                    'team_id' => $team,
                    'player_id' => $player->player_id,
                    'active' => 'A'
                ]);
            }

        }
        $this->flash->addMessage('info', 'Jugador '.$fName.' '.$lName.' Creado Correctamente');

        return $response->withRedirect($this->router->pathFor('player.create'));

    }
}