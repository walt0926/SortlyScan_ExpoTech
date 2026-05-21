/**
 * MOTOR DE PETICIONES ASÍNCRONAS
 * Centraliza la comunicación con el servidor PHP/MySQL
 */
async function ejecutarPeticion(archivoPHP, datos) {
    try {
        const params = new URLSearchParams();
        for (let key in datos) params.append(key, datos[key]);

        // --- CONEXIÓN PHP: Modificado para apuntar a la carpeta logic/ ---
        const response = await fetch(`logic/${archivoPHP}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: params
        });

        if (!response.ok) throw new Error("Error en la respuesta del servidor");
        
        return await response.json();
    } catch (error) {
        console.error("Error crítico de conexión:", error);
        return { success: false, message: "Error de red: No se pudo contactar al servidor." };
    }
}

/**
 * LOGIN STAFF (Maestros y Directores)
 * Valida las credenciales contra la base de datos
 */
async function validarLoginStaff(rol) {
    // Obtenemos los elementos del DOM basándonos en el HTML
    const inputUsuario = document.getElementById('user-staff');
    const inputPass = document.getElementById('pass-staff');
    const inputCCT = document.getElementById('cct-input'); // <-- NUEVO: Buscamos el input del CCT
    
    // CORRECCIÓN: Si el input de CCT existe (pantalla maestro), tomamos su valor. Si no (pantalla director), usamos el guardado o lo dejamos vacío.
    const cctActual = inputCCT ? inputCCT.value.trim().toUpperCase() : (localStorage.getItem('institucion_cct') || '');

    // Validación específica para el maestro: el CCT no puede estar vacío
    if (rol === 'maestro' && !cctActual) {
        alert("Por favor, ingresa el código CCT de tu escuela.");
        if (inputCCT) inputCCT.focus();
        return;
    }

    // Validación de seguridad de respaldo
    if (rol !== 'director' && !cctActual) {
        alert("Sesión inválida. Por favor, vuelve a ingresar el código de tu escuela.");
        window.location.href = "ValidarInstitucion.php";
        return;
    }

    const usuario = inputUsuario.value.trim();
    const password = inputPass.value.trim();

    // Validación básica de cliente (UX)
    if (!usuario || !password) {
        alert("Por favor, completa todos los campos requeridos.");
        return;
    }

    // Ejecución de la petición al archivo PHP
    const data = await ejecutarPeticion('login_staff.php', { 
        identificador: usuario, 
        pass: password, 
        rol: rol, // 'maestro' o 'director'
        cct: cctActual // Enviamos el CCT que el maestro escribió
    });

    if (data.success) {
        // Persistencia de sesión
        localStorage.setItem('sesion_activa', 'true');
        localStorage.setItem('rol_usuario', rol);
        localStorage.setItem('usuario_nombre', data.nombre_usuario);
        localStorage.setItem('institucion_cct', cctActual); // <-- NUEVO: Guardamos el CCT validado
        
        // Opcional: Guardamos el ID del usuario por si lo necesitas para otras consultas
        if (data.id_usuario) localStorage.setItem('usuario_id', data.id_usuario);

        // Redirección basada en el rol
        if (rol === 'director') {
            window.location.href = "vista_director.php";
        } else {
            window.location.href = "Vista_docente.php"; 
        }
    } else {
        // Mostramos el error devuelto por PHP
        alert(data.message || "Error de autenticación. Verifica tus datos.");
    }
}

/**
 * INICIALIZADOR DE INTERFAZ
 * Se ejecuta cuando el HTML termina de cargar
 */
document.addEventListener('DOMContentLoaded', () => {
    // Recuperamos el nombre de la institución para mostrarlo en pantalla
    const nombreInstitucion = localStorage.getItem('institucion_nombre');
    const labelInstitucion = document.getElementById('nombre-institucion');

    if (labelInstitucion && nombreInstitucion) {
        labelInstitucion.innerText = nombreInstitucion;
    }

    // Permitir login al presionar "Enter"
    const inputs = document.querySelectorAll('.input-codigo');
    inputs.forEach(input => {
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const btn = document.querySelector('.btn-entrar');
                if (btn) btn.click();
            }
        });
    });
});