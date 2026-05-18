<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css"> <!-- Reutilizamos tu CSS base -->
    <title>SortlyScan - Student Registration</title>
</head>
<body>
    <div class="tailwind">
        <div class="login-screen">
            <div class="login-card-container">
                <div class="text-center mb-8 popi">
                    <h1 class="titulo-principal"><span class="text-white">PIN</span><span class="text-scan">Code</span></h1>
                    <p id="alumno-seleccionado" class="subtitle" style="color: #F57C00;"></p>
                    <p class="subtitle">Enter your 4-digit access code</p>
                </div>

                <div class="form-container">
                    <input type="password" id="pin-input" maxlength="4" placeholder="0 0 0 0" 
                           class="input-codigo" style="letter-spacing: 1.5rem; font-size: 2.5rem;">
                    
                    <button onclick="validarPIN()" class="btn-entrar">Access</button>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/inicio_de_sesion.js"></script>
</body>
</html>