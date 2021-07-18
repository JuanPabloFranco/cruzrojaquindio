<?php
include_once '../Conexion/Conexion.php';
class FotoEvento
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($id_evento, $archivo, $descripcion)
    {
        $sql2 = "INSERT INTO fotos_evento(id_evento, archivo, descripcion)                
               values(:id_evento,:archivo,:descripcion)";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id_evento' => $id_evento, ':archivo' => $archivo, ':descripcion' => $descripcion))) {
            echo 'creado';
        } else {
            echo 'Error al registrar la foto';
        }
    }

    function listar()
    {
        $id_evento = $_POST['id_evento'];
        $sql = "SELECT * FROM fotos_evento WHERE id_evento=$id_evento ORDER BY id";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function cargarFoto($id)
    {
        $sql = "SELECT * FROM fotos_evento WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_foto_evento($id, $descripcion)
    {
        $sql = "UPDATE fotos_evento SET descripcion=:descripcion WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':descripcion' => $descripcion))) {
            echo 'update';
        } else {
            echo 'Error al actualizar la descripción de la foto';
        }
    }

    function eliminar($id)
    {
        $sql = "SELECT archivo FROM fotos_evento WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();      

        $sqlDelete = "DELETE FROM fotos_evento WHERE id=:id";
        $query = $this->acceso->prepare($sqlDelete);
        $query->execute(array(':id' => $id));

        return $this->objetos;
    }
}
