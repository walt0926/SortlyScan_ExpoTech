const alumnos = [
    { nombre: "Juan Pérez", puntos: 2450 },
    { nombre: "Ana Martínez", puntos: 3100 },
    { nombre: "Carlos López", puntos: 1850 },
    { nombre: "María García", puntos: 2950 },
    { nombre: "Sofía Ruiz", puntos: 1200 },
    { nombre: "Luis Fernando", puntos: 2700 }
];

function mostrarRanking() {
    const listaHtml = document.getElementById('ranking-list');
    alumnos.sort((a, b) => b.puntos - a.puntos);
    listaHtml.innerHTML = "";
    alumnos.forEach((alumno, index) => {
        const puesto = index + 1;
        let claseMedalla = "";
        if (puesto === 1) claseMedalla = "gold";
        else if (puesto === 2) claseMedalla = "silver";
        else if (puesto === 3) claseMedalla = "bronze";
        const item = document.createElement('div');
        item.className = `ranking-item ${puesto <= 3 ? 'top-3' : ''}`;
        
        item.innerHTML = `
            <div class="rank-number ${claseMedalla}">${puesto}</div>
            <div class="user-avatar">
                <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(alumno.nombre)}&background=random" alt="Avatar">
            </div>
            <div class="user-info">
                <p class="user-name">${alumno.nombre}</p>
            </div>
            <div class="user-points">${alumno.puntos.toLocaleString()} pts</div>
        `;
        
        listaHtml.appendChild(item);
    });
}

document.addEventListener('DOMContentLoaded', mostrarRanking);