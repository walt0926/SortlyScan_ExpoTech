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
                <h1>Teacher Panel</h1>
                <p>Manage your class and your students' points</p>
            </div>
            <button class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</button>
        </header>

        <section class="class-code-card">
            <div class="code-info">
                <span>Class code</span>
                <h2 id="class-code">ABC123</h2>
            </div>
            <button class="copy-btn" onclick="copyCode()"><i class="fa-regular fa-copy"></i> Copy</button>
        </section>

        <main class="students-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-trophy"></i> Students (5)</h3>
                <button class="add-student-btn"><i class="fa-solid fa-plus"></i> Add student</button>
            </div>

            <div class="student-list">
                <div class="student-item">
                    <div class="student-info">
                        <div class="rank-icon gold"><i class="fa-solid fa-trophy"></i></div>
                        <div>
                            <h4>María González</h4>
                            <p>250 points</p>
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
                            <p>230 points</p>
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