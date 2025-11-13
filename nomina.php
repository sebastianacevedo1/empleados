<?php
require_once "conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   
    if (isset($_POST["porcentaje"]) && $_POST["porcentaje"] !== '') {
        $porcentaje = $_POST["porcentaje"];

        if (!is_numeric($porcentaje) || $porcentaje <= 0) {
            header("Location: GestionNomina.php?msg=invalid");
            exit;
        }

        $factor = 1 + ($porcentaje / 100);

        try {
            $sql = "UPDATE persona SET salario = salario * :factor";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":factor", $factor);
            $stmt->execute();
            header("Location: GestionNomina.php?msg=ok");
            exit;
        } catch (PDOException $e) {
            header("Location: GestionNomina.php?msg=error");
            exit;
        }
    }

}

?>
