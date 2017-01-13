<?php
  include "basedatos.php"
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Lista de tareas</title>
  </head>
  <body>
      <form class=""  method="post">
          <label for="">Tarea</label>
          <input type="text" name="tarea" placeholder="Ingrese una trea"/>
          <label for="">Fecha vencimiento</label>
          <input type="date" name="vencimiento" placeholder="Vencimiento" />
          <input type="submit" value= "Enviar"/>

          <?php
           if (isset($_POST['tarea']) && isset($_POST['vencimiento']))
           {
             crearTarea($_POST['tarea'], $_POST['vencimiento']  );
           }
           #crearTarea("creada", '2017-01-01'  );
           $tareas = leerTareas();
           while ($tarea = $tareas->fetch_assoc())
           {
             echo "<div>";
             echo "<a href='editar.php?id=".$tarea['id']. "&tarea=". urlencode($tarea['tarea']) . "&vencimiento=" . $tarea['vencimiento']  . "'>Editar</a>";
             echo " <a href='eliminar.php?id=".$tarea['id']. '&tarea='. urlencode($tarea['tarea']) . "'>Eliminar</a>";
             echo ' ' . $tarea['tarea'];
             echo ' ' . $tarea['vencimiento'];
             echo "</div>";
           }

           ?>
      </form>
  </body>
</html>
