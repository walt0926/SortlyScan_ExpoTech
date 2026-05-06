let students = JSON.parse(localStorage.getItem("students")) || [
  { name: "Ana", points: 200 },
  { name: "Luis", points: 150 },
  { name: "Carlos", points: 120 }
];

saveData();

function saveData() {
  localStorage.setItem("students", JSON.stringify(students));
}

function showScreen(screenId) {
  document.querySelectorAll(".screen").forEach(s => s.classList.remove("active"));
  document.getElementById(screenId).classList.add("active");

  if (screenId === "studentDashboard") renderStudentDashboard();
  if (screenId === "teacherDashboard") renderTeacherDashboard();
}

function renderStudentDashboard() {
  sortRanking();

  const rankingList = document.querySelector("#studentDashboard ul");
  rankingList.innerHTML = "";

  students.forEach((s, index) => {
    const li = document.createElement("li");
    li.innerText = `#${index + 1} ${s.name} - ${s.points}`;
    rankingList.appendChild(li);
  });
  const current = students[students.length - 1];
  document.querySelector(".points").innerText = current.points;
}

function renderTeacherDashboard() {
  sortRanking();

  const table = document.querySelector("#teacherDashboard table");
  table.innerHTML = `
    <tr>
      <th>Nombre</th>
      <th>Puntos</th>
      <th>Acciones</th>
    </tr>
  `;

  students.forEach((s, index) => {
    const row = document.createElement("tr");

    row.innerHTML = `
      <td>${s.name}</td>
      <td>${s.points}</td>
      <td>
        <button onclick="addPoints(${index}, 10)">➕</button>
        <button onclick="addPoints(${index}, -10)">➖</button>
      </td>
    `;

    table.appendChild(row);
  });
}

function addPoints(index, amount) {
  students[index].points += amount;

  if (students[index].points < 0) {
    students[index].points = 0;
  }

  saveData();
  renderTeacherDashboard();
}

function sortRanking() {
  students.sort((a, b) => b.points - a.points);
}

function addStudent() {
  const name = prompt("Nombre del estudiante:");
  if (!name) return;

  students.push({ name, points: 0 });
  saveData();
  renderTeacherDashboard();
}

function generateCode() {
  const code = Math.random().toString(36).substring(2, 8).toUpperCase();
  document.getElementById("classCode").innerText = code;
}
renderStudentDashboard();