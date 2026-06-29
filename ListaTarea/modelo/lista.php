<?php

require_once "conexion/conexion.php";

class lista{
    private $conexion;

    public function __construct(){
        $this->conexion = Conexion::conectar();
    }

    public function verTodo(){
        $stmt = $this->conexion->prepare("SELECT * FROM lista");
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);        
        return $resultado ?: [];
    }
    public function eliminar($id){
        $stmt = $this->conexion->prepare("DELETE FROM lista WHERE id = ? ");
        return $stmt->execute([$id]);
    } 

    public function agregar($proyecto, $descripcion){
        $stmt = $this->conexion->prepare("INSERT INTO lista (proyecto, descripcion) VALUES(?, ?)");
        return $stmt->execute([$proyecto, $descripcion]);
    } 

    public function obtenerPorId($id){
        $stmt = $this->conexion->prepare("SELECT * FROM lista WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $proyecto, $descripcion){
        $stmt = $this->conexion->prepare("UPDATE lista SET proyecto = ?, descripcion = ? WHERE id = ?");
        return $stmt->execute([$proyecto, $descripcion, $id]); 
    } 
}