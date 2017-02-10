<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FormType; //formularios
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints as Assert; //Validaciones

use Symfony\Component\Validator\ExecutionContext;

//Codificar password
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

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
                   "constraints"   =>  array(
                   new Assert\NotBlank(),
                   new Assert\Email(),
               ), //Constraints
              ))
         ->add('clave', RepeatedType::class, array(
                'invalid_message' => 'Las claves deben ser identicas',
                'first_options'  => array('label' => 'Clave', 'attr'=> array('class'=>'form-control')),
                'second_options' => array('label' => 'Confirmar clave', 'attr'=> array('class'=>'form-control')),
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 8)))
              ))

         ->getForm();

     $form->handleRequest($request);


     //Validaciones adicionales
     if ($form->isSubmitted())
     {
       $data = $form->getData();

       //El correo no debe de existir
       $existe = $app['db']->fetchColumn('SELECT username FROM users WHERE username = ?', array($data['email']));
       if($existe)
       {
          $form->get('email')->addError(new \Symfony\Component\Form\FormError("Ya hay un usuario con este Email"));
       }
     }

     if ($form->isValid()) {
         $data = $form->getData();


         $encoder = new BCryptPasswordEncoder(10);
         $pwd = $data['clave'];
         $clave = $encoder->encodePassword($pwd, '');

         //Crear usuario en base de datos
         $app['db']->insert('users', array(
           'username' => $data['email'],
           'password' => $clave,
           'roles' => 'ROLE_USER'
         ));

         $user = new \Symfony\Component\Security\Core\User\User($data['email'], $data['clave'], array('ROLE_USER'));
         $token = new UsernamePasswordToken(
             $user,
             $user->getPassword(),
             'privado',                 //Llave del firewall
             $user->getRoles()
         );


         // _security_privado depende del nombre del firewall
         $app['session']->set('_security_privado', serialize($token));
         $app['session']->save();
         $app['security.token_storage']->setToken($token);

         //Logeamos al usuario y lo enviamos a la pagina principal
         return $app->redirect($app["url_generator"]->generate("tareas_inicio"));

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
