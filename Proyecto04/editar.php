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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="master.css">
    <title>Modificar</title>
  </head>
  <body>
    <?php
       if (isset($error))
       {
         echo "<p class='alert alert-danger'>$error</p>";
       }
     ?>
     <h1>Editar tarea</h1>
    <form class="form" method="post">

      <input type="hidden" name="id" value="<?php echo ($_REQUEST['id'])?>">

      <div class="form-group">
      <label>Tarea</label>
      <input class="form-control" type="text" name="tarea" value="<?php echo urldecode($_REQUEST['tarea'])?>" />
      </div>

      <div class="form-group">
      <label>Fecha vencimiento</label>
      <input class="form-control" type="date" name="vencimiento" value="<?php echo ($_REQUEST['vencimiento'])?>"/>
      </div>

      <div class="checkbox">
      <label>
      <input type="checkbox" name="estado" value="0" />
      Finalizada
      </label>
      </div>

      <div class="form-group">
      <input class="btn btn-primary" type="submit" value="Guardar" />
      <a class="btn btn-default" href="index.php">Cancelar</a>
      </div>

    </form>
  </body>
</html>
