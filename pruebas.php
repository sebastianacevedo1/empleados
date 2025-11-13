<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard de Empleados</title>
  <link rel="stylesheet" href="pruebas.css">
 
</head>
<body>
<?php
    require_once "conexion.php";

    $sql = "select count(*) as total from persona";
    $stmt=$conexion->query($sql);
    $TotalEmpleados = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    $sql = "SELECT COUNT(*) AS total
    FROM persona
    WHERE DATE(CONCAT(YEAR(CURDATE()), '-', MONTH(fechaNacimiento), '-', DAY(fechaNacimiento))) >= CURDATE()
    AND DATE(CONCAT(YEAR(CURDATE()), '-', MONTH(fechaNacimiento), '-', DAY(fechaNacimiento))) <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)";
    $stmt = $conexion->query($sql);
    $proxCumple = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    $sql = "select count(cargo) as cargoTotal from persona where cargo='auxiliar'";
    $stmt=$conexion->query($sql);
    $totalcargo = $stmt->fetch(PDO::FETCH_ASSOC)['cargoTotal'];

    $sql = "select count(cargo) as cargoTotal from persona where cargo='Gerente General'";
    $stmt=$conexion->query($sql);
    $totalcargo2 = $stmt->fetch(PDO::FETCH_ASSOC)['cargoTotal'];

    $sql = "select count(cargo) as cargoTotal from persona where cargo='Gerente de operaciones'";
    $stmt=$conexion->query($sql);
    $totalcargo3 = $stmt->fetch(PDO::FETCH_ASSOC)['cargoTotal'];

    $sql = "select count(cargo) as cargoTotal from persona where cargo='Ingeniero'";
    $stmt=$conexion->query($sql);
    $totalcargo4 = $stmt->fetch(PDO::FETCH_ASSOC)['cargoTotal'];

    $sql = "select count(sexo) as total from persona where sexo='masculino'";
    $stmt = $conexion->query($sql);
    $generoempleado = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    $sql = "SELECT COUNT(sexo) AS total FROM persona WHERE sexo='femenino'";
    $stmt = $conexion->query($sql);
    $generoempleado2 = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    $sql = "SELECT SUM(salario) AS totalSalarios FROM persona";
    $stmt = $conexion->query($sql);
    $totalSalarios = $stmt->fetch(PDO::FETCH_ASSOC)['totalSalarios'];

    $sql = "SELECT CONCAT(primerNombre, ' ', primerApellido) AS nombreCompleto, fechaNacimiento, cargo
    FROM persona
    WHERE MONTH(fechaNacimiento) = MONTH(CURDATE())
    AND DAY(fechaNacimiento) >= DAY(CURDATE())
    ORDER BY DAY(fechaNacimiento)";
    $stmt = $conexion->query($sql);
    $cumpleanosMes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    



?>

<a href="login.php" class="btn1">Iniciar sesión</a>
  <h1>Dashboard de Empleados</h1>
  
  <br><br>

  <div class="cards-container">
    <div class="card">
       <h2>Total Empleados</h2>
    <p class="p1"><?php echo $TotalEmpleados; ?></p>
    </div>
    <div class="card">
      <h2>Cargo</h2>
    <p>Auxiliar: <?php echo $totalcargo; ?></p>
    <p>Gerente General: <?php echo $totalcargo2; ?></p>
    <p>Gerente de operaciones: <?php echo $totalcargo3; ?></p>
    <p>Ingeniero: <?php echo $totalcargo4; ?></p>

      
    </div>
    <div class="card">
      <h2>Próximos Cumpleaños</h2>
      <p><?php echo $proxCumple; ?></p>
    </div>
    <div class="card">
      <h2>Empleados por genero</h2>
    <p>Hombres: <?php echo $generoempleado; ?></p>
    <p>Mujeres: <?php echo $generoempleado2; ?></p>
      
    </div>
    <div class="card">
      <h2>Gasto en salarios</h2>
    <p><?php echo $totalSalarios; ?></p>
      
    </div>
  </div>

<div class="full-width-container">
    <div class="card full-width-card">
        <h1>Cumpleaños del mes</h1>
        <br>

        <div class="cumpleanos-table-container">
            <table class="cumpleanos-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Cargo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($cumpleanosMes) > 0): ?>
                        <?php foreach ($cumpleanosMes as $cumple): ?>
                            <tr>
                                <td><?php echo $cumple['nombreCompleto']; ?></td>
                                <td><?php echo $cumple['fechaNacimiento']; ?></td>
                                <td><?php echo $cumple['cargo']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No hay cumpleaños este mes</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>



  

</body>
</html>
