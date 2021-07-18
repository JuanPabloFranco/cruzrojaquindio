<?php
include_once '../Conexion/Conexion.php';
class Visita
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($id_visitante, $fecha_inicio, $fecha_fin, $id_servicio, $estado_visita, $create_at)
    {
        $sql2 = "INSERT INTO visitas(id_visitante, fecha_inicio, fecha_fin,id_servicio,estado_visita)                
               values(:id_visitante,:fecha_inicio,:fecha_fin,:id_servicio,'Terminada',:create_at)";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id_visitante' => $id_visitante, ':fecha_inicio' => $fecha_inicio, ':fecha_fin' => $fecha_fin, ':id_servicio' => $id_servicio, ':create_at' => $create_at))) {
            echo 'creado';
        } else {
            echo 'Error al registrar la visita';
        }
    }

    function buscar_visitas()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT V.id, V.fecha_inicio, V.fecha_fin, V.estado_visita, U.nombre_completo, U.cel_usuario, U.email_usuario, S.nombre_servicio, M.nombre AS municipio, D.nombre AS departamento, S.nombre_servicio FROM visitas V JOIN servicios S ON V.id_servicio=S.id JOIN usuario U ON V.id_visitante=U.id JOIN municipios M ON U.id_municipio=M.id JOIN departamentos D ON M.departamento_id=D.id WHERE (V.fecha_inicio LIKE :consulta OR U.nombre_completo LIKE :consulta OR S.nombre_servicio LIKE :consulta) ORDER BY V.fecha_inicio DESC";

            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT V.id, V.fecha_inicio, V.fecha_fin, V.estado_visita, U.nombre_completo, U.cel_usuario, U.email_usuario, S.nombre_servicio, M.nombre AS municipio, D.nombre AS departamento, S.nombre_servicio FROM visitas V JOIN servicios S ON V.id_servicio=S.id JOIN usuario U ON V.id_visitante=U.id JOIN municipios M ON U.id_municipio=M.id JOIN departamentos D ON M.departamento_id=D.id WHERE (fecha_inicio NOT LIKE '')  ORDER BY V.fecha_inicio DESC";

            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function editar_visita($id, $fecha_inicio, $fecha_fin)
    {
        $sql = "UPDATE visitas SET fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':fecha_inicio' => $fecha_inicio, ':fecha_fin' => $fecha_fin))) {
            echo 'update';
        } else {
            echo 'Error al actualizar la visita';
        }
    }

    function buscar_visita($id)
    {
        $sql = "SELECT V.fecha_inicio, V.fecha_fin, V.estado_visita, V.id_servicio, U.nombre_completo, U.doc_id FROM visitas V JOIN servicios S ON V.id_servicio=S.id JOIN usuario U ON V.id_visitante=U.id JOIN municipios M ON U.id_municipio=M.id JOIN departamentos D ON M.departamento_id=D.id WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function cambiar_estado($id, $estado)
    {
        $sql = "UPDATE visitas SET estado_visita=:estado WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':estado' => $estado))) {
            echo 'update';
        } else {
            echo 'Error al cambiar el estado';
        }
    }

    function eliminar_visita($id)
    {

        $sql2 = "DELETE FROM visitas WHERE id=:id";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id' => $id))) {
            echo 'update';
        } else {
            echo 'Error al eliminar la visita';
        }
    }

    function contar_visitas()
    {
        $sql = "SELECT COUNT(visitas.id) AS cantidad FROM visitas ";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function reporteGeneral()
    {
        $sql = "SELECT V.fecha_inicio, V.fecha_fin, V.estado_visita, U.nombre_completo, U.cel_usuario, U.email_usuario, S.nombre_servicio, M.nombre AS municipio, D.nombre AS departamento, S.nombre_servicio, N.GENTILICIO_NAC AS nacionalidad FROM visitas V JOIN servicios S ON V.id_servicio=S.id JOIN usuario U ON V.id_visitante=U.id JOIN municipios M ON U.id_municipio=M.id JOIN departamentos D ON M.departamento_id=D.id JOIN nacionalidad N ON U.id_nacionalidad=N.id ORDER BY V.fecha_inicio DESC";

        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function estadisticas()
    {
        $sql = "SELECT (SELECT COUNT(id) FROM visitas) AS registrados, 
        (SELECT COUNT(id) FROM visitas WHERE id_servicio=1) AS pasadia, 
        (SELECT COUNT(id) FROM visitas WHERE id_servicio=2) AS camping, 
        (SELECT COUNT(V.id) FROM visitas V JOIN usuario U ON V.id_visitante=U.id WHERE U.id_municipio=825) AS quindio, 
        (SELECT COUNT(V.id) FROM visitas V JOIN usuario U ON V.id_visitante=U.id WHERE U.id_municipio<>825 AND U.id_municipio<>1127) AS other,
        (SELECT COUNT(V.id) FROM visitas V JOIN usuario U ON V.id_visitante=U.id WHERE U.id_municipio<>825 AND U.id_nacionalidad<>43) AS extranjero
        FROM usuario GROUP BY registrados, pasadia, camping, quindio, other, extranjero";


        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
