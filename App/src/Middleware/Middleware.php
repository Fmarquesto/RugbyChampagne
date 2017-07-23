<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 16/7/2017
 * Time: 10:21
 */
namespace App\Middleware;


class Middleware
{
    protected $container;

    function __construct($container)
    {
        $this->container = $container;
    }
}