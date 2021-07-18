<?php
include_once '../Conexion/Conexion.php';
class ParticipanteEvento
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($id_evento, $nombre_participante, $tipo_doc, $documento, $fec_nac_part, $telefono, $email, $tipo_sangre, $nacionalidad, $departamento_res, $municipio_res, $eps, $fecha_inscripcion)
    {
        $sql = "INSERT INTO participantes_evento(id_evento, nombre_participante, tipo_doc, documento, fec_nac_part, telefono, email, tipo_sangre, nacionalidad, departamento_res, municipio_res, eps, fecha_inscripcion, estado )                
               VALUES(:id_evento,:nombre_participante,:tipo_doc,:documento, :fec_nac_part, :telefono,:email,:tipo_sangre,:nacionalidad,:departamento_res,:municipio_res,:eps,:fecha_inscripcion, 'Inscrito')";

        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id_evento' => $id_evento, ':nombre_participante' => $nombre_participante, ':tipo_doc' => $tipo_doc, ':documento' => $documento, ':fec_nac_part' => $fec_nac_part, ':telefono' => $telefono, ':email' => $email, ':tipo_sangre' => $tipo_sangre, ':nacionalidad' => $nacionalidad, ':departamento_res' => $departamento_res, ':municipio_res' => $municipio_res, ':eps' => $eps, ':fecha_inscripcion' => $fecha_inscripcion))) {
            $sql2 = "UPDATE eventos SET cupos_disp=cupos_disp-1 WHERE id=:id_evento";
            $query2 = $this->acceso->prepare($sql2);
            if ($query2->execute(array(':id_evento' => $id_evento))) {
                echo 'registrado';
            } else {
                echo 'Error al restar el cupo';
            }
        } else {
            echo 'Error al registrar el participante';
        }
    }

    function listar()
    {
        $id_evento = $_POST['id_evento'];
        $sql = "SELECT P.id, P.nombre_participante, P.tipo_doc, P.documento, P.telefono, P.email, P.tipo_sangre, P.nacionalidad, P.departamento_res, P.municipio_res, P.eps, P.fecha_inscripcion, P.estado FROM participantes_evento P WHERE P.id_evento=$id_evento ORDER BY P.fecha_inscripcion ASC";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function cargarParticipante($id)
    {
        $sql = "SELECT P.nombre_participante, P.tipo_doc, P.documento, P.telefono, P.email, P.tipo_sangre, P.nacionalidad, P.departamento_res, P.municipio_res, P.eps, P.fecha_inscripcion, P.estado, P.fec_nac_part FROM participantes_evento P WHERE P.id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function contarParticipante($id_evento)
    {
        $sql = "SELECT count(id) AS cantidad FROM participantes_evento P WHERE P.id_evento=:id_evento";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_evento' => $id_evento));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_estado($id, $estado, $id_evento)
    {
        if ($estado == 'Eliminar') {
            $sql = "DELETE FROM participantes_evento WHERE id=:id";
            $query = $this->acceso->prepare($sql);
            if ($query->execute(array(':id' => $id))) {
                $sql2 = "UPDATE eventos SET cupos_disp=cupos_disp+1 WHERE id=:id_evento";
                $query2 = $this->acceso->prepare($sql2);
                if ($query2->execute(array(':id_evento' => $id_evento))) {
                    echo 'update';
                } else {
                    echo 'Error al restablecer el cupo';
                }
            } else {
                echo 'Error al eliminar el participante';
            }
        } else {
            $sql = "UPDATE participantes_evento SET estado=:estado WHERE id=:id";
            $query = $this->acceso->prepare($sql);
            if ($query->execute(array(':id' => $id, ':estado' => $estado))) {
                if ($estado == "Cancelado") {
                    $sql2 = "UPDATE eventos SET cupos_disp=cupos_disp+1 WHERE id=:id_evento";
                    $query2 = $this->acceso->prepare($sql2);
                    if ($query2->execute(array(':id_evento' => $id_evento))) {
                        echo 'update';
                    } else {
                        echo 'Error al restablecer el cupo';
                    }
                } else {
                    echo 'update';
                }
            } else {
                echo 'Error al actualizar el evento';
            }
        }
    }
}
