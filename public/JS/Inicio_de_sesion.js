// public/JS/inicio_de_sesion.js

/**
 * 2. PANTALLA ALUMNO: Validar Código de Clase
 */
async function validarCodigoClase() {
    const codeInput = document.getElementById('class-code-input');
    const btnUnirse = document.getElementById('btn-unirse');
    if (!codeInput || !btnUnirse) return;

    const code = codeInput.value.trim().toUpperCase();
    const cct = localStorage.getItem('institucion_cct'); // ID Mined guardado

    if (!code) {
        alert("Ingresa el código de clase.");
        return;
    }
    if (!cct) {
        alert("CCT no encontrado. Regresa a validar tu escuela.");
        return;
    }

    // Efecto dinámico: Estado de carga Bootstrap en el botón
    const textoOriginalBtn = btnUnirse.innerHTML;
    btnUnirse.disabled = true;
    btnUnirse.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Validando...`;

    try {
        // Preparamos los datos como un formulario tradicional (FormData / URLSearchParams)
        // para que tu PHP los lea perfectamente mediante $_POST
        const params = new URLSearchParams();
        params.append('codigo_clase', code);
        params.append('cct', cct);

        // Apuntamos exactamente a TU ruta: logic/validar_clase.php
        const response = await fetch('logic/validar_clase.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: params
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            localStorage.setItem('clase_id', data.clase_id);
            localStorage.setItem('clase_nombre', data.nombre_clase);
            window.location.href = "Inicioparte2.php";
        } else {
            alert(data.message || "Código de clase incorrecto.");
            // Restablecer botón en caso de error controlado
            btnUnirse.disabled = false;
            btnUnirse.innerHTML = textoOriginalBtn;
        }

    } catch (error) {
        console.error("Error al validar la clase:", error);
        alert("Ocurrió un error de comunicación con el servidor. Por favor, intenta de nuevo.");
        
        // Restablecer botón en caso de caída de red o error de sintaxis
        btnUnirse.disabled = false;
        btnUnirse.innerHTML = textoOriginalBtn;
    }
}

/**
 * INICIALIZADOR AUTOMÁTICO
 */
document.addEventListener('DOMContentLoaded', () => {
    // Llenar nombre de la institución de forma elegante si existe en LocalStorage
    const labelInstitucion = document.getElementById('nombre-institucion');
    if (labelInstitucion) {
        const escuelaGuardada = localStorage.getItem('institucion_nombre');
        if (escuelaGuardada) {
            labelInstitucion.innerText = escuelaGuardada;
            labelInstitucion.style.display = 'inline-block'; // Hace visible el badge solo si hay datos
        } else {
            labelInstitucion.style.display = 'none';
        }
    }

    // Llenar nombre de la clase si el label existe (en Inicioparte2.php)
    const labelClase = document.getElementById('nombre-clase');
    if (labelClase) {
        labelClase.innerText = localStorage.getItem('clase_nombre') || 'Clase';
    }

    // Si existe el select de alumnos, cargarlos de inmediato
    if (document.getElementById('lista-alumnos')) {
        if (typeof cargarAlumnos === 'function') {
            cargarAlumnos();
        }
    }
    
    // Mostrar nombre seleccionado en pantalla de PIN
    const displayNombre = document.getElementById('alumno-seleccionado');
    if (displayNombre) {
        displayNombre.innerText = localStorage.getItem('alumno_nombre') || 'Alumno';
    }

    // Soporte consistente para la tecla "Enter"
    const inputs = document.querySelectorAll('.input-codigo');
    inputs.forEach(input => {
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const btn = document.getElementById('btn-unirse') || document.querySelector('.btn-entrar') || document.querySelector('button[onclick*="validar"]');
                if (btn) btn.click();
            }
        });
    });
});