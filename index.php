<html lang='es'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    
<div class='contenedor'>
 <!--  Encabezado -->
<header class='encabezado'>
    <div class='encabezado2'>
        <i class='material-icons'>people</i>
        <h1>Gestión de empleados</h1>
    </div>
    
</header>     
<!-- encabezado -->

<div class='seccion1'>
    <p class='descripcion'>Crea y registra a los empleados</p>
</div>

<!-- Seccion para añadir -->
 <form action="datos.php" method="POST">
<section class="SeccionAñadir">
            <h2>Crear Nuevo Empleado</h2>
            
            <div class="formulario">
                <label for="cedula">Cedula:</label>
                <input id="cedula" type="text" placeholder="CC" name="cedula" required >

                <label for="nombre1">Primer Nombre:</label>
                <input id="nombre1" type="text" placeholder="ingrese su primer nombre" name="nombre1" required>

                <label for="nombre2">Segundo Nombre:</label>
                <input id="nombre2" type="text" placeholder="ingrese su segundo nombre" name="nombre2" required>

                <label for="apellido1">Primer Apellido:</label>
                <input id="apellido1" type="text" placeholder="ingrese su primer apellido" name="apellido1" required>

                <label for="apellido2">Segundo apellido:</label>
                <input id="apellido2" type="text" placeholder="ingrese su segundo apellido" name="apellido2" required>

                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo" required> 
                    <option value="">seleccione su sexo</option> 
                    <option value="masculino">M</option> 
                    <option value="Femenino">F</option>
                </select>

                <label for="nacimiento">Fecha de nacimiento:</label>
                <input id="nacimiento" type="date" name="nacimiento" required>

                <label for="domicilio">Direccion de residencia:</label>
                <input type="text" id="domicilio" placeholder="calle # . - ." name="domicilio" required>

                <label for="tel">Telefono:</label>
                <input id="tel" type="tel" name="tel" placeholder="313 0000000" required >

                <label for="email">Email:</label>
                <input id="email" type="email" name="email" required placeholder="ejemplo@gmail.com">

                <label for="ingreso">Fecha de contratacion:</label>
                <input id="ingreso" type="date" name="ingreso" required> 

                <label for="cargo">Cargo</label>
                <select name="cargo" id="cargo" required> 
                    <option value="">seleccione el cargo adquirido</option> 
                    <option value="auxiliar">Auxilar</option> 
                    <option value="gerente">Gerente General</option>
                    <option value="subgerente">Gerente de operaciones</option>
                    <option value="ingeniero">Ingeniero</option>
                </select>

                <label for="sueldo">Sueldo basico:</label>
                <input type="text" id="sueldo" name="sueldo" required>
            </div>
            
            <div class="GB">
                <button class="btn2">Cancelar</button>
                <button type="submit" class="btn1">Guardar Empleado</button>
            </div>
        </section>
</form>


</body>
</html>