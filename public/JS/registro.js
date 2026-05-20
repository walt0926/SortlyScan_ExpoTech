// public/JS/registro.js
let codeSent = false; 

document.getElementById("formRegistroEscuela").addEventListener("submit", async (e) => {
    e.preventDefault();

    const form = e.target;
    const password = document.getElementById("password_director").value;
    const passwordConfirm = document.getElementById("password_confirm").value;

    if (password !== passwordConfirm) {
        alert("Las contraseñas no coinciden. Por favor, verifícalas.");
        document.getElementById("password_confirm").focus();
        return;
    }

    const formData = new FormData(form);

    // PASO 1: Solicitar y enviar el código al correo electrónico
    if (!codeSent) {
        formData.append('action', 'enviar_codigo');

        try {
            // CORRECCIÓN DE RUTA: Apunta a la carpeta logic/
            const response = await fetch('logic/registro_proceso.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                alert("¡Datos validados! Se ha enviado un código de confirmación a tu correo electrónico.");
                
                document.getElementById("verification-block").style.display = "block";
                document.getElementById("codigo_verificacion").required = true;
                document.getElementById("codigo_verificacion").focus();
                
                document.getElementById("btn-submit-registro").textContent = "VERIFY & REGISTER SCHOOL";
                document.getElementById("btn-submit-registro").style.backgroundColor = "#4CAF50";
                
                form.querySelectorAll('input:not(#codigo_verificacion)').forEach(input => {
                    input.readOnly = true;
                });

                codeSent = true; 
            } else {
                alert("Error de validación: " + data.message);
            }
        } catch (error) {
            console.error("Error de conexión:", error);
            alert("No se pudo procesar el envío del código. Revisa la conexión con el servidor.");
        }
    } 
    // PASO 2: Verificar el código ingresado e insertar definitivamente en la BD
    else {
        formData.append('action', 'registrar_institucion');

        try {
            // CORRECCIÓN DE RUTA: Apunta a la carpeta logic/
            const response = await fetch('logic/registro_proceso.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                alert("¡Institución y Director registrados con éxito! Ahora puedes iniciar sesión.");
                window.location.href = "iniciodesesion_Director.php"; 
            } else {
                alert("Error de verificación: " + data.message);
            }
        } catch (error) {
            console.error("Error de conexión:", error);
            alert("No se pudo conectar con el servidor para procesar el registro definitivo.");
        }
    }
});