// public/JS/registro.js

const API_URL = "http://localhost/sortlyscan";

document.getElementById("formRegistroEscuela").addEventListener("submit", async (e) => {
    e.preventDefault();

    const btnRegistrar = document.getElementById("btn-registrar");
    if (!btnRegistrar) return;

    // Guardar el contenido original del botón (texto)
    const textoOriginalBtn = btnRegistrar.innerHTML;

    // Efecto dinámico: Deshabilitar y añadir Spinner de Bootstrap
    btnRegistrar.disabled = true;
    btnRegistrar.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Procesando Registro...`;

    const formData = new FormData(e.target);
    formData.append('action', 'registrar_institucion'); // Indica al archivo PHP qué proceso ejecutar

    try {
        const response = await fetch(`${API_URL}/auth/registro_proceso.php`, {
            method: 'POST',
            body: formData
        });

        if (!response.ok) throw new Error("Error en la respuesta del servidor");

        const data = await response.json();

        if (data.success) {
            alert("¡Institución registrada con éxito! Ahora puedes iniciar sesión.");
            // Redirección directa agregándole la extensión .php correspondiente
            window.location.href = "iniciodesesion_Director.php";
        } else {
            alert("Error al registrar: " + (data.message || "Ocurrió un problema desconocido."));
            // Restablecer botón si el backend deniega el registro
            btnRegistrar.disabled = false;
            btnRegistrar.innerHTML = textoOriginalBtn;
        }
    } catch (error) {
        console.error("Error de conexión:", error);
        alert("No se pudo conectar con el servidor para procesar el registro. Asegúrate de que el backend esté encendido.");
        
        // Restablecer botón en caso de un fallo crítico de red
        btnRegistrar.disabled = false;
        btnRegistrar.innerHTML = textoOriginalBtn;
    }
});