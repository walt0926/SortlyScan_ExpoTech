// ==========================================
// 5. UTILIDADES Y GESTIÓN DE ESTUDIANTES
// ==========================================

/**
 * Copia el código de clase al portapapeles con feedback visual
 */
function copyCode() {
    const codeElement = document.getElementById('class-code');
    if (!codeElement) return;

    const code = codeElement.innerText;
    const btn = document.querySelector('.copy-btn');
    const originalHTML = btn.innerHTML;

    navigator.clipboard.writeText(code).then(() => {
        // Feedback visual al estilo SortlyScan
        btn.innerHTML = '<i class="fa-solid fa-check"></i> ¡Copiado!';
        btn.classList.add('btn-success-active'); // Recomiendo usar clases CSS en lugar de style.background
        btn.style.background = "#2c7a7b"; 

        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.style.background = "rgba(255, 255, 255, 0.2)";
            btn.classList.remove('btn-success-active');
        }, 2000);
    }).catch(err => {
        console.error("Error al copiar:", err);
    });
}

/**
 * Elimina un estudiante tanto del DOM como de la Base de Datos
 * @param {number} studentId - ID del estudiante en MySQL
 * @param {HTMLElement} btn - Referencia al botón presionado
 */
async function eliminarEstudiante(studentId, btn) {
    // REGLA: Validación nativa antes de proceder
    if (!confirm('¿Estás seguro de eliminar a este estudiante? Esta acción no se puede deshacer.')) {
        return;
    }

    /**
 * Toma el archivo CSV seleccionado por el maestro y lo envía al servidor vía AJAX (Fetch)
 * @param {HTMLInputElement} input - El elemento input file del DOM
 */
async function procesarImportacion(input) {
    // Si el usuario cancela la selección o no hay archivo, salimos de la función
    if (input.files.length === 0) return;

    const archivo = input.files[0];
    const formData = new FormData();
    
    // Vinculamos el archivo con la clave 'archivo_alumnos' que espera tu script PHP
    formData.append('archivo_alumnos', archivo);
// CORRECCIÓN: Apuntar a la carpeta 'usuarios' y al archivo exacto 'import_students.php'
const BACKEND_URL = '../usuarios/import_students.php';

try {
    const response = await fetch(BACKEND_URL, {
        method: 'POST',
        body: formData,
        credentials: 'include'
    });

    // Clonamos la respuesta para poder leerla en texto plano si no es un JSON válido
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
        // Si PHP da un error de sintaxis o de base de datos, devolverá texto HTML, no un JSON
        const textoError = await responseClone.text();
        console.error("Respuesta cruda del servidor:", textoError);
        alert("El servidor no devolvió una respuesta limpia. Revisa la consola de desarrollador (F12) para ver el error de PHP.");
    }
} catch (error) {
    console.error("Error de conexión:", error);
    alert("Hubo un fallo de comunicación con el servidor.");
}
    } finally {
        // Limpiamos el valor del input para que deje subir el mismo archivo si se corrigen errores
        input.value = '';
    }
}
    // REGLA: Preparar datos para el backend PHP
    const formData = new FormData();
    formData.append('action', 'eliminar_estudiante');
    formData.append('id_estudiante', studentId);

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            body: formData,
            credentials: 'include' // Mantiene la sesión del director activa
        });

        const data = await response.json();

        if (data.success) {
            // Animación simple de salida antes de remover
            const row = btn.closest('.student-item');
            row.style.opacity = '0.5';
            row.style.transform = 'translateX(20px)';
            row.style.transition = 'all 0.3s ease';
            
            setTimeout(() => row.remove(), 300);
            
            // Opcional: Recargar estadísticas si la eliminación afecta totales
            cargarDashboard(); 
        } else {
            alert("Error del servidor: " + data.message);
        }
    } catch (error) {
        console.error("Error de conexión:", error);
        alert("No se pudo conectar con el servidor para eliminar.");
    }
}

// Evento para botones de edición (Estructura base)
function editarEstudiante(studentId) {
    console.log("Editando estudiante ID:", studentId);
    // Aquí podrías abrir un modal con los datos actuales
}