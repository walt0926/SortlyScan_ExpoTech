<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - Panel de Director</title>
    <link rel="stylesheet" href="CSS/vista_director.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container">
        <header class="main-header">
            <div class="titles">
                <h1 id="school-name">Panel de Director</h1>
                <p>Vista general de la institución</p>
            </div>
            <button class="logout-btn" onclick="cerrarSesion()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Salir</button>
        </header>

        <!-- Estadísticas Dinámicas -->
        <section class="stats-grid">
            <div class="stat-card orange">
                <div class="stat-icon"><i class="fa-solid fa-school"></i> Total clases</div>
                <div class="stat-number" id="stat-clases">0</div>
            </div>
            <div class="stat-card teal">
                <div class="stat-icon"><i class="fa-solid fa-users"></i> Total estudiantes</div>
                <div class="stat-number" id="stat-alumnos">0</div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon"><i class="fa-solid fa-trophy"></i> Puntos totales</div>
                <div class="stat-number" id="stat-puntos">0</div>
            </div>
        </section>

        <!-- SECCIÓN DE GESTIÓN -->
        <section class="management-section ranking-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-plus-circle"></i> Gestión de Clases y Docentes</h3>
            </div>
            <div class="form-management-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Crear Salón -->
                <div class="form-box" style="background: #f8fafc; padding: 20px; border-radius: 15px;">
                    <h4 style="margin-bottom:10px">Registrar Nueva Clase</h4>
                    <input type="text" id="nombre-clase" placeholder="Ej: 3ro Primaria - A" class="input-estilo">
                    <button onclick="crearClase()" class="btn-accion">Crear Clase</button>
                </div>
                <!-- Asignar Docente -->
                <div class="form-box" style="background: #f8fafc; padding: 20px; border-radius: 15px;">
                    <h4 style="margin-bottom:10px">Asignar Docente a Clase</h4>
                    <select id="select-clases" class="input-estilo"><option>Cargando clases...</option></select>
                    <input type="text" id="nombre-docente" placeholder="Nombre del Profesor" class="input-estilo">
                    <input type="password" id="pass-docente" placeholder="Contraseña Docente" class="input-estilo">
                    <button onclick="asignarDocente()" class="btn-accion">Asignar Docente</button>
                </div>
            </div>
        </section>

        <!-- Ranking Dinámico -->
        <section class="ranking-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-trophy"></i> Ranking de Clases</h3>
            </div>
            <div class="ranking-list" id="ranking-container">
                <!-- Se llena con JS -->
                <p style="text-align:center; color: #999;">Cargando ranking de la institución...</p>
            </div>
        </section>

        <section class="acopio-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-house-chimney-window"></i> Centros de Acopio</h3>
            </div>
            <button class="go-acopio-btn" onclick="location.href='Centro_acopio.php'">
                Gestionar Centros de Acopio 
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </section>
    </div>

    <script src="JS/Panel_Director.js"></script>
</body>
</html>