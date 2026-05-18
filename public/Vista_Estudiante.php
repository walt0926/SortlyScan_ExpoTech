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

try {
    // Database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // We query the data of the current student
    $stmt = $pdo->prepare("SELECT nombre_display, puntos_totales FROM Alumnos WHERE id_alumno = ?");
    $stmt->execute([$id_alumno_actual]);
    $alumno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($alumno) {
        $nombre_alumno = $alumno['nombre_display'];
        $puntos_totales = $alumno['puntos_totales'];
    }

} catch (PDOException $e) {
    // In production you can handle the error, here we let it continue with default values
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
            <button class="icon-exit-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
        </header>

        <section class="points-card">
            <div class="points-content">
                <div class="points-header">
                    <i class="fa-solid fa-trophy"></i> Your points
                </div>
                <div class="points-number"><?php echo htmlspecialchars($puntos_totales); ?></div>
                <div class="rank-badge">
                    <i class="fa-solid fa-trophy"></i> #3 in your class
                </div>
            </div>
            <i class="fa-solid fa-star decorative-star"></i>
        </section>

        <section class="ranking-container">
            <h3><i class="fa-solid fa-trophy"></i> Class Ranking</h3>
            
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