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
                    <h1 class="titulo-principal">
                        <span class="text-white">Student</span><span class="text-scan">Registration</span>
                    </h1>
                    <!-- Aquí se mostrará el nombre de la escuela que guardamos antes -->
                    <p id="nombre-institucion" class="subtitle" style="color: #F57C00; font-weight: bold;"></p>
                    <p class="subtitle">Enter your class code</p>
                </div>

                <div class="form-container">
                    <label class="block mb-4">
                        <span class="label-text">Class Code</span>
                        <input type="text" id="class-code-input" placeholder="e.g., CLASS-2024" class="input-codigo">
                    </label>

                    <button onclick="validarCodigoClase()" class="btn-entrar">Join Class</button>
                    
                    <div class="footer">
                        <button onclick="window.location.href='ValidarInstitucion.php'" class="link-footer">Go back</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="JS/inicio_de_sesion.js"></script>
</body>
</html>