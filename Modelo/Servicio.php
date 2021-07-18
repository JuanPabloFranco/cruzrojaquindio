<?php
include_once '../Conexion/Conexion.php';
class Servicio
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($nombre, $descrip)
    {
        $sql2 = "INSERT INTO servicios(nombre_servicio, descripcion, estado_servicio)                
               values(:nombre,:descrip,'Activo')";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':nombre' => $nombre, ':descrip' => $descrip))) {
            echo 'creado';
        } else {
            echo 'Error al registrar el servicio';
        }
    }

    function buscar_datos()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM servicios WHERE nombre_servicio LIKE :consulta OR descripcion LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM servicios WHERE nombre_servicio NOT LIKE '' ORDER BY id";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function cargarServicio($id)
    {
        $sql = "SELECT * FROM servicios WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_serrvicio($id, $nombre, $descrip)
    {
        $sql = "UPDATE servicios SET nombre_servicio=:nombre, descripcion=:descrip WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':nombre' => "$nombre", ':descrip' => "$descrip"))) {
            echo 'update';
        } else {
            echo 'Error al actualizar el servicio';
        }
    }

    function changeEstadoServicio($id)
    {
        $sql = "SELECT id FROM servicios WHERE estado_servicio='Activo' AND id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            $sql = "UPDATE servicios SET estado_servicio='Inactivo' WHERE id=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id));
        } else {
            $sql = "UPDATE servicios SET estado_servicio='Activo' WHERE id=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id));
        }
    }

    function listar_fotos_servicio($id)
    {
        $sql = "SELECT * FROM fotos_servicios WHERE id_servicio=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function crear_foto($id_servicio, $archivo, $descripcion)
    {
        
        $sql2 = "INSERT INTO fotos_servicios(id_servicio, archivo, descripcion)                
               values(:id_servicio,:archivo,:descripcion)";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id_servicio' => $id_servicio, ':archivo' => $archivo, ':descripcion' => $descripcion))) {
           echo 'creado';
        } else {
            echo 'Error al registrar la foto';
        }
    }

    function buscar_foto_servicio($id_servicio)
    {
        $sql = "SELECT * FROM fotos_servicios WHERE id_servicio=:id_servicio";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_servicio' => $id_servicio));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function eliminarFotoServicio($id)
    {
        
        $sql2 = "DELETE FROM fotos_servicios WHERE id=:id";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id' => $id))) {
           echo 'eliminado';
        } else {
            echo 'Error al eliminar la foto';
        }
    }
}
