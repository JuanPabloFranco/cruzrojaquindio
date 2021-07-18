<?php
include_once '../Conexion/Conexion.php';
class Reserva
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($id_visitante, $id_descuento, $fecha_inicio, $fecha_fin, $estado_reserva, $create_at)
    {
        $sql2 = "INSERT INTO reservas(id_visitante, id_descuento, fecha_inicio, fecha_fin, estado_reserva, create_at)                
               values(:id_visitante,:id_descuento,:fecha_inicio,:fecha_fin,:estado_reserva,:create_at)";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id_visitante' => $id_visitante, ':id_descuento' => $id_descuento, ':fecha_inicio' => $fecha_inicio, ':fecha_fin' => $fecha_fin, ':estado_reserva' => $estado_reserva, ':create_at' => $create_at,))) {
            echo 'creado';
        } else {
            echo 'Error al registrar la reserva';
        }
    }

    function buscar()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT R.fecha_inicio, R.fecha_fin, R.estado_reserva, D.nombre_descuento, D.descuento, R.valor_total FROM reservas R JOIN usuario U ON R.id_usuario=U.id JOIN descuentos D ON R.id_descuento WHERE (U.nombre_completo LIKE :consulta OR D.nombre_descuento LIKE :consulta OR U.tel_usuario LIKE :consulta) ORDER BY R.fecha_inicio DESC";

            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT R.fecha_inicio, R.fecha_fin, R.estado_reserva, D.nombre_descuento, D.descuento, R.valor_total FROM reservas R JOIN usuario U ON R.id_usuario=U.id JOIN descuentos D ON R.id_descuento WHERE (R.fecha_inicio NOT LIKE '')  ORDER BY R.fecha_inicio DESC";

            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function editar($id, $id_descuento, $fecha_inicio, $fecha_fin, $valor_total)
    {
        $sql = "UPDATE reservas SET id_descuento=:id_descuento, fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':id_descuento' => $id_descuento, ':fecha_inicio' => $fecha_inicio, ':fecha_fin' => $fecha_fin))) {
            echo 'update';
        } else {
            echo 'Error al actualizar la reserva';
        }
    }
    
    function completar($id, $id_visitante, $id_descuento, $fecha_inicio, $fecha_fin, $estado_reserva, $valor_total)
    {
        $sql = "UPDATE reservas SET id_visitante=:id_visitante, id_descuento=:id_descuento, fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin, valor_total=:valor_total, estado_reserva=:estado_reserva WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':id_visitante' => $id_visitante, ':id_descuento' => $id_descuento, ':fecha_inicio' => $fecha_inicio, ':fecha_fin' => $fecha_fin, ':estado_reserva' => $estado_reserva, ':valor_total' => $valor_total))) {
            echo 'update';
        } else {
            echo 'Error al completar la reserva';
        }
    }
    function cargar($id)
    {
        $sql = "SELECT R.fecha_inicio, R.fecha_fin, R.estado_reserva, D.nombre_descuento, D.descuento, R.valor_total, U.nombre_completo, U.doc_id, R.id_descuento, R.id_visitante FROM reservas R JOIN usuario U ON R.id_usuario=U.id JOIN descuentos D ON R.id_descuento WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function cambiar_estado($id, $estado_reserva)
    {
        $sql = "UPDATE reservas SET estado_reserva=:estado_reserva WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':estado_reserva' => $estado_reserva))) {
            echo 'update';
        } else {
            echo 'Error al cambiar el estado';
        }
    }

    function delete($id)
    {
        $sql2 = "DELETE FROM reservas WHERE id=:id";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id' => $id))) {
            echo 'update';
        } else {
            echo 'Error al eliminar la reserva';
        }
    }

    function count()
    {
        $sql = "SELECT COUNT(reservas.id) AS cantidad FROM reservas ";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function reporteGeneral()
    {
        $sql = "ORDER BY V.fecha_inicio DESC";

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
