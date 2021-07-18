<?php
include_once '../Conexion/Conexion.php';
class Nota
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($id_autor, $tipo, $dirigido, $id_cargo, $id_sede, $id_usuario, $fechaini, $fechafin, $descripcion)
    {
        $sql2 = "INSERT INTO notas(id_autor, tipo_nota, dirigido, id_cargo, id_sede, id_usuario, fecha_ini, fecha_fin, descripcion_nota, imagen)                
               values(:id_autor,:tipo,:dirigido,:id_cargo,:id_sede,:id_usuario,:fechaini,:fechafin,:descripcion,'')";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id_autor' => $id_autor, ':tipo' => $tipo, ':dirigido' => $dirigido, ':id_cargo' => $id_cargo, ':id_sede' => $id_sede, ':id_usuario' => $id_usuario, ':fechaini' => $fechaini, ':fechafin' => $fechafin, ':descripcion' => $descripcion))) {
            echo 'creado';
        } else {
            echo 'Error al registrar la nota';
        }
    }

    function buscar_datos($id)
    {
        $sql = "SELECT * FROM notas WHERE id_autor=:id ORDER BY fecha_ini";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function cargarNota($id)
    {
        $autor = $_POST['id'];
        $sql = "SELECT * FROM notas WHERE id=$id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_nota($id, $tipo, $dirigido, $id_cargo, $id_sede, $id_usuario, $fechaini, $fechafin, $descripcion)
    {
        $sql = "UPDATE notas SET tipo_nota=:tipo, dirigido=:dirigido, id_cargo=:id_cargo, id_sede=:id_sede, id_usuario=:id_usuario, fecha_ini=:fecha_ini, fecha_fin=:fechafin, descripcion_nota=:descripcion WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':tipo' => "$tipo", ':dirigido' => "$dirigido", ':id_cargo' => $id_cargo, ':id_sede' => $id_sede, ':id_usuario' => $id_usuario, ':fecha_ini' => "$fechaini", ':fechafin' => "$fechafin", ':descripcion' => "$descripcion"))) {
            echo 'update';
        } else {
            echo 'Error al actualizar la nota';
        }
    }

    function cambiar_img($id, $img)
    {
        $sql = "SELECT imagen FROM notas WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();

        $sql = "UPDATE notas SET imagen=:img WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id, ':img' => $img));
        return $this->objetos;
    }

    function eliminarNota($id)
    {
        $sql = "DELETE FROM notas WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        return $this->objetos;
    }
}
