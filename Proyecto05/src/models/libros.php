<?php
namespace models;

use Doctrine\DBAL\Schema\Table;
class libros extends  base  {

    protected $id;
    protected $nombre;
    protected $tabla = 'libros';

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
      return $tabla;
    }

    public function getLibros($userId)
    {
      return $this->db->fetchAll('SELECT * FROM libros WHERE propietario = ? ', array( $userId ));
    }

    public function getTareasPorLibro($userId)
    {
      return $this->db->fetchAll('SELECT * FROM tareas WHERE estado = ? and propietario = ? ', array('P', $userId ));
    }



  }
?>
