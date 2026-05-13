const API_URL = "http://localhost/sortlyscan";

document.getElementById("formRegistroEscuela").addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    formData.append('action', 'registrar_institucion'); // Para que tu PHP sepa qué proceso ejecutar

    try {
        const response = await fetch(`${API_URL}/auth/registro_proceso.php`, {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            alert("¡Institución registrada con éxito! Ahora puedes iniciar sesión.");
            window.location.href = "iniciodesesion_Director";
        } else {
            alert("Error al registrar: " + data.message);
        }
    } catch (error) {
        console.error("Error de conexión:", error);
        alert("No se pudo conectar con el servidor para procesar el registro.");
    }
});