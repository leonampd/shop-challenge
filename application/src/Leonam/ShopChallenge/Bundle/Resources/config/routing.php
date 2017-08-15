<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$route = new Route(
    '/products',
    array(
        '_controller' => 'ShopBundle:Products:list'
    )
);
$routes = new RouteCollection();
$routes->add('shop_challenge_list_products', $route);

return $routes;