<?php
include_once '../Conexion/Conexion.php';
class Contacto
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($id_sede, $nombre_cto, $tel_cto, $email_cto, $dir_cto, $municipio, $depto_cto, $web_cto, $tipo_cto, $notas)
    {
        $sql2 = "INSERT INTO contactos(id_sede, nombre_cto, tel_cto,email_cto,dir_cto,municipio,depto_cto,web_cto,tipo_cto,notas,logo_cto)                
               values(:id_sede,:nombre_cto,:tel_cto,:email_cto,:dir_cto,:municipio,:depto_cto,:web_cto,:tipo_cto,:notas,'contacto_default.png')";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':id_sede' => $id_sede, ':nombre_cto' => $nombre_cto, ':tel_cto' => $tel_cto, ':email_cto' => $email_cto, ':dir_cto' => $dir_cto, ':municipio' => $municipio, ':depto_cto' => $depto_cto, ':web_cto' => $web_cto, ':tipo_cto' => $tipo_cto, ':notas' => $notas))) {
            echo 'creado';
        } else {
            echo 'Error al registrar el contacto';
        }
    }

    function buscar_datos()
    {

        $id_sede = $_POST['id_sede'];
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            if ($_POST['cobertura'] == 'Full') {
                $sql = "SELECT C.id, C.nombre_cto, C.tel_cto, C.email_cto, C.dir_cto, C.municipio, C.depto_cto, C.web_cto, C.logo_cto, C.tipo_cto, C.notas, S.nombre_sede FROM contactos C JOIN sedes S ON C.id_sede=S.id WHERE (C.nombre_cto LIKE :consulta OR C.tel_cto LIKE :consulta OR C.municipio LIKE :consulta OR C.depto_cto LIKE :consulta OR C.notas LIKE :consulta) ";
            } else {
                $sql = "SELECT C.id, C.nombre_cto, C.tel_cto, C.email_cto, C.dir_cto, C.municipio, C.depto_cto, C.web_cto, C.logo_cto, C.tipo_cto, C.notas, S.nombre_sede FROM contactos C JOIN sedes S ON C.id_sede=S.id WHERE id_sede=$id_sede AND (C.nombre_cto LIKE :consulta OR C.tel_cto LIKE :consulta OR C.municipio LIKE :consulta OR C.depto_cto LIKE :consulta OR C.notas LIKE :consulta) ";
            }
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            if ($_POST['cobertura'] == 'Full') {
                $sql = "SELECT C.id, C.nombre_cto, C.tel_cto, C.email_cto, C.dir_cto, C.municipio, C.depto_cto, C.web_cto, C.logo_cto, C.tipo_cto, C.notas, S.nombre_sede FROM contactos C JOIN sedes S ON C.id_sede=S.id WHERE (C.nombre_cto NOT LIKE '') ORDER BY nombre_cto";
            } else {
                $sql = "SELECT C.id, C.nombre_cto, C.tel_cto, C.email_cto, C.dir_cto, C.municipio, C.depto_cto, C.web_cto, C.logo_cto, C.tipo_cto, C.notas, S.nombre_sede FROM contactos C JOIN sedes S ON C.id_sede=S.id WHERE (C.nombre_cto NOT LIKE '') AND id_sede=$id_sede ORDER BY nombre_cto";
            }
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function cargarContacto($id)
    {
        $sql = "SELECT * FROM contactos WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_contacto($id, $nombre_cto, $tel_cto, $email_cto, $dir_cto, $municipio, $depto_cto, $web_cto, $tipo_cto, $notas)
    {
        $sql = "UPDATE contactos SET nombre_cto=:nombre_cto, tel_cto=:tel_cto, email_cto=:email_cto, dir_cto=:dir_cto, municipio=:municipio, depto_cto=:depto_cto, web_cto=:web_cto, tipo_cto=:tipo_cto, notas=:notas WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':nombre_cto' => "$nombre_cto", ':tel_cto' => "$tel_cto", ':email_cto' => "$email_cto", ':dir_cto' => "$dir_cto", ':municipio' => "$municipio", ':depto_cto' => "$depto_cto", ':web_cto' => "$web_cto", ':tipo_cto' => "$tipo_cto", ':notas' => "$notas"))) {
            echo 'update';
        } else {
            echo 'Error al actualizar el contacto';
        }
    }

    function cambiar_logo($id, $logo)
    {
        $sql = "SELECT logo_cto FROM contactos WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();

        $sql = "UPDATE contactos SET logo_cto=:logo WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id, ':logo' => $logo));
        return $this->objetos;
    }

    function eliminar_contacto($id)
    {
        $sql = "DELETE FROM contactos WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        return $this->objetos;
    }
}
