// public/JS/Panel_Director.js

document.addEventListener('DOMContentLoaded', () => {
    const idDirector = localStorage.getItem('usuario_id');
    
    if (!idDirector) {
        alert("Debes iniciar sesión primero.");
        window.location.href = 'iniciodesesion_Director.php';
        return;
    }

    cargarDatosDashboard(idDirector);

    // Escuchadores de formularios de modales
    const formEdit = document.getElementById('form-editar-salon');
    if(formEdit) formEdit.addEventListener('submit', guardarEditarSalon);

    const formDel = document.getElementById('form-eliminar-salon');
    if(formDel) formDel.addEventListener('submit', guardarEliminarSalon);

    // Escuchador del formulario de ajustes globales del director
    const formAjustes = document.getElementById('form-ajustes-director');
    if(formAjustes) formAjustes.addEventListener('submit', guardarAjustesDirector);

    // Verificación en tiempo real de la palabra "ELIMINAR"
    const inputConfirm = document.getElementById('del-salon-confirmacion');
    if(inputConfirm) {
        inputConfirm.addEventListener('input', (e) => {
            const btnDel = document.getElementById('btn-del-salon-submit');
            if(e.target.value === 'ELIMINAR') {
                btnDel.disabled = false;
                btnDel.style.cursor = 'pointer';
                btnDel.style.opacity = '1';
            } else {
                btnDel.disabled = true;
                btnDel.style.cursor = 'not-allowed';
                btnDel.style.opacity = '0.5';
            }
        });
    }
});

async function cargarDatosDashboard(idDirector) {
    try {
        const formData = new FormData();
        formData.append('id_director', idDirector);

        const response = await fetch('logic/get_dashboard_director.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            window.salonesActuales = data.salones; 

            // Almacenamos los datos mapeados del perfil del director
            window.perfilDirector = {
                cct: data.escuela_cct,
                escuela_nombre: data.escuela_nombre,
                director_nombre: data.director_nombre
            };

            const tituloEscuela = document.getElementById('school-name');
            if (tituloEscuela && data.escuela_nombre) tituloEscuela.textContent = data.escuela_nombre;

            const cctEscuela = document.getElementById('school-cct');
            if (cctEscuela && data.escuela_cct) cctEscuela.textContent = `CCT: ${data.escuela_cct}`;

            document.getElementById('stat-clases').textContent = data.stats.total_clases;
            document.getElementById('stat-alumnos').textContent = data.stats.total_alumnos;
            document.getElementById('stat-puntos').textContent = data.stats.total_puntos;

            const selectClases = document.getElementById('select-clases');
            selectClases.innerHTML = '<option value="">Selecciona un salón...</option>';
            data.salones.forEach(salon => {
                selectClases.innerHTML += `<option value="${salon.id_salon}">${salon.nombre_salon}</option>`;
            });

            const rankingContainer = document.getElementById('ranking-container');
            if (data.salones.length > 0) {
                rankingContainer.innerHTML = ''; 
                data.salones.forEach((salon, index) => {
                    rankingContainer.innerHTML += `
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 14px 20px; border-bottom: 1px solid #f1f5f9; cursor: pointer; transition: all 0.2s;" 
                             onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'"
                             onclick="verAlumnos(${salon.id_salon}, '${salon.nombre_salon}')">
                            <div>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="font-weight: bold; color: #00BCD4; font-size: 1.1rem;">#${index + 1}</span>
                                    <span style="font-weight: 600; color: #1e293b; font-size: 1rem;">${salon.nombre_salon}</span>
                                </div>
                                <div style="font-size: 0.8rem; color: #64748b; margin-top: 4px; display: flex; gap: 10px;">
                                    <span><i class="fa-solid fa-user-tie"></i> ${salon.nombre_maestro ? salon.nombre_maestro : 'Sin maestro'}</span>
                                    <span>•</span>
                                    <span><i class="fa-solid fa-qrcode"></i> Aula: <strong>${salon.codigo_aula}</strong></span>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 20px;">
                                <div style="font-weight: bold; color: #4CAF50; font-size: 1.1rem; display: flex; align-items: center; gap: 5px;">
                                    ${salon.puntos} <i class="fa-solid fa-star" style="font-size:0.9rem;"></i>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <button onclick="event.stopPropagation(); abrirModalEditarSalon(${salon.id_salon})" style="background: #e0f7fa; color: #00BCD4; border: none; padding: 8px 12px; border-radius: 10px; cursor: pointer; font-size: 0.9rem; transition: 0.2s;" onmouseover="this.style.background='#00BCD4'; this.style.color='white';" onmouseout="this.style.background='#e0f7fa'; this.style.color='#00BCD4';"><i class="fa-solid fa-pen"></i></button>
                                    <button onclick="event.stopPropagation(); abrirModalEliminarSalon(${salon.id_salon}, '${salon.nombre_salon}')" style="background: #fde8e8; color: #ef4444; border: none; padding: 8px 12px; border-radius: 10px; cursor: pointer; font-size: 0.9rem; transition: 0.2s;" onmouseover="this.style.background='#ef4444'; this.style.color='white';" onmouseout="this.style.background='#fde8e8'; this.style.color='#ef4444';"><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                            </div>
                        </div>
                    `;
                });
            } else {
                rankingContainer.innerHTML = '<p style="text-align:center; color: #999; padding: 20px;">Aún no hay salones registrados en esta institución.</p>';
            }
        }
    } catch (error) {
        console.error("Error de red al cargar dashboard:", error);
    }
}

// AJUSTES DEL DIRECTOR
function abrirModalAjustes() {
    if (!window.perfilDirector) return;

    document.getElementById('ajustes-cct').value = window.perfilDirector.cct;
    document.getElementById('ajustes-escuela-nombre').value = window.perfilDirector.escuela_nombre;
    document.getElementById('ajustes-director-nombre').value = window.perfilDirector.director_nombre;
    document.getElementById('ajustes-director-pass').value = ''; 

    document.getElementById('modal-ajustes-director').style.display = 'flex';
    document.getElementById('ajustes-escuela-nombre').focus();
}

function cerrarModalAjustes() {
    document.getElementById('modal-ajustes-director').style.display = 'none';
}

async function guardarAjustesDirector(e) {
    e.preventDefault();
    const idDirector = localStorage.getItem('usuario_id');

    const formData = new FormData();
    formData.append('id_director', idDirector);
    formData.append('nombre_escuela', document.getElementById('ajustes-escuela-nombre').value.trim());
    formData.append('nombre_director', document.getElementById('ajustes-director-nombre').value.trim());
    formData.append('pass_director', document.getElementById('ajustes-director-pass').value.trim());

    try {
        const response = await fetch('logic/editar_ajustes_director.php', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();

        if (data.success) {
            alert("¡Configuraciones guardadas de forma exitosa!");
            cerrarModalAjustes();
            cargarDatosDashboard(idDirector); 
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Ocurrió un error al intentar conectarse al servidor.");
    }
}

// ACCIÓN: VER ALUMNOS DEL SALÓN
async function verAlumnos(idSalon, nombreSalon) {
    document.getElementById('txt-modal-aula-nombre').textContent = nombreSalon;
    const container = document.getElementById('lista-alumnos-clase');
    container.innerHTML = '<p style="text-align:center; color:#999; padding:10px;">Loading classroom ranking...</p>';
    
    document.getElementById('modal-ver-alumnos').style.display = 'flex';

    try {
        const formData = new FormData();
        formData.append('id_salon', idSalon);

        const response = await fetch('logic/get_estudiantes_clase.php', { method: 'POST', body: formData });
        const data = await response.json();

        if(data.success) {
            container.innerHTML = '';
            if(data.alumnos.length > 0) {
                data.alumnos.forEach((al, idx) => {
                    container.innerHTML += `
                        <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #f1f5f9;">
                            <span style="color:#1e293b;"><strong style="color:#00BCD4; margin-right:8px;">#${idx+1}</strong> ${al.nombre_display}</span>
                            <span style="font-weight:bold; color:#4CAF50;">${al.puntos_totales} ★</span>
                        </div>
                    `;
                });
            } else {
                container.innerHTML = '<p style="text-align:center; color:#999; padding:15px;">Este salón no tiene alumnos registrados.</p>';
            }
        }
    } catch (error) {
        container.innerHTML = '<p style="text-align:center; color:#ef4444; padding:15px;">Error al conectar con el servidor.</p>';
    }
}
function cerrarModalAlumnos() { document.getElementById('modal-ver-alumnos').style.display = 'none'; }

// ACCIÓN: EDITAR SALÓN Y MAESTRO
function abrirModalEditarSalon(idSalon) {
    if(!window.salonesActuales) return;
    const salon = window.salonesActuales.find(s => parseInt(s.id_salon) === parseInt(idSalon));

    if(salon) {
        document.getElementById('edit-salon-id').value = salon.id_salon;
        document.getElementById('edit-salon-nombre').value = salon.nombre_salon;
        document.getElementById('edit-docente-nombre').value = salon.nombre_maestro ? salon.nombre_maestro : '';
        document.getElementById('edit-docente-user').value = salon.user_maestro ? salon.user_maestro : '';
        document.getElementById('edit-docente-pass').value = ''; 

        document.getElementById('modal-editar-salon').style.display = 'flex';
        document.getElementById('edit-salon-nombre').focus();
    }
}
function cerrarModalEditarSalon() { document.getElementById('modal-editar-salon').style.display = 'none'; }

async function guardarEditarSalon(e) {
    e.preventDefault();
    const idDirector = localStorage.getItem('usuario_id');
    
    const formData = new FormData();
    formData.append('id_director', idDirector);
    formData.append('id_salon', document.getElementById('edit-salon-id').value);
    formData.append('nombre_salon', document.getElementById('edit-salon-nombre').value.trim());
    formData.append('nombre_docente', document.getElementById('edit-docente-nombre').value.trim());
    formData.append('user_docente', document.getElementById('edit-docente-user').value.trim().toLowerCase());
    formData.append('pass_docente', document.getElementById('edit-docente-pass').value.trim());

    try {
        const response = await fetch('logic/editar_clase.php', { method: 'POST', body: formData });
        const data = await response.json();

        if(data.success) {
            alert("¡Cambios aplicados con éxito!");
            cerrarModalEditarSalon();
            cargarDatosDashboard(idDirector);
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        alert("Ocurrió un error al procesar los cambios.");
    }
}

// ACCIÓN: ELIMINAR SALÓN COMPLETAMENTE
function abrirModalEliminarSalon(idSalon, nombreSalon) {
    document.getElementById('del-salon-id').value = idSalon;
    document.getElementById('del-salon-nombre-text').textContent = nombreSalon;
    document.getElementById('del-salon-confirmacion').value = '';
    
    const btnDel = document.getElementById('btn-del-salon-submit');
    btnDel.disabled = true;
    btnDel.style.opacity = '0.5';
    btnDel.style.cursor = 'not-allowed';

    document.getElementById('modal-eliminar-salon').style.display = 'flex';
    document.getElementById('del-salon-confirmacion').focus();
}
function cerrarModalEliminarSalon() { document.getElementById('modal-eliminar-salon').style.display = 'none'; }

async function guardarEliminarSalon(e) {
    e.preventDefault();
    const idDirector = localStorage.getItem('usuario_id');
    const idSalon = document.getElementById('del-salon-id').value;

    const formData = new FormData();
    formData.append('id_salon', idSalon);

    try {
        const response = await fetch('logic/eliminar_clase.php', { method: 'POST', body: formData });
        const data = await response.json();

        if(data.success) {
            alert("El salón ha sido eliminado por completo.");
            cerrarModalEliminarSalon();
            cargarDatosDashboard(idDirector);
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        alert("Error de comunicación con el servidor.");
    }
}

// ACCIONES BASE
async function crearClase() {
    const idDirector = localStorage.getItem('usuario_id');
    const nombreClase = document.getElementById('nombre-clase').value.trim();

    if (!nombreClase) {
        alert("Por favor ingresa un nombre para el salón.");
        return;
    }

    const formData = new FormData();
    formData.append('id_director', idDirector);
    formData.append('nombre_clase', nombreClase);

    try {
        const response = await fetch('logic/crear_clase.php', { method: 'POST', body: formData });
        const data = await response.json();

        if (data.success) {
            alert(`¡Salón creado! Código de aula generado: ${data.codigo_aula}`);
            document.getElementById('nombre-clase').value = ''; 
            cargarDatosDashboard(idDirector); 
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        alert("Error de red.");
    }
}

async function asignarDocente() {
    const idDirector = localStorage.getItem('usuario_id');
    const idSalon = document.getElementById('select-clases').value;
    const nombreDocente = document.getElementById('nombre-docente').value.trim();
    const userDocente = document.getElementById('user-docente').value.trim().toLowerCase(); 
    const passDocente = document.getElementById('pass-docente').value.trim();

    if (!idSalon || !nombreDocente || !userDocente || !passDocente) {
        alert("Por favor completa todos los campos para asignar al maestro.");
        return;
    }

    const formData = new FormData();
    formData.append('id_director', idDirector);
    formData.append('id_salon', idSalon);
    formData.append('nombre_docente', nombreDocente);
    formData.append('user_docente', userDocente); 
    formData.append('pass_docente', passDocente);

    try {
        const response = await fetch('logic/asignar_docente.php', { method: 'POST', body: formData });
        const data = await response.json();

        if (data.success) {
            alert(`¡Docente asignado con éxito!\nEl maestro iniciará sesión con el usuario: ${userDocente}`);
            document.getElementById('select-clases').value = '';
            document.getElementById('nombre-docente').value = '';
            document.getElementById('user-docente').value = '';
            document.getElementById('pass-docente').value = '';
            cargarDatosDashboard(idDirector);
        } else {
            alert("Error: " + data.message);
        }
    } catch (error) {
        alert("Error de red.");
    }
}

function cerrarSesion() {
    localStorage.clear();
    window.location.href = 'iniciodesesion_Director.php';
}