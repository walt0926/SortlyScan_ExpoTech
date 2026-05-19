<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
    <title>SortlyScan - Student Registration</title>
</head>
<body class="login-screen">
    <div class="login-card-container">
        <div class="popi">
            <h1 class="titulo-principal">Access Password</h1>
            <p id="alumno-seleccionado" style="color: #00BCD4; font-weight: bold; margin-bottom: 0.5rem;"></p>
            <p class="subtitle">Enter your account security password</p>

            <div class="form-container" style="width: 100%;">
                <input type="password" id="pin-input" placeholder="••••••••" class="input-codigo" style="font-size: 1.5rem; text-align: center; margin-bottom: 1.5rem;">
                
                <button onclick="validarPIN()" class="btn-entrar">Access</button>
            </div>
        </div>
    </div>
    <script src="JS/inicio_de_sesion.js"></script>
</body>
</html>