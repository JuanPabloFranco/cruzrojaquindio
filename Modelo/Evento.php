<?php
include_once '../Conexion/Conexion.php';
class Evento
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($nombre_evento, $fecha_inicial, $fecha_final, $descripcion_evento, $imagen_evento, $total_cupos, $precio, $tel_contacto, $id_organizador, $id_sede, $id_servicio)
    {
        $sql2 = "INSERT INTO eventos(nombre_evento, fecha_inicial, fecha_final, descripcion_evento, imagen_evento, total_cupos, cupos_disp, precio, tel_contacto, id_organizador, estado_evento, id_sede, id_servicio )                
               values(:nombre_evento,:fecha_inicial,:fecha_final,:descripcion_evento, :imagen_evento,:total_cupos,:total_cupos,:precio,:tel_contacto,:id_organizador,'Activo',:id_sede,:id_servicio)";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':nombre_evento' => $nombre_evento, ':fecha_inicial' => $fecha_inicial, ':fecha_final' => $fecha_final, ':descripcion_evento' => $descripcion_evento, ':imagen_evento' => $imagen_evento, ':total_cupos' => $total_cupos, ':precio' => $precio, ':tel_contacto' => $tel_contacto, ':id_organizador' => $id_organizador, ':id_sede' => $id_sede, ':id_servicio' => $id_servicio))) {
            echo 'edit';
        } else {
            echo 'Error al registrar el evento';
        }
    }

    function buscar_datos()
    {
        $id_sede = $_POST['id_sede'];
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT E.id, E.nombre_evento, E.fecha_inicial, E.fecha_final, E.descripcion_evento, E.imagen_evento, E.total_cupos, E.cupos_disp, E.precio, E.tel_contacto, E.imagen_evento, S.nombre_servicio, E.estado_evento FROM eventos E JOIN sedes R ON E.id_sede=R.id JOIN servicios S ON E.id_servicio=S.id WHERE (E.nombre_evento LIKE :consulta OR E.descripcion_evento LIKE :consulta) AND E.id_sede=$id_sede";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT E.id, E.nombre_evento, E.fecha_inicial, E.fecha_final, E.descripcion_evento, E.imagen_evento, E.total_cupos, E.cupos_disp, E.precio, E.tel_contacto, E.imagen_evento, S.nombre_servicio, E.estado_evento FROM eventos E JOIN sedes R ON E.id_sede=R.id JOIN servicios S ON E.id_servicio=S.id WHERE (E.nombre_evento NOT LIKE '') AND E.id_sede=$id_sede ORDER BY id";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function cargarEvento($id)
    {
        $sql = "SELECT E.id, E.nombre_evento, E.fecha_inicial, E.fecha_final, E.descripcion_evento, E.imagen_evento, E.total_cupos, E.cupos_disp, E.precio, E.tel_contacto, E.estado_evento, S.nombre_servicio, S.descripcion, R.nombre_region, E.id_servicio FROM eventos E JOIN servicios S ON E.id_servicio=S.id JOIN sedes R ON E.id_sede=R.id WHERE E.id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_evento($id, $nombre_evento, $fecha_inicial, $fecha_final, $descripcion_evento, $total_cupos, $precio, $tel_contacto, $id_servicio, $cupos_disp)
    {
        $sql = "UPDATE eventos SET nombre_evento=:nombre_evento, fecha_inicial=:fecha_inicial, fecha_final=:fecha_final, descripcion_evento=:descripcion_evento, total_cupos=:total_cupos, precio=:precio, tel_contacto=:tel_contacto, id_servicio=:id_servicio, cupos_disp=:cupos_disp  WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':nombre_evento' => $nombre_evento, ':fecha_inicial' => $fecha_inicial, ':fecha_final' => $fecha_final, ':descripcion_evento' => $descripcion_evento, ':total_cupos' => $total_cupos, ':precio' => $precio, ':tel_contacto' => $tel_contacto, ':id_servicio' => $id_servicio, ':cupos_disp' => $cupos_disp))) {
            echo 'update';
        } else {
            echo 'Error al actualizar el evento';
        }
    }

    function editar_imagen($id, $imagen_evento)
    {
        $sql = "SELECT imagen_evento FROM eventos WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();

        $sql = "UPDATE eventos SET imagen_evento=:imagen_evento WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id, ':imagen_evento' => $imagen_evento));
        return $this->objetos;
    }

    function changeEstadoEvento($id)
    {
        $sql = "SELECT id FROM eventos WHERE estado_evento='Activo' AND id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            $sql = "UPDATE eventos SET estado_evento='Inactivo' WHERE id=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id));
        } else {
            $sql = "UPDATE eventos SET estado_evento='Activo' WHERE id=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id));
        }
    }
}
