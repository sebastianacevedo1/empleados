<?php
require_once "conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM persona WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);

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
