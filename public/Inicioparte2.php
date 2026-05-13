<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css"> <!-- Reutilizamos tu CSS base -->
    <title>SortlyScan - Registro de Alumno</title>
</head>
<body>
    <div class="tailwind">
        <div class="login-screen">
            <div class="login-card-container">
    <div class="text-center mb-8 popi">
        <h1 class="titulo-principal"><span class="text-white">Tu</span><span class="text-scan">Nombre</span></h1>
        <p id="nombre-clase" class="subtitle" style="color: #F57C00;"></p>
        <p class="subtitle">Selecciona tu nombre de la lista</p>
    </div>

    <div class="form-container">
        <!-- El select se llenará dinámicamente con JS -->
        <label class="block mb-4">
            <span class="label-text">Lista de Alumnos</span>
            <select id="lista-alumnos" class="input-codigo" style="font-size: 1.2rem;">
                <option value="">Cargando alumnos...</option>
            </select>
        </label>

        <button onclick="confirmarAlumno()" class="btn-entrar">Este soy yo</button>
    </div>
</div>
    <script src="JS/inicio_de_sesion.js"></script>
</body>
</html>