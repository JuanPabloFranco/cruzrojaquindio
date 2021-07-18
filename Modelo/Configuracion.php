<?php
include_once '../Conexion/Conexion.php';
class Configuracion
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function cargarInformacion()
    {
        $sql = "SELECT * FROM configuracion";
        $query = $this->acceso->prepare($sql);
        $query->execute();
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function guardarDatosBasicos($nombre, $texto, $mision, $vision)
    {
        $sql = "UPDATE configuracion SET nombre=:nombre, texto=:texto, mision=:mision, vision=:vision";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':nombre' => $nombre, ':texto' => $texto, ':mision' => $mision, ':vision' => $vision))) {
            echo 'update';
        } else {
            echo 'Error al actualizar la información';
        }
    }
    function guardarDatosAlternativos($titulo, $texto2)
    {
        $sql = "UPDATE configuracion SET titulo=:titulo, texto2=:texto2";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':titulo' => $titulo, ':texto2' => $texto2))) {
            echo 'update';
        } else {
            echo 'Error al actualizar la información';
        }
    }
    function guardarImagen1($imagen1)
    {
        $sql = "UPDATE configuracion SET imagen1=:imagen1";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':imagen1' => $imagen1))) {
            echo 'update';
        } else {
            echo 'Error al actualizar la información';
        }
    }
    function guardarImagen2($imagen2)
    {
        $sql = "UPDATE configuracion SET imagen2=:imagen2";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':imagen2' => $imagen2))) {
            echo 'update';
        } else {
            echo 'Error al actualizar la información';
        }
    }
    function eliminarImagen1()
    {
        $sql = "UPDATE configuracion SET imagen1=''";
        $query = $this->acceso->prepare($sql);
        if ($query->execute()) {
            echo 'update';
        } else {
            echo 'Error al actualizar la información';
        }
    }
    function eliminarImagen2()
    {
        $sql = "UPDATE configuracion SET imagen2=''";
        $query = $this->acceso->prepare($sql);
        if ($query->execute()) {
            echo 'update';
        } else {
            echo 'Error al actualizar la información';
        }
    }
}
