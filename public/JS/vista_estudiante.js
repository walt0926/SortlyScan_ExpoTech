// JS/vista_estudiante.js

document.addEventListener('DOMContentLoaded', () => {
    // Capturamos el ID del alumno desde el atributo del body (si se requiere para futuras llamadas Fetch)
    const studentId = document.body.getAttribute('data-student-id');

    const btnScan = document.getElementById('btn-scan-code');
    const btnLogout = document.getElementById('btn-logout-student');

    // Listener para el botón de escaneo de cámara
    if (btnScan) {
        btnScan.addEventListener('click', () => {
            // Efecto de pulsación antes de cambiar de página
            btnScan.style.transform = 'translateX(-50%) scale(0.95)';
            setTimeout(() => {
                window.location.href = 'SortlyScanIA.php';
            }, 100);
        });
    }

    // Listener para el botón de salida segura
    if (btnLogout) {
        btnLogout.addEventListener('click', () => {
            if (confirm("¿Estás seguro de que deseas salir de tu panel?")) {
                localStorage.removeItem('alumno_nombre');
                window.location.href = 'ValidarInstitucion.php';
            }
        });
    }

    // Animación sutil en cascada para la lista de clasificación
    const rankingItems = document.querySelectorAll('.ranking-item');
    rankingItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(10px)';
        item.style.transition = 'all 0.3s ease';
        
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 60); // Retraso escalonado para efecto visual premium
    });
});