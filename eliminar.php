<?php
require_once "conexion.php";

if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    $sql = "DELETE FROM persona WHERE cedula = :cedula";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':cedula', $cedula);

    if ($stmt->execute()) {
        header("Location: listaempleados.php");
        exit();
    } else {
        echo "Error al eliminar";
    }

} else {
    echo "No llegó la cédula";
}
?>
