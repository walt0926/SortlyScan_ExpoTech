<?php
// Iniciamos sesión para obtener el ID del alumno
session_start();

// Validamos si existe el ID del alumno en la sesión. 
// Si no, asignamos el 1 por defecto para las pruebas.
$id_alumno_actual = isset($_SESSION['id_alumno']) ? $_SESSION['id_alumno'] : 1; 

// Credenciales de la base de datos
$host = 'localhost';
$dbname = 'bdsortlyscan';
$username = 'root'; 
$password = ''; 

$nombre_alumno = "Estudiante";
$puntos_totales = 0;
$ranking_datos = [];
$posicion_actual = 0;

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Consultamos los datos del alumno actual
    $stmt = $pdo->prepare("SELECT nombre_display, puntos_totales, id_clase FROM Alumnos WHERE id_alumno = ?");
    $stmt->execute([$id_alumno_actual]);
    $alumno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($alumno) {
        $nombre_alumno = $alumno['nombre_display'];
        $puntos_totales = $alumno['puntos_totales'];
        $id_clase_actual = $alumno['id_clase'];

        // 2. Traemos a todos los alumnos de la misma clase ordenados por puntos (Ranking Real)
        if ($id_clase_actual) {
            $stmtRank = $pdo->prepare("SELECT id_alumno, nombre_display, puntos_totales FROM Alumnos WHERE id_clase = ? ORDER BY puntos_totales DESC");
            $stmtRank->execute([$id_clase_actual]);
            $ranking_datos = $stmtRank->fetchAll(PDO::FETCH_ASSOC);

            // Encontrar la posición del alumno actual en el arreglo
            foreach ($ranking_datos as $index => $row) {
                if ($row['id_alumno'] == $id_alumno_actual) {
                    $posicion_actual = $index + 1;
                    break;
                }
            }
        }
    }

} catch (PDOException $e) {
    error_log("Error de BD: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - Panel de Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/vista_estudiante.css">
</head>
<body>

    <div class="container py-4 student-panel-container">
        
        <header class="d-flex justify-content-between align-items-start mb-4">
            <div class="user-welcome">
                <h1 class="fw-800 m-0 h2 text-capitalize">¡Hola, <?= htmlspecialchars($nombre_alumno); ?>! 👋</h1>
                <p class="text-muted m-0 small mt-1">Revisa tus logros de hoy</p>
            </div>
            <button class="btn-logout d-flex align-items-center justify-content-center" id="btn-logout-student" title="Cerrar Sesión">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </button>
        </header>

        <section class="points-card p-4 mb-4 text-white">
            <div class="position-relative" style="z-index: 2;">
                <div class="text-white-50 small fw-bold text-uppercase tracking-wider mb-1">
                    <i class="fa-solid fa-star me-1"></i> Tus puntos acumulados
                </div>
                <div class="display-3 fw-extrabold my-2 lh-1" id="puntos-estudiante"><?= number_format($puntos_totales); ?></div>
                
                <div class="rank-badge text-white mt-2 small">
                    <i class="fa-solid fa-trophy text-warning"></i> 
                    <span>#<?= $posicion_actual > 0 ? $posicion_actual : '--'; ?> en tu clase</span>
                </div>
            </div>
            <i class="fa-solid fa-star decorative-star"></i>
        </section>

        <section class="ranking-container">
            <h3 class="h5 fw-bold mb-3 d-flex align-items-center gap-2">
                <i class="fa-solid fa-medal text-warning"></i> Ranking de tu clase
            </h3>
            
            <div class="ranking-box p-3" id="contenedor-ranking">
                <?php if (!empty($ranking_datos)): ?>
                    <?php foreach ($ranking_datos as $index => $row): 
                        $pos = $index + 1;
                        $clasePodio = 'rank-default';
                        $iconPodio = $pos;
                        if ($pos === 1) { $clasePodio = 'rank-1'; $iconPodio = '<i class="fa-solid fa-crown small"></i>'; }
                        elseif ($pos === 2) { $clasePodio = 'rank-2'; $iconPodio = '<i class="fa-solid fa-trophy small"></i>'; }
                        elseif ($pos === 3) { $clasePodio = 'rank-3'; $iconPodio = '<i class="fa-solid fa-medal small"></i>'; }

                        $esUsuarioActual = ($row['id_alumno'] == $id_alumno_actual) ? 'current-user' : '';
                    ?>
                        <div class="ranking-item <?= $esUsuarioActual; ?>">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rank-icon <?= $clasePodio; ?>">
                                    <?= $iconPodio; ?>
                                </div>
                                <span class="fw-bold text-secondary"><?= htmlspecialchars($row['nombre_display']); ?></span>
                            </div>
                            <div class="fw-extrabold text-dark d-flex align-items-center gap-1">
                                <i class="fa-solid fa-star text-warning small me-1"></i><?= number_format($row['puntos_totales']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center text-muted py-4 small">
                        <i class="fa-solid fa-user-group d-block mb-2 h3 opacity-50"></i>
                        Aún no hay alumnos en esta clase.
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <button class="fab-camera" id="btn-scan-code">
            <i class="fa-solid fa-camera"></i> Escanear Código
        </button>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <body data-student-id="<?= $id_alumno_actual; ?>">

    <script src="JS/vista_estudiante.js"></script>
</body>
</html>