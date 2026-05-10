const API_URL = "http://localhost/sortlyscan"; // Ajusta a tu ruta real
let isAdminMode = false;
let isRegisterMode = false;

// Alternar entre Alumno/Maestro y Director
function toggleAdminMode() {
    isAdminMode = !isAdminMode;
    isRegisterMode = false;
    document.getElementById('form-acceso').style.display = 'block';
    document.getElementById('form-registro').style.display = 'none';
    
    const adminFields = document.getElementById('admin-auth');
    const btn = document.getElementById('btn-principal');
    const link = document.getElementById('mode-toggle');

    if (isAdminMode) {
        adminFields.style.display = 'block';
        btn.innerText = "Iniciar Gestión";
        link.innerText = "Regresar a acceso alumnos/maestros";
    } else {
        adminFields.style.display = 'none';
        btn.innerText = "Entrar a la Escuela";
        link.innerText = "¿Eres el Director? Acceso Administrativo";
    }
}

// Alternar vista de registro
function toggleRegistro() {
    isRegisterMode = !isRegisterMode;
    const formAcceso = document.getElementById('form-acceso');
    const formReg = document.getElementById('form-registro');
    const regBtn = document.getElementById('reg-toggle');

    if (isRegisterMode) {
        formAcceso.style.display = 'none';
        formReg.style.display = 'block';
        regBtn.innerText = "Volver al inicio";
    } else {
        formAcceso.style.display = 'block';
        formReg.style.display = 'none';
        regBtn.innerText = "Inscribir nueva institución";
    }
}

// Procesar login (Simple o Admin)
async function procesarAcceso() {
    const cct = document.getElementById("cct-input").value;
    const pass = document.getElementById("admin-pass-input").value;

    if (!cct) return alert("Por favor ingresa el CCT de tu escuela");

    const formData = new FormData();
    formData.append('cct', cct);

    if (isAdminMode) {
        if (!pass) return alert("El director debe ingresar su contraseña");
        formData.append('action', 'login_director');
        formData.append('password', pass);
    } else {
        formData.append('action', 'validar_simple');
    }

    try {
        const response = await fetch(`${API_URL}/auth/instituciones.php`, {
            method: 'POST',
            body: formData
        });
        const data = await response.json();

        if (data.success) {
            localStorage.setItem('inst_id', data.inst_id);
            localStorage.setItem('inst_nombre', data.nombre);

            if (isAdminMode) {
                localStorage.setItem('user_role', 'Director');
                window.location.href = "Home_pw.php"; 
            } else {
                window.location.href = "Iniciodesesion.php";
            }
        } else {
            alert(data.message || "Error de validación");
        }
    } catch (e) {
        alert("Error de conexión con el servidor");
    }
}

// Procesar Registro
async function registrarInstitucion() {
    const nombre = document.getElementById("reg-nombre").value;
    const cct = document.getElementById("reg-cct").value;
    const pass = document.getElementById("reg-pass").value;

    if (!nombre || !cct || !pass) return alert("Llena todos los campos");

    const formData = new FormData();
    formData.append('action', 'registrar_institucion');
    formData.append('nombre', nombre);
    formData.append('cct', cct);
    formData.append('password', pass);

    try {
        const response = await fetch(`${API_URL}/auth/instituciones.php`, {
            method: 'POST',
            body: formData
        });
        const data = await response.json();

        if (data.success) {
            alert("Institución registrada con éxito. Ya puedes iniciar sesión.");
            location.reload();
        } else {
            alert(data.message);
        }
    } catch (e) {
        alert("Error al registrar");
    }
}