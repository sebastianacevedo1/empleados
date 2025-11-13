<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opcion = $_POST["opcion"] ?? "";

    try {
        $resultado = "";
        $titulo = "";

        // Promedio general
        $promQuery = $conexion->query("SELECT AVG(salario) AS promedio FROM persona");
        $promedio = $promQuery->fetch(PDO::FETCH_ASSOC)["promedio"];

        switch ($opcion) {
            case "promediomas":
                $titulo = "Empleados que ganan más del salario promedio (" . number_format($promedio, 0, ',', '.') . ")";
                $stmt = $conexion->prepare("SELECT primerNombre, segundoApellido, cargo, salario FROM persona WHERE salario > :promedio");
                $stmt->bindParam(":promedio", $promedio);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                break;

            case "promediomenos":
                $titulo = "Empleados que ganan menos del salario promedio (" . number_format($promedio, 0, ',', '.') . ")";
                $stmt = $conexion->prepare("SELECT primerNombre, segundoApellido, cargo, salario FROM persona WHERE salario < :promedio");
                $stmt->bindParam(":promedio", $promedio);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                break;

            case "maximo":
                $titulo = "Empleado que más gana";
                $stmt = $conexion->query("SELECT primerNombre, segundoApellido, cargo, salario FROM persona ORDER BY salario DESC LIMIT 1");
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                break;

            case "minimo":
                $titulo = "Empleado que menos gana";
                $stmt = $conexion->query("SELECT primerNombre, segundoApellido, cargo, salario FROM persona ORDER BY salario ASC LIMIT 1");
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                break;

            case "mayorMinimo":
                $titulo = "Empleados que ganan más del salario mínimo (1.400.000)";
                $minimo = 1400000;
                $stmt = $conexion->prepare("SELECT primerNombre, segundoApellido, cargo, salario FROM persona WHERE salario > :minimo");
                $stmt->bindParam(":minimo", $minimo);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                break;

            default:
                $_SESSION["estadistica"] = ["error" => "No seleccionaste ninguna opción."];
                header("Location: GestionNomina.php");
                exit;
        }

        $_SESSION["estadistica"] = [
            "titulo" => $titulo,
            "resultado" => $resultado
        ];
    } catch (PDOException $e) {
        $_SESSION["estadistica"] = ["error" => "Error al obtener estadísticas: " . $e->getMessage()];
    }

    header("Location: GestionNomina.php");
    exit;
}
?>
