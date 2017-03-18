<?php

/*
  Retorna un string o cadena con el codigo HTML para mostrar un calendario
*/
  function mostrarCalendario($dia, $mes, $anio)
  {
    $fecha = mktime(0,0,0,$mes, $dia, $anio);
    setlocale(LC_ALL,"es");

    $cal = "<table><tr class='titulo'><td>".crearLinkAtras($mes, $anio)."</td><td colspan='5'>".ucfirst(strftime ("%B", $fecha)). " " . $anio ."</td><td>".crearLinkAdelante($mes, $anio)."</td></tr>";
    $cal .= "<tr>";
    $cal .= "<td class='subtitulo'>Dom</td>";
    $cal .= "<td class='subtitulo'>Lun</td>";
    $cal .= "<td class='subtitulo'>Mar</td>";
    $cal .= "<td class='subtitulo'>Mie</td>";
    $cal .= "<td class='subtitulo'>Jue</td>";
    $cal .= "<td class='subtitulo'>Vie</td>";
    $cal .= "<td class='subtitulo'>Sab</td>";
    $cal .= "</tr>";


    do {
        $cal .= "<tr>";

        for($i = 0; $i<=6; $i++)
        {
            if (date('w', $fecha) == $i)
            {
              $cal .= "<td>$dia</td>";
              $dia++;
              $fecha = mktime(0,0,0,$mes, $dia, $anio);
              if ($mes != date("m", $fecha))
              {
                break;
              }
            }
            else {
              $cal .= "<td></td>";
            }
        }
        $cal .= "</tr>";

    } while ($mes == date("m", $fecha));
    $cal .= "</table>";
    return $cal;
  }

  /*
    Crea un enlace para mostrar un mes atras
  */
  function crearLinkAtras($mes, $anio)
  {
    return crearLink(date('m',mktime(0,0,0,$mes - 1, 1, $anio)), date('Y',mktime(0,0,0,$mes - 1, 1, $anio)), '<');
  }

  /*
    Crea un enlace para mostrar un mes adelante	
  */
  function crearLinkAdelante($mes, $anio)
  {
    return crearLink(date('m',mktime(0,0,0,$mes + 1, 1, $anio)), date('Y',mktime(0,0,0,$mes + 1, 1, $anio)), '>');
  }

  /*
    Crea un enlace para mostrar un mes especifico
  */
  function crearLink($mes, $anio, $texto)
  {
     return "<a class='linkCalendario' href='?mes=$mes&anio=$anio'>$texto</a>";
  }


?>
