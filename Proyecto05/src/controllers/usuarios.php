<?php
$usuarios = $app['controllers_factory'];

$usuarios->get('/login', function () use($app){

  return $app['twig']->render('usuarios/login.html.twig');
})->bind('login');
$usuarios->get('/', function () { return 'Blog home page'; });
$usuarios->get('/resetear', function () { return 'Ingresa tu correo'; });

return $usuarios;
?>
