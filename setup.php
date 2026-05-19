<?php
// setup.php
/*
========================================================================
CREDENCIALES DE PRUEBA (MULTI-ESCUELA):
========================================================================

--- ESCUELA 1 ---
CCT / MINED: 10293
Director: director1@sortly.com | Pass: admin123
Maestro: profe_juan | Pass: maestro123
Alumno (Aula SORT26): Pepito Reciclador | PIN: 1234

--- ESCUELA 2 ---
CCT / MINED: 45012
Director: director2@sortly.com | Pass: admin123
Maestro: profe_maria | Pass: maestro123
Alumno (Aula SORT27): Ana Verde | PIN: 1234

--- ESCUELA 3 ---
CCT / MINED: 88104
Director: director3@sortly.com | Pass: admin123
Maestro: profe_carlos | Pass: maestro123
Alumno (Aula SORT28): Luis Planeta | PIN: 1234
========================================================================
*/

require_once("config/conexion.php"); 

header("Content-Type: text/html; charset=utf-8");

// Arreglo con los datos de las 3 escuelas de prueba
$escuelas = [
    [
        'id_mined' => '10293', 'nombre_centro' => 'Centro Escolar SortlyScan',
        'dir_email' => 'director1@sortly.com', 'dir_nombre' => 'Director Uno',
        'maestro_user' => 'profe_juan', 'maestro_nombre' => 'Juan Pérez',
        'nombre_salon' => '6to Grado A', 'codigo_aula' => 'SORT26',
        'alumno_nombre' => 'Pepito Reciclador', 'alumno_pin' => '1234'
    ],
    [
        'id_mined' => '45012', 'nombre_centro' => 'Instituto Nacional San Miguel',
        'dir_email' => 'director2@sortly.com', 'dir_nombre' => 'Directora Dos',
        'maestro_user' => 'profe_maria', 'maestro_nombre' => 'María López',
        'nombre_salon' => '1er Año B', 'codigo_aula' => 'SORT27',
        'alumno_nombre' => 'Ana Verde', 'alumno_pin' => '1234'
    ],
    [
        'id_mined' => '88104', 'nombre_centro' => 'Colegio Bilingüe El Salvador',
        'dir_email' => 'director3@sortly.com', 'dir_nombre' => 'Director Tres',
        'maestro_user' => 'profe_carlos', 'maestro_nombre' => 'Carlos Robles',
        'nombre_salon' => '9no Grado C', 'codigo_aula' => 'SORT28',
        'alumno_nombre' => 'Luis Planeta', 'alumno_pin' => '1234'
    ]
];

// Hasheamos las contraseñas una sola vez para optimizar
$pass_dir_hash = password_hash("admin123", PASSWORD_DEFAULT);
$pass_maestro_hash = password_hash("maestro123", PASSWORD_DEFAULT);

try {
    // Iniciamos el ciclo para registrar cada escuela
    foreach ($escuelas as $e) {
        
        // 1. Crear Institución
        $stmt1 = $pdo->prepare("INSERT IGNORE INTO Instituciones (id_mined, nombre_centro) VALUES (?, ?)");
        $stmt1->execute([$e['id_mined'], $e['nombre_centro']]);

        // 2. Crear Director (Login por EMAIL)
        $stmt2 = $pdo->prepare("INSERT IGNORE INTO Usuarios (id_mined, email, password, rol, nombre_completo) VALUES (?, ?, ?, 'Director', ?)");
        $stmt2->execute([$e['id_mined'], $e['dir_email'], $pass_dir_hash, $e['dir_nombre']]);

        // 3. Crear Maestro (Login por USERNAME)
        $stmt3 = $pdo->prepare("INSERT IGNORE INTO Usuarios (id_mined, username, password, rol, nombre_completo) VALUES (?, ?, ?, 'Maestro', ?)");
        $stmt3->execute([$e['id_mined'], $e['maestro_user'], $pass_maestro_hash, $e['maestro_nombre']]);
        
        // Obtenemos el ID del maestro recién creado
        $stmt_find = $pdo->prepare("SELECT id_usuario FROM Usuarios WHERE username = ?");
        $stmt_find->execute([$e['maestro_user']]);
        $id_maestro = $stmt_find->fetchColumn();

        // 4. Crear un Salón de prueba
        if ($id_maestro) {
            $stmt4 = $pdo->prepare("INSERT IGNORE INTO Salones (id_mined, id_maestro, nombre_salon, codigo_aula) VALUES (?, ?, ?, ?)");
            $stmt4->execute([$e['id_mined'], $id_maestro, $e['nombre_salon'], $e['codigo_aula']]);
            
            // Obtenemos el ID del salón recién creado
            $stmt_find_s = $pdo->prepare("SELECT id_salon FROM Salones WHERE codigo_aula = ?");
            $stmt_find_s->execute([$e['codigo_aula']]);
            $id_salon = $stmt_find_s->fetchColumn();

            // 5. Crear un Alumno de prueba
            if ($id_salon) {
                $stmt5 = $pdo->prepare("INSERT IGNORE INTO Alumnos (id_salon, nombre_display, pin, puntos_totales) VALUES (?, ?, ?, ?)");
                $stmt5->execute([$id_salon, $e['alumno_nombre'], $e['alumno_pin'], 0]);
            }
        }
    }

    echo "<h2>✅ Sistema inicializado con éxito</h2>";
    echo "Revisa el comentario al inicio del código PHP para ver las credenciales de las 3 escuelas.";

} catch (PDOException $e) {
    echo "<h2>❌ Error al inicializar:</h2> " . $e->getMessage();
}
?>