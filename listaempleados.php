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
    <link rel="stylesheet" href="listaempleados.css">
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

 <nav>
        <a href="index.php" class="btn3">Agregar Empleado</a>
        <a href="GestionNomina.php" class="btn3">Administracion Nomina</a>
        <a href="logout.php" class="btn3">Cerrar Sesión</a>

    </nav>

</header>     
<!-- encabezado -->

<div class='seccion1'>
    <p class='descripcion'>Lista de empleados, busca y edita.</p>
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
<td><?= $empleado["cargo"]?></td>
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
<h1>Cumpleaños por mes</h1><br>
<form action="" method="post">
<label for="cumple"></label>
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
<button type="submit">Enviar mes</button>
</form>
<br><br>
<?php include "cumple.php"; ?>

<?php if (!empty($cumplesMes)) { ?>
    <h2 class="centro"><?php echo "$mesNombre"; ?></h2>

    <?php 
        $totalCumpleMes = count($cumplesMes);
        echo "<p>Total de cumpleaños este mes: <strong>$totalCumpleMes</strong></p>";
    ?>
<br>

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
</section>
<!------------------------------------------------------------------------------------------------------>
<!-- Agrupar empleados -->

<section class="Empleados">
    <h2>Empleados Agrupados por sexo</h2>
    <form method="POST">
        <select name="sexo">
            <option value="">Seleccione el Sexo</option>
            <option value="masculino" <?= (isset($sexoSeleccionado) && $sexoSeleccionado == "masculino") ? "selected" : "" ?>>Hombres</option>
            <option value="femenino" <?= (isset($sexoSeleccionado) && $sexoSeleccionado == "femenino") ? "selected" : "" ?>>Mujeres</option>
            <option value="todos" <?= (isset($sexoSeleccionado) && $sexoSeleccionado == "todos") ? "selected" : "" ?>>Ambos sexos</option>
        </select>
        <button type="submit">Enviar sexo</button>
    </form>
<br>
    <?php if ($sexoSeleccionado === "todos") { ?>

    <h2 class="centro">Hombres</h2>
    <?php if (!empty($_SESSION['empleadosMasculinos'])) { ?>
        <p>Total de empleados hombres: <?= count($_SESSION['empleadosMasculinos']) ?></p><br>
        <table class="tablaEmpleados">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Sexo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['empleadosMasculinos'] as $emp) { ?>
                    <tr>
                        <td><?= htmlspecialchars($emp['cedula']); ?></td>
                        <td><?= htmlspecialchars($emp['nombre']); ?></td>
                        <td><?= htmlspecialchars(ucfirst($emp['sexo'])); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No hay empleados hombres registrados.</p>
    <?php } ?>
<br><br><br><br>
    <h2 class="centro">Mujeres</h2>
    <?php if (!empty($_SESSION['empleadosFemeninos'])) { ?>
        <p>Total de empleadas mujeres: <?= count($_SESSION['empleadosFemeninos']) ?></p>
       <br> <table class="tablaEmpleados">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Sexo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['empleadosFemeninos'] as $emp) { ?>
                    <tr>
                        <td><?= htmlspecialchars($emp['cedula']); ?></td>
                        <td><?= htmlspecialchars($emp['nombre']); ?></td>
                        <td><?= htmlspecialchars(ucfirst($emp['sexo'])); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No hay empleadas mujeres registradas.</p>
    <?php } ?>

<?php } elseif (!empty($empleadosSexo)) { ?>

    <h2 class="centro"><?= ($sexoSeleccionado === 'masculino') ? 'Hombres' : 'Mujeres' ?></h2>
    <p>Total de empleados: <?= count($empleadosSexo) ?></p>
    <br><table class="tablaEmpleados">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Sexo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleadosSexo as $emp) { ?>
                <tr>
                    <td><?= htmlspecialchars($emp['cedula']); ?></td>
                    <td><?= htmlspecialchars($emp['nombre']); ?></td>
                    <td><?= htmlspecialchars(ucfirst($emp['sexo'])); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

<?php } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sexo'])) { ?>

    <p>No hay empleados con ese sexo.</p>

<?php } ?>
    <br>
</section>


</body>
</html>