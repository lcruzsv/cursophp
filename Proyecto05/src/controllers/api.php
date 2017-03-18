<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$api = $app['controllers_factory'];

/**
*  Lista de tareas
**/
$api->get('/', function (Request $request) use($app){

  $modeloLibros = new \models\libros($app['db']);
  return json_encode($modeloLibros->getLibros(1));
})->bind('libros_inicio2');


$api->get('/add', function (Request $request) use($app){

  $modeloLibros = new \models\libros($app['db']);
  return json_encode($modeloLibros->getLibros(1));
})->bind('libros_inicio3');

return $api;
?>
