<?php
// public/Vista_docente.php

// 1. Iniciamos o retomamos la sesión segura
session_start();

// 2. Validamos que el usuario esté logueado y sea un Maestro
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'Maestro') {
    // Si no está logueado o intenta entrar un alumno/director, lo expulsamos al login
    header("Location: iniciodesesion_Director.php");
    exit;
}

// 3. Conexión a la base de datos
require_once '../config/conexion.php';

$id_maestro = $_SESSION['id_usuario'];
$nombre_maestro = $_SESSION['nombre_completo'];

// Inicializamos variables por defecto por si el maestro aún no ha creado un salón
$codigo_clase = "SIN-AULA";
$nombre_clase = "Panel de Docente";
$alumnos = [];

try {
    // 4. Obtenemos el salón asignado a este maestro
    $stmtSalon = $pdo->prepare("SELECT id_salon, nombre_salon, codigo_aula FROM Salones WHERE id_maestro = :id_maestro LIMIT 1");
    $stmtSalon->bindParam(':id_maestro', $id_maestro, PDO::PARAM_INT);
    $stmtSalon->execute();
    $salon = $stmtSalon->fetch();

    // 5. Si el maestro tiene un salón, buscamos a sus alumnos ordenados por puntos (de mayor a menor)
    if ($salon) {
        $id_salon = $salon['id_salon'];
        $codigo_clase = $salon['codigo_aula'];
        $nombre_clase = $salon['nombre_salon'];

        $stmtAlumnos = $pdo->prepare("SELECT id_alumno, nombre_display, puntos_totales FROM Alumnos WHERE id_salon = :id_salon ORDER BY puntos_totales DESC");
        $stmtAlumnos->bindParam(':id_salon', $id_salon, PDO::PARAM_INT);
        $stmtAlumnos->execute();
        $alumnos = $stmtAlumnos->fetchAll();
    }

} catch (PDOException $e) {
    // En caso de error de base de datos, mostramos un mensaje de emergencia
    die("Error crítico al cargar los datos: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - <?= htmlspecialchars($nombre_clase) ?></title>
    <link rel="stylesheet" href="style_panel.css">
    <link rel="stylesheet" href="CSS/Vista_docente.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container">
        <header class="main-header">
            <div class="titles">
                <h1><?= htmlspecialchars($nombre_clase) ?></h1>
                <p>Bienvenido, Prof. <?= htmlspecialchars($nombre_maestro) ?>. Gestiona tu clase y los puntos de tus estudiantes.</p>
            </div>
            <button class="logout-btn" onclick="window.location.href='iniciodesesion_Director.php'"><i class="fa-solid fa-arrow-right-from-bracket"></i> Salir</button>
        </header>

        <section class="class-code-card">
            <div class="code-info">
                <span>Código de clase</span>
                <h2 id="class-code"><?= htmlspecialchars($codigo_clase) ?></h2>
            </div>
            <button class="copy-btn" onclick="copyCode()"><i class="fa-regular fa-copy"></i> Copiar</button>
        </section>

        <main class="students-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-trophy"></i> Estudiantes (<?= count($alumnos) ?>)</h3>
                <button class="add-student-btn"><i class="fa-solid fa-plus"></i> Agregar estudiante</button>
            </div>

            <div class="student-list">
                <?php if (count($alumnos) > 0): ?>
                    <?php foreach ($alumnos as $index => $alumno): 
                        // Lógica de medallas para el Top 3
                        $rankClass = '';
                        if ($index === 0) {
                            $rankClass = 'gold'; // 1er lugar
                        } elseif ($index === 1) {
                            $rankClass = 'silver'; // 2do lugar
                        } elseif ($index === 2) {
                            $rankClass = 'bronze'; // 3er lugar (asegúrate de tener una clase .bronze en tu CSS)
                        }
                    ?>
                        <div class="student-item" data-id="<?= $alumno['id_alumno'] ?>">
                            <div class="student-info">
                                <div class="rank-icon <?= $rankClass ?>"><i class="fa-solid fa-trophy"></i></div>
                                <div>
                                    <h4><?= htmlspecialchars($alumno['nombre_display']) ?></h4>
                                    <p><?= htmlspecialchars($alumno['puntos_totales']) ?> puntos</p>
                                </div>
                            </div>
                            <div class="actions">
                                <button class="edit-btn"><i class="fa-solid fa-pen"></i></button>
                                <button class="delete-btn"><i class="fa-solid fa-trash-can"></i></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="text-align: center; padding: 2rem; color: #6c757d;">
                        <i class="fa-solid fa-user-graduate" style="font-size: 2rem; margin-bottom: 10px;"></i>
                        <p>Aún no hay estudiantes registrados en tu clase.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script src="script_panel.js"></script>
    <script>
        // Pequeño script de apoyo para copiar el código al portapapeles si no lo tenías en tu script_panel.js
        function copyCode() {
            const code = document.getElementById('class-code').innerText;
            navigator.clipboard.writeText(code).then(() => {
                alert("¡Código " + code + " copiado al portapapeles!");
            }).catch(err => {
                console.error('Error al copiar: ', err);
            });
        }
    </script>
</body>
</html>