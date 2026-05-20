<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - Principal Panel</title>
    <link rel="stylesheet" href="CSS/vista_director.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container">
        <header class="main-header">
            <div class="titles">
                <div style="display: flex; align-items: baseline; gap: 15px;">
                    <h1 id="school-name">Principal Panel</h1>
                    <span id="school-cct" style="font-size: 1.1rem; color: #64748b; font-weight: bold; background: #e2e8f0; padding: 4px 12px; border-radius: 12px; font-family: monospace;">---</span>
                </div>
                <p>General overview of the institution</p>
            </div>
            <button class="logout-btn" onclick="cerrarSesion()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</button>
        </header>

        <section class="stats-grid">
            <div class="stat-card orange">
                <div class="stat-icon"><i class="fa-solid fa-school"></i> Total classes</div>
                <div class="stat-number" id="stat-clases">0</div>
            </div>
            <div class="stat-card teal">
                <div class="stat-icon"><i class="fa-solid fa-users"></i> Total students</div>
                <div class="stat-number" id="stat-alumnos">0</div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon"><i class="fa-solid fa-trophy"></i> Total points</div>
                <div class="stat-number" id="stat-puntos">0</div>
            </div>
        </section>

        <section class="management-section ranking-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-plus-circle"></i> Class & Teacher Management</h3>
            </div>
            <div class="form-management-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-box" style="background: #f8fafc; padding: 20px; border-radius: 15px;">
                    <h4 style="margin-bottom:10px">Register New Class</h4>
                    <input type="text" id="nombre-clase" placeholder="e.g., 3rd Grade - A" class="input-estilo">
                    <button onclick="crearClase()" class="btn-accion">Create Class</button>
                </div>
                <div class="form-box" style="background: #f8fafc; padding: 20px; border-radius: 15px;">
                    <h4 style="margin-bottom:10px">Assign Teacher to Class</h4>
                    <select id="select-clases" class="input-estilo"><option>Loading classes...</option></select>
                    
                    <input type="text" id="nombre-docente" placeholder="Teacher's Name" class="input-estilo">
                    <input type="text" id="user-docente" placeholder="Teacher's Username (e.g., miguel)" class="input-estilo">
                    <input type="password" id="pass-docente" placeholder="Teacher's Password" class="input-estilo">
                    
                    <button onclick="asignarDocente()" class="btn-accion">Assign Teacher</button>
                </div>
            </div>
        </section>

        <section class="ranking-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-trophy"></i> Class Ranking</h3>
            </div>
            <button class="ranking-list" id="ranking-container">
                <p style="text-align:center; color: #999;">Loading school ranking...</p>
            </button>
        </section>

        <section class="acopio-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-house-chimney-window"></i> Collection Centers</h3>
            </div>
            <button class="go-acopio-btn" onclick="location.href='Centro_acopio.php'">
                Manage Collection Centers 
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </section>
    </div>

    <script src="JS/Panel_Director.js"></script>
</body>
</html>