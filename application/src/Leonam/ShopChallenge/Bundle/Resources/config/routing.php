<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$cartRoute = new Route(
    '/cart',
    array(
        '_controller' => 'ShopBundle:Cart:precheckout'
    )
);

$checkoutRoute = new Route(
    '/checkout',
    ['_controller' => 'ShopBundle:Cart:checkout'],
    array(), array(), '', array(), array('POST')
);

$routes = new RouteCollection();
$routes->add('shop_challenge_cart_precheckout', $cartRoute);
$routes->add('shop_challenge_cart_checkout', $checkoutRoute);

return $routes;