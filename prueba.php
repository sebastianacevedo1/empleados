<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    <link rel="stylesheet" href="prueba.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
<body>
    <div class="container">
        <header class="header">
            <div class="header-title">
                <i class="material-icons">people</i>
                <h1>Gestión de Empleados</h1>
            </div>
            <div class="header-actions">
                <i class="material-icons notification-icon">notifications</i>
                <i class="material-icons settings-icon">settings</i>
                <div class="user-profile">
                    <img src="user-avatar.png" alt="Usuario">
                </div>
            </div>
        </header>
        
        <div class="section-header">
            <p class="description">Crea, edita y gestiona los registros de todos los empleados.</p>
            <button class="btn btn-primary">
                <i class="material-icons">add</i> Agregar Nuevo Empleado
            </button>
        </div>

        <section class="form-section">
            <h2>Crear Nuevo Empleado</h2>
            <div class="form-grid">
                <input type="text" placeholder="Ingrese el nombre" value="Ingrese el nombre">
                <input type="text" placeholder="Ingrese el apellido" value="Ingrese el apellido">

                <input type="email" placeholder="ejemplo@correo.com" value="ejemplo@correo.com">
                <input type="text" placeholder="Ej. Desarrollador de Software" value="Ej. Desarrollador de Software">

                <select>
                    <option value="tecnologia">Tecnología</option>
                    <option value="marketing">Marketing</option>
                </select>
                <input type="date" value="2026-05-21"> 
            </div>
            
            <div class="form-actions">
                <button class="btn btn-secondary">Cancelar</button>
                <button class="btn btn-save">Guardar Empleado</button>
            </div>
        </section>

        <section class="list-section">
            <h2>Lista de Empleados</h2>
            <div class="search-bar">
                <i class="material-icons">search</i>
                <input type="text" placeholder="Buscar empleado...">
            </div>

            <table class="employees-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE COMPLETO</th>
                        <th>CARGO</th>
                        <th>DEPARTAMENTO</th>
                        <th>EMAIL</th>
                        <th>FECHA CONTRATACIÓN</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Ana Martínez</td>
                        <td>Desarrolladora Frontend</td>
                        <td>Tecnología</td>
                        <td>ana.martinez@example.com</td>
                        <td>2023-01-15</td>
                        <td class="action-icons">
                            <i class="material-icons delete-icon">delete</i>
                            <i class="material-icons edit-icon">edit</i>
                        </td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Carlos Rodriguez</td>
                        <td>Gerente de Proyectos</td>
                        <td>Tecnología</td>
                        <td>carlos.rodriguez@example.com</td>
                        <td>2022-11-20</td>
                        <td class="action-icons">
                            <i class="material-icons delete-icon">delete</i>
                            <i class="material-icons edit-icon">edit</i>
                        </td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Laura Gómez</td>
                        <td>Especialista en Marketing</td>
                        <td>Marketing</td>
                        <td>laura.gomez@example.com</td>
                        <td>2023-01-18</td>
                        <td class="action-icons">
                            <i class="material-icons delete-icon">delete</i>
                            <i class="material-icons edit-icon">edit</i>
                        </td>
                    </tr>

                    <tr>
                        <td>004</td>
                        <td>rosame el ano</td>
                        <td>penes fresquitos sisi</td>
                        <td>Tecnología</td>
                        <td>penesitos@example.com</td>
                        <td>2023-01-15</td>
                        <td class="action-icons">
                            <i class="material-icons delete-icon">delete</i>
                            <i class="material-icons edit-icon">edit</i>
                        </td>


                </tbody>
            </table>
            
            <div class="pagination">
                <span>Mostrando 1-3 de 50</span>
                <div class="pagination-controls">
                    <button class="btn-page">Anterior</button>
                    <button class="btn-page active">1</button>
                    <button class="btn-page">2</button>
                    <button class="btn-page">Siguiente</button>
                </div>
            </div>
        </section>
    </div>
</body>
</html>