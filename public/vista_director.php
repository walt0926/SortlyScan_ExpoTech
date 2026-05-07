<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - Panel de Director</title>
    <link rel="stylesheet" href="style_director.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container">
        <header class="main-header">
            <div class="titles">
                <h1>Panel de Director</h1>
                <p>Vista general de todas las clases</p>
            </div>
            <button class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Salir</button>
        </header>

        <section class="stats-grid">
            <div class="stat-card orange">
                <div class="stat-icon"><i class="fa-solid fa-school"></i> Total clases</div>
                <div class="stat-number">4</div>
            </div>
            <div class="stat-card teal">
                <div class="stat-icon"><i class="fa-solid fa-users"></i> Total estudiantes</div>
                <div class="stat-number">95</div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon"><i class="fa-solid fa-trophy"></i> Puntos totales</div>
                <div class="stat-number">10,750</div>
            </div>
        </section>

        <section class="ranking-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-trophy"></i> Ranking de Clases</h3>
            </div>

            <div class="ranking-list">
                <div class="ranking-item">
                    <div class="class-info">
                        <div class="rank-circle gold"><i class="fa-solid fa-trophy"></i></div>
                        <div>
                            <h4>Clase ABC123</h4>
                            <p>Docente: Prof. García • 25 estudiantes</p>
                        </div>
                    </div>
                    <div class="points">
                        <span class="points-num">3200</span>
                        <span class="points-label">puntos</span>
                    </div>
                </div>

                <div class="ranking-item">
                    <div class="class-info">
                        <div class="rank-circle silver"><i class="fa-solid fa-trophy"></i></div>
                        <div>
                            <h4>Clase DEF456</h4>
                            <p>Docente: Prof. Morales • 22 estudiantes</p>
                        </div>
                    </div>
                    <div class="points">
                        <span class="points-num">2800</span>
                        <span class="points-label">puntos</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="acopio-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-house-chimney-window"></i> Centros de Acopio</h3>
            </div>
            <button class="go-acopio-btn" onclick="location.href='centros_acopio.html'">
                Gestionar Centros de Acopio 
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </section>
    </div>

</body>
</html>