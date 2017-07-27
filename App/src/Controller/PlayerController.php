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
use Slim\Http\Request;
use Slim\Http\Response;

class PlayerController extends Controller
{
    public function getPlayer(Request $request, Response $response){
        $players = Player::all()->toArray();
        return var_dump($players);
    }

    public function getPlayerCreate(Request $request, Response $response){
        $countries = Country::all()->toArray();
        return $this->view->render($response,'player/player-create.twig',[
            "countries"=>$countries
        ]);
    }
}