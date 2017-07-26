<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 23/7/2017
 * Time: 11:40
 */

namespace App\Controller;

use App\Models\Category;
use App\Models\Country;
use App\Models\Team;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;

class TeamController extends Controller
{
    public function getTeams(Request $request, Response $response)
    {
        $teams = Team::query()
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
        return $this->view->render($response,'team/teams.twig',[
            "data"=>json_encode($teams)
        ]);
    }

    public function getTeamCreate(Request $request, Response $response)
    {
        $categories = Category::all()->toArray();
        $countries = Country::all()->toArray();
        return $this->view->render($response,'team/team-create.twig',[
            "categories"=>$categories,
            "countries"=>$countries
        ]);
    }

    public function postTeamCreate(Request $request, Response $response)
    {
        $validation = $this->validator->validate($request,[
            'teamName'=>v::notEmpty(),
        ]);
        if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('team.create'));
        }
        $teamName = $request->getParam('teamName');
        $country = $request->getParam('country');
        $category = $request->getParam('category')=='0'?'':$request->getParam('category');

        $team = Team::where('name',$teamName)->where('category_id',$category)->first();
        if(!is_null($team)){
            $this->flash->addMessage('error', 'El equipo ya existe en la categoria seleccionada');
            return $response->withRedirect($this->router->pathFor('team.create'));
        }

        Team::create([
            'name' => $teamName,
            'category_id' => $category,
            'country_id' => $country
        ]);

        $this->flash->addMessage('info', 'Equipo '.$teamName.' Creado Correctamente');

        return $response->withRedirect($this->router->pathFor('team.create'));
    }

    public function putTeam(Request $request, Response $response)
    {
        $teamId = $request->getParam('teamId');
        if($teamId !='' && filter_var($teamId, FILTER_VALIDATE_INT)){
            $active = $request->getParam('value')? 1 : 0;
            $team = Team::find($teamId);
            if(is_null($teamId)){
                //No se encontro el team
                exit('invalid team_id');
            }
            $team->active = $active;
            $team->save();
        }else{
            //no deberia llegar aca
            exit('no team_id');
        }
        return $response->withJson(json_encode(array('csrf_name'=>$this->container->csrf->getTokenName(),'csrf_value'=>$this->container->csrf->getTokenValue())));
    }
}