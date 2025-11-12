<?php
session_start();
require_once "conexion.php";

$email = $_POST["email"];
$password = $_POST["password"];

$sql = "SELECT * FROM usuarios WHERE email = :email AND password = MD5(:password)";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Guardar datos del usuario en la sesión
    $_SESSION["usuario_id"] = $usuario["id"];
    $_SESSION["usuario_nombre"] = $usuario["nombre"];

    // Redirección por PHP (mantiene la sesión)
    header("Location: index.php");
    exit();
} else {
    echo "<script>
        alert('Correo o contraseña incorrectos');
        window.location.href='login.php';
    </script>";
}
?>
