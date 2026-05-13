// public/JS/Inicio_de_sesion.js

/**
 * MOTOR DE PETICIONES
 */
async function ejecutarPeticion(archivoPHP, datos) {
    try {
        const params = new URLSearchParams();
        for (let key in datos) params.append(key, datos[key]);

        // Llamada al servidor
        const response = await fetch(`logic/${archivoPHP}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: params
        });

        const textoBruto = await response.text();
        
        try {
            return JSON.parse(textoBruto);
        } catch (errorParseo) {
            console.error("Respuesta no es JSON válida:", textoBruto);
            return { 
                success: false, 
                message: "Error de formato en el servidor. Revisa la consola (F12)." 
            };
        }
    } catch (errorRed) {
        console.error("Error de red:", errorRed);
        return { success: false, message: "No se pudo establecer conexión con el servidor." };
    }
}

/**
 * 1. PANTALLA INICIAL: Validar CCT
 */
async function procesarAcceso(rol) {
    const input = document.getElementById('cct-input');
    if (!input) return;

    const cctValue = input.value.trim().toUpperCase();
    if (!cctValue) return alert("Ingresa el código de la escuela.");

    const data = await ejecutarPeticion('validad_institucion.php', { cct: cctValue });

    if (data.success) {
        localStorage.setItem('institucion_cct', cctValue);
        localStorage.setItem('institucion_nombre', data.nombre_institucion);
        
        // Redirección
        if (rol === 'alumno') window.location.href = "Iniciodesesion_Alumno.php";
        else if (rol === 'maestro') window.location.href = "iniciodesesion_Maestro.php";
        else if (rol === 'director') window.location.href = "iniciodesesion_Director.php";
    } else {
        alert(data.message || "Error al validar institución.");
    }
}

/**
 * 2. PANTALLA ALUMNO: Validar Código de Clase
 */
async function validarCodigoClase() {
    const code = document.getElementById('class-code-input').value.trim().toUpperCase();
    const cct = localStorage.getItem('institucion_cct');

    if (!code) return alert("Ingresa el código de clase.");
    if (!cct) return alert("CCT no encontrado. Regresa a validar tu escuela.");

    const data = await ejecutarPeticion('validar_clase.php', { codigo_clase: code, cct: cct });

    if (data.success) {
        localStorage.setItem('clase_id', data.clase_id);
        localStorage.setItem('clase_nombre', data.nombre_clase);
        window.location.href = "Inicioparte2";
    } else {
        alert(data.message);
    }
}

/**
 * 3. PANTALLA SELECCIÓN: Cargar lista de alumnos
 */
async function cargarAlumnos() {
    const claseId = localStorage.getItem('clase_id');
    const select = document.getElementById('lista-alumnos');
    if (!claseId || !select) return;

    const data = await ejecutarPeticion('obtener_alumnos.php', { clase_id: claseId });

    if (data.success) {
        select.innerHTML = '<option value="">-- Selecciona tu nombre --</option>';
        data.alumnos.forEach(alum => {
            select.innerHTML += `<option value="${alum.id}">${alum.nombre}</option>`;
        });
    }
}

/**
 * 4. PANTALLA PIN: Validar código de 4 dígitos
 */
async function validarPIN() {
    const pin = document.getElementById('pin-input').value;
    const alumnoId = localStorage.getItem('alumno_id');
    if (pin.length !== 4) return alert("El PIN debe ser de 4 dígitos");

    const data = await ejecutarPeticion('validar_pin.php', { id: alumnoId, pin: pin });

    if (data.success) {
        window.location.href = "dashboard_alumno.html";
    } else {
        alert("PIN Incorrecto");
    }
}

/**
 * LOGIN STAFF
 */
async function validarLoginStaff(rol) {
    const usuario = document.getElementById('user-staff').value.trim();
    const password = document.getElementById('pass-staff').value.trim();
    const cct = localStorage.getItem('institucion_cct');

    if (!usuario || !password) return alert("Completa los campos.");

    const data = await ejecutarPeticion('login_staff.php', { 
        identificador: usuario, 
        pass: password, 
        rol: rol, 
        cct: cct || '' 
    });

    if (data.success) {
        localStorage.setItem('sesion_activa', 'true');
        localStorage.setItem('rol_usuario', rol);
        localStorage.setItem('usuario_nombre', data.nombre_usuario);
        window.location.href = (rol === 'director') ? "dashboard_director.php" : "dashboard_maestro.php";
    } else {
        alert(data.message);
    }
}

/**
 * INICIALIZADOR
 */
document.addEventListener('DOMContentLoaded', () => {
    const labelInstitucion = document.getElementById('nombre-institucion');
    if (labelInstitucion) {
        labelInstitucion.innerText = localStorage.getItem('institucion_nombre') || '';
    }

    if (document.getElementById('lista-alumnos')) cargarAlumnos();

    const inputs = document.querySelectorAll('.input-codigo');
    inputs.forEach(input => {
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const btn = document.querySelector('.btn-entrar') || document.querySelector('button[onclick*="validar"]');
                if (btn) btn.click();
            }
        });
    });
});