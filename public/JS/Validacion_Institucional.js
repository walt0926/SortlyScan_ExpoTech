document.addEventListener('DOMContentLoaded', () => {
    // Limpiamos datos anteriores para evitar conflictos de sesiones pasadas
    localStorage.removeItem('institucion_cct');
    localStorage.removeItem('institucion_nombre');
    
    // Permitir "Enter" en el input del CCT
    const inputCCT = document.getElementById('cct-input');
    if (inputCCT) {
        inputCCT.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                procesarAcceso();
            }
        });
    }
});

// Función para el botón principal "Validar Institución"
function procesarAcceso() {
    const cctInput = document.getElementById('cct-input').value.trim();

    if (!cctInput) {
        alert("Por favor, ingresa el código CCT de la escuela.");
        return false;
    }

    // Guardamos el CCT en localStorage
    localStorage.setItem('institucion_cct', cctInput);
    localStorage.setItem('institucion_nombre', 'CCT: ' + cctInput); 
    
    alert("Institución validada. Selecciona tu acceso.");
    return true;
}

// Función para ir al Login de Maestro
function mostrarLoginMaestro() {
    const cctInput = document.getElementById('cct-input').value.trim();
    const cctGuardado = localStorage.getItem('institucion_cct');

    // Si no hay CCT guardado, verificamos si al menos lo escribió en el input
    if (!cctGuardado) {
        if (cctInput) {
            // Lo escribió pero no le dio a "Validar Institución", lo validamos automáticamente
            procesarAcceso();
            window.location.href = 'iniciodesesion_Maestro.php';
        } else {
            alert("Los maestros deben ingresar el código CCT de la escuela primero.");
            document.getElementById('cct-input').focus();
        }
        return;
    }
    
    // Si todo está bien, lo enviamos al login
    window.location.href = 'iniciodesesion_Maestro.php';
}

// Función para ir al Login de Director
function mostrarLoginDirector() {
    // El director NO necesita CCT. Lo enviamos directo a su login.
    window.location.href = 'iniciodesesion_Director.php';
}