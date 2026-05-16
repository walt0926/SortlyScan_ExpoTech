<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
    <title>SortlyScan - Acceso Maestro</title>
</head>
<body>
    <div class="login-screen d-flex align-items-center justify-content-center min-vh-100 px-3">
        <div class="login-card-container w-100" style="max-width: 450px;">
            
            <div class="text-center mb-4 popi d-flex flex-column align-items-center">
                <div class="icon-circle shadow-lg d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-3 transition-transform" style="width: 5.5rem; height: 5.5rem;">
                    <img src="img/logo1.png" alt="SortlyScan Isotipo" style="width: 65%; height: 65%; object-fit: contain;">
                </div>
                <h1 class="titulo-principal m-0 text-center">
                    <span class="text-white">Acceso</span><span class="text-scan">Maestro</span>
                </h1>
                <p class="subtitle text-white-50 mt-2">Ingresa el CCT de tu escuela y tus credenciales</p>
            </div>

            <div class="card border-0 shadow-lg form-container p-4 p-sm-5 rounded-4 bg-white">
                
                <div class="mb-3">
                    <label for="cct-input" class="form-label label-text fw-bold text-secondary mb-2">
                        Código CCT de la Escuela
                    </label>
                    <input type="text" id="cct-input" placeholder="Ej: 15EPR0001X" 
                           class="form-control form-control-lg input-codigo py-2 border-2 shadow-sm fs-6 uppercase-input">
                </div>

                <div class="mb-3">
                    <label for="user-staff" class="form-label label-text fw-bold text-secondary mb-2">
                        Usuario o No. de Nómina
                    </label>
                    <input type="text" id="user-staff" placeholder="Ej: MAE12345" 
                           class="form-control form-control-lg input-codigo py-2 border-2 shadow-sm fs-6">
                </div>

                <div class="mb-4">
                    <label for="pass-staff" class="form-label label-text fw-bold text-secondary mb-2">
                        Contraseña
                    </label>
                    <input type="password" id="pass-staff" placeholder="••••••••" 
                           class="form-control form-control-lg input-codigo py-2 border-2 shadow-sm fs-6">
                </div>
                
                <button onclick="validarLoginStaff('maestro')" id="btn-entrar-staff" class="btn btn-lg btn-entrar w-100 py-3 fw-bold shadow-sm transition-transform">
                    Iniciar Sesión
                </button>
                
                <div class="text-center mt-4">
                    <button onclick="window.location.href='ValidarInstitucion.php'" class="btn btn-link link-footer p-0 text-decoration-none fw-bold">
                        ← Cambiar de rol o institución
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/sesion_administrativos.js"></script>
</body>
</html>