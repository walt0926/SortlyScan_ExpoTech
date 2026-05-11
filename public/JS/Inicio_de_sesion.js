//*** FUNCIÓN MOTOR (El puente con PHP/MySQL)Este es el espacio principal de conexión. Todos los demás procesos pasan por aquí.*/
async function ejecutarPeticion(archivoPHP, datos) {
    try {
        const params = new URLSearchParams();
        for (let key in datos) params.append(key, datos[key]);

        // --- CONEXIÓN PHP: Aquí se hace la llamada física al servidor ---
        const response = await fetch(`PHP/${archivoPHP}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: params
        });
        return await response.json();
    } catch (error) {
        console.error("Error crítico de conexión:", error);
        return { success: false, message: "No se pudo conectar con el servidor" };
    }
}

/**
 * 1. PANTALLA INICIAL: Validar CCT (Institución)
 */
async function procesarAcceso(rol) {
    const cctInput = document.getElementById('cct-input').value.trim().toUpperCase();
    if (!cctInput) return alert("Ingresa el CCT");

    // --- CONEXIÓN PHP: Valida si la escuela existe en MySQL ---
    const data = await ejecutarPeticion('validar_institucion.php', { cct: cctInput });

    if (data.success) {
        localStorage.setItem('institucion_nombre', data.nombre);
        localStorage.setItem('institucion_cct', cctInput);
        
        // Redirección según el botón presionado
        if (rol === 'alumno') window.location.href = "registro_alumno.html";
        else if (rol === 'maestro') window.location.href = "login_maestros.html";
        else if (rol === 'director') window.location.href = "login_director.html";
    } else {
        alert("CCT no encontrado");
    }
}

/**
 * 2. PANTALLA ALUMNO: Validar Código de Clase
 */
async function validarCodigoClase() {
    const code = document.getElementById('class-code-input').value.trim().toUpperCase();
    const cct = localStorage.getItem('institucion_cct');

    // --- CONEXIÓN PHP: Revisa si la clase existe para ese CCT en MySQL ---
    const data = await ejecutarPeticion('validar_clase.php', { codigo_clase: code, cct: cct });

    if (data.success) {
        localStorage.setItem('clase_id', data.clase_id); // Guardamos el ID de la BD
        localStorage.setItem('clase_nombre', data.nombre_clase);
        window.location.href = "seleccion_nombre.html";
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

    // --- CONEXIÓN PHP: Trae los nombres e IDs de la tabla 'alumnos' ---
    const data = await ejecutarPeticion('obtener_alumnos.php', { clase_id: claseId });

    if (data.success) {
        select.innerHTML = '<option value="">-- Selecciona tu nombre --</option>';
        data.alumnos.forEach(alum => {
            // El 'value' es el ID de la base de datos, el texto es el nombre
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

    // --- CONEXIÓN PHP: Verifica si el PIN coincide con el alumno en MySQL ---
    const data = await ejecutarPeticion('validar_pin.php', { id: alumnoId, pin: pin });

    if (data.success) {
        window.location.href = "dashboard_alumno.html";
    } else {
        alert("PIN Incorrecto");
    }
}

/**
 * INICIALIZADOR DE VISTAS
 * Detecta en qué página estás para ejecutar la conexión necesaria al cargar
 */
document.addEventListener('DOMContentLoaded', () => {
    // Si existe el elemento de la lista, carga los alumnos automáticamente
    if (document.getElementById('lista-alumnos')) cargarAlumnos();
    
    // Si estamos en la pantalla de PIN, muestra el nombre que seleccionó
    const displayNombre = document.getElementById('alumno-seleccionado');
    if (displayNombre) displayNombre.innerText = localStorage.getItem('alumno_nombre');
});

/**
 * LOGIN STAFF (Maestros y Directores)
 * Conexión unificada para el personal de la institución
 */
async function validarLoginStaff(rol) {
    const usuario = document.getElementById('user-staff').value.trim();
    const password = document.getElementById('pass-staff').value.trim();
    const cct = localStorage.getItem('institucion_cct');

    if (!usuario || !password) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // --- CONEXIÓN PHP: Enviamos credenciales, el rol y el CCT para validar en MySQL ---
    const data = await ejecutarPeticion('login_staff.php', { 
        identificador: usuario, 
        pass: password, 
        rol: rol, 
        cct: cct 
    });

    if (data.success) {
        // Guardamos un token o sesión si el PHP lo genera
        localStorage.setItem('sesion_activa', 'true');
        localStorage.setItem('rol_usuario', rol);
        
        alert(`¡Bienvenido! Accediendo como ${rol}.`);
        
        // Redirección según el éxito
        window.location.href = (rol === 'director') ? "dashboard_director.html" : "dashboard_maestro.html";
    } else {
        alert(data.message || "Credenciales incorrectas para esta institución.");
    }
}