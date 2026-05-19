<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - Teacher Panel</title>
    <link rel="stylesheet" href="style_panel.css">
    <link rel="stylesheet" href="CSS/Vista_docente.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container">
        <header class="main-header">
            <div class="titles">
                <h1 id="panel-title">Teacher Panel</h1>
                <p id="teacher-welcome">Welcome!</p>
            </div>
            <button class="logout-btn" onclick="cerrarSesion()"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</button>
        </header>

        <section class="class-code-card">
            <div class="code-info">
                <span>Class code</span>
                <h2 id="class-code">---</h2>
            </div>
            <button class="copy-btn" onclick="copyCode()"><i class="fa-regular fa-copy"></i> Copy</button>
        </section>

        <main class="students-section">
            <div class="section-header">
                <h3 id="student-count"><i class="fa-solid fa-users"></i> Students (0)</h3>
                <button class="add-student-btn" onclick="agregarAlumno()"><i class="fa-solid fa-plus"></i> Add student</button>
            </div>

            <div class="student-list" id="student-list-container">
                <p style="text-align:center; color: #999; padding: 20px;">Loading students...</p>
            </div>
        </main>
    </div>

    <script src="JS/Panel_Docente.js"></script>
</body>
</html>