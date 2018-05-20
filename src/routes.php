<?php

use Slim\Http\Request;
use Slim\Http\Response;

// ver todos los usuarios

$app->get('/', function (Request $request, Response $response, array $args) use ($tabla){
      return $response->withJson($this->db->table($tabla)->get());
 });
// ver un usuario
$app->get('/{id}', function (Request $request, Response $response, array $args) use ($tabla) {
 return $response->withJson( $this->get('db')->table($tabla)->find($args['id']));
});

// Crear usuarios
$app->post('/', function (Request $request, Response $response, array $args) use ($tabla){
return $response->withJson( $this->get('db')->table($tabla)->insertGetId($request->getParsedBody()));
});
//Actualizar usuario
$app->put('/{id}', function ($request, $response, $args) use ($tabla) {
     
   return $response->withJson($this->get('db')->table($tabla)->where("id",$args["id"])->update($request->getParsedBody()));
       });
// Borrar un usuario
$app->delete('/{id}', function  (Request $request, Response $response, array $args) use ($tabla)  {
  return $response->withJson($this->get('db')->table($tabla)->delete($args['id']));
 });




