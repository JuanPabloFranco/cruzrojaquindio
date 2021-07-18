<?php
include_once '../Conexion/Conexion.php';
class Imagen
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($nombre_foto, $descripcion, $id_sede)
    {
        $sql = "INSERT INTO fotos_sede(nombre_foto, id_sede, desc_foto)                
        values(:nombre_foto, :id_sede, :descripcion)";
        $query2 = $this->acceso->prepare($sql);
        if ($query2->execute(array(':nombre_foto' => "$nombre_foto", ':id_sede' => $id_sede, ':descripcion' => "$descripcion"))) {
            echo 'subido';
        } else {
            echo 'Error al registrar la imagén en base de datos';
        }
    }

    function buscar_datos()
    {
        $id = $_POST['id'];
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM fotos_sede WHERE id_sede=:id AND (desc_foto LIKE :consulta)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%", ':id' => $id));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM fotos_sede WHERE id_sede=:id AND (desc_foto NOT LIKE '' OR desc_foto NOT LIKE 'null') ORDER BY id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function cargarFoto($id)
    {
        $sql = "SELECT * FROM fotos_sede WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_imagen($id, $descripcion)
    {
        $sql = "UPDATE fotos_sede SET desc_foto=:descripcion WHERE id=:id";
        $query2 = $this->acceso->prepare($sql);
        if ($query2->execute(array(':id' => $id, ':descripcion' => "$descripcion"))) {
            echo 'update';
        } else {
            echo 'Error al actualizar la imagén ';
        }
    }
    function eliminar_imagen($id)
    {
        $sql = "DELETE FROM fotos_sede WHERE id=:id";
        $query2 = $this->acceso->prepare($sql);
        $query2->execute(array(':id' => $id));
    }
}
