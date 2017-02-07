<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType; //formularios
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints as Assert; //Validaciones

//Codificar password
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

$usuarios = $app['controllers_factory'];

$usuarios->get('/login', function(Request $request) use ($app) {

    return $app['twig']->render('usuarios/login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));

});

$usuarios->get('/admin/logout', function(Request $request) use ($app) {
    return $app->redirect($app['url_generator']->generate('home'));
});

$usuarios->match('/nuevo',  function (Request $request) use ($app) {

  $data = array(
          'email' => '',
          'clave' => '',
      );

  $form = $app['form.factory']->createBuilder(FormType::class, $data)
         ->add('email', null, array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5)))
              ))
         ->add('clave', RepeatedType::class, array(
                'invalid_message' => 'Las claves deben ser identicas',
                'first_options'  => array('label' => 'Clave', 'attr'=> array('class'=>'form-control')),
                'second_options' => array('label' => 'Confirmar clave', 'attr'=> array('class'=>'form-control')),
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 8)))
              ))

         ->getForm();

   $form->handleRequest($request);

     if ($form->isValid()) {
         $data = $form->getData();

         var_dump($data);
         $encoder = new BCryptPasswordEncoder(10);
         $pwd = $data['clave'];
         $clave = $encoder->encodePassword($pwd, '');

         //Crear usuario en base de datos
         $app['db']->insert('users', array(
           'username' => $data['email'],
           'password' => $clave,
           'roles' => 'ROLE_USER'
         ));

         //return $app->redirect('...');
         return "nuevo";
     }


  return $app['twig']->render('usuarios/nuevo.html.twig', array('form' => $form->createView()));
})->bind('usuario_nuevo');

/*
$usuarios->get('/', function () { return 'Blog home page'; });
$usuarios->get('/resetear', function () { return 'Ingresa tu correo'; });

$usuarios->get('/nuevo', function () use($app){
  return $app['twig']->render('usuarios/nuevo.html.twig');
})->bind('usuario_nuevo');
*/

return $usuarios;
?>
