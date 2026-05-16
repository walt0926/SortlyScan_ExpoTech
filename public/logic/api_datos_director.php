<?php
// public/logic/api_datos_director.php
session_start();
header('Content-Type: application/json');

// Validar sesión del director antes de hacer cualquier cosa
if (!isset($_SESSION['id_mined']) || !isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'error' => 'Sesión no válida o caducada.']);
    exit();
}

$id_mined = $_SESSION['id_mined'];
$id_director = $_SESSION['id_usuario'];

try {
    // CORRECCIÓN DE RUTA: Subimos dos niveles para llegar a config/conexion.php
    require_once '../../config/conexion.php'; 

    $action = isset($_GET['action']) ? $_GET['action'] : '';

    switch ($action) {
        case 'get_dashboard':
            // Contadores estadísticos globales utilizando tu $pdo
            $stmtStats = $pdo->prepare("
                SELECT 
                    (SELECT COUNT(*) FROM Salones WHERE id_mined = ?) AS total_clases,
                    (SELECT COUNT(*) FROM Alumnos a JOIN Salones s ON a.id_salon = s.id_salon WHERE s.id_mined = ?) AS total_alumnos,
                    (SELECT COALESCE(SUM(puntos_totales), 0) FROM Alumnos a JOIN Salones s ON a.id_salon = s.id_salon WHERE s.id_mined = ?) AS total_puntos
            ");
            $stmtStats->execute([$id_mined, $id_mined, $id_mined]);
            $stats = $stmtStats->fetch();

            // Ranking de salones de esta institución
            $stmtRanking = $pdo->prepare("
                SELECT s.nombre_salon, COALESCE(SUM(a.puntos_totales), 0) as puntos_clase
                FROM Salones s
                LEFT JOIN Alumnos a ON s.id_salon = a.id_salon
                WHERE s.id_mined = ?
                GROUP BY s.id_salon
                ORDER BY puntos_clase DESC
            ");
            $stmtRanking->execute([$id_mined]);
            $ranking = $stmtRanking->fetchAll();

            echo json_encode(['success' => true, 'stats' => $stats, 'ranking' => $ranking]);
            break;

        case 'get_clases':
            // Obtiene las clases para el <select> del formulario
            $stmt = $pdo->prepare("SELECT id_salon, nombre_salon FROM Salones WHERE id_mined = ? ORDER BY nombre_salon ASC");
            $stmt->execute([$id_mined]);
            $clases = $stmt->fetchAll();
            echo json_encode(['success' => true, 'clases' => $clases]);
            break;

        case 'crear_clase':
            $nombre_clase = isset($_POST['nombre_clase']) ? trim($_POST['nombre_clase']) : '';
            if (empty($nombre_clase)) {
                echo json_encode(['success' => false, 'error' => 'El nombre de la clase es obligatorio.']);
                exit();
            }

            $codigo_aula = strtoupper(substr(str_shuffle("0123456789ABCDEFGHJKLMNOPQRSTUVWXYZ"), 0, 6));

            // Inserta el salón usando la estructura original de tu base de datos
            $stmt = $pdo->prepare("INSERT INTO Salones (id_mined, id_maestro, nombre_salon, codigo_aula) VALUES (?, ?, ?, ?)");
            $stmt->execute([$id_mined, $id_director, $nombre_clase, $codigo_aula]);

            echo json_encode(['success' => true, 'message' => 'Clase creada con éxito. Código: ' . $codigo_aula]);
            break;

        case 'asignar_docente':
            $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : 0;
            $nombre_docente = isset($_POST['nombre_docente']) ? trim($_POST['nombre_docente']) : '';
            $pass_docente = isset($_POST['pass_docente']) ? trim($_POST['pass_docente']) : '';

            if ($id_salon === 0 || empty($nombre_docente) || empty($pass_docente)) {
                echo json_encode(['success' => false, 'error' => 'Todos los campos son obligatorios.']);
                exit();
            }

            $username_base = strtolower(str_replace(' ', '', $nombre_docente));
            $username = $username_base . rand(10, 99);
            $password_hashed = password_hash($pass_docente, PASSWORD_BCRYPT);

            // 1. Crear el usuario Maestro
            $stmtUser = $pdo->prepare("INSERT INTO Usuarios (id_mined, username, password, rol, nombre_completo) VALUES (?, ?, ?, 'Maestro', ?)");
            $stmtUser->execute([$id_mined, $username, $password_hashed, $nombre_docente]);
            $id_nuevo_maestro = $pdo->lastInsertId();

            // 2. Vincular el maestro al salón seleccionado
            $stmtSalon = $pdo->prepare("UPDATE Salones SET id_maestro = ? WHERE id_salon = ? AND id_mined = ?");
            $stmtSalon->execute([$id_nuevo_maestro, $id_salon, $id_mined]);

            echo json_encode(['success' => true, 'message' => "Docente asignado. Usuario generado: $username"]);
            break;

        default:
            echo json_encode(['success' => false, 'error' => 'Acción no reconocida.']);
            break;
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>