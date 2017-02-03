<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;

//Multiples url en firewall
use Symfony\Component\HttpFoundation\RequestMatcher;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
});

// Registrar acceso a base de datos
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'dbname'   => 'silex',
        'host'     => 'localhost',
        'user'     => 'root',
        'password' => '',
    ),
));

require_once 'schema.php'; #Todo esto no me gusta
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
      'publico' => array(
          'pattern' =>  '^/usuario',          
          ),

        'privado' => array(
            'pattern' =>  '^/',
            'form' => array('login_path' => 'login', 'check_path' => '/admin/login_check'),
            'users' => function () use ($app) {
                  return new models\UserProvider($app['db']);
              },
            ),
        ),

));

//Montar controles
$app->mount('/', include 'controllers/tareas.php');
$app->mount('/usuario', include 'controllers/usuarios.php');

return $app;
