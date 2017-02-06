<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\DBAL\DriverManager;
//Request::setTrustedProxies(array('127.0.0.1'));


$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
});

$app->get('/admin/logout', function(Request $request) use ($app) {
    return $app->redirect($app['url_generator']->generate('home'));
});

$app->get('/', function () use ($app) {
/*
    $tarea = 'lll';
    $sql = "SELECT * FROM tareas ";
    $post = $app['db']->fetchAssoc($sql);

    $queryBuilder =  $app['db']->createQueryBuilder();
    $t = $queryBuilder
    ->select('nombre')
    ->from('tareas')
    ->where('id = ?')
    ->setParameter(0, 1)->execute()->fetchAll();
*/
    //siledie ( print_r($t)  );

    #$statement = $conn->executeQuery('SELECT * FROM user WHERE username = ?', array('jwage'));
    #$user = $statement->fetch();
    return $app['twig']->render('index.html.twig', array( 'tarea' => '' ));
})
->bind('homepage')
;

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
