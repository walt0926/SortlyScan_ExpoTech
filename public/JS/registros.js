// Selección de elementos
const btnDocente = document.getElementById('btn-docente');
const btnDirector = document.getElementById('btn-director');
const loginForm = document.getElementById('login-form');

// Lógica para cambiar entre Docente y Director
btnDocente.addEventListener('click', () => {
    btnDocente.classList.add('active');
    btnDirector.classList.remove('active');
});

btnDirector.addEventListener('click', () => {
    btnDirector.classList.add('active');
    btnDocente.classList.remove('active');
});

// Manejo del envío del formulario
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    
    const user = document.getElementById('username').value;
    const pass = document.getElementById('password').value;
    const rol = document.querySelector('.role-btn.active').innerText;

    alert(`Iniciando sesión como ${rol}\nUsuario: ${user}`);
});