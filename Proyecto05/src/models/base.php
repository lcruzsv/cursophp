<?php
namespace models;

class base {

  protected $db;
  protected $creado_por;
  protected $tabla;
  protected $campos = array(
  );
  public function __construct($db)
  {
      $this->db = $db;
      $this->crearTabla();

  }

  public function getCreadoPor()     {
      //return $this->id;
      return "Luis Cruz?";
  }

  public function getEsquema()
  {

  }

  public function crearTabla()
  {
      $schema = $this->db->getSchemaManager();
      if (!$schema->tablesExist($this->tabla))
      {
        $schema = $this->db->getSchemaManager();
        $schema->createTable( $this->getEsquema() );
      }
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

  /**
   * Agrega un registro en la base de datos
   * @param  [type] $datos [description]
   * @return bool        verdadero si el registro se inserto
   */
  public function insertar($datos)
  {
    $this->db->insert($this->tabla, $datos);
    return true;
  }

  public function borrar($condiciones)
  {
    $ids = $this->db->fetchAll('SELECT id FROM '.$this->tabla .' where id in (?)', $condiciones);

    $this->db->executeQuery('DELETE FROM '.$this->tabla .' WHERE id IN (?)', $condiciones);
    $this->postBorrar($ids);
    return true;
  }

  public function postBorrar($ids)
  {
    return true;
  }



  public function actualizar($datos, $condiciones)
  {
    $this->db->update($this->tabla, $datos, $condiciones);
    return true;
  }
}

 ?>
