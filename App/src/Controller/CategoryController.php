<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 23/7/2017
 * Time: 11:35
 */

namespace App\Controller;


use Slim\Http\Request;
use Slim\Http\Response;

class CategoryController extends Controller
{
    public function getCategories(Request $request, Response $response)
    {
        echo "aa";
    }
}