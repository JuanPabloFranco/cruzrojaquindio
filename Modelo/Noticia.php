<?php
include_once '../Conexion/Conexion.php';
class Noticia
{
    var $objetos;
    public function __CONSTRUCT()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    function crear($fecha, $titulo, $encabezado, $texto, $id_sede)
    {
        $sql2 = "INSERT INTO posts(fecha, titulo, encabezado, texto, imagen, id_sede)                
               values(:fecha,:titulo,:encabezado,:texto,'',:id_sede)";
        $query2 = $this->acceso->prepare($sql2);
        if ($query2->execute(array(':fecha' => $fecha, ':titulo' => $titulo, ':encabezado' => $encabezado, ':texto' => $texto, ':id_sede' => $id_sede))) {
            echo 'creado';
        } else {
            echo 'Error al registrar la noticia';
        }
    }

    function buscar_datos()
    {
        $id_sede = $_POST['id_sede'];
        if (!empty($_POST['consulta'])) {
            $consulta = $_POST['consulta'];
            $sql = "SELECT * FROM posts WHERE id_sede=$id_sede AND (titulo LIKE :consulta OR encabezado LIKE :consulta OR texto LIKE :consulta)";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta' => "%$consulta%"));
            $this->objetos = $query->fetchall();
            return $this->objetos;
        } else {
            $sql = "SELECT * FROM posts WHERE id_sede=$id_sede AND (titulo NOT LIKE '') ORDER BY id";
            $query = $this->acceso->prepare($sql);
            $query->execute();
            $this->objetos = $query->fetchall();
            return $this->objetos;
        }
    }

    function cargarNoticia($id)
    {
        $sql = "SELECT * FROM posts WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();
        return $this->objetos;
    }

    function editar_noticia($id, $fecha, $titulo, $encabezado, $texto)
    {
        $sql = "UPDATE posts SET fecha=:fecha, titulo=:titulo, encabezado=:encabezado, texto=:texto WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':fecha' => "$fecha", ':titulo' => "$titulo", ':encabezado' => "$encabezado", ':texto' => "$texto"))) {
            echo 'update';
        } else {
            echo 'Error al actualizar la noticia';
        }
    }

    function agregar_imagen($id, $imagen)
    {
        $sql = "SELECT imagen FROM posts WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objetos = $query->fetchall();

        $sql = "UPDATE posts SET imagen=:imagen WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id, ':imagen' => "$imagen"))) {
            return $this->objetos;
        } else {
            echo 'Error';
        }
    }

    function eliminar_noticia($id)
    {
        $sql = "DELETE FROM posts WHERE id=:id";
        $query = $this->acceso->prepare($sql);
        if ($query->execute(array(':id' => $id))) {
            echo 'del';
        } else {
            echo 'Error al eliminar la noticia';
        }
    }
}
