<?php
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $cedula = $_POST["cedula"];
    $nombre1 = $_POST["nombre1"];
    $nombre2 = $_POST["nombre2"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $sexo = $_POST["sexo"];
    $nacimiento = $_POST["nacimiento"];
    $domicilio = $_POST["domicilio"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $ingreso = $_POST["ingreso"];
    $cargo = $_POST["cargo"];
    $sueldo = $_POST["sueldo"];

    $sql = "UPDATE persona SET
        cedula = ?,
        primerNombre = ?,
        segundoNombre = ?,
        primerApellido = ?,
        segundoApellido = ?,
        sexo = ?,
        fechaNacimiento = ?,
        direccion = ?,
        telefono = ?,
        email = ?,
        fechaContratacion = ?,
        cargo = ?,
        salario = ?
        WHERE id = ?";

    $stmt = $conexion->prepare($sql);
    $result = $stmt->execute([
        $cedula,
        $nombre1,
        $nombre2,
        $apellido1,
        $apellido2,
        $sexo,
        $nacimiento,
        $domicilio,
        $tel,
        $email,
        $ingreso,
        $cargo,
        $sueldo,
        $id
    ]);

    if ($result) {
        echo "<script>alert('Empleado actualizado correctamente'); window.location='listaempleados.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar'); window.history.back();</script>";
    }

}
?>
