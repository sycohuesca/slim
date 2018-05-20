<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*.*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
});

// auth

use Slim\Middleware\TokenAuthentication;
require_once('../src/UnauthorizedException.php');

$authenticator = function($request, TokenAuthentication $tokenAuth ) use ($settings){
    /**
     * Try find authorization token via header, parameters, cookie or attribute
     * If token not found, return response with status 401 (unauthorized) ASdid9uij29329j0m0kaojidsah
     */
    $token = $tokenAuth->findToken($request);

    if ($token != $settings["settings"]["token"]) {
    
        /**
         * The throwable class must implement UnauthorizedExceptionInterface
         */
        throw new UnauthorizedException('No estas autorizado.');
    }

};
/**
 * Add token authentication middleware
 */
$app->add(new TokenAuthentication([
    'path' => '/',
    'authenticator' => $authenticator
]));