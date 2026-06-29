<?php
class Conexion {
    public static function conectar() {
        $host = "";
        $db = "";
        $user = "";
        $pass = "";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            return $pdo;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>
