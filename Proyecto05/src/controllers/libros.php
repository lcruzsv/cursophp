<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$libros = $app['controllers_factory'];

/**
*  Lista de tareas
**/
$libros->get('/', function (Request $request) use($app){

  $modeloLibros = new \models\libros($app['db']);
  return $app['twig']->render('libros/index.html.twig', array( 'libros' => $modeloLibros->getLibros($app['userId'])));
})->bind('libros_inicio');


$libros->post('/nuevo', function (Request $request) use($app) {
 $nombre = $request->get('nombre');
 if ($nombre != '')
 {
     $userId = $app['userId'];
     $datos = array(
       'nombre' => $nombre,
       'propietario' => $userId
     );
     $modeloLibros = new \models\libros($app['db']);
     $modeloLibros->insertar($datos);
 }
 return $app->redirect($app["url_generator"]->generate("libros_inicio"));
})->bind('libros_nuevo');


$libros->get('/borrar', function (Request $request) use($app) {
  $id = $request->get('id');
  $modeloLibros = new \models\libros($app['db']);
  $condicion = array(
    'id' => $id
  );
  $modeloLibros->borrar($condicion);
  return $app->redirect($app["url_generator"]->generate("libros_inicio"));
})->bind('libros_borrar');


$libros->get('/seleccionar', function (Request $request) use($app) {
    $app['session']->set('libro',$request->get('id'));
    return $app->redirect($app["url_generator"]->generate("tareas_inicio"));
})->bind('libros_seleccionar');;

$libros->get('/modificar', function (Request $request) use($app) {
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
})->bind('libros_modificar');

return $libros;
?>
