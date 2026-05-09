<?php
// auth/verificar_acceso.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Verifica si el usuario tiene permiso para ver una página.
 * @param array $rolesPermitidos Lista de roles que pueden entrar (ej: ['Director', 'Maestro'])
 */
function verificarAcceso($rolesPermitidos) {
    // 1. ¿Está logueado?
    if (!isset($_SESSION['rol'])) {
        // Si es una petición de página normal, redirigir al login
        header("Location: ../public/Iniciodesesion.php");
        exit();
    }

    // 2. ¿Tiene el rol adecuado?
    if (!in_array($_SESSION['rol'], $rolesPermitidos)) {
        // Si no tiene permiso, lo mandamos a una página de error o al home
        header("Location: ../public/Home_pw.php?error=no_autorizado");
        exit();
    }
}

/**
 * Verifica acceso para archivos de BACKEND (API)
 * Devuelve JSON en lugar de redireccionar.
 */
function verificarAccesoAPI($rolesPermitidos) {
    if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], $rolesPermitidos)) {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Acceso denegado: permisos insuficientes."]);
        exit();
    }
}
?>