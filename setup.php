<?php
// setup.php
/*
========================================================================
CREDENCIALES DE PRUEBA (PARA COPIAR Y PEGAR):
========================================================================
DIRECTOR:
- Email: director@sortly.com
- Password: admin123

MAESTRO:
- Username: profe_juan
- Password: maestro123

ALUMNO (Login Classroom):
- Código MINED: 10293
- Código Aula: SORT26
- Nombre: Pepito Reciclador
- PIN: 1234
========================================================================
*/

require_once("config/conexion.php"); 

header("Content-Type: text/html; charset=utf-8");

try {
    // 1. Crear Institución de prueba
    $id_mined = "10293";
    $stmt1 = $pdo->prepare("INSERT IGNORE INTO Instituciones (id_mined, nombre_centro) VALUES (?, ?)");
    $stmt1->execute([$id_mined, 'Centro Escolar SortlyScan']);

    // 2. Crear Director (Login por EMAIL)
    $email_dir = "director@sortly.com";
    $pass_dir = password_hash("admin123", PASSWORD_DEFAULT);
    
    $stmt2 = $pdo->prepare("INSERT IGNORE INTO Usuarios (id_mined, email, password, rol, nombre_completo) VALUES (?, ?, ?, 'Director', ?)");
    $stmt2->execute([$id_mined, $email_dir, $pass_dir, 'Administrador de Prueba']);

    // 3. Crear Maestro (Login por USERNAME)
    $user_maestro = "profe_juan";
    $pass_maestro = password_hash("maestro123", PASSWORD_DEFAULT);
    
    $stmt3 = $pdo->prepare("INSERT IGNORE INTO Usuarios (id_mined, username, password, rol, nombre_completo) VALUES (?, ?, ?, 'Maestro', ?)");
    $stmt3->execute([$id_mined, $user_maestro, $pass_maestro, 'Juan Pérez']);
    
    // Obtenemos el ID del maestro recién creado buscando su username (ya que INSERT IGNORE no devuelve lastInsertId si ya existe)
    $stmt_find = $pdo->prepare("SELECT id_usuario FROM Usuarios WHERE username = ?");
    $stmt_find->execute([$user_maestro]);
    $id_maestro = $stmt_find->fetchColumn();

    // 4. Crear un Salón de prueba
    if ($id_maestro) {
        $stmt4 = $pdo->prepare("INSERT IGNORE INTO Salones (id_mined, id_maestro, nombre_salon, codigo_aula) VALUES (?, ?, ?, ?)");
        $stmt4->execute([$id_mined, $id_maestro, '6to Grado A', 'SORT26']);
        
        $stmt_find_s = $pdo->prepare("SELECT id_salon FROM Salones WHERE codigo_aula = ?");
        $stmt_find_s->execute(['SORT26']);
        $id_salon = $stmt_find_s->fetchColumn();

        // 5. Crear un Alumno de prueba
        if ($id_salon) {
            $stmt5 = $pdo->prepare("INSERT IGNORE INTO Alumnos (id_salon, nombre_display, pin, puntos_totales) VALUES (?, ?, ?, ?)");
            $stmt5->execute([$id_salon, 'Pepito Reciclador', '1234', 0]);
        }
    }

    echo "<h2>✅ Sistema inicializado con éxito</h2>";
    echo "Revisa el comentario al inicio del código PHP para ver las credenciales.";

} catch (PDOException $e) {
    echo "<h2>❌ Error al inicializar:</h2> " . $e->getMessage();
}
?>