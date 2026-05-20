<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
    <title>SortlyScan - Management Access</title>
</head>
<body class="login-screen">
    <div class="login-card-container">
        <div class="popi">
            <h1 class="titulo-principal">
                Management Panel
            </h1>
            <p id="nombre-institucion" style="color: #00BCD4; font-weight: bold; margin-bottom: 0.5rem;"></p>
            <p class="subtitle">Log in with institutional email</p>

            <div class="form-container" style="width: 100%;">
                <label class="label-text">Email Address</label>
                <input type="email" id="user-staff" placeholder="principal@school.com" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;">

                <label class="label-text">Principal Password</label>
                <input type="password" id="pass-staff" placeholder="••••••••" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;">

                <button onclick="validarLoginStaff('director')" class="btn-entrar">Enter Panel</button>
                
                <div class="opciones-secundarias">
                    <a href="registroinstitucional.php" class="btn-link">Register School</a>
                </div>

                <div class="footer">
                    <button onclick="window.location.href='ValidarInstitucion.php'" class="btn-link">Back to home</button>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/sesion_administrativos.js"></script>
</body>
</html>