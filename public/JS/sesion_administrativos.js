/**
 * MOTOR DE PETICIONES ASÍNCRONAS
 * Centraliza la comunicación con el servidor PHP/MySQL
 */
async function ejecutarPeticion(archivoPHP, datos) {
    try {
        const params = new URLSearchParams();
        for (let key in datos) params.append(key, datos[key]);

        // --- CONEXIÓN PHP: Se comunica con la carpeta PHP en tu servidor ---
        const response = await fetch(`PHP/${archivoPHP}`, {
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
 * Valida las credenciales contra la base de datos MySQL
 */
async function validarLoginStaff(rol) {
    // Obtenemos los elementos del DOM basándonos en tus HTML
    const inputUsuario = document.getElementById('user-staff');
    const inputPass = document.getElementById('pass-staff');
    const cctActual = localStorage.getItem('institucion_cct');

    const usuario = inputUsuario.value.trim();
    const password = inputPass.value.trim();

    // Validación básica de cliente (UX)
    if (!usuario || !password) {
        alert("Por favor, completa todos los campos requeridos.");
        return;
    }

    // --- ESPACIO DE CONEXIÓN: 'login_staff.php' debe procesar estos datos ---
    const data = await ejecutarPeticion('login_staff.php', { 
        identificador: usuario, 
        pass: password, 
        rol: rol, // 'maestro' o 'director'
        cct: cctActual 
    });

    if (data.success) {
        // Persistencia de sesión básica
        localStorage.setItem('sesion_activa', 'true');
        localStorage.setItem('rol_usuario', rol);
        localStorage.setItem('usuario_nombre', data.nombre_usuario || usuario);

        // Redirección inteligente basada en el rol
        if (rol === 'director') {
            window.location.href = "dashboard_director.html";
        } else {
            window.location.href = "dashboard_maestro.html";
        }
    } else {
        // Mostramos el error que venga desde el PHP (ej: "Contraseña incorrecta")
        alert(data.message || "Error de autenticación. Verifica tus datos.");
    }
}

/**
 * INICIALIZADOR DE INTERFAZ
 * Se ejecuta cuando el HTML termina de cargar
 */
document.addEventListener('DOMContentLoaded', () => {
    // Recuperamos el nombre de la institución guardado previamente
    const nombreInstitucion = localStorage.getItem('institucion_nombre');
    const labelInstitucion = document.getElementById('nombre-institucion');

    if (labelInstitucion && nombreInstitucion) {
        labelInstitucion.innerText = nombreInstitucion;
    }

    // Opcional: Permitir login al presionar "Enter" en los inputs
    const inputs = document.querySelectorAll('.input-codigo');
    inputs.forEach(input => {
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                // Buscamos el botón de la página actual y disparamos el click
                const btn = document.querySelector('.btn-entrar');
                if (btn) btn.click();
            }
        });
    });
});