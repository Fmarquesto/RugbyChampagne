<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 16/7/2017
 * Time: 10:22
 */

namespace App\Middleware;

class AuthMiddleware extends Middleware
{
    function __invoke($request, $response, $next)
    {
        if(!$this->container->auth->check()){
            $this->container->flash->addMessage('error','Ingrese al sistema por favor');
            return $response->withRedirect($this->container->router->pathFor('auth.signin'));
        }
        return $next($request, $response);
    }
}