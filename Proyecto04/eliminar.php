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
    <title>Eliminar tarea</title>
  </head>
  <body>
    <p>¿Esta seguro que desea eliminar esta tarea?</p>
    <p><?php echo urldecode($_GET['tarea'])?></p>
    <a href="eliminar.php?id=<?php echo $_GET['id'] ?>&eliminar=si">Si</a>
    <a href="index.php">Cancelar</a>
  </body>
</html>
