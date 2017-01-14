<?php
include "basedatos.php";

if(isset($_POST['id']))
{
  $estado = (isset($_POST['estado'])) ? '1':'0';

  //Algunas validaciones....
  if ($_POST['tarea'] == '')
  {
    $error = 'La descripcion de la tarea no puede quedar vacia';
  }

  if (!isset($error)) //no hay error
  {
    editarTarea($_POST['id'], $_POST['tarea'], $_POST['vencimiento'], $estado);
    header('Location: index.php');
  }
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <title>Modificar</title>
  </head>
  <body>
    <?php
       if (isset($error))
       {
         echo "<p class='alert alert-danger'>$error</p>";
       }
     ?>

    <form class="" method="post">
      <input type="hidden" name="id" value="<?php echo ($_REQUEST['id'])?>">
      <label>Tarea</label>
      <input type="text" name="tarea" value="<?php echo urldecode($_REQUEST['tarea'])?>" />
      <label>Fecha vencimiento</label>
      <input type="date" name="vencimiento" value="<?php echo ($_REQUEST['vencimiento'])?>"/>
      <label>Finalizada</label>
      <input type="checkbox" name="estado" value="0" />
      <input class="" type="submit" value="Guardar" />
      <a class="" href="index.php">Cancelar</a>
    </form>
  </body>
</html>
