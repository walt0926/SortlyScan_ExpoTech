<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - Estudiante</title>
    <link rel="stylesheet" href="vista_estudiante.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="container">
        <header class="header">
            <div class="user-welcome">
                <h1>¡Hola, Ana Rodríguez!</h1>
                <p>Sigue así, ¡vas muy bien!</p>
            </div>
            <button class="icon-exit-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i></button>
        </header>

        <section class="points-card">
            <div class="points-content">
                <div class="points-header">
                    <i class="fa-solid fa-trophy"></i> Tus puntos
                </div>
                <div class="points-number">215</div>
                <div class="rank-badge">
                    <i class="fa-solid fa-trophy"></i> #3 en tu clase
                </div>
            </div>
            <i class="fa-solid fa-star decorative-star"></i>
        </section>

        <section class="ranking-container">
            <h3><i class="fa-solid fa-trophy"></i> Ranking de tu clase</h3>
            
            <div class="ranking-list">
                <div class="ranking-item">
                    <div class="item-left">
                        <div class="rank-icon gold"><i class="fa-solid fa-trophy"></i></div>
                        <span class="name">María González</span>
                    </div>
                    <div class="item-right">
                        <i class="fa-solid fa-star"></i> 250
                    </div>
                </div>

                </div>
        </section>

        <button class="fab-camera" onclick="location.href='scanner.html'">
            <i class="fa-solid fa-camera"></i>
        </button>
    </div>

</body>
</html>