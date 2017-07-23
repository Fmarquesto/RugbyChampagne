<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 8/7/2017
 * Time: 14:08
 */

namespace App\Controller;


class HomeController extends Controller
{
    public function index($request, $response)
    {
        return $this->view->render($response, 'home.twig');
    }
}