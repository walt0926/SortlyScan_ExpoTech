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
            margin-left: 20px; /* Para separarlo del nombre Luis */
            border: 1px solid #e2e8f0;
        }
        
        .pin-input {
            border: none;
            background: transparent;
            font-weight: bold;
            font-size: 1.1rem;
            letter-spacing: 0.15rem;
            color: #334155;
            width: 4.5rem; /* Ancho justo para 4 dígitos */
            padding: 0;
            text-align: center;
            margin-right: 8px;
            font-family: 'Courier New', monospace; /* Para que '••••' se vea uniforme */
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
            <button class="logout-btn" onclick="cerrarSesion()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</button>
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
        
        <input type="file" id="excel-file-input" accept=".csv" style="display: none;" onchange="procesarImportacion(this)">
        
        <button class="import-excel-btn" onclick="document.getElementById('excel-file-input').click()" style="background-color: #2e7d32; color: white; border: none; padding: 10px 15px; border-radius: 8px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-file-excel"></i> Import Excel
        </button>

        <button class="add-student-btn" onclick="agregarAlumno()"><i class="fa-solid fa-plus"></i> Add student</button>
    </div>
</div>

            <div class="student-list" id="student-list-container">
                <p style="text-align:center; color: #999; padding: 20px;">Loading students...</p>
            </div>
        </main>
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

<script src="JS/Panel_Docente.js"></script>

    <script>
async function procesarImportacion(input) {
    if (input.files.length === 0) return;

    const archivo = input.files[0];
    const formData = new FormData();
    
    // 1. Añadimos el archivo que espera leer PHP con $_FILES
    formData.append('archivo_alumnos', archivo);
    
    // 2. REGRESA ESTA REGLA: Le mandamos la acción por si el archivo PHP la valida con $_POST['action']
    formData.append('action', 'importar_estudiantes'); 

    const BACKEND_URL = '../usuarios/import_students.php';

    try {
        const response = await fetch(BACKEND_URL, {
            method: 'POST',
            body: formData,
            credentials: 'include' // Esto pasa las cookies de sesión del Maestro para que no dé "Acceso denegado"
        });

        const responseClone = response.clone();
        
        try {
            const data = await response.json();
            if (data.success) {
                alert(`¡Importación exitosa!\n\n• Registrados: ${data.insertados}\n• Ignorados/Duplicados: ${data.ignorados}`);
                if (typeof cargarDashboard === "function") cargarDashboard(); else location.reload();
            } else {
                // Aquí está cayendo el mensaje actual de permisos insuficientes
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

</body>
</html>