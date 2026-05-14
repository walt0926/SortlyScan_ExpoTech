<?php
// Iniciamos sesión para obtener el ID del alumno
session_start();

// Validamos si existe el ID del alumno en la sesión. 
// Si no, asignamos el 1 por defecto para las pruebas.
$id_alumno_actual = isset($_SESSION['id_alumno']) ? $_SESSION['id_alumno'] : 1; 

// Credenciales de la base de datos (Ajusta si es necesario)
$host = 'localhost';
$dbname = 'bdsortlyscan';
$username = 'root'; 
$password = ''; 

// Variables por defecto en caso de que no cargue la BD
$nombre_alumno = "Estudiante";
$puntos_totales = 0;

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consultamos los datos del alumno actual
    $stmt = $pdo->prepare("SELECT nombre_display, puntos_totales FROM Alumnos WHERE id_alumno = ?");
    $stmt->execute([$id_alumno_actual]);
    $alumno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($alumno) {
        $nombre_alumno = $alumno['nombre_display'];
        $puntos_totales = $alumno['puntos_totales'];
    }

} catch (PDOException $e) {
    // En producción puedes manejar el error, aquí lo dejamos continuar con valores por defecto
    error_log("Error de conexión: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - Estudiante</title>
    <link rel="stylesheet" href="CSS/vista_estudiante.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container">
        <header class="header">
            <div class="user-welcome">
                <h1>¡Hola, <?php echo htmlspecialchars($nombre_alumno); ?>!</h1>
                <p>Sigue así, ¡vas muy bien!</p>
            </div>
            <button class="icon-exit-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
        </header>

        <section class="points-card">
            <div class="points-content">
                <div class="points-header">
                    <i class="fa-solid fa-trophy"></i> Tus puntos
                </div>
                <div class="points-number"><?php echo htmlspecialchars($puntos_totales); ?></div>
                <div class="rank-badge">
                    <i class="fa-solid fa-trophy"></i> #3 en tu clase
                </div>
            </div>
            <i class="fa-solid fa-star decorative-star"></i>
        </section>

        <section class="ranking-container">
            <h3><i class="fa-solid fa-trophy"></i> Ranking de tu clase</h3>
            
            <div class="ranking-list">
                <div class="ranking-item">
                    <div class="item-left">
                        <div class="rank-icon gold"><i class="fa-solid fa-trophy"></i></div>
                        <span class="name">María González</span>
                    </div>
                    <div class="item-right">
                        <i class="fa-solid fa-star"></i> 250
                    </div>
                </div>

            </div>
        </section>

        <button class="fab-camera" onclick="location.href='SortlyScanIA.php'">
            <i class="fa-solid fa-camera"></i>
        </button>
    </div>

</body>
</html>