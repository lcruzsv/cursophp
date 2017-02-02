<?php

namespace models;

class tareas extends  base  {

    protected $id;
    protected $nombre;
    protected $estado;
    protected $tabla = 'tareas';
    protected $campos = array(
      array('campo' => 'nombre', 'tipo'=>'string' )
    );

    function 
    $schema = $app['db']->getSchemaManager();
    if (!$schema->tablesExist('users')) {
        $users = new Table('users');
        $users->addColumn('id', 'integer', array('unsigned' => true, 'autoincrement' => true));
        $users->setPrimaryKey(array('id'));
        $users->addColumn('username', 'string', array('length' => 32));
        $users->addUniqueIndex(array('username'));
        $users->addColumn('password', 'string', array('length' => 255));
        $users->addColumn('roles', 'string', array('length' => 255));

        $schema->createTable($users);

        $app['db']->insert('users', array(
          'username' => 'fabien',
          'password' => '$2y$10$3i9/lVd8UOFIJ6PAMFt8gu3/r5g0qeCJvoSlLCsvMTythye19F77a',
          'roles' => 'ROLE_USER'
        ));

        $app['db']->insert('users', array(
          'username' => 'admin',
          'password' => '$2y$10$3i9/lVd8UOFIJ6PAMFt8gu3/r5g0qeCJvoSlLCsvMTythye19F77a',
          'roles' => 'ROLE_ADMIN'
        ));
    }



    public function getId()     {
        //return $this->id;
        return "Si funciona?";
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
  }
?>
