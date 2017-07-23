<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 16/7/2017
 * Time: 10:26
 */

namespace App\Middleware;


class GuestMiddleware extends Middleware
{
    function __invoke($request, $response, $next)
    {
        if($this->container->auth->check()){
            return $response->withRedirect($this->container->router->pathFor('home'));
        }
        return $next($request, $response);
    }
}