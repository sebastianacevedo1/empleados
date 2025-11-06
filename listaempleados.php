<html>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<!--  Encabezado -->
<header class='encabezado'>
    <div class='encabezado2'>
        <i class='material-icons'>people</i>
        <h1>Gestión de empleados</h1>
    </div>
    <div class='acciones'>
        <i class="material-icons notification-icon">notifications</i>
        <i class="material-icons settings-icon">settings</i>
         <div class="user-profile">
            <img src='user-avatar.png' alt='usuario'>
         </div>
    </div>
</header>     
<!-- encabezado -->

<div class='seccion1'>
    <p class='descripcion'>Lista de empleados, busca y edita.</p>
</div>


<div class="busqueda">
        <i class="material-icons">search</i>
        <input type="text" placeholder="buscar empleado..." values="">
    </div>

<!-- lista de empleados -->
<section class="Empleados">
    <h2>Lista de Empleados</h2>
    
    <div class="tabla-contenedor">
    <table class="tablaEmpleados">
    <thead>
        <tr>
            <th>Cedula</th>
            <th>Primer Nombre</th>
            <th>Segundo Nombre</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Sexo</th>
            <th>Fecha de Nacimiento</th>
            <th>Direccion de residencia</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Fecha de contratacion</th>
            <th>Cargo</th>
            <th>Salario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
<?php
    require_once "conexion.php";
    $sql = "select * from persona";
    $stmt=$conexion->query($sql);
    $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($empleados as $empleado) {
?>
<tr>
<td> <?= $empleado["cedula"]; ?></td>
<td><?= $empleado["primerNombre"]; ?></td>
<td><?= $empleado["segundoNombre"]; ?></td>
<td><?= $empleado["primerApellido"]; ?></td>
<td><?= $empleado["segundoApellido"]; ?></td>
<td><?= $empleado["sexo"]; ?></td>
<td><?= $empleado["fechaNacimiento"];?></td>
<td><?= $empleado["direccion"];?></td>
<td><?= $empleado["telefono"];?></td>
<td><?= $empleado["email"];?></td>
<td><?= $empleado["fechaContratacion"]?></td>
<td><?= $empleado["salario"];?></td> 
<td>
    <a href="editar.php?id=<?echo $empleado['cedula'] ?>" class="btnEditar">Editar</a>
<a href="eliminar.php?cedula=<?= $empleado['cedula'] ?>" class="btnEliminar" onclick="return confirm('¿Seguro que deseas eliminar?');">Eliminar</a>

</tr>
<?php } ?>
   </tbody>
    </table>
    </div>
</section>






</body>
</html>