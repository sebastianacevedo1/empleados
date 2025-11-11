<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['mes'])) {

    require_once "conexion.php";
    $mes = $_POST['mes'];

    $meses = [
    1=>"Enero",2=>"Febrero",3=>"Marzo",4=>"Abril",5=>"Mayo",6=>"Junio",
    7=>"Julio",8=>"Agosto",9=>"Septiembre",10=>"Octubre",11=>"Noviembre",12=>"Diciembre"
];

$mesNombre = $meses[$mes];


    $sql = "SELECT cedula, primerNombre, primerApellido, fechaNacimiento 
            FROM persona 
            WHERE MONTH(fechaNacimiento) = :mes";

    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(":mes", $mes, PDO::PARAM_INT);
    $stmt->execute();
    $cumplesMes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    $cumlesMes = []; // para evitar error si no se envía mes
}
