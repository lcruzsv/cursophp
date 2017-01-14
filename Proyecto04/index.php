<?php
  include "basedatos.php"
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="master.css">
    <title>Lista de tareas</title>
  </head>
  <body>
      <h1>Lista de tareas</h1>
      <form   method="post" class="form-inline">
          <div class="form-group">
            <label for="tarea">Tarea</label>
            <input class="form-control" type="text" id="tarea" name="tarea" placeholder="Ingrese una trea"/>
          </div>
          <div class="form-group">
            <label for="vencimiento">Fecha vencimiento</label>
            <input class="form-control" type="date" id="vencimiento" name="vencimiento" placeholder="Vencimiento" />
          </div>

          <input type="submit" class="btn btn-primary" value= "Agregar tarea"/>
      </form>
      <br>
      <?php
       if (isset($_POST['tarea']) && isset($_POST['vencimiento']))
       {
         if ($_POST['tarea'] == '')
         {
           echo "<p class='alert alert-danger'>La descripcion de la tarea no puede estar vacia</p>";
         }
         elseif ( $_POST['vencimiento'] == '' )
         {
           echo "<p class='alert alert-danger'>La fecha de vencimiento no puede estar vacia</p>";
         }
         else {
           crearTarea($_POST['tarea'], $_POST['vencimiento']  );
         }
       }
       #crearTarea("creada", '2017-01-01'  );
       $tareas = leerTareas();
       while ($tarea = $tareas->fetch_assoc())
       {
         $fecha = new DateTime($tarea['vencimiento']);
         echo "<div class='ver-tarea'>";
         echo " <a class='btn btn-default btn-xs' href='editar.php?id=".$tarea['id']. "&tarea=". urlencode($tarea['tarea']) . "&vencimiento=" . $tarea['vencimiento']  . "'>".'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>'."</a>";
         echo " <a class='btn btn-danger btn-xs' href='eliminar.php?id=".$tarea['id']. '&tarea='. urlencode($tarea['tarea']) . "'>".'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>'."</a>";
         echo ' ' . $tarea['tarea'];
         echo ' <span class="pull-right label label-primary">' . $fecha->format('d/m/Y') . '</span>';
         echo "</div>";
       }

       ?>

  </body>
</html>
