const API_URL = "http://tu-servidor.com/api"; //URL DE BACKEND

let currentUser = null;

async function login() {
    const nameInput = document.getElementById("username").value;

    try {
        const response = await fetch(`${API_URL}/login.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ nombre: nameInput })
        });

        const data = await response.json();

        if (data.success) {
            currentUser = data.user; 
            
            if (currentUser.role === "teacher") {
                showScreen("teacherDashboard");
            } else {
                showScreen("studentDashboard");
            }
        } else {
            alert("Usuario no encontrado en la base de datos.");
        }
    } catch (error) {
        console.error("Error de conexión:", error);
        alert("No se pudo conectar con el servidor MySQL.");
    }
}

async function addPoints(studentId, amount) {
    try {
        const response = await fetch(`${API_URL}/update_points.php`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                id: studentId, 
                points: amount 
            })
        });

        const result = await response.json();
        if (result.success) {
            renderTeacherDashboard();
        }
    } catch (error) {
        console.error("Error al actualizar puntos:", error);
    }
}

async function getRanking() {
    try {
        const response = await fetch(`${API_URL}/get_ranking.php`);
        const students = await response.json();
        return students;
    } catch (error) {
        console.error("Error al obtener ranking:", error);
        return [];
    }
}

function showScreen(screenId) {
    document.querySelectorAll(".screen").forEach(s => s.classList.remove("active"));
    document.getElementById(screenId).classList.add("active");

    if (screenId === "studentDashboard") renderStudentDashboard();
    if (screenId === "teacherDashboard") renderTeacherDashboard();
}

async function renderStudentDashboard() {
    const students = await getRanking();
    const rankingList = document.querySelector("#studentDashboard ul");
    rankingList.innerHTML = "";

    students.forEach((s, index) => {
        const li = document.createElement("li");
        if (currentUser && s.name === currentUser.name) li.classList.add("highlight");
        li.innerText = `#${index + 1} ${s.name} - ${s.points} pts`;
        rankingList.appendChild(li);
    });

    const userUpdate = students.find(s => s.id === currentUser.id);
    document.querySelector(".points").innerText = userUpdate ? userUpdate.points : 0;
}

async function renderTeacherDashboard() {
    const students = await getRanking();
    const table = document.querySelector("#teacherDashboard table");
    table.innerHTML = `
        <tr>
            <th>Nombre</th>
            <th>Puntos</th>
            <th>Acciones</th>
        </tr>
    `;

    students.filter(s => s.role === 'student').forEach((s) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${s.name}</td>
            <td>${s.points}</td>
            <td>
                <button onclick="addPoints(${s.id}, 10)">➕</button>
                <button onclick="addPoints(${s.id}, -10)">➖</button>
            </td>
        `;
        table.appendChild(row);
    });
}