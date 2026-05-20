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
            <div style="display: flex; align-items: center; gap: 12px;">
                <button class="settings-btn" onclick="abrirModalAjustes()">
                    <i class="fa-solid fa-gear"></i>
                </button>
                <button class="logout-btn" onclick="cerrarSesion()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</button>
            </div>
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
            <div class="ranking-list" id="ranking-container" style="background: #ffffff; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <p style="text-align:center; color: #999; padding: 20px;">Loading school ranking...</p>
            </div>
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

    <div id="modal-ver-alumnos" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 9999; justify-content: center; align-items: center; padding: 15px;">
        <div style="background: white; padding: 30px; border-radius: 20px; width: 100%; max-width: 500px; max-height: 85vh; display: flex; flex-direction: column; box-shadow: 0 10px 25px rgba(0,0,0,0.2); box-sizing: border-box;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="margin: 0; color: #333; font-size: 1.3rem;"><i class="fa-solid fa-users" style="color: #00BCD4;"></i> Students: <span id="txt-modal-aula-nombre" style="font-weight: 800;"></span></h3>
                <button onclick="cerrarModalAlumnos()" style="background: transparent; border: none; font-size: 1.2rem; cursor: pointer; color: #94a3b8;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div id="lista-alumnos-clase" style="overflow-y: auto; flex-grow: 1; padding-right: 5px;"></div>
        </div>
    </div>

    <div id="modal-editar-salon" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 9999; justify-content: center; align-items: center; padding: 15px;">
        <div style="background: white; padding: 30px; border-radius: 20px; width: 100%; max-width: 420px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); box-sizing: border-box;">
            <h3 style="margin-top:0; margin-bottom: 20px; color: #333; font-size: 1.3rem;"><i class="fa-solid fa-chalkboard-user" style="color: #00BCD4;"></i> Edit Classroom Details</h3>
            <form id="form-editar-salon">
                <input type="hidden" id="edit-salon-id">
                
                <label style="display:block; margin-bottom:5px; font-weight:bold; font-size:0.85rem; color:#4a5568;">Classroom Name</label>
                <input type="text" id="edit-salon-nombre" class="input-estilo" style="margin-bottom:15px;" required>

                <div style="border-top: 1px dashed #e2e8f0; margin: 15px 0; padding-top: 15px;">
                    <h5 style="margin: 0 0 10px 0; color:#00BCD4; font-size:0.9rem;">Assigned Teacher Settings</h5>
                </div>

                <label style="display:block; margin-bottom:5px; font-weight:bold; font-size:0.85rem; color:#4a5568;">Teacher's Full Name</label>
                <input type="text" id="edit-docente-nombre" class="input-estilo" style="margin-bottom:15px;" placeholder="No teacher assigned yet" required>

                <label style="display:block; margin-bottom:5px; font-weight:bold; font-size:0.85rem; color:#4a5568;">Teacher's Username</label>
                <input type="text" id="edit-docente-user" class="input-estilo" style="margin-bottom:15px;" placeholder="e.g., miguel" required>

                <label style="display:block; margin-bottom:5px; font-weight:bold; font-size:0.85rem; color:#4a5568;">New Password <span style="font-weight:normal; color:#94a3b8;">(Optional)</span></label>
                <input type="password" id="edit-docente-pass" class="input-estilo" style="margin-bottom:20px;" placeholder="Leave blank to keep current password">

                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" onclick="cerrarModalEditarSalon()" style="padding: 10px 18px; border: none; background: #e2e8f0; color: #4a5568; border-radius: 10px; font-weight: bold; cursor: pointer;">Cancel</button>
                    <button type="submit" style="padding: 10px 18px; border: none; background: #00BCD4; color: white; border-radius: 10px; font-weight: bold; cursor: pointer;">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-eliminar-salon" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 9999; justify-content: center; align-items: center; padding: 15px;">
        <div style="background: white; padding: 30px; border-radius: 20px; width: 100%; max-width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); box-sizing: border-box;">
            <h3 style="margin-top: 0; margin-bottom: 15px; color: #ef4444; font-size: 1.3rem;"><i class="fa-solid fa-triangle-exclamation"></i> Delete Classroom</h3>
            <p style="color: #4a5568; font-size: 0.95rem; line-height: 1.5; margin-bottom: 20px;">
                Are you sure you want to completely delete <strong id="del-salon-nombre-text"></strong>? All students, accumulative stars, and recycle logs inside it will be permanently lost.
            </p>
            <form id="form-eliminar-salon">
                <input type="hidden" id="del-salon-id">
                <label style="display: block; margin-bottom: 8px; color: #4a5568; font-weight: bold; font-size: 0.85rem;">Type <span style="color: #ef4444; font-weight: 800;">ELIMINAR</span> to confirm action:</label>
                <input type="text" id="del-salon-confirmacion" placeholder="ELIMINAR" required autocomplete="off"
                       style="width: 100%; padding: 12px; margin-bottom: 25px; border: 2px solid #ef4444; border-radius: 10px; font-size: 1rem; box-sizing: border-box; font-weight: bold; text-align: center; color: #ef4444;">

                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" onclick="cerrarModalEliminarSalon()" style="padding: 12px 20px; border: none; background: #e2e8f0; color: #4a5568; border-radius: 10px; font-weight: bold; cursor: pointer;">Cancel</button>
                    <button type="submit" id="btn-del-salon-submit" disabled style="padding: 12px 20px; border: none; background: #ef4444; color: white; border-radius: 10px; font-weight: bold; cursor: not-allowed; opacity: 0.5; transition: all 0.2s;">Delete Forever</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-ajustes-director" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 9999; justify-content: center; align-items: center; padding: 15px;">
        <div style="background: white; padding: 30px; border-radius: 20px; width: 100%; max-width: 440px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); box-sizing: border-box;">
            <h3 style="margin-top:0; margin-bottom: 20px; color: #333; font-size: 1.3rem;"><i class="fa-solid fa-sliders" style="color: #4CAF50;"></i> System & Profile Settings</h3>
            <form id="form-ajustes-director">
                
                <label style="display:block; margin-bottom:5px; font-weight:bold; font-size:0.85rem; color:#4a5568;">Infrastructure Number (CCT)</label>
                <input type="text" id="ajustes-cct" class="input-estilo" style="margin-bottom:15px; background: #f1f5f9; color: #64748b; cursor: not-allowed; font-family: monospace; font-weight: bold;" readonly>

                <label style="display:block; margin-bottom:5px; font-weight:bold; font-size:0.85rem; color:#4a5568;">School Name</label>
                <input type="text" id="ajustes-escuela-nombre" class="input-estilo" style="margin-bottom:15px;" required>

                <div style="border-top: 1px dashed #e2e8f0; margin: 15px 0; padding-top: 15px;">
                    <h5 style="margin: 0 0 10px 0; color:#4CAF50; font-size:0.9rem;">Principal's Personal Data</h5>
                </div>

                <label style="display:block; margin-bottom:5px; font-weight:bold; font-size:0.85rem; color:#4a5568;">Full Name</label>
                <input type="text" id="ajustes-director-nombre" class="input-estilo" style="margin-bottom:15px;" required>

                <label style="display:block; margin-bottom:5px; font-weight:bold; font-size:0.85rem; color:#4a5568;">Change Password <span style="font-weight:normal; color:#94a3b8;">(Optional)</span></label>
                <input type="password" id="ajustes-director-pass" class="input-estilo" style="margin-bottom:20px;" placeholder="Leave blank to keep current password">

                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" onclick="cerrarModalAjustes()" style="padding: 10px 18px; border: none; background: #e2e8f0; color: #4a5568; border-radius: 10px; font-weight: bold; cursor: pointer;">Cancel</button>
                    <button type="submit" style="padding: 10px 18px; border: none; background: #4CAF50; color: white; border-radius: 10px; font-weight: bold; cursor: pointer;">Save Settings</button>
                </div>
            </form>
        </div>
    </div>

    <script src="JS/Panel_Director.js"></script>
</body>
</html>