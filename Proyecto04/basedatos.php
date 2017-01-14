<?php



function conectarBD( )
{
  $mysqli = new mysqli('127.0.0.1', 'root', '', 'tareas');
  if ($mysqli->connect_errno) {
    die($mysqli->connect_error);
  }

  return $mysqli;
}


/*
  Regresa un array con todas las tearas pendientes
*/
function leerTareas()
{
  $mysqli = conectarBD();
  $sql = "Select * from tareas where estado = '0'";

  if (!$resultado = $mysqli->query($sql))
  {
    die( "Error: " . $mysqli->error );
  }
  return $resultado;
}

/*
  Agrega una tarea
*/
function crearTarea($tarea, $fecha)
{
  $mysqli = conectarBD();
  $sql = "INSERT INTO tareas (tarea, vencimiento, estado) VALUES (?,?,?)";
  $comando = $mysqli->prepare($sql);
  if (!$comando)
  {
    die("Error en sql: " . $sql);
  }
  $comando->bind_param('sss', $tarea, $fecha, $estado);
  $estado = '0';
  $comando->execute();
}

/*
  Borra una tarea
*/
function borrarTarea($id)
{
  $mysqli = conectarBD();
  $sql = "delete from tareas where id = ?";
  $comando = $mysqli->prepare($sql);
  if (!$comando)
  {
    die("Error en sql: " . $sql);
  }
  $comando->bind_param('i', $id);
  $comando->execute();
}

/*
  Modificar una tarea
*/
function editarTarea($id, $tarea, $vencimiento, $estado)
{
  $mysqli = conectarBD();
  $sql = "update tareas set tarea=?, vencimiento=?, estado=? where id = ?";
  $comando = $mysqli->prepare($sql);
  if (!$comando)
  {
    die("Error en sql: " . $sql);
  }
  $comando->bind_param('sssi', $tarea, $vencimiento, $estado, $id);
  $comando->execute();
}
 ?>
