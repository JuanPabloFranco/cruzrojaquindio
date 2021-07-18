<?php
include_once '../Conexion/Conexion.php';
class Soporte
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($id_voluntario, $descripcion_soporte, $fecha_registro)
    {
        $sql2 = "INSERT INTO contacto_soporte(id_voluntario, estado_soporte, descripcion_soporte,soporte,fecha_registro)                
               values(:id_voluntario,'Nuevo',:descripcion_soporte,'',:fecha_registro)";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id_voluntario' => $id_voluntario, ':descripcion_soporte' => $descripcion_soporte, ':fecha_registro' => $fecha_registro))) {
            echo 'creado';
        } else {
            echo 'Error al registrar la solicitud';
        }
    }

    function buscar_datos()
    {
        $tipo_usuario = $_POST['tipo_usuario'];
        $id_voluntario = $_POST['id_voluntario'];
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            if ($tipo_usuario == 1) {
                $sql = "SELECT S.id, V.nombre_completo, R.nombre_region, S.estado_soporte, S.descripcion_soporte, S.fecha_registro FROM contacto_soporte S JOIN voluntarios V ON S.id_voluntario=V.id JOIN regiones R ON V.id_region=R.id WHERE (descripcion_soporte LIKE :consulta) ";
            } else {
                $sql = "SELECT S.id, V.nombre_completo, R.nombre_region, S.estado_soporte, S.descripcion_soporte, S.fecha_registro FROM contacto_soporte S JOIN voluntarios V ON S.id_voluntario=V.id JOIN regiones R ON V.id_region=R.id WHERE S.id_voluntario=$id_voluntario AND (descripcion_soporte LIKE :consulta) ";
            }
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            if ($tipo_usuario == 1) {
                $sql = "SELECT S.id, V.nombre_completo, R.nombre_region, S.estado_soporte, S.descripcion_soporte, S.fecha_registro FROM contacto_soporte S JOIN voluntarios V ON S.id_voluntario=V.id JOIN regiones R ON V.id_region=R.id  WHERE (descripcion_soporte NOT LIKE '')  ORDER BY S.fecha_registro DESC";
            } else {
                $sql = "SELECT S.id, V.nombre_completo, R.nombre_region, S.estado_soporte, S.descripcion_soporte, S.fecha_registro FROM contacto_soporte S JOIN voluntarios V ON S.id_voluntario=V.id JOIN regiones R ON V.id_region=R.id  WHERE (descripcion_soporte NOT LIKE '') AND S.id_voluntario=$id_voluntario  ORDER BY S.fecha_registro DESC";
            }
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }    

    function agregar_soporte($id, $soporte)
    {
        $sql = "UPDATE contacto_soporte SET soporte=:soporte WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':soporte' => $soporte))) {
            echo 'update';
        } else {
            echo 'Error al guardar el soporte';
        }
    }

    function cambiar_estado($id, $estado)
    {
        $sql = "UPDATE contacto_soporte SET estado_soporte=:estado WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':estado' => $estado))) {
            echo 'update';
        } else {
            echo 'Error al cambiar el estado';
        }
    }

    function crear_comentario($id_soporte, $respuesta, $id_voluntario, $fecha_com)
    {

        $sql2 = "INSERT INTO respuesta_soporte(id_soporte, respuesta, id_voluntario,fecha_com)                
               values(:id_soporte,:respuesta,:id_voluntario,:fecha_com)";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id_soporte' => $id_soporte, ':respuesta' => $respuesta, ':id_voluntario' => $id_voluntario, ':fecha_com' => $fecha_com))) {
            echo 'update';
        } else {
            echo 'Error al registrar el comentario';
        }
    }

    function contar_soporte()
    {
        $sql = "SELECT COUNT(contacto_soporte.id) AS cantidad FROM contacto_soporte WHERE estado_soporte='Nuevo'";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
