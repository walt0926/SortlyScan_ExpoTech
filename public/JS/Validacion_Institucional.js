/**
 * Función principal para validar acceso contra PHP/MySQL
 * @param {string} rol - El rol que intenta acceder ('alumno', 'maestro', 'director')
 */
async function validarAcceso(rol) {
    const cctInput = document.getElementById('cct-input').value.trim().toUpperCase();

    if (cctInput === "") {
        alert("Por favor, ingresa el código CCT.");
        return;
    }

    try {
        // --- Llamar archivo PHP ---
        const response = await fetch('PHP/validar_institucion.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `cct=${encodeURIComponent(cctInput)}`
        });

        const data = await response.json();

        if (data.success) {
            // Guardamos datos en el navegador
            localStorage.setItem('institucion_nombre', data.nombre);
            localStorage.setItem('institucion_cct', cctInput);
            localStorage.setItem('rol_usuario', rol);

            // --- LÓGICA DE REDIRECCIÓN ENTRE PÁGINAS ---
            if (rol === 'alumno') {
                window.location.href = "iniciodesesion_Alumno.php";
            } else if (rol === 'maestro') {
                window.location.href = "iniciodesesion_Maestro.php";
            }
        } else {
            alert(data.message || "Código CCT no encontrado en nuestra base de datos.");
        }
    } catch (error) {
        console.error("Error en la conexión:", error);
        alert("Hubo un error al conectar con el servidor.");
    }
}

// Funciones que llaman los botones del HTML
function procesarAcceso() { validarAcceso('alumno'); }
function mostrarLoginMaestro() { validarAcceso('maestro'); }