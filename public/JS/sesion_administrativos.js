/**
 * MOTOR DE PETICIONES ASÍNCRONAS
 * Centraliza la comunicación con el servidor PHP/MySQL
 */
async function ejecutarPeticion(archivoPHP, datos) {
    try {
        const params = new URLSearchParams();
        for (let key in datos) params.append(key, datos[key]);

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
 * Valida las credenciales y añade CCT obligatoriamente si es Maestro
 */
async function validarLoginStaff(rol) {
    const inputUsuario = document.getElementById('user-staff');
    const inputPass = document.getElementById('pass-staff');
    const inputCCT = document.getElementById('cct-input'); // Captura el input CCT si existe
    const btnEntrar = document.getElementById('btn-entrar-staff');
    
    if (!inputUsuario || !inputPass) return;

    const usuario = inputUsuario.value.trim();
    const password = inputPass.value.trim();
    let cctValue = "";

    // NUEVA VALIDACIÓN: Si es maestro, el campo CCT es obligatorio a nivel JS
    if (rol === 'maestro') {
        if (!inputCCT) {
            alert("Error del sistema: No se encontró el campo de código CCT.");
            return;
        }
        cctValue = inputCCT.value.trim().toUpperCase();
        if (!cctValue) {
            alert("Por favor, ingresa el código CCT de la escuela.");
            inputCCT.focus();
            return;
        }
    }

    // Validación de credenciales básicas
    if (!usuario || !password) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Efecto dinámico: Añadir spinner de Bootstrap al botón y deshabilitarlo
    const textoOriginalBtn = btnEntrar.innerHTML;
    btnEntrar.disabled = true;
    btnEntrar.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Autenticando...`;

    // Empaquetamos los datos de envío
    const datosEnvio = {
        usuario: usuario,
        password: password,
        rol: rol
    };

    // Si el rol es maestro, inyectamos el CCT validado a la petición
    if (rol === 'maestro') {
        datosEnvio.cct = cctValue;
    }

    const data = await ejecutarPeticion('login_staff.php', datosEnvio);

    if (data.success) {
        // Almacenamos datos de sesión administrativa en LocalStorage
        localStorage.setItem('usuario_rol', rol);
        localStorage.setItem('usuario_nombre', data.nombre_usuario);
        
        if (data.id_usuario) localStorage.setItem('usuario_id', data.id_usuario);

        // Redirección basada en el rol
        if (rol === 'director') {
            window.location.href = "Vista_Director.php";
        } else {
            window.location.href = "Vista_Maestro.php"; 
        }
    } else {
        // Mostramos el error devuelto por tu backend PHP
        alert(data.message || "Error de autenticación. Verifica tus datos.");
        
        // Restablecer botón en caso de error
        btnEntrar.disabled = false;
        btnEntrar.innerHTML = textoOriginalBtn;
    }
}

/**
 * INICIALIZADOR DE INTERFAZ
 */
document.addEventListener('DOMContentLoaded', () => {
    // Si estamos en la pantalla de maestro, podemos precargar el CCT si ya existía en LocalStorage
    const inputCCT = document.getElementById('cct-input');
    if (inputCCT) {
        const cctGuardado = localStorage.getItem('institucion_cct');
        if (cctGuardado) {
            inputCCT.value = cctGuardado;
        }
    }

    // Escucha de la tecla "Enter" en los inputs para ejecutar el inicio de sesión cómodamente
    const inputs = document.querySelectorAll('.input-codigo, input[type="password"], input[type="email"]');
    inputs.forEach(input => {
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const btn = document.getElementById('btn-entrar-staff');
                if (btn) btn.click();
            }
        });
    });
});