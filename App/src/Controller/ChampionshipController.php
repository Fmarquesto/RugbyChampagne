<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 11/7/2017
 * Time: 19:30
 */

namespace App\Controller;

use App\Models\Championship;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;

class ChampionshipController extends Controller
{
    public function getChampionships(Request $request, Response $response)
    {
        $championships = Championship::all()->toArray();
        return $this->view->render($response,'championship/championships.twig',[
            "data"=>json_encode($championships)
        ]);
    }

    public function getChampionshipCreate(Request $request, Response $response)
    {
        return $this->view->render($response,'championship/championship-create.twig');
    }

    public function postChampionshipCreate(Request $request, Response $response)
    {
        /*$validation = $this->validator->validate($request,[
            'form-first-name'=>v::noWhitespace()->notEmpty(),
            'form-last-name'=> v::noWhitespace()->notEmpty(),
            'form-email' => v::noWhitespace()->notEmpty(),
            'form-password' => v::noWhitespace()->notEmpty(),
        ]);
        if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('championship.create'));
        }*/

        $championship = Championship::create([
            'name' => $request->getParam('championshipName'),
            'win_points' => $request->getParam('winPoints'),
            'draw_points' => $request->getParam('drawPoints'),
            'lose_points' => $request->getParam('losePoints'),
            'round' => $request->getParam('round'),
            'category_id' => 1
        ]);

        $this->flash->addMessage('info', 'Campeonato Creado Correctamente');

        return $response->withRedirect($this->router->pathFor('championship.create'));
    }
}