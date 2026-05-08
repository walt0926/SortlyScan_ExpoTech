<?php
// auth/login.php
session_start();
require_once '../config/conexion.php'; 
header('Content-Type: application/json');

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? '';

switch ($action) {
    case 'login_staff':
        $identifier = filter_input(INPUT_POST, 'identifier', FILTER_SANITIZE_STRING);
        $password = $_POST['password'] ?? '';

        if (!$identifier || !$password) {
            echo json_encode(['success' => false, 'message' => 'Faltan credenciales.']);
            exit;
        }

        try {
            $stmt = $pdo->prepare("SELECT id_usuario, rol, password, id_mined, email, username FROM Usuarios WHERE email = ? OR username = ?");
            $stmt->execute([$identifier, $identifier]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id_usuario'];
                $_SESSION['rol'] = $user['rol'];
                $_SESSION['id_mined'] = $user['id_mined'];

                echo json_encode([
                    'success' => true, 
                    'rol' => $user['rol'], 
                    'message' => 'Autenticación exitosa.'
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error de base de datos.']);
        }
        break;

    case 'get_alumnos_classroom':
        $id_mined = filter_input(INPUT_POST, 'id_mined', FILTER_SANITIZE_STRING);
        $codigo_aula = filter_input(INPUT_POST, 'codigo_aula', FILTER_SANITIZE_STRING);

        try {
            $stmt = $pdo->prepare("
                SELECT Alumnos.id_alumno, Alumnos.nombre_display 
                FROM Alumnos 
                JOIN Salones ON Alumnos.id_salon = Salones.id_salon
                WHERE Salones.id_mined = ? AND Salones.codigo_aula = ?
                ORDER BY Alumnos.nombre_display ASC
            ");
            $stmt->execute([$id_mined, $codigo_aula]);
            $alumnos = $stmt->fetchAll();

            if (count($alumnos) > 0) {
                echo json_encode(['success' => true, 'alumnos' => $alumnos]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Códigos no válidos o salón vacío.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error de consulta.']);
        }
        break;

    case 'login_alumno':
        $id_alumno = filter_input(INPUT_POST, 'id_alumno', FILTER_SANITIZE_NUMBER_INT);
        $pin = filter_input(INPUT_POST, 'pin', FILTER_SANITIZE_STRING);

        try {
            $stmt = $pdo->prepare("SELECT id_alumno, nombre_display, pin, id_salon FROM Alumnos WHERE id_alumno = ?");
            $stmt->execute([$id_alumno]);
            $alumno = $stmt->fetch();

            if ($alumno && $alumno['pin'] === $pin) {
                $alumno_token = bin2hex(random_bytes(16)); 
                echo json_encode([
                    'success' => true,
                    'alumno' => [
                        'id_alumno' => $alumno['id_alumno'],
                        'nombre_display' => $alumno['nombre_display'],
                        'id_salon' => $alumno['id_salon']
                    ],
                    'token' => $alumno_token,
                    'message' => 'Acceso concedido.'
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'PIN incorrecto.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al validar el PIN.']);
        }
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Acción no válida.']);
        break;
}
?>