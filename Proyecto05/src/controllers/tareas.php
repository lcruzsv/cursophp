<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$tareas = $app['controllers_factory'];
$tareas->get('/', function () use($app){

  $modeloTareas = new \models\tareas($app['db']);

  return $app['twig']->render('tareas/index.html.twig', array( 'tareas' => $modeloTareas->getTodos() ));
});


$tareas->get('/nuevo', function (Request $request) use($app) {

  $data = $request->get('nombre');
  $modeloTareas = new \models\tareas($app['db']);
  
  return $data;
});

return $tareas;
?>
