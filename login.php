<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="validar.php">
      <label for="email">Correo:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Ingresar</button>
      <br>
      <a href="pruebas.php" class="btn3">Volver</a>

    </form>
  </div>
  
</body>
</html>
