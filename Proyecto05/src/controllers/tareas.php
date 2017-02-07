<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$tareas = $app['controllers_factory'];

/**
*
**/
$tareas->get('/', function (Request $request) use($app){

/*
  $message = \Swift_Message::newInstance()
         ->setSubject('[YourSite] Feedback')
         ->setFrom(array('cruz.orellana@gmail.com'))
         ->setTo(array('lcruz@inteligenciae.com'))
         ->setBody('Prueba');

     $app['mailer']->send($message);

*/

  $modeloTareas = new \models\tareas($app['db']);
  return $app['twig']->render('tareas/index.html.twig', array( 'tareas' => $modeloTareas->getTareasPendientes() ));
})->bind('tareas_inicio');


$tareas->get('/borrar', function (Request $request) use($app) {
  $id = $request->get('id');
  $modeloTareas = new \models\tareas($app['db']);
  $condicion = array(
    'id' => $id
  );
  $modeloTareas->borrar($condicion);
  return $app->redirect($app["url_generator"]->generate("tareas_inicio"));
})->bind('tareas_borrar');

$tareas->post('/nuevo', function (Request $request) use($app) {
  $nombre = $request->get('nombre');
  if ($nombre != '')
  {
    $datos = array(
      'nombre' => $nombre,
      'estado' => 'P',
      'propietario' => '1'
    );
    $modeloTareas = new \models\tareas($app['db']);
    $modeloTareas->insertar($datos);
  }
  return $app->redirect($app["url_generator"]->generate("tareas_inicio"));
})->bind('tareas_nuevo');


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
  return $app->redirect($app["url_generator"]->generate("tareas_inicio"));
})->bind('tareas_completar');

return $tareas;
?>
