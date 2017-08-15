<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$route = new Route(
    '/cart',
    array(
        '_controller' => 'ShopBundle:Cart:checkout'
    )
);
$routes = new RouteCollection();
$routes->add('shop_challenge_cart', $route);

return $routes;