// public/JS/Validacion_Institucional.js

document.addEventListener('DOMContentLoaded', () => {
    // Limpieza total de datos al cargar la pantalla de validación
    localStorage.removeItem('institucion_cct');
    localStorage.removeItem('institucion_nombre');
    
    const inputCCT = document.getElementById('cct-input');
    if (inputCCT) {
        // Al presionar Enter en el input, solo valida si es para alumnos
        inputCCT.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                procesarAcceso();
            }
        });
    }
});

// Esta función queda EXCLUSIVA para el flujo de Alumnos
async function procesarAcceso() {
    const cctInput = document.getElementById('cct-input').value.trim();
    const btnPrincipal = document.getElementById('btn-principal');

    if (!cctInput) {
        alert("Por favor, ingresa el código CCT de la escuela.");
        return;
    }

    // Efecto dinámico de carga en el botón (Bootstrap)
    const textoOriginalBtn = btnPrincipal.innerHTML;
    btnPrincipal.disabled = true;
    btnPrincipal.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Validando...`;

    try {
        const params = new URLSearchParams();
        params.append('cct', cctInput);

        const response = await fetch('logic/validad_institucion.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: params
        });

        if (!response.ok) {
            alert(`Error del servidor: ${response.status} ${response.statusText}\nVerifica que el archivo public/logic/validad_institucion.php existe.`);
            btnPrincipal.disabled = false;
            btnPrincipal.innerHTML = textoOriginalBtn;
            return;
        }

        const data = await response.json();

        if (data.success) {
            localStorage.setItem('institucion_cct', cctInput);
            localStorage.setItem('institucion_nombre', data.nombre_institucion);
            
            // Redirigir al alumno
            window.location.href = 'Iniciodesesion_Alumno.php';
        } else {
            alert(data.message || "CCT no encontrado.");
            btnPrincipal.disabled = false;
            btnPrincipal.innerHTML = textoOriginalBtn;
        }
    } catch (error) {
        console.error("Error de conexión:", error);
        alert("Error crítico: El servidor envió una respuesta inválida (posible error de PHP) o el archivo no existe.");
        btnPrincipal.disabled = false;
        btnPrincipal.innerHTML = textoOriginalBtn;
    }
}

// ACCESO DIRECTO PARA MAESTROS (Se salta por completo la validación de CCT)
function mostrarLoginMaestro() {
    window.location.href = 'iniciodesesion_Maestro.php';
}

// ACCESO DIRECTO PARA DIRECTORES (Se salta por completo la validación de CCT)
function mostrarLoginDirector() {
    window.location.href = 'iniciodesesion_Director.php';
}