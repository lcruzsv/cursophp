<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$tareas = $app['controllers_factory'];

/**
*
**/
$tareas->get('/', function (Request $request) use($app){

  $modeloTareas = new \models\tareas($app['db']);

  $nombre = $request->get('nombre');
  if ($nombre != '')
  {
    $datos = array(
      'nombre' => $nombre,
      'estado' => 'P',
      'propietario' => '1'
    );
    $modeloTareas->insertar($datos);
  }

  return $app['twig']->render('tareas/index.html.twig', array( 'tareas' => $modeloTareas->getTareasPendientes() ));
})->bind('tareas_inicio');


$tareas->get('/borrar', function (Request $request) use($app) {

  $id = $request->get('id');
  $modeloTareas = new \models\tareas($app['db']);
  $condicion = array(
    'id' => $id
  );
  $modeloTareas->borrar($condicion);
  return $app['twig']->render('tareas/index.html.twig', array( 'tareas' => $modeloTareas->getTareasPendientes() ));
})->bind('tareas_borrar');


$tareas->get('/completar', function (Request $request) use($app) {

  $id = $request->get('id');
  $modeloTareas = new \models\tareas($app['db']);
  $condicion = array(
    'id' => $id
  );

  $datos = array(
    'estado' => 'C'
  );
  $modeloTareas->actualizar($datos, $condicion);
  return $app['twig']->render('tareas/index.html.twig', array( 'tareas' => $modeloTareas->getTareasPendientes() ));
})->bind('tareas_completar');

return $tareas;
?>
