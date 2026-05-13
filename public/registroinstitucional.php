<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Institución - SortlyScan</title>
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
</head>
<body class="login-screen">
    <div class="login-card-container">
        <div class="popi">
            <div class="icon-circle">
                <!-- Icono de escuela -->
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M3 7v1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7H3l2-4h14l2 4"/><path d="M5 21V10.85"/><path d="M19 21V10.85"/><path d="M9 21v-4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v4"/></svg>
            </div>
            <h1 class="titulo-principal"><span class="text-white">Sortly</span><span class="text-scan">Scan</span></h1>
            <p class="subtitle">Registro de Institución</p>
        </div>

        <div class="login-form">
            <form id="formRegistroEscuela">
                <!-- SECCIÓN ESCUELA -->
                <label class="label-text">Nombre de la Escuela</label>
                <input type="text" name="nombre_escuela" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="Ej. Instituto Nacional" required>

                <label class="label-text">Número de Infraestructura (CCT)</label>
                <input type="text" name="cct" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="Clave única" required>

                <hr style="border: 0; border-top: 1px solid #eee; margin: 1.5rem 0;">

                <!-- SECCIÓN DIRECTOR -->
                <label class="label-text">Correo del Director</label>
                <input type="email" name="email_director" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="correo@ejemplo.com" required>

                <label class="label-text">Contraseña</label>
                <input type="password" name="password_director" class="input-codigo" style="font-size: 1.1rem;" placeholder="********" required>

                <button type="submit" class="btn-entrar">REGISTRAR INSTITUCIÓN</button>
            </form>
            
            <div class="footer">
                <a href="iniciodesesion_Director.php" class="btn-link">¿Ya tienes cuenta? Inicia sesión</a>
            </div>
        </div>
    </div>
    <script src="js/registro.js"></script>
</body>
</html>