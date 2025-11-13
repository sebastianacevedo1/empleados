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
        <a href="listaempleados.php" class="btn3">Administracion de empleados</a>
        <a href="logout.php" class="btn3">Cerrar Sesión</a>

    </nav>

</header>     
<!-- encabezado -->

<div class='seccion1'>
    <p class='descripcion'>Gestion de Nomina.</p>
</div>
<!--   AUMENTO DE SUELDO PARA LOS EMPLEADOS       -->
<section class="empleados">

<h2>Aumento de sueldo a empleados</h2>

    <form action="nomina.php" method="POST" class="form-nomina">
        <div >
            <input type="number" class="porcentaje" name="porcentaje" id="porcentaje" placeholder="%" min="0" step="0.01" required>
            <button type="submit" class="btn1">actualizar salarios</button>
        </div>
    </form>

    <table class="tablaempleados">
        <thead>
            <tr>
                <th>CÉDULA</th>
                <th>NOMBRE</th>
                <th>CARGO</th>
                <th>SALARIO</th>
            </tr>
        </thead>
<tbody>
    <?php
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'ok') {
        echo "<script>alert(' Se han actualizado los salarios con éxito');</script>";
    } elseif ($_GET['msg'] == 'error') {
        echo "<script>alert('Error al actualizar los salarios');</script>";
    } else {
        echo "<script>alert('El porcentaje ingresado no es válido');</script>";
    }
}
?>
<?php
require_once "conexion.php";

try {
    $sql = "SELECT cedula, primerNombre, segundoNombre, primerApellido, segundoApellido, cargo, salario 
            FROM persona";
    $stmt = $conexion->query($sql);
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($resultado) {
        foreach ($resultado as $fila) {
            $nombreCompleto = trim($fila['primerNombre'] . " " . 
                                   $fila['segundoApellido']);

            echo "<tr>
                    <td>{$fila['cedula']}</td>
                    <td>{$nombreCompleto}</td>
                    <td>{$fila['cargo']}</td>
                    <td>$" . number_format($fila['salario'], 2, ',', '.') . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No hay empleados registrados</td></tr>";
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='4' style='color:red;'>Error: " . $e->getMessage() . "</td></tr>";
}
?>
</tbody>

    </table>
</section>

<!-- MUESTRA NOMINA POR EL SEXO   -->

<section class="empleados">
 <h2>Consultar total de nómina por sexo</h2>
    <form action="consultaNomina.php" method="POST">
        <label for="sexo">Seleccione el sexo:</label>
        <select name="sexo" id="sexo" required class="porcentaje">
            <option value=""> Seleccione Sexo </option>
            <option value="Masculino">Hombres</option>
            <option value="Femenino">Mujeres</option>
        </select>
        <button type="submit" name="consultar">Enviar Sexo</button>
    </form>
<?php
    
    if (isset($_SESSION["resultado_nomina"])) {
        $r = $_SESSION["resultado_nomina"];

        if (isset($r["error"])) {
            echo "<div class='resultado-nomina' style='color:red;'>{$r['error']}</div>";
        } else {
            echo "<div class='resultado-nomina'>";
            
$sexoTexto = ($r['sexo'] === 'Masculino') 
    ? "empleados hombres" 
    : "empleadas mujeres";

echo "<p>Total de nómina para <strong>{$sexoTexto}</strong> 
      ({$r['cantidad']} personas): 
      <span class='valor-nomina'>$" . number_format($r['total'], 0, ',', '.') . "</span></p>";

        }

        unset($_SESSION["resultado_nomina"]); 
    }
    ?>
</section>

<!-- Analisis Nomina -->

<section class="empleados">
  <h2>Consultar Estadísticas de Nómina</h2>

  <form action="analisisNomina.php" method="POST">
      <label for="opcion">Seleccione una opción:</label>
      <select name="opcion" id="opcion" required>
          <option value="">-- Seleccione --</option>
          <option value="promediomas">Empleados que ganan más del promedio</option>
          <option value="promediomenos">Empleados que ganan menos del promedio</option>
          <option value="maximo">Empleado que más gana</option>
          <option value="minimo">Empleado que menos gana</option>
          <option value="mayorMinimo">Empleados que ganan más del salario mínimo (1.400.000)</option>
        
      </select>
      <button type="submit" class="btn1">Mostrar</button>
  </form>
<br>
  <?php
if (isset($_SESSION["estadistica"])) {
    $e = $_SESSION["estadistica"];

    if (isset($e["error"])) {
        echo "<p style='color:red;'>{$e['error']}</p>";
    } else {
        echo "<h2 class='centro'>{$e['titulo']}</h2> <br>";

        if (count($e["resultado"]) > 0) {
            echo "<table class='tablaempleados'>";
            echo "<tr><th>Nombre</th><th>Apellido</th><th>Cargo</th><th>Salario</th></tr>";
            foreach ($e["resultado"] as $emp) {
                echo "<tr>
                        <td>{$emp['primerNombre']}</td>
                        <td>{$emp['segundoApellido']}</td>
                        <td>{$emp['cargo']}</td>
                        <td>$" . number_format($emp['salario'], 0, ',', '.') . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay resultados para esta consulta.</p>";
        }
    }
    unset($_SESSION["estadistica"]);
}
?>
</section>


</body>
</html>