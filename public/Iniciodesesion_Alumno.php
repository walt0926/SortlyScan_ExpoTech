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
                    <h1 class="titulo-principal">
                        <span class="text-white">Registro</span><span class="text-scan">Alumno</span>
                    </h1>
                    <!-- Aquí se mostrará el nombre de la escuela que guardamos antes -->
                    <p id="nombre-institucion" class="subtitle" style="color: #F57C00; font-weight: bold;"></p>
                    <p class="subtitle">Ingresa el código de tu clase</p>
                </div>

                <div class="form-container">
                    <label class="block mb-4">
                        <span class="label-text">Código de Clase</span>
                        <input type="text" id="class-code-input" placeholder="Ej: CLASE-2024" class="input-codigo">
                    </label>

                    <button onclick="validarCodigoClase()" class="btn-entrar">Unirse a la Clase</button>
                    
                    <div class="footer">
                        <button onclick="window.location.href='index.html'" class="link-footer">Volver atrás</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="JS/inicio_de_sesion.js"></script>
</body>
</html>