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
            <h1 class="titulo-principal">
                Student Access
            </h1>
            <p id=\"nombre-institucion\" style="color: #00BCD4; font-weight: bold; margin-bottom: 0.5rem;"></p>
            <p class="subtitle">Enter your class code</p>

            <div class="form-container" style="width: 100%;">
                <label class="label-text">Class Code</label>
                <input type="text" id="class-code-input" placeholder="e.g., CLASS-2024" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;">

                <button onclick="validarCodigoClase()" class="btn-entrar">Join Class</button>
                
                <div class="footer">
                    <button onclick="window.location.href='ValidarInstitucion.php'" class="btn-link">Go back</button>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/inicio_de_sesion.js"></script>
</body>
</html>