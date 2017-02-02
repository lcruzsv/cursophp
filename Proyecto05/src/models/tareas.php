<?php
namespace models;

use Doctrine\DBAL\Schema\Table;
class tareas extends  base  {

    protected $id;
    protected $nombre;
    protected $estado;
    protected $tabla = 'tareas';
    protected $campos = array(
      array('campo' => 'nombre', 'tipo'=>'string' )
    );

/**
 * [getEsquema description]
 * @return [type] [description]
 */
    public function getEsquema()
    {
      $schema = $this->db->getSchemaManager();
      $tabla = new Table($this->tabla);
      $tabla->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
      $tabla->setPrimaryKey(array('id'));
      $tabla->addColumn('nombre', 'string', array('length' => 140));
      $tabla->addColumn('propietario', 'integer');
      $tabla->addColumn('estado', 'string', array('length' => 1));

      return $tabla;
    }

    public function getTareasPendientes()
    {
      return $this->db->fetchAll('SELECT * FROM tareas WHERE estado = "P"');      
    }



  }
?>
