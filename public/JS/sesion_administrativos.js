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
 * Valida las credenciales contra la base de datos MySQL
 */
async function validarLoginStaff(rol) {
    // Obtenemos los elementos del DOM basándonos en tus HTML
    const inputUsuario = document.getElementById('user-staff');
    const inputPass = document.getElementById('pass-staff');
    
    // Recuperamos el CCT (ahora puede estar vacío para ambos roles sin problema)
    const cctActual = localStorage.getItem('institucion_cct') || '';

    const usuario = inputUsuario.value.trim();
    const password = inputPass.value.trim();

    // Validación básica de cliente (UX)
    if (!usuario || !password) {
        alert("Por favor, completa todos los campos requeridos.");
        return;
    }

    // --- Ejecución de la petición al nuevo archivo PHP ---
    const data = await ejecutarPeticion('login_staff.php', { 
        identificador: usuario, 
        pass: password, 
        rol: rol, // 'maestro' o 'director'
        cct: cctActual // Enviará vacío si no hay, y el backend ya no lo exigirá para el maestro
    });

    if (data.success) {
        // Persistencia de sesión
        localStorage.setItem('sesion_activa', 'true');
        localStorage.setItem('rol_usuario', rol);
        localStorage.setItem('usuario_nombre', data.nombre_usuario);
        
        // Opcional: Guardamos el ID del usuario por si lo necesitas para otras consultas (ej. buscar sus salones)
        if (data.id_usuario) localStorage.setItem('usuario_id', data.id_usuario);

        // Redirección basada en el rol
        if (rol === 'director') {
            window.location.href = "dashboard_director.php";
        } else {
            window.location.href = "dashboard_maestro.php"; 
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