<?php include "calendario.php" ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Calendario</title>
    <link rel="stylesheet" href="master.css">
  </head>
  <body>
    <?php
      if (isset($_GET['mes']))
      {
        $mes = $_GET['mes'];
      }
      else
      {
        $mes = '01';
      }

      if (isset($_GET['anio']))
      {
        $anio = $_GET['anio'];        
      }
      else
      {
        $anio = '2017';
      }

      echo mostrarCalendario(1, $mes, $anio);

    ?>

  </body>
</html>
