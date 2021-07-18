<?php
class Conexion{
    private $servidor = "localhost";
    private $db = "hdagolondrinas";
    private $puerto = "3306";
    private $charset = "utf8";
    private $user = "root";
    private $pass = "";

    private $atributos = [PDO::ATTR_CASE=>PDO::CASE_LOWER,
    PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_ORACLE_NULLS=>PDO::NULL_EMPTY_STRING,
    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];
    public $pdo = null;

    function __CONSTRUCT(){
        $this->pdo = new PDO("mysql:dbname={$this->db};host={$this->servidor};port={$this->puerto};charset={$this->charset}",$this->user,$this->pass,$this->atributos);
    }
}
?>