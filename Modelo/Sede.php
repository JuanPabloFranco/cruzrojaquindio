<?php
include_once '../Conexion/Conexion.php';
class Sede
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function listaContactanos($id)
    {
        $sql = "SELECT nombre_sede, ciudad_sede, direccion_sede, tel_sede, email, wp_sede, facebook, instagram, twitter, youtube FROM sedes WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => "$id"));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function crear_sede($nombre, $ciudad, $direccion, $telefono, $email, $nit, $wp, $fb, $instagram, $twitter, $youtube)
    {
        $sql = "INSERT INTO sedes(nombre_sede,ciudad_sede,direccion_sede,tel_sede,email,wp_sede,nit,facebook,instagram,twitter,youtube, estado_sede) 
        VALUES(:nombre,:ciudad,:direccion,:telefono,:email,:wp,:nit,:fb,:instagram,:twitter,:youtube,'Activo')";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':nombre' => "$nombre", ':ciudad' => "$ciudad", ':direccion' => "$direccion", ':telefono' => "$telefono", ':email' => "$email", ':wp' => "$wp", ':nit' => "$nit", ':fb' => "$fb", ':instagram' => "$instagram", ':twitter' => "$twitter", ':youtube' => "$youtube"))) {
            echo 'creada';
        } else {
            echo 'noCreada';
        }
    }

    function buscar_datos()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM sedes WHERE nombre_sede LIKE :consulta";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM sedes WHERE nombre_sede NOT LIKE '' ORDER BY id ";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function cargarsede($id)
    {
        $sql = "SELECT * FROM sedes WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_sede($id, $nombre, $ciudad, $direccion, $telefono, $email, $wp, $nit, $fb, $instagram, $twitter, $youtube)
    {
        $sql = "UPDATE sedes SET nombre_sede=:nombre, ciudad_sede=:ciudad, direccion_sede=:direccion, tel_sede=:telefono, email=:email, wp_sede=:wp, nit=:nit, facebook=:fb, instagram=:instagram, twitter=:twitter, youtube=:youtube WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':nombre' => "$nombre", ':ciudad' => "$ciudad", ':direccion' => "$direccion", ':telefono' => "$telefono", ':email' => "$email", ':wp' => "$wp", ':nit' => "$nit", ':fb' => "$fb", ':instagram' => "$instagram", ':twitter' => "$twitter", ':youtube' => "$youtube"))) {
            echo 'update';
        } else {
            echo 'Error al actualizar la región';
        }
    }
    function changeEstadosede($id)
    {
        $sql = "SELECT id FROM sedes WHERE estado_sede='Activo' AND id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        if (!empty($this->objetos)) {
            $sql = "UPDATE sedes SET estado_sede='Inactivo' WHERE id=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id));
        } else {
            $sql = "UPDATE sedes SET estado_sede='Activo' WHERE id=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id' => $id));
        }
    }

    function cargarFb($id)
    {
        $sql = "SELECT facebook FROM sedes WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }
}
