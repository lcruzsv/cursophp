<?php
$usuarios = $app['controllers_factory'];
$usuarios->get('/', function () { return 'Blog home page'; });
$usuarios->get('/resetear', function () { return 'Ingresa tu correo'; });

return $usuarios;
?>
