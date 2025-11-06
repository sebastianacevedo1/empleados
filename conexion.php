<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDatos = "empleados";

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $clave);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

?>