<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require_once "controlador/listaControlador.php";
$controlador = new listaControlador();
$controlador->manejar();
?>