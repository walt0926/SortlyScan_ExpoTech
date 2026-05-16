<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
    <title>Registro de Institución - SortlyScan</title>
</head>
<body>
    <div class="login-screen d-flex align-items-center justify-content-center min-vh-100 px-3 py-5">
        <div class="login-card-container w-100" style="max-width: 480px;">
            
            <div class="text-center mb-4 popi d-flex flex-column align-items-center">
                <div class="icon-circle shadow-lg d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-3 transition-transform" style="width: 5.5rem; height: 5.5rem;">
                    <img src="img/logo1.png" alt="SortlyScan Isotipo" style="width: 65%; height: 65%; object-fit: contain;">
                </div>
                <h1 class="titulo-principal m-0 text-center">
                    <span class="text-white">Registro</span><span class="text-scan">Institucional</span>
                </h1>
                <p class="subtitle text-white-50 mt-2">Da de alta tu escuela en la plataforma</p>
            </div>

            <div class="card border-0 shadow-lg form-container p-4 p-sm-5 rounded-4 bg-white">
                <form id="formRegistroEscuela">
                    
                    <div class="mb-4">
                        <div class="text-muted fw-bold small text-uppercase tracking-wider mb-3 pb-1 border-bottom border-light">
                            📍 Datos de la Escuela
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label label-text fw-bold text-secondary mb-1">Nombre de la Escuela</label>
                            <input type="text" name="nombre_escuela" placeholder="Ej. Instituto Nacional" 
                                   class="form-control form-control-lg input-codigo py-2 border-2 shadow-sm fs-6" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label label-text fw-bold text-secondary mb-1">Número de Infraestructura (CCT)</label>
                            <input type="text" name="cct" placeholder="Clave única (CCT)" 
                                   class="form-control form-control-lg input-codigo py-2 border-2 shadow-sm fs-6 uppercase-input" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="text-muted fw-bold small text-uppercase tracking-wider mb-3 pb-1 border-bottom border-light">
                            👤 Datos del Directivo
                        </div>

                        <div class="mb-3">
                            <label class="form-label label-text fw-bold text-secondary mb-1">Correo del Director</label>
                            <input type="email" name="email_director" placeholder="correo@ejemplo.com" 
                                   class="form-control form-control-lg input-codigo py-2 border-2 shadow-sm fs-6" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label label-text fw-bold text-secondary mb-1">Contraseña</label>
                            <input type="password" name="password_director" placeholder="********" 
                                   class="form-control form-control-lg input-codigo py-2 border-2 shadow-sm fs-6" required>
                        </div>
                    </div>

                    <button type="submit" id="btn-registrar" class="btn btn-lg btn-entrar w-100 py-3 fw-bold shadow-sm transition-transform mt-2">
                        REGISTRAR INSTITUCIÓN
                    </button>
                </form>
                
                <div class="text-center mt-4 border-top pt-3">
                    <a href="iniciodesesion_Director.php" class="btn btn-link link-footer p-0 text-decoration-none fw-bold text-secondary fs-7">
                        ← ¿Ya tienes registro? Inicia sesión aquí
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/registro.js"></script>
</body>
</html>