<?php
include "basedatos.php";
if (isset($_GET['eliminar']) && $_GET['eliminar'] == 'si' && isset($_GET['id']) )
{
  borrarTarea($_GET['id']);
  header('Location: index.php');
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="master.css">
    <title>Eliminar tarea</title>
  </head>
  <body>
    <h1>¿Esta seguro que desea eliminar esta tarea?</h1>
    <p><?php echo urldecode($_GET['tarea'])?></p>
    <a class="btn btn-danger" href="eliminar.php?id=<?php echo $_GET['id'] ?>&eliminar=si">Si</a>
    <a class="btn btn-default" href="index.php">Cancelar</a>
  </body>
</html>
