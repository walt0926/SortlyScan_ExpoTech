<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - Teacher Panel</title>
    <link rel="stylesheet" href="style_panel.css">
    <link rel="stylesheet" href="CSS/Vista_docente.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .pin-wrapper {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            padding: 5px 12px;
            border-radius: 20px;
            margin-left: 20px;
            border: 1px solid #e2e8f0;
        }
        
        .pin-input {
            border: none;
            background: transparent;
            font-weight: bold;
            font-size: 1.1rem;
            letter-spacing: 0.15rem;
            color: #334155;
            width: 4.5rem;
            padding: 0;
            text-align: center;
            margin-right: 8px;
            font-family: 'Courier New', monospace;
        }
        
        .pin-input:focus { outline: none; }
        
        .toggle-pin-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            color: #94a3b8;
            padding: 0;
            font-size: 1rem;
        }
        
        .toggle-pin-btn:hover { color: #64748b; }
    </style>
</head>
<body>

    <div class="container">
        <header class="main-header">
            <div class="titles">
                <h1 id="panel-title">Teacher Panel</h1>
                <p id="teacher-welcome">Welcome!</p>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <button class="settings-btn" onclick="abrirModalAjustesMaestro()">
                    <i class="fa-solid fa-gear"></i>
                </button>
                <button class="logout-btn" onclick="cerrarSesion()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</button>
            </div>
        </header>

        <section class="class-code-card">
            <div class="code-info">
                <span>Class code</span>
                <h2 id="class-code">---</h2>
            </div>
            <button class="copy-btn" onclick="copyCode()"><i class="fa-regular fa-copy"></i> Copy</button>
        </section>

        <main class="students-section">
            <div class="section-header">
                <h3 id="student-count"><i class="fa-solid fa-users"></i> Students (0)</h3>
                
                <div style="display: flex; gap: 10px; align-items: center;">
                    <button onclick="abrirModalImportar()" class="import-excel-btn" style="display: flex; align-items: center; gap: 8px; border: none; background: #16a34a; color: white; padding: 10px 16px; border-radius: 12px; font-weight: bold; cursor: pointer; font-size: 0.9rem; transition: background 0.2s;">
                        <i class="fa-solid fa-file-csv"></i> Import CSV
                    </button>
                    
                    <input type="file" id="inputArchivoOculto" accept=".csv" style="display: none;" onchange="manejarArchivoSeleccionado(this)">
                    
                    <button class="add-student-btn" onclick="agregarAlumno()"><i class="fa-solid fa-plus"></i> Add student</button>
                </div>
            </div>

            <div class="student-list" id="student-list-container">
                <p style="text-align:center; color: #999; padding: 20px;">Loading students...</p>
            </div>
        </main>
    </div>

    <div id="modalImportar" style="position: fixed; inset: 0; background-color: rgba(0, 0, 0, 0.6); display: none; align-items: center; justify-content: center; z-index: 9999; padding: 16px;">
        <div style="background-color: #ffffff; border-radius: 24px; padding: 35px; max-width: 580px; width: 100%; box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; box-sizing: border-box;">
            
            <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 20px;">
                <div style="padding: 12px; background-color: #dcfce7; color: #16a34a; border-radius: 12px; display: flex; align-items: center;">
                    <i class="fa-solid fa-file-circle-info" style="font-size: 1.6rem;"></i>
                </div>
                <h3 style="margin: 0; font-size: 1.5rem; font-weight: 700; color: #333;">Import Students via CSV</h3>
            </div>

            <div style="font-size: 0.95rem; color: #555; margin-bottom: 24px; line-height: 1.6;">
                <p style="margin: 0 0 14px 0; font-weight: bold; color: #444;">To ensure a correct upload, follow these steps:</p>
                
                <ul style="margin: 0 0 20px 0; padding-left: 20px; background-color: #f8fafc; padding: 16px 16px 16px 32px; border-radius: 14px; border: 1px solid #e2e8f0;">
                    <li style="margin-bottom: 10px;">The file format must be strictly <strong style="color: #16a34a;">.csv</strong>.</li>
                    <li style="margin-bottom: 10px;">The first row must include the exact column header: <code style="background-color: #e2e8f0; padding: 3px 6px; border-radius: 6px; font-size: 0.85rem; font-family: monospace; font-weight: bold; color: #1e293b;">Nombre</code>.</li>
                    <li>The access PIN will be automatically generated for each student.</li>
                </ul>

                <p style="margin: 0 0 8px 0; font-weight: bold; color: #444; font-size: 0.9rem;"><i class="fa-regular fa-eye"></i> File Structure Example:</p>
                <div style="background-color: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 12px; padding: 12px; font-family: monospace; font-size: 0.85rem; color: #334155; margin-bottom: 20px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);">
                    <table style="width: 100%; border-collapse: collapse; background: #ffffff; border-radius: 8px; overflow: hidden;">
                        <thead>
                            <tr style="background-color: #e2e8f0; text-align: left; border-bottom: 2px solid #cbd5e1;">
                                <th style="padding: 8px 12px; color: #1e293b; font-weight: bold; border-right: 1px solid #cbd5e1; width: 40px; text-align: center; background: #cbd5e1;"></th>
                                <th style="padding: 8px 12px; color: #15803d; font-weight: bold;">A</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 6px; background: #f8fafc; text-align: center; font-weight: bold; color: #94a3b8; border-right: 1px solid #cbd5e1;">1</td>
                                <td style="padding: 6px 12px; font-weight: bold; color: #1e293b; background-color: #f0fdf4;">Nombre</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e2e8f0;">
                                <td style="padding: 6px; background: #f8fafc; text-align: center; font-weight: bold; color: #94a3b8; border-right: 1px solid #cbd5e1;">2</td>
                                <td style="padding: 6px 12px; color: #475569;">Pepito Reciclador</td>
                            </tr>
                            <tr>
                                <td style="padding: 6px; background: #f8fafc; text-align: center; font-weight: bold; color: #94a3b8; border-right: 1px solid #cbd5e1;">3</td>
                                <td style="padding: 6px 12px; color: #475569;">Joel González</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p style="margin: 0; font-size: 0.85rem; color: #b45309; background-color: #fffbeb; padding: 12px; border-radius: 12px; border: 1px solid #fef3c7; display: flex; gap: 8px; align-items: flex-start;">
                    <span>⚠️</span> <span>Students with names already registered in this class will be skipped to prevent duplicates.</span>
                </p>
            </div>

            <div style="display: flex; gap: 14px; justify-content: flex-end;">
                <button type="button" onclick="cerrarModalImportar()" style="padding: 12px 24px; font-size: 0.95rem; font-weight: bold; color: #4a5568; background-color: #e2e8f0; border: none; border-radius: 12px; cursor: pointer; transition: background 0.2s;">
                    Cancel
                </button>
                <button type="button" onclick="activarExploradorArchivos()" style="padding: 12px 24px; font-size: 0.95rem; font-weight: bold; color: #ffffff; background-color: #16a34a; border: none; border-radius: 12px; cursor: pointer; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3); transition: background 0.2s;">
                    Select File
                </button>
            </div>
        </div>
    </div>

    <div id="modal-alumno" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; padding: 30px; border-radius: 20px; width: 90%; max-width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); box-sizing: border-box;">
            <h3 style="margin-top: 0; margin-bottom: 20px; color: #333; font-size: 1.4rem;"><i class="fa-solid fa-user-plus" style="color: #4CAF50;"></i> Add New Student</h3>
            
            <form id="form-nuevo-alumno">
                <label style="display: block; margin-bottom: 5px; color: #666; font-weight: bold; font-size: 0.9rem;">Student's Display Name</label>
                <input type="text" id="modal-nombre" placeholder="e.g., John Doe" maxlength="50" required 
                       style="width: 100%; padding: 12px; margin-bottom: 20px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; box-sizing: border-box;">

                <label style="display: block; margin-bottom: 5px; color: #666; font-weight: bold; font-size: 0.9rem;">Access PIN (4 digits)</label>
                <input type="text" id="modal-pin" placeholder="1234" maxlength="4" required 
                       style="width: 100%; padding: 12px; margin-bottom: 25px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1.2rem; font-weight: bold; letter-spacing: 0.2rem; box-sizing: border-box;">

                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" onclick="cerrarModal()" style="padding: 12px 20px; border: none; background: #e2e8f0; color: #4a5568; border-radius: 10px; font-weight: bold; cursor: pointer;">Cancel</button>
                    <button type="submit" style="padding: 12px 20px; border: none; background: #4CAF50; color: white; border-radius: 10px; font-weight: bold; cursor: pointer;">Save Student</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-editar-alumno" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; padding: 30px; border-radius: 20px; width: 90%; max-width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); box-sizing: border-box;">
            <h3 style="margin-top: 0; margin-bottom: 20px; color: #333; font-size: 1.4rem;"><i class="fa-solid fa-user-gear" style="color: #00BCD4;"></i> Edit Student Details</h3>
            
            <form id="form-editar-alumno">
                <input type="hidden" id="edit-modal-id">

                <label style="display: block; margin-bottom: 5px; color: #666; font-weight: bold; font-size: 0.9rem;">Student's Display Name</label>
                <input type="text" id="edit-modal-nombre" maxlength="50" required 
                       style="width: 100%; padding: 12px; margin-bottom: 20px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; box-sizing: border-box;">

                <label style="display: block; margin-bottom: 5px; color: #666; font-weight: bold; font-size: 0.9rem;">Access PIN (4 digits)</label>
                <input type="text" id="edit-modal-pin" maxlength="4" required 
                       style="width: 100%; padding: 12px; margin-bottom: 20px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1.2rem; font-weight: bold; letter-spacing: 0.2rem; box-sizing: border-box;">

                <label style="display: block; margin-bottom: 5px; color: #666; font-weight: bold; font-size: 0.9rem;">Total Accumulated Points</label>
                <input type="number" id="edit-modal-puntos" min="0" required 
                       style="width: 100%; padding: 12px; margin-bottom: 25px; border: 2px solid #e2e8f0; border-radius: 10px; font-size: 1rem; box-sizing: border-box;">

                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" onclick="cerrarModalEditar()" style="padding: 12px 20px; border: none; background: #e2e8f0; color: #4a5568; border-radius: 10px; font-weight: bold; cursor: pointer;">Cancel</button>
                    <button type="submit" style="padding: 12px 20px; border: none; background: #00BCD4; color: white; border-radius: 10px; font-weight: bold; cursor: pointer;">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-eliminar-alumno" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; padding: 30px; border-radius: 20px; width: 90%; max-width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); box-sizing: border-box;">
            <h3 style="margin-top: 0; margin-bottom: 15px; color: #ef4444; font-size: 1.4rem;"><i class="fa-solid fa-triangle-exclamation"></i> Delete Student</h3>
            
            <p style="color: #4a5568; font-size: 0.95rem; line-height: 1.5; margin-bottom: 20px;">
                Are you sure you want to completely delete <strong id="delete-modal-nombre-texto"></strong>? All their points and logs will be permanently lost.
            </p>

            <form id="form-eliminar-alumno">
                <input type="hidden" id="delete-modal-id">
                
                <label style="display: block; margin-bottom: 8px; color: #4a5568; font-weight: bold; font-size: 0.85rem;">Type <span style="color: #ef4444; font-weight: 800;">ELIMINAR</span> to confirm action:</label>
                <input type="text" id="delete-modal-confirmacion" placeholder="ELIMINAR" required autocomplete="off"
                       style="width: 100%; padding: 12px; margin-bottom: 25px; border: 2px solid #ef4444; border-radius: 10px; font-size: 1rem; box-sizing: border-box; font-weight: bold; text-align: center; color: #ef4444;">

                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" onclick="cerrarModalEliminar()" style="padding: 12px 20px; border: none; background: #e2e8f0; color: #4a5568; border-radius: 10px; font-weight: bold; cursor: pointer;">Cancel</button>
                    <button type="submit" id="btn-confirmar-eliminar" disabled style="padding: 12px 20px; border: none; background: #ef4444; color: white; border-radius: 10px; font-weight: bold; cursor: not-allowed; opacity: 0.5; transition: all 0.2s;">Delete Forever</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-ajustes-maestro" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 9999; justify-content: center; align-items: center; padding: 15px;">
        <div style="background: white; padding: 30px; border-radius: 20px; width: 100%; max-width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); box-sizing: border-box;">
            <h3 style="margin-top:0; margin-bottom: 20px; color: #333; font-size: 1.4rem;"><i class="fa-solid fa-user-gear" style="color: #16a34a;"></i> Teacher Profile Settings</h3>
            <form id="form-ajustes-maestro">
                
                <label style="display:block; margin-bottom:5px; color:#666; font-weight:bold; font-size:0.9rem;">Assigned Classroom</label>
                <input type="text" id="ajustes-maestro-aula" style="width:100%; padding:12px; margin-bottom:15px; border:2px solid #e2e8f0; border-radius:10px; font-size:1rem; box-sizing:border-box; background: #f1f5f9; color: #64748b; cursor: not-allowed;" readonly>

                <label style="display:block; margin-bottom:5px; color:#666; font-weight:bold; font-size:0.9rem;">Class Code</label>
                <input type="text" id="ajustes-maestro-codigo" style="width:100%; padding:12px; margin-bottom:15px; border:2px solid #e2e8f0; border-radius:10px; font-size:1.1rem; box-sizing:border-box; background: #f1f5f9; color: #64748b; cursor: not-allowed; font-family: monospace; font-weight: bold; letter-spacing: 1px;" readonly>

                <hr style="border: 0; border-top: 1px dashed #e2e8f0; margin: 15px 0;">

                <label style="display:block; margin-bottom:5px; color:#666; font-weight:bold; font-size:0.9rem;">Your Full Name</label>
                <input type="text" id="ajustes-maestro-nombre" style="width:100%; padding:12px; margin-bottom:15px; border:2px solid #e2e8f0; border-radius:10px; font-size:1rem; box-sizing:border-box;" required>

                <label style="display:block; margin-bottom:5px; color:#666; font-weight:bold; font-size:0.9rem;">Login Username</label>
                <input type="text" id="ajustes-maestro-user" style="width:100%; padding:12px; margin-bottom:15px; border:2px solid #e2e8f0; border-radius:10px; font-size:1rem; box-sizing:border-box;" required autocomplete="off">

                <label style="display:block; margin-bottom:5px; color:#666; font-weight:bold; font-size:0.9rem;">Change Password <span style="font-weight:normal; color:#94a3b8;">(Optional)</span></label>
                <input type="password" id="ajustes-maestro-pass" placeholder="Leave blank to keep current password" style="width:100%; padding:12px; margin-bottom:20px; border:2px solid #e2e8f0; border-radius:10px; font-size:1rem; box-sizing:border-box;">

                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button type="button" onclick="cerrarModalAjustesMaestro()" style="padding: 12px 20px; border: none; background: #e2e8f0; color: #4a5568; border-radius: 10px; font-weight: bold; cursor: pointer;">Cancel</button>
                    <button type="submit" style="padding: 12px 20px; border: none; background: #16a34a; color: white; border-radius: 10px; font-weight: bold; cursor: pointer;">Save Settings</button>
                </div>
            </form>
        </div>
    </div>

    <script src="JS/Panel_Docente.js"></script>

    <script>
    // =========================================================
    // 1. CONTROLADORES DEL MODAL DE IMPORTACIÓN INTERMEDIO
    // =========================================================
    function abrirModalImportar() {
        document.getElementById('modalImportar').style.display = 'flex';
    }

    function cerrarModalImportar() {
        document.getElementById('modalImportar').style.display = 'none';
    }

    function activarExploradorArchivos() {
        document.getElementById('inputArchivoOculto').click();
    }

    function manejarArchivoSeleccionado(input) {
        if (input.files.length === 0) return;
        cerrarModalImportar(); 
        procesarImportacion(input); 
    }

    // =========================================================
    // 2. LOGÍSTICA BACKEND: ENVÍO ASÍNCRONO DEL ARCHIVO
    // =========================================================
    async function procesarImportacion(input) {
        if (input.files.length === 0) return;

        const archivo = input.files[0];
        const formData = new FormData();
        
        formData.append('archivo_alumnos', archivo);
        formData.append('action', 'importar_estudiantes');
        formData.append('id_maestro_directo', '<?php echo isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : (isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : ""); ?>');
        
        const divCodigo = Array.from(document.querySelectorAll('*')).find(el => /SORT\d+/.test(el.innerText));
        const codigoExtraido = document.getElementById("class-code").textContent;
        formData.append('codigo_aula_interfaz', codigoExtraido);
        
        const BACKEND_URL = '../usuarios/import_students.php';

        try {
            const response = await fetch(BACKEND_URL, {
                method: 'POST',
                body: formData,
                credentials: 'include'
            });

            const responseClone = response.clone();
            
            try {
                const data = await response.json();
                if (data.success) {
                    alert(`¡Importación exitosa!\n\n• Registrados: ${data.insertados}\n• Ignorados/Duplicados: ${data.ignorados}`);
                    if (typeof cargarDashboard === "function") cargarDashboard(); else location.reload();
                } else {
                    alert("Error devuelto por PHP: " + data.message);
                }
            } catch (jsonError) {
                const textoError = await responseClone.text();
                console.error("--- DETALLE DEL ERROR EN EL SERVIDOR ---");
                console.error(textoError);
                console.error("----------------------------------------");
                alert("El servidor no devolvió un JSON limpio. Revisa la Consola (F12).");
            }
        } catch (error) {
            console.error("Error de conexión:", error);
            alert("Hubo un fallo de comunicación con el servidor.");
        } finally {
            input.value = '';
        }
    }
    </script>
</body>
</html>