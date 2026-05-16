<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
    <title>SortlyScan - Acceso Maestro</title>
</head>
<body>
    <div class="tailwind">
        <div class="login-screen">
            <div class="login-card-container">
                
                <div class="text-center mb-8 popi">
                    <h1 class="titulo-principal">
                        <span class="text-white">Acceso</span><span class="text-scan">Maestro</span>
                    </h1>
                    <p id="nombre-institucion" class="subtitle" style="color: #F57C00; font-weight: bold;"></p>
                    <p class="subtitle">Ingresa tus credenciales de docente</p>
                </div>

                <div class="form-container">
                    <label class="block mb-4">
                            <span class="label-text">Código CCT de la Escuela</span>
                            <input type="text" id="cct-input" placeholder="Ej: 15EPR0001X" class="input-codigo">
                        </label>

                    <label class="block mb-4">
                        <span class="label-text">Usuario o No. de Nómina</span>
                        <input type="text" id="user-staff" placeholder="Ej: MAE12345" class="input-codigo">
                    </label>

                    <label class="block mb-4">
                        <span class="label-text">Contraseña</span>
                        <input type="password" id="pass-staff" placeholder="••••••••" class="input-codigo">
                    </label>

                    <!-- Pasamos 'maestro' como argumento -->
                    <button onclick="validarLoginStaff('maestro')" class="btn-entrar">Iniciar Sesión</button>
                    
                    <div class="footer">
                        <button onclick="window.location.href='index.html'" class="link-footer">Cambiar de institución</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="JS/sesion_administrativos.js"></script>
</body>
</html>