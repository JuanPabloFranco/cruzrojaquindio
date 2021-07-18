<?php
include_once '../Conexion/Conexion.php';
class Cargo
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function buscar_datos()
    {
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM cargo WHERE nombre_cargo LIKE :consulta AND id<>1";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM cargo WHERE nombre_cargo NOT LIKE '' AND id<>1 ORDER BY nombre_cargo LIMIT 25";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function cargarCargo($id)
    {
        $sql = "SELECT * FROM cargo WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_cargo($id, $nombre_cargo, $cobertura, $descr, $adm, $sedes, $servicios, $galeria, $esal, $noticias, $eventos, $usuarios, $msj_contacto, $agenda, $notas, $reservas, $visitas, $visitantes, $promociones)
    {
        $sql = "UPDATE cargo SET nombre_cargo=:nombre_cargo, cobertura=:cobertura, descripcion=:descr, adm=:adm, sedes=:sedes, servicios=:servicios, galeria=:galeria, esal=:esal, noticias=:noticias, eventos=:eventos, usuarios=:usuarios, msj_contacto=:msj_contacto, agenda=:agenda, notas=:notas,
        reservas=:reservas, visitas=:vistas, visitantes=:visitantes, promociones=:promociones WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':nombre_cargo' => $nombre_cargo, ':cobertura' => $cobertura, ':adm' => $adm, ':sedes' => $sedes, ':servicios' => $servicios, ':galeria' => $galeria, ':esal' => $esal, ':noticias' => $noticias, ':eventos' => $eventos, ':usuarios' => $usuarios, ':msj_contacto' => $msj_contacto, ':agenda' => $agenda, ':notas' => $notas, ':descr' => $descr, ':reservas' => $reservas, ':visitas' => $visitas, ':visitantes' => $visitantes, ':promociones' => $promociones))) {
            echo 'update';
        } else {
            echo 'Error al actualizar el cargo';
        }
    }

    function crear_cargo($nombre_cargo, $cobertura, $descripcion, $adm, $sedes, $servicios, $galeria, $esal, $noticias, $eventos, $usuarios, $msj_contacto, $agenda, $notas, $reservas, $visitas, $visitantes, $promociones)
    {
        $sql = "INSERT INTO cargo(nombre_cargo, descripcion, cobertura, adm, sedes, servicios, galeria, esal, noticias, eventos, usuarios, msj_contacto, agenda, notas, visitantes, reservas, visitas, promociones, estado_cargo) 
        VALUES (:nombre_cargo, :descripcion, :cobertura, :adm, :sedes, :servicios, :galeria, :esal, :noticias, :eventos, :usuarios, :msj_contacto, :agenda, :notas, :visitantes, :reservas, :visitas, :promociones, 'Activo')";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':nombre_cargo' => $nombre_cargo, ':cobertura' => $cobertura, ':adm' => $adm, ':sedes' => $sedes, ':servicios' => $servicios, ':galeria' => $galeria, ':esal' => $esal, ':noticias' => $noticias, ':eventos' => $eventos, ':usuarios' => $usuarios, ':msj_contacto' => $msj_contacto, ':agenda' => $agenda, ':notas' => $notas, ':descripcion' => $descripcion, ':reservas' => $reservas, ':visitas' => $visitas, ':visitantes' => $visitantes, ':promociones' => $promociones))) {
            echo 'create';
        } else {
            echo 'Error al crear el cargo';
        }
    }

    function cambiar_estado($id, $estado_cargo)
    {        
        if($estado_cargo=="Activo"){
                $estado_cargo = "Inactivo";
        }else{
            $estado_cargo = "Activo";
        }
        $sql = "UPDATE cargo SET estado_cargo=:estado_cargo WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':estado_cargo' => $estado_cargo))) {
            echo 'update';
        } else {
            echo 'Error al cambiar el estado del cargo';
        }
    }
}
