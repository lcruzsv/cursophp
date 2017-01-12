<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Calendario</title>
    <link rel="stylesheet" href="master.css">
  </head>
  <body>
      <h1>Tareas pendientes</h1>
      <?php

        define('CANT_LINEAS', 15);
        $tareas = ['Lavarlos los platos', 'Terminar curso de PHP', 'Pasear al perro'];
        for ($i = 1; $i<= CANT_LINEAS; $i++)
        {
          if (isset($tareas[$i - 1]) )
          {
            $tarea = $tareas[$i - 1];
          }
          else
          {
            $tarea = "";
          }
          echo "<p> $i. $tarea<hr></p>";
        }
       ?>
  </body>
</html>
