<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoftlyScan - Login</title>
    <link rel="stylesheet" href="registros.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="main-container">
        <header class="header-text">
            <h1>SortlyScan</h1>
            <p>Panel de Docente</p>
        </header>

        <div class="login-card">
            <div class="role-selector">
                <button class="role-btn active" id="btn-docente">Docente</button>
                <button class="role-btn" id="btn-director">Director</button>
            </div>

            <form id="login-form">
                <div class="input-group">
                    <label for="username"><i class="fa-regular fa-user"></i> Usuario</label>
                    <input type="text" id="username" placeholder="Ingresa tu usuario" required>
                </div>

                <div class="input-group">
                    <label for="password"><i class="fa-solid fa-lock"></i> Contraseña</label>
                    <input type="password" id="password" placeholder="Ingresa tu contraseña" required>
                </div>

                <button type="submit" class="login-btn">Iniciar Sesión</button>
            </form>
        </div>

        <a href="#" class="back-link">← Volver a entrada de estudiante</a>
    </div>

    <script src="registros.js"></script>
</body>
</html>