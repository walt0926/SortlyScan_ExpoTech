<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
    <title>SortlyScan - Registro de Alumno</title>
</head>
<body>
    <div class="login-screen d-flex align-items-center justify-content-center min-vh-100 px-3">
        <div class="login-card-container w-100" style="max-width: 450px;">
            
            <div class="text-center mb-4 popi d-flex flex-column align-items-center">
                <div class="icon-circle shadow-lg d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-3 transition-transform" style="width: 5.5rem; height: 5.5rem;">
                    <img src="img/logo1.png" alt="SortlyScan Isotipo" style="width: 65%; height: 65%; object-fit: contain;">
                </div>
                <h1 class="titulo-principal m-0 text-center">
                    <span class="text-white">Registro</span><span class="text-scan">Alumno</span>
                </h1>
                
                <div class="mt-2">
                    <span id="nombre-institucion" class="badge bg-warning text-dark shadow-sm py-2 px-3 fs-6 fw-bold rounded-pill" style="display: none;"></span>
                </div>
                <p class="subtitle text-white-50 mt-2">Ingresa el código de tu clase</p>
            </div>

            <div class="card border-0 shadow-lg form-container p-4 p-sm-5 rounded-4 bg-white">
                <div class="mb-4">
                    <label for="class-code-input" class="form-label label-text fw-bold text-secondary text-center d-block mb-3">
                        Código de Clase
                    </label>
                    <input type="text" id="class-code-input" placeholder="Ej: CLASE-2024" 
                           class="form-control form-control-lg input-codigo text-center py-3 border-2 shadow-sm uppercase-input">
                </div>
                
                <button onclick="validarCodigoClase()" id="btn-unirse" class="btn btn-lg btn-entrar w-100 py-3 fw-bold shadow-sm transition-transform">
                    Unirse a la Clase
                </button>
                
                <div class="text-center mt-4">
                    <button onclick="window.location.href='ValidarInstitucion.php'" class="btn btn-link link-footer p-0 text-decoration-none fw-bold">
                        ← Volver atrás
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/inicio_de_sesion.js"></script>
</body>
</html>