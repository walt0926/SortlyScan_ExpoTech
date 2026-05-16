<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
    <title>SortlyScan - Acceso Institucional</title>
</head>
<body>
    <div class="login-screen d-flex align-items-center justify-content-center min-vh-100 px-3">
        <div class="login-card-container w-100" style="max-width: 450px;">
            
            <div class="text-center mb-4 popi d-flex flex-column align-items-center">
                <div class="icon-circle shadow-lg d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-3 transition-transform" style="width: 5.5rem; height: 5.5rem;">
                    <img src="img/logo1.png" alt="SortlyScan Isotipo" style="width: 85%; height: 85%; object-fit: contain;">
                </div>
                <h1 class="titulo-principal m-0 text-center">
                    <span class="text-white">Sortly</span><span class="text-scan">Scan</span>
                </h1>
                <p id="setup-subtitle" class="subtitle text-white-50 mt-1">Identifica tu institución</p>
            </div>

            <div id="form-acceso" class="card border-0 shadow-lg form-container p-4 p-sm-5 rounded-4 bg-white">
                <div class="mb-4">
                    <label for="cct-input" class="form-label label-text fw-bold text-secondary text-center d-block mb-3">
                        Código CCT de la Escuela
                    </label>
                    <input type="text" id="cct-input" placeholder="Ej: 15EPR0001X" 
                           class="form-control form-control-lg input-codigo text-center py-3 border-2 shadow-sm uppercase-input">
                </div>
                <button onclick="procesarAcceso()" id="btn-principal" class="btn btn-lg btn-entrar w-100 py-3 fw-bold shadow-sm transition-transform">
                    Validar Institución
                </button>
            </div>

            <div class="opciones-secundarias d-flex justify-content-center align-items-center gap-2 mt-4">
                <button onclick="mostrarLoginMaestro()" class="btn btn-link btn-opcion p-0 text-decoration-none fw-bold">Acceso Maestro</button>
                <span class="separador text-white-50">|</span>
                <button onclick="mostrarLoginDirector()" class="btn btn-link btn-opcion p-0 text-decoration-none fw-bold">Acceso Director</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/Validacion_Institucional.js"></script>
</body>
</html>