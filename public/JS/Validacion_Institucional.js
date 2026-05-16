// public/JS/Validacion_Institucional.js

document.addEventListener('DOMContentLoaded', () => {
    // Limpieza de datos al cargar
    localStorage.removeItem('institucion_cct');
    localStorage.removeItem('institucion_nombre');
    
    const inputCCT = document.getElementById('cct-input');
    if (inputCCT) {
        inputCCT.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                procesarAcceso();
            }
        });
    }
});

async function procesarAcceso() {
    const cctInput = document.getElementById('cct-input').value.trim();

    if (!cctInput) {
        alert("Por favor, ingresa el código CCT de la escuela.");
        return;
    }

    try {
        const params = new URLSearchParams();
        params.append('cct', cctInput);

        // Intentamos contactar al archivo con el error tipográfico 'validad'
        const response = await fetch('logic/validad_institucion.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: params
        });

        // Verificamos si la respuesta es exitosa (HTTP 200)
        if (!response.ok) {
            alert(`Error del servidor: ${response.status} ${response.statusText}\nVerifica que el archivo public/logic/validad_institucion.php existe.`);
            return;
        }

        // Intentamos leer el JSON
        const data = await response.json();

        if (data.success) {
            localStorage.setItem('institucion_cct', cctInput);
            localStorage.setItem('institucion_nombre', data.nombre_institucion);
            
            // Redirigir al alumno
            window.location.href = 'Iniciodesesion_Alumno.php';
        } else {
            alert(data.message || "CCT no encontrado.");
        }
    } catch (error) {
        console.error("Error de conexión:", error);
        alert("Error crítico: El servidor envió una respuesta inválida (posible error de PHP) o el archivo no existe.");
    }
}

// Función para maestros (usada en la misma pantalla)
function mostrarLoginMaestro() {
    // Se eliminaron las ~30 líneas de validación. Ahora solo redirige.
    window.location.href = 'iniciodesesion_Maestro.php';
}

function mostrarLoginDirector() {
    window.location.href = 'iniciodesesion_Director.php';
}