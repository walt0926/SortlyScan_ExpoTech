/**
 * Función principal para validar acceso contra PHP/MySQL
 * @param {string} rol - El rol que intenta acceder ('alumno', 'maestro', 'director')
 */
async function validarAcceso(rol) {
    // Obtenemos el input, limpiamos espacios y convertimos a mayúsculas
    const cctInput = document.getElementById('cct-input').value.trim().toUpperCase();

    // Validación básica de campo vacío
    if (cctInput === "") {
        alert("Por favor, ingresa el código CCT.");
        return;
    }

    try {
        /**
         * LLAMADA AL SERVIDOR
         * Apuntamos a 'logic/validar_institucion.php' ya que la carpeta 'PHP' no existe
         * y estamos separando la lógica en su propia carpeta.
         */
        const response = await fetch('logic/validar_institucion.php', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/x-www-form-urlencoded' 
            },
            body: `cct=${encodeURIComponent(cctInput)}`
        });

        // Verificamos si la respuesta es un JSON válido
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }

        const data = await response.json();

        if (data.success) {
            // --- PERSISTENCIA DE DATOS ---
            // Guardamos info relevante para usarla en las siguientes pantallas
            localStorage.setItem('institucion_nombre', data.nombre);
            localStorage.setItem('institucion_cct', cctInput);
            localStorage.setItem('rol_usuario', rol);

            // --- LÓGICA DE REDIRECCIÓN ---
            // Redirigimos según el rol pasado por parámetro
            switch (rol) {
                case 'alumno':
                    window.location.href = "iniciodesesion_Alumno.php";
                    break;
                case 'maestro':
                    window.location.href = "iniciodesesion_Maestro.php";
                    break;
                case 'director':
                    window.location.href = "iniciodesesion_Director.php";
                    break;
                default:
                    alert("Rol no reconocido.");
            }
        } else {
            // Si el PHP devuelve success: false (CCT no encontrado)
            alert(data.message || "Código CCT no encontrado en nuestra base de datos.");
        }
    } catch (error) {
        console.error("Error en la conexión:", error);
        alert("Hubo un error al conectar con el servidor. Verifica tu conexión a internet o la configuración del servidor.");
    }
}

/**
 * Funciones disparadas por los eventos 'onclick' en el HTML
 */

// Se ejecuta al dar clic en "Entrar a la Escuela"
function procesarAcceso() { 
    validarAcceso('alumno'); 
}

// Se ejecuta al dar clic en "Acceso Maestro"
function mostrarLoginMaestro() { 
    validarAcceso('maestro'); 
}

// Se ejecuta al dar clic en "Acceso Director"
function mostrarLoginDirector() { 
    validarAcceso('director'); 
}