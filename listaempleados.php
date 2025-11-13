<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}
?>
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
            <th>ID</th>
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
<td> <?= $empleado["id"]; ?></td>
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
<td><?= $empleado["cargo"];?></td>
<td><?= $empleado["salario"];?></td>
<td>
    <a href="editar.php?id=<?= $empleado['id'] ?>" class="btnEditar">Editar</a>

<a href="eliminar.php?id=<?= $empleado['id'] ?>" class="btnEliminar" onclick="return confirm('¿Seguro que deseas eliminar?');">Eliminar</a>

</tr>
<?php } ?>
   </tbody>
    </table>
    </div>
</section>

<!-- cumpleaños por mes -->
<section class = "empleados">

<form action="" method="post">
<label for="cumple"> cumpleaños por mes:</label>
<select name="mes" id="cumple">
    <option value="">Seleccione el mes</option>
    <option value="1">Enero</option>
    <option value="2">Febrero</option>
    <option value="3">Marzo</option>
    <option value="4">Abril</option>
    <option value="5">Mayo</option>
    <option value="6">Junio</option>
    <option value="7">Julio</option>
    <option value="8">Agosto</option>
    <option value="9">Septiembre</option>
    <option value="10">Octubre</option>
    <option value="11">Noviembre</option>
    <option value="12">Diciembre</option>
</select>

<button type="submi">Enviar mes</button>
</form>
<?php include "cumple.php"; ?>

<?php if (!empty($cumplesMes)) { ?>
    <h2><?php echo "Cumpleaños del mes $mesNombre"; ?></h2>

    <?php 
        $totalCumpleMes = count($cumplesMes);
        echo "<p>Total de cumpleaños este mes: <strong>$totalCumpleMes</strong></p>";
    ?>

    <table class="tablaEmpleados">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Fecha de Nacimiento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cumplesMes as $emp) { ?>
                <tr>
                    <td><?= $emp['cedula']; ?></td>
                    <td><?= $emp['primerNombre'] . " " . $emp['primerApellido']; ?></td>
                    <td><?= $emp['fechaNacimiento']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
    <p>No hay cumpleaños en este mes.</p>
<?php } ?>
<br>
<a href="logout.php" class="btn1">Cerrar sesión</a>
<a href="index.php" class="btn1">Registrar Empleado</a>
<a href="pruebas.php" class="btn1">Dashboard empleados</a>



</section>




</body>
</html>