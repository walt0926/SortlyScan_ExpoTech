<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - Panel de Docente</title>
    <link rel="stylesheet" href="style_panel.css">
    <link rel="stylesheet" href="CSS/Vista_docente.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container">
        <header class="main-header">
            <div class="titles">
                <h1>Panel de Docente</h1>
                <p>Gestiona tu clase y los puntos de tus estudiantes</p>
            </div>
            <button class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Salir</button>
        </header>

        <section class="class-code-card">
            <div class="code-info">
                <span>Código de clase</span>
                <h2 id="class-code">ABC123</h2>
            </div>
            <button class="copy-btn" onclick="copyCode()"><i class="fa-regular fa-copy"></i> Copiar</button>
        </section>

        <main class="students-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-trophy"></i> Estudiantes (5)</h3>
                <button class="add-student-btn"><i class="fa-solid fa-plus"></i> Agregar estudiante</button>
            </div>

            <div class="student-list">
                <div class="student-item">
                    <div class="student-info">
                        <div class="rank-icon gold"><i class="fa-solid fa-trophy"></i></div>
                        <div>
                            <h4>María González</h4>
                            <p>250 puntos</p>
                        </div>
                    </div>
                    <div class="actions">
                        <button class="edit-btn"><i class="fa-solid fa-pen"></i></button>
                        <button class="delete-btn"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </div>

                <div class="student-item">
                    <div class="student-info">
                        <div class="rank-icon silver"><i class="fa-solid fa-trophy"></i></div>
                        <div>
                            <h4>Juan Pérez</h4>
                            <p>230 puntos</p>
                        </div>
                    </div>
                    <div class="actions">
                        <button class="edit-btn"><i class="fa-solid fa-pen"></i></button>
                        <button class="delete-btn"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </div>

                </div>
        </main>
    </div>

    <script src="script_panel.js"></script>
</body>
</html>