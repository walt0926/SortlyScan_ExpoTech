<?php
// We start the session to get the student's ID
session_start();

// We validate if the student's ID exists in the session.
// If not, we assign a default value of 1 for testing purposes.
$id_alumno_actual = isset($_SESSION['id_alumno']) ? $_SESSION['id_alumno'] : 1; 

// Database credentials (Adjust if necessary)
$host = 'localhost';
$dbname = 'bdsortlyscan';
$username = 'root'; 
$password = ''; 

// Default variables in case the database does not load
$nombre_alumno = "Student";
$puntos_totales = 0;
$mi_posicion = 0;
$ranking_salon = array(); // Almacenará a los compañeros del salón

try {
    // Database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Consultamos los datos del alumno actual incluyendo su salón asignado
    $stmt = $pdo->prepare("SELECT nombre_display, puntos_totales, id_salon FROM Alumnos WHERE id_alumno = ?");
    $stmt->execute(array($id_alumno_actual));
    $alumno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($alumno) {
        $nombre_alumno = $alumno['nombre_display'];
        $puntos_totales = $alumno['puntos_totales'];
        $id_salon_actual = $alumno['id_salon'];

        // 2. Traemos a TODOS los alumnos que compartan el mismo salón ordenados por puntos (Descendente)
        $stmt_rank = $pdo->prepare("SELECT id_alumno, nombre_display, puntos_totales FROM Alumnos WHERE id_salon = ? ORDER BY puntos_totales DESC");
        $stmt_rank->execute(array($id_salon_actual));
        $ranking_salon = $stmt_rank->fetchAll(PDO::FETCH_ASSOC);

        // 3. Calculamos la posición exacta del alumno actual dentro de su salón
        foreach ($ranking_salon as $index => $companion) {
            if ($companion['id_alumno'] == $id_alumno_actual) {
                $mi_posicion = $index + 1; // Las posiciones empiezan en 1, no en 0
                break;
            }
        }
    }

} catch (PDOException $e) {
    error_log("Connection error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - Student</title>
    <link rel="stylesheet" href="CSS/vista_estudiante.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container">
        <header class="header">
            <div class="user-welcome">
                <h1>Hello, <?php echo htmlspecialchars($nombre_alumno); ?>!</h1>
                <p>Keep it up, you are doing great!</p>
            </div>
            <button class="icon-exit-btn" onclick="localStorage.clear(); location.href='ValidarInstitucion.php';">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </button>
        </header>

        <section class="points-card">
            <div class="points-content">
                <div class="points-header">
                    <i class="fa-solid fa-trophy"></i> Your points
                </div>
                <div class="points-number"><?php echo htmlspecialchars($puntos_totales); ?></div>
                <div class="rank-badge">
                    <i class="fa-solid fa-trophy"></i> #<?php echo $mi_posicion; ?> in your class
                </div>
            </div>
            <i class="fa-solid fa-star decorative-star"></i>
        </section>

        <section class="ranking-container">
            <h3><i class="fa-solid fa-trophy"></i> Class Ranking</h3>
            
            <div class="ranking-list">
                <?php 
                if (!empty($ranking_salon)): 
                    foreach ($ranking_salon as $index => $alum): 
                        // Asignamos la medalla visual del CSS según su lugar
                        $rankClass = "";
                        if ($index === 0) $rankClass = "gold";
                        elseif ($index === 1) $rankClass = "silver";
                        elseif ($index === 2) $rankClass = "bronze";
                ?>
                        <div class="ranking-item">
                            <div class="item-left">
                                <div class="rank-icon <?php echo $rankClass; ?>">
                                    <?php if ($index < 3): ?>
                                        <i class="fa-solid fa-trophy"></i>
                                    <?php else: ?>
                                        <span style="font-size: 0.9rem; font-weight: bold; color: #666;"><?php echo $index + 1; ?></span>
                                    <?php endif; ?>
                                </div>
                                <span class="name"><?php echo htmlspecialchars($alum['nombre_display']); ?></span>
                            </div>
                            <div class="item-right">
                                <i class="fa-solid fa-star"></i> <?php echo htmlspecialchars($alum['puntos_totales']); ?>
                            </div>
                        </div>
                <?php 
                    endforeach; 
                else: 
                ?>
                    <p style="text-align:center; color: #999; padding: 15px;">No students registered in this classroom.</p>
                <?php endif; ?>
            </div>
        </section>

        <button class="fab-camera" onclick="location.href='SortlyScanIA.php'">
            <i class="fa-solid fa-camera"></i>
        </button>
    </div>

</body>
</html>