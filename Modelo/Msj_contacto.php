<?php
include_once '../Conexion/Conexion.php';
class Msj_contacto
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($id_sede, $nombre, $email, $asunto, $mensaje, $fecha)
    {        
        $sql2 = "INSERT INTO msj_contacto(id_sede, nombre, email, asunto, mensaje, estado_msj, fecha)                
               values(:id_sede,:nombre,:email,:asunto,:mensaje, 'Nuevo', :fecha)";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id_sede' => $id_sede, ':nombre' => $nombre, ':email' => $email, ':asunto' => $asunto, ':mensaje' => $mensaje, ':fecha' => $fecha))) {
            echo 'creado';
        } else {
            echo 'Error al enviar el mensaje';
        }
    }

    function buscar_datos()
    {
        $id_sede = $_POST['id_sede'];
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
           
            $sql = "SELECT * FROM msj_contacto WHERE nombre LIKE :consulta OR email LIKE :consulta OR asunto LIKE :consulta AND id_sede=$id_sede";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM msj_contacto WHERE nombre NOT LIKE '' AND id_sede=$id_sede ORDER BY fecha ASC";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function cargarMsj($id)
    {
        $sql = "SELECT * FROM msj_contacto WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function changeVisto($id)
    {
        $sql = "UPDATE msj_contacto SET estado_msj='Visto' WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id))) {
            echo 'update';
        } else {
            echo 'Error al actualizar el mensaje';
        }
    }

    function changeRes($id)
    {
        $sql = "UPDATE msj_contacto SET estado_msj='Respondido' WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id))) {
            echo 'update';
        } else {
            echo 'Error al actualizar el mensaje';
        }
    }

    function contar_msj($id_sede)
    {
        $sql = "SELECT COUNT(M.id) AS cantidad FROM msj_contacto M WHERE M.id_sede=:id_sede AND estado_msj='Nuevo'";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_sede' => $id_sede));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function responder($id, $id_vol_respuesta, $fecha_respuesta, $respuesta)
    {
        $sql = "UPDATE msj_contacto SET id_vol_respuesta=:id_vol_respuesta, fecha_respuesta=:fecha_respuesta, respuesta=:respuesta WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':id_vol_respuesta' => $id_vol_respuesta, ':fecha_respuesta' => $fecha_respuesta, ':respuesta' => $respuesta))) {
            echo 'update';
        } else {
            echo 'Error al actualizar el mensaje';
        }
    }
    
}
