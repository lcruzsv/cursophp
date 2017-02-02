<?php
namespace models;

class base {

  private $db;
  protected $creado_por;
  protected $tabla;
  protected $campos = array(    
  );
  public function __construct($db)
  {
      $this->db = $db;
  }

  public function getCreadoPor()     {
      //return $this->id;
      return "Luis Cruz?";
  }

  public function getTodos()
  {
    $sql = "SELECT * FROM ". $this->tabla;
    $resultado = $this->db->fetchAll($sql);
    return $resultado;
  }

  public function getPorId($id)
  {
    $sql = "SELECT * FROM ". $this->tabla .  " where id = ?";
    $resultado = $this->db->fetchAssoc($sql, array((int) $id));
    return $resultado;
  }

  public function insertar($valores)
  {
    $sql = "insert into ". $this->tabla ();
    $resultado = $this->db->fetchAssoc($sql, array((int) $id));
    return $resultado;
  }

}

 ?>
