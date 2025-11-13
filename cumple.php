<?php

require_once "conexion.php";

$cumplesMes = $_SESSION['cumplesMes'] ?? [];
$mesNombre = $_SESSION['mesNombre'] ?? "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mes']) && !empty($_POST['mes'])) {
    $mes = $_POST['mes'];

    $meses = [
        1=>"Enero", 2=>"Febrero", 3=>"Marzo", 4=>"Abril", 5=>"Mayo", 6=>"Junio",
        7=>"Julio", 8=>"Agosto", 9=>"Septiembre", 10=>"Octubre", 11=>"Noviembre", 12=>"Diciembre"
    ];

    $mesNombre = $meses[$mes];

    $sql = "SELECT cedula, primerNombre, primerApellido, fechaNacimiento 
            FROM persona 
            WHERE MONTH(fechaNacimiento) = :mes";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
    $stmt->execute();
    $cumplesMes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Guardar en sesión
    $_SESSION['cumplesMes'] = $cumplesMes;
    $_SESSION['mesNombre'] = $mesNombre;
}
// ----------------------------------------- agupar por sexooo -----------------------------------------
$empleadosSexo = $_SESSION['empleadosSexo'] ?? [];
$sexoSeleccionado = $_SESSION['sexoSeleccionado'] ?? "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sexo']) && !empty($_POST['sexo'])) {
    $sexoSeleccionado = $_POST['sexo'];

    if ($sexoSeleccionado === "todos") {
        // Consultar ambos sexos por separado
        $sqlMasculino = "SELECT cedula, CONCAT(primerNombre, ' ', primerApellido) AS nombre, sexo 
                         FROM persona WHERE sexo = 'masculino'";
        $stmtM = $conexion->prepare($sqlMasculino);
        $stmtM->execute();
        $empleadosMasculinos = $stmtM->fetchAll(PDO::FETCH_ASSOC);

        $sqlFemenino = "SELECT cedula, CONCAT(primerNombre, ' ', primerApellido) AS nombre, sexo 
                        FROM persona WHERE sexo = 'femenino'";
        $stmtF = $conexion->prepare($sqlFemenino);
        $stmtF->execute();
        $empleadosFemeninos = $stmtF->fetchAll(PDO::FETCH_ASSOC);

        // Guardar ambos resultados en sesión
        $_SESSION['empleadosMasculinos'] = $empleadosMasculinos;
        $_SESSION['empleadosFemeninos'] = $empleadosFemeninos;
        $_SESSION['sexoSeleccionado'] = $sexoSeleccionado;

    } else {
        // Consulta normal por un solo sexo
        $sql = "SELECT cedula, CONCAT(primerNombre, ' ', primerApellido) AS nombre, sexo 
                FROM persona WHERE sexo = :sexo";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":sexo", $sexoSeleccionado, PDO::PARAM_STR);
        $stmt->execute();
        $empleadosSexo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION['empleadosSexo'] = $empleadosSexo;
        $_SESSION['sexoSeleccionado'] = $sexoSeleccionado;
    }
}


?>
