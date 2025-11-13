<?php 
require_once "conexion.php"; 

    $cedula = $_POST["cedula"];
    $nombre1 = $_POST["nombre1"];
    $nombre2 = $_POST["nombre2"];
    $apellido1 = $_POST["apellido1"];
    $apellido2 = $_POST["apellido2"];
    $sexo = $_POST["sexo"];
    $nacimiento = $_POST["nacimiento"];
    $residencia = $_POST["domicilio"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $ingreso = $_POST["ingreso"];
    $cargo = $_POST["cargo"];
    $sueldo = $_POST["sueldo"];

    $sql = "INSERT INTO persona
    (cedula, primerNombre, segundoNombre, primerApellido, segundoApellido, sexo, fechaNacimiento, direccion, telefono, email, fechaContratacion, cargo, salario)
    VALUES
    (:cedula, :nombre1, :nombre2, :apellido1, :apellido2, :sexo, :nacimiento, :domicilio, :tel, :email, :ingreso, :cargo, :sueldo)";

    $stmt = $conexion->prepare($sql);

    $stmt->bindParam(':cedula', $cedula);
    $stmt->bindParam(':nombre1', $nombre1);
    $stmt->bindParam(':nombre2', $nombre2);
    $stmt->bindParam(':apellido1', $apellido1);
    $stmt->bindParam(':apellido2', $apellido2);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':nacimiento', $nacimiento);
    $stmt->bindParam(':domicilio', $residencia);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':ingreso', $ingreso);
    $stmt->bindParam(':cargo', $cargo);
    $stmt->bindParam(':sueldo', $sueldo);


 if($stmt->execute()){
    echo "<script>
        alert('Empleado registrado con exito');
        window.location.href='index.php';
    </script>";
} else {
    echo "<script>alert('Error al registrar'); window.location.href='index.php';</script>";
   
}
?>
