<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sexo = $_POST['sexo'] ?? '';

    if ($sexo !== '') {
        try {
           
            $sql = "SELECT SUM(salario) AS total_nomina, COUNT(*) AS cantidad
                    FROM persona
                    WHERE sexo = :sexo";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->execute();
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);

            
            $_SESSION["resultado_nomina"] = [
                "sexo" => $sexo,
                "total" => $fila["total_nomina"] ?? 0,
                "cantidad" => $fila["cantidad"] ?? 0
            ];
        } catch (PDOException $e) {
            $_SESSION["resultado_nomina"] = [
                "sexo" => $sexo,
                "total" => 0,
                "cantidad" => 0,
                "error" => "Error al consultar la base de datos"
            ];
        }
    }
}

header("Location: GestionNomina.php");
exit();
?>
