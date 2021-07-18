<?php
include_once '../Conexion/Conexion.php';
class Esal
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function listaEsalCol($ano)
    {
        $sql = "SELECT nombre, ano, archivo FROM esal WHERE id_sede=1 AND ano=$ano";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function listaEsalReg($ano, $region)
    {
        $sql = "SELECT nombre, ano, archivo FROM esal WHERE id_sede=$region AND ano=$ano";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function crear($id_sede, $nombre, $ano, $archivo)
    {
        $sql = "INSERT INTO esal(id_sede, nombre, ano, archivo)                
        values(:id_sede, :nombre, :ano, :archivo)";
        $query2 = $this->acceso->prepare($sql);
        if ($query2->execute(array(':id_sede' => $id_sede, ':nombre' => "$nombre", ':ano' => $ano, ':archivo' => "$archivo"))) {
            echo 'subido';
        } else {
            echo 'Error al registrar el archivo';
        }
    }

    function buscar_datos()
    {
        $id = $_POST['id'];
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM esal WHERE id_sede=:id AND (nombre LIKE :consulta OR ano LIKE :consulta ) ";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%", ':id' => $id));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM esal WHERE id_sede=:id AND (nombre NOT LIKE '' OR nombre NOT LIKE 'null')  ORDER BY id LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function cargarFoto($id)
    {
        $sql = "SELECT * FROM esal WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_esal($id, $nombre, $ano)
    {
        $sql = "UPDATE esal SET nombre=:nombre, ano=:ano WHERE id=:id";
        $query2 = $this->acceso->prepare($sql);
        if ($query2->execute(array(':id' => $id, ':nombre' => "$nombre", ':ano' => $ano))) {
            echo 'update';
        } else {
            echo 'Error al actualizar el archivo ';
        }
    }
    function eliminar_imagen($id)
    {
        $sql = "DELETE FROM esal WHERE id=:id";
        $query2 = $this->acceso->prepare($sql);
        $query2->execute(array(':id' => $id));
    }
}
