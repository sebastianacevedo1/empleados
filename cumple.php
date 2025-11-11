<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['mes'])) {

    require_once "conexion.php";
    $mes = $_POST['mes'];

    $sql = "SELECT cedula, primerNombre, primerApellido, fechaNacimiento 
            FROM persona 
            WHERE MONTH(fechaNacimiento) = :mes";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
    $stmt->execute();
    $cumplesMes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    $cumlesMes = []; // para evitar error si no se envía mes
}
