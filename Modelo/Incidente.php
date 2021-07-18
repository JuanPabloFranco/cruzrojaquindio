<?php
include_once '../Conexion/Conexion.php';
class Incidente
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear(
        $id_voluntario,
        $id_region,
        $fecha_creacion,
        $fecha,
        $hora,
        $evento,
        $tipo,
        $departamento,
        $municipio,
        $direccion,
        $cant_personal,
        $personal,
        $afectado,
        $heridos,
        $desaparecidos,
        $muertos,
        $lesionados,
        $traslado,
        $quien_traslado,
        $viviendas_averiadas,
        $viviendas_destruidas,
        $familias_afectadas,
        $otros,
        $observaciones
    ) {
        $sql2 = "INSERT INTO incidentes(id_voluntario, id_region, fecha_creacion, estado, fecha, hora, evento, tipo, departamento, municipio, direccion, cant_personal, personal, afectado, heridos, desaparecidos, muertos, lesionados, traslado, quien_traslado, viviendas_averiadas, viviendas_destruidas, familias_afectadas, otros, observaciones)                
               values(:id_voluntario,:id_region,:fecha_creacion,'Nuevo',:fecha,:hora,:evento,:tipo, :departamento, :municipio,:direccion,:cant_personal,:personal,:afectado,:heridos,:desaparecidos,:muertos,:lesionados,:traslado,:quien_traslado, :viviendas_averiadas, :viviendas_destruidas,:familias_afectadas,:otros,:observaciones)";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(
            ':id_voluntario' => $id_voluntario, ':id_region' => $id_region, ':fecha_creacion' => $fecha_creacion, ':fecha' => $fecha, ':hora' => $hora,
            ':evento' => $evento, ':tipo' => $tipo, ':departamento' => $departamento, ':municipio' => $municipio, ':direccion' => $direccion, ':cant_personal' => $cant_personal, ':personal' => $personal, ':afectado' => $afectado,
            ':heridos' => $heridos, ':desaparecidos' => $desaparecidos, ':muertos' => $muertos, ':lesionados' => $lesionados, ':traslado' => $traslado, ':quien_traslado' => $quien_traslado, ':viviendas_averiadas' => $viviendas_averiadas, ':viviendas_destruidas' => $viviendas_destruidas,
            ':familias_afectadas' => $familias_afectadas, ':otros' => $otros, ':observaciones' => $observaciones
        ))) {
            echo 'creado';
        } else {
            echo 'Error al registrar el incidente';
        }
    }

    function buscar_datos($id_region, $id_cargo)
    {
        if ($id_cargo <= 7) {
            if (!empty($_POST['consulta'])) {
                $consulta = $_POST['consulta'];
                $sql = "SELECT * FROM incidentes I JOIN regiones R ON I.id_region=R.id WHERE (I.evento LIKE :consulta OR I.tipo LIKE :consulta OR I.municipio LIKE :consulta OR R.nombre_region LIKE :consulta) ORDER BY I.estado ASC, I.fecha DESC";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':consulta' => "%$consulta%"));
                $this->objetos = $query->fetchall();
                return $this->objetos;
            } else {
                $sql = "SELECT * FROM incidentes I JOIN regiones R ON I.id_region=R.id WHERE (evento NOT LIKE '') ORDER BY I.estado ASC, I.fecha DESC";
                $query = $this->acceso->prepare($sql);
                $query->execute();
                $this->objetos = $query->fetchall();
                return $this->objetos;
            }
        } else {
            if (!empty($_POST['consulta'])) {
                $consulta = $_POST['consulta'];
                $sql = "SELECT I.id, R.nombre_region, I.estado, I.fecha, I.hora, I.evento, I.tipo, I.departamento, I.municipio, I.direccion FROM incidentes I JOIN regiones R ON I.id_region=R.id WHERE I.id_region=$id_region AND (I.evento LIKE :consulta OR I.tipo LIKE :consulta OR I.municipio LIKE :consulta OR R.nombre_region LIKE :consulta) ORDER BY I.fecha DESC";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':consulta' => "%$consulta%"));
                $this->objetos = $query->fetchall();
                return $this->objetos;
            } else {
                $sql = "SELECT I.id, R.nombre_region, I.estado, I.fecha, I.hora, I.evento, I.tipo, I.departamento, I.municipio, I.direccion FROM incidentes I JOIN regiones R ON I.id_region=R.id WHERE I.id_region=$id_region AND (evento NOT LIKE '') ORDER BY I.id, I.fecha DESC";
                $query = $this->acceso->prepare($sql);
                $query->execute();
                $this->objetos = $query->fetchall();
                return $this->objetos;
            }
        }
    }

    function cargarIncidente($id)
    {
        $sql = "SELECT I.id, V.nombre_completo, R.nombre_region, I.estado, I.evento, I.tipo, I.municipio, I.direccion, I.cant_personal, I.personal, I.afectado, I.heridos, I.desaparecidos, I.muertos, I.lesionados, I.traslado, I.quien_traslado, I.viviendas_averiadas, I.viviendas_destruidas, I.familias_afectadas, I.otros, I.observaciones, 
        I.fecha, I.hora, I.departamento FROM incidentes I JOIN voluntarios V ON I.id_voluntario=V.id JOIN regiones R on I.id_region=R.id WHERE I.id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_incidente(
        $id,
        $fecha,
        $hora,
        $evento,
        $tipo,
        $departamento,
        $municipio,
        $direccion,
        $cant_personal,
        $personal,
        $afectado,
        $heridos,
        $desaparecidos,
        $muertos,
        $lesionados,
        $traslado,
        $quien_traslado,
        $viviendas_averiadas,
        $viviendas_destruidas,
        $familias_afectadas,
        $otros,
        $observaciones
    ) {
        $sql = "UPDATE incidentes SET fecha=:fecha, hora=:hora, evento=:evento, tipo=:tipo, departamento=:departamento, municipio=:municipio, direccion=:direccion, cant_personal=:cant_personal, personal=:personal, afectado=:afectado, heridos=:heridos, desaparecidos=:desaparecidos, muertos=:muertos, lesionados=:lesionados,
        traslado=:traslado, quien_traslado=:quien_traslado, viviendas_averiadas=:viviendas_averiadas, viviendas_destruidas=:viviendas_destruidas, familias_afectadas=:familias_afectadas, otros=:otros, observaciones=:observaciones  WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(
            ':id' => $id, ':fecha' => $fecha, ':hora' => $hora, ':evento' => $evento, ':tipo' => $tipo, ':departamento' => $departamento, ':municipio' => $municipio, ':direccion' => $direccion, ':cant_personal' => $cant_personal, ':personal' => $personal, ':afectado' => $afectado,
            ':heridos' => $heridos, ':desaparecidos' => $desaparecidos, ':muertos' => $muertos, ':lesionados' => $lesionados, ':traslado' => $traslado, ':quien_traslado' => $quien_traslado, ':viviendas_averiadas' => $viviendas_averiadas, ':viviendas_destruidas' => $viviendas_destruidas,
            ':familias_afectadas' => $familias_afectadas, ':otros' => $otros, ':observaciones' => $observaciones
        ))) {
            echo 'update';
        } else {
            echo 'Error al actualizar el incidente';
        }
    }

    function cambiar_estado($id)
    {
        $sql = "UPDATE incidentes SET estado='Verificado' WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id))) {
            echo 'change';
        } else {
            echo 'Error';
        }
    }
    function estadisticas($id_region, $id_cargo)
    {
        if ($id_cargo <= 7) {
            $sql = "SELECT (SELECT COUNT(id) FROM incidentes) AS registrados, 
               (SELECT COUNT(id) FROM incidentes WHERE estado='Nuevo') AS nuevos, 
               (SELECT COUNT(id) FROM incidentes WHERE estado='Verificado') AS verificados, 
               (SELECT SUM(incidentes.cant_personal) FROM incidentes WHERE estado='Verificado') AS personal,
               (SELECT SUM(incidentes.heridos) FROM incidentes WHERE estado='Verificado') AS heridos,
               (SELECT SUM(incidentes.desaparecidos) FROM incidentes WHERE estado='Verificado') AS desaparecidos,
               (SELECT SUM(incidentes.lesionados) FROM incidentes WHERE estado='Verificado') AS lesionados,
               (SELECT SUM(incidentes.muertos) FROM incidentes WHERE estado='Verificado') AS muertos,
               (SELECT SUM(incidentes.viviendas_averiadas) FROM incidentes WHERE estado='Verificado') AS averiadas,
               (SELECT SUM(incidentes.viviendas_destruidas) FROM incidentes WHERE estado='Verificado') AS destruidas,
               (SELECT SUM(incidentes.familias_afectadas) FROM incidentes WHERE estado='Verificado') AS familias
               FROM incidentes GROUP BY registrados, nuevos, verificados, personal, heridos, desaparecidos, lesionados, muertos, averiadas, destruidas, familias";
        } else {
            $sql = "SELECT (SELECT COUNT(id) FROM incidentes WHERE id_region=$id_region) AS registrados, 
               (SELECT COUNT(id) FROM incidentes WHERE estado='Nuevo' AND id_region=$id_region) AS nuevos, 
               (SELECT COUNT(id) FROM incidentes WHERE estado='Verificado' AND id_region=$id_region) AS verificados, 
               (SELECT SUM(incidentes.cant_personal) FROM incidentes WHERE estado='Verificado' AND id_region=$id_region) AS personal,
               (SELECT SUM(incidentes.heridos) FROM incidentes WHERE estado='Verificado' AND id_region=$id_region) AS heridos,
               (SELECT SUM(incidentes.desaparecidos) FROM incidentes WHERE estado='Verificado' AND id_region=$id_region) AS desaparecidos,
               (SELECT SUM(incidentes.lesionados) FROM incidentes WHERE estado='Verificado' AND id_region=$id_region) AS lesionados,
               (SELECT SUM(incidentes.muertos) FROM incidentes WHERE estado='Verificado' AND id_region=$id_region) AS muertos,
               (SELECT SUM(incidentes.viviendas_averiadas) FROM incidentes WHERE estado='Verificado' AND id_region=$id_region) AS averiadas,
               (SELECT SUM(incidentes.viviendas_destruidas) FROM incidentes WHERE estado='Verificado' AND id_region=$id_region) AS destruidas,
               (SELECT SUM(incidentes.familias_afectadas) FROM incidentes WHERE estado='Verificado' AND id_region=$id_region) AS familias
               FROM incidentes GROUP BY registrados, nuevos, verificados, personal, heridos, desaparecidos, lesionados, muertos, averiadas, destruidas, familias";
        }
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function estadisticasRegiones()
    {
        $sql = "SELECT COUNT(I.id) AS cantidad, R.nombre_region FROM incidentes I JOIN regiones R ON I.id_region=R.id GROUP BY R.nombre_region ORDER BY FIELD (R.nombre_region,'Colombia') DESC, R.nombre_region ASC";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
