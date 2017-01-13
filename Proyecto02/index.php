<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Calendario</title>
    <link rel="stylesheet" href="master.css">
  </head>
  <body>
    <?php

      //$mes = date("D", $fecha);
      $mes = '02';
      $anio = '2016';
      $dia = 1;
      $fecha = mktime(0,0,0,$mes, $dia, $anio);
      setlocale(LC_ALL,"es");

      echo "<table><tr class='titulo'><td colspan='7'>".ucfirst(strftime ("%B", $fecha))."</td></tr>";
      echo "<tr>";
      echo "<td class='subtitulo'>Dom</td>";
      echo "<td class='subtitulo'>Lun</td>";
      echo "<td class='subtitulo'>Mar</td>";
      echo "<td class='subtitulo'>Mie</td>";
      echo "<td class='subtitulo'>Jue</td>";
      echo "<td class='subtitulo'>Vie</td>";
      echo "<td class='subtitulo'>Sab</td>";
      echo "</tr>";


      do {
          echo "<tr>";

          for($i = 0; $i<=6; $i++)
          {
              if (date('w', $fecha) == $i)
              {
                echo "<td>$dia</td>";
                $dia++;
                $fecha = mktime(0,0,0,$mes, $dia, $anio);
                if ($mes != date("m", $fecha))
                {
                  break;
                }
              }
              else {
                echo "<td></td>";
              }
          }
          echo "</tr>";

      } while ($mes == date("m", $fecha));
      echo "</table>";
    ?>

  </body>
</html>
