<?php
require_once "conexion.php";

if (!isset($_GET["id"])) {
    echo "No se recibió el ID del empleado.";
    exit();
}

$id = $_GET["id"];

$sql = "SELECT * FROM persona WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$id]);
$empleado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$empleado) {
    echo "No se encontró el empleado.";
    exit();
}
?>

<html lang='es'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<div class='contenedor'>

<header class='encabezado'>
    <div class='encabezado2'>
        <i class='material-icons'>edit</i>
        <h1>Editar Empleado</h1>
    </div>
</header>

<div class='seccion1'>
    <p class='descripcion'>Modifica los datos del empleado</p>
</div>

<form action="actualizar.php" method="POST">
<section class="SeccionAñadir">
    <h2>Actualizar Información</h2>
    
    <div class="formulario">

        <input type="hidden" name="id" value="<?= $empleado['id'] ?>">

        <label>Cédula:</label>
        <input type="text" name="cedula" value="<?= $empleado['cedula'] ?>">

        <label>Primer Nombre:</label>
        <input type="text" name="nombre1" value="<?= $empleado['primerNombre'] ?>" required>

        <label>Segundo Nombre:</label>
        <input type="text" name="nombre2" value="<?= $empleado['segundoNombre'] ?>" required>

        <label>Primer Apellido:</label>
        <input type="text" name="apellido1" value="<?= $empleado['primerApellido'] ?>" required>

        <label>Segundo Apellido:</label>
        <input type="text" name="apellido2" value="<?= $empleado['segundoApellido'] ?>" required>

        <label>Sexo:</label>
        <select name="sexo" required>
            <option value="masculino" <?= $empleado['sexo']=="masculino" ? "selected" : "" ?>>M</option>
            <option value="Femenino" <?= $empleado['sexo']=="Femenino" ? "selected" : "" ?>>F</option>
        </select>

        <label>Fecha de nacimiento:</label>
        <input type="date" name="nacimiento" value="<?= $empleado['fechaNacimiento'] ?>" required>

        <label>Dirección:</label>
        <input type="text" name="domicilio" value="<?= $empleado['direccion'] ?>" required>

        <label>Teléfono:</label>
        <input type="tel" name="tel" value="<?= $empleado['telefono'] ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $empleado['email'] ?>" required>

        <label>Fecha contratación:</label>
        <input type="date" name="ingreso" value="<?= $empleado['fechaContratacion'] ?>" required>

        <label>Cargo:</label>
        <select name="cargo" required>
            <option value="auxiliar" <?= $empleado['cargo']=="auxiliar" ? "selected" : "" ?>>Auxiliar</option>
            <option value="gerente" <?= $empleado['cargo']=="gerente" ? "selected" : "" ?>>Gerente General</option>
            <option value="subgerente" <?= $empleado['cargo']=="subgerente" ? "selected" : "" ?>>Gerente de operaciones</option>
            <option value="ingeniero" <?= $empleado['cargo']=="ingeniero" ? "selected" : "" ?>>Ingeniero</option>
        </select>

        <label>Sueldo básico:</label>
        <input type="text" name="sueldo" value="<?= $empleado['salario'] ?>" required>
    </div>
    
    <div class="GB">
        <a href="listaempleados.php" class="btn2">Cancelar</a>
        <button type="submit" class="btn1">Guardar Cambios</button>
    </div>

</section>
</form>

</body>
</html>
