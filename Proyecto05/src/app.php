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

//Pasar a login
#use Symfony\Component\HttpFoundation\Request;
#use Symfony\Component\HttpFoundation\Response;

//Usar Formularios
use Silex\Provider\FormServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
});

//Registrar Formularios
$app->register(new FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.domains' => array(),
    'locale'            => 'es',
    'locale_fallbacks'  => array('es')
));

//Redireccionar a rutas
#$app->register(new Silex\Provider\UrlGeneratorServiceProvider());


// Registrar acceso a base de datos
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'dbname'   => 'silex',
        'host'     => 'localhost',
        'user'     => 'root',
        'password' => '',
    ),
));


$app->register(new Silex\Provider\SwiftmailerServiceProvider());
//  Configurar envio de correos
$app['swiftmailer.options'] = array(
  'host' => 'smtp.gmail.com',
  'port' => 465,
  'username' => 'cruz.orellana@gmail.com',
  'password' => '594685',
  'encryption' => 'ssl',
  'auth_mode' => 'login'
);
//Habilitar sesiones de usuario
$app
    ->register(new Silex\Provider\SessionServiceProvider())
    ->register(new Silex\Provider\FormServiceProvider())
    ->register(new Silex\Provider\ValidatorServiceProvider())
    ;


require_once 'schema.php'; #Todo esto no me gusta

//Montar controles
$app->mount('/', include 'controllers/tareas.php');
$app->mount('/usuario', include 'controllers/usuarios.php');

$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
      'login' => array(
             'pattern' => '^/usuario',
         ),

        'privado' => array(
            'pattern' =>  '^/',
            'http' => true,
            'form' => array('login_path' => '/usuario/login', 'check_path' => 'login_check'),
            'logout' => array('logout_path' => '/admin/logout', 'invalidate_session' => true),
            'users' => function () use ($app) {
                  return new models\UserProvider($app['db']);
              },
            ),
        ),

));




return $app;
