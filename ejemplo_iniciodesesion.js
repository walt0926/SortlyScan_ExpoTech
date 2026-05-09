const API// iniciodesesion.js - Versión Completa y Compatible con SortlyScan Backend_URL = "http://localhost/sortlyscan"; // Ajusta esto si tu carpeta en www se llama diferente

let currentUser = null;

// ==========================================
// 1. LOGIN PARA DIRECTOR Y MAESTRO
// ==========================================
async function login() {
    const identifierInput = document.getElementById("username").value; // Puede ser correo o nombre de usuario
    const passwordInput = document.getElementById("password").value;

    // REGLA 1: Usar FormData para que PHP reciba los datos en $_POST
    const formData = new FormData();
    formData.append('action', 'login_staff');
    formData.append('identifier', identifierInput);
    formData.append('password', passwordInput);

    try {
        const response = await fetch(`${API_URL}/auth/login.php`, {
            method: 'POST',
            body: formData,
            credentials: 'include' // REGLA 2: Vital para mantener la sesión iniciada
        });

        const data = await response.json();

        if (data.success) {
            // REGLA 3: Los nombres de los roles coinciden con MySQL
            currentUser = { role: data.rol }; 
            
            // Redirecciones basadas en el rol
            if (currentUser.role === "Director") {
                window.location.href = "Home_pw.php"; // Cambiar al nombre real de tu archivo HTML/PHP
            } else if (currentUser.role === "Maestro") {
                window.location.href = "Dashboard_maestro.php"; // Cambiar al nombre real de tu archivo
            }
        } else {
            alert("Acceso denegado: " + data.message);
        }
    } catch (error) {
        console.error("Error de conexión:", error);
        alert("No se pudo conectar con el servidor.");
    }
}

// ==========================================
// 2. LOGIN PARA ALUMNO (Con Código de Aula y PIN)
// ==========================================
async function loginAlumno() {
    const idAlumno = document.getElementById("selectAlumno").value; // ID obtenido del selector del frontend
    const pinInput = document.getElementById("pin").value; // PIN de 4 dígitos

    const formData = new FormData();
    formData.append('action', 'login_alumno');
    formData.append('id_alumno', idAlumno);
    formData.append('pin', pinInput);

    try {
        const response = await fetch(`${API_URL}/auth/login.php`, {
            method: 'POST',
            body: formData,
            credentials: 'include'
        });

        const data = await response.json();

        if (data.success) {
            // REGLA 4: Guardar datos en LocalStorage para que la cámara/IA sepa quién es
            localStorage.setItem('id_alumno', data.alumno.id_alumno);
            localStorage.setItem('nombre_alumno', data.alumno.nombre_display);
            
            // Redirigir a la vista donde está la cámara
            window.location.href = "Scanner.php"; 
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error de red:", error);
        alert("Error al intentar validar el alumno.");
    }
}

// ==========================================
// 3. CERRAR SESIÓN (Logout)
// ==========================================
async function logout() {
    try {
        const response = await fetch(`${API_URL}/auth/logout.php`, {
            method: 'POST',
            credentials: 'include'
        });
        
        const data = await response.json();
        
        if (data.success) {
            localStorage.removeItem('id_alumno');
            localStorage.removeItem('nombre_alumno');
            window.location.href = "Iniciodesesion.php"; // Redirigir al inicio
        }
    } catch (error) {
        console.error("Error al cerrar sesión:", error);
    }
}