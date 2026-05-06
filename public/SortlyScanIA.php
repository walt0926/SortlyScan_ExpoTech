<<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan</title>
    
    <!-- Librerías de IA -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.10.0/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet@2.1.0/dist/mobilenet.min.js"></script>
    
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

    <!-- Pantalla de Carga -->
    <div id="loadingScreen" class="loading-screen">
        <div class="loading-container">
            <div class="loading-spinner"></div>
            <h2 class="loading-text">¡Activando Visión Artificial!</h2>
            <p>Cargando el cerebro de los robots...</p>
        </div>
    </div>

    <!-- Interfaz Principal -->
    <div id="mainInterface" class="main-container" style="display: none;">
        
        <!-- Panel Izquierdo: Escáner -->
        <div class="scanner-section">
            <header class="header-card">
                <h1 class="header-title">🌟 SortlyScan Pro</h1>
                <p>Apunta a un objeto para clasificarlo</p>
            </header>

            <div class="camera-container glass-card">
                <video id="video" autoplay muted playsinline></video>
                <div id="scanLine" class="scan-line"></div>
            </div>

            <div class="info-panel glass-card">
                <div id="wasteCategoryLarge" class="category-tag unknown">
                    ¡Listo para empezar!
                </div>
                
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-label">Certeza de IA</span>
                        <div id="confidenceValue" class="stat-value">--</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Eco-Puntos</span>
                        <div id="totalCount" class="stat-value">0</div>
                    </div>
                </div>
            </div>

            <div class="controls">
                <button id="startBtn" class="btn btn-start">🚀 INICIAR ESCÁNER</button>
                <button id="stopBtn" class="btn btn-stop" disabled>🛑 REINICIAR</button>
            </div>
        </div>

        <!-- Panel Derecho: Historial -->
        <div class="history-section glass-card">
            <h3 class="history-title">📋 Registro de Capturas</h3>
            <div id="historyList" class="history-list">
                <!-- Los objetos detectados aparecerán aquí -->
                <div class="empty-state">Aún no has detectado nada...</div>
            </div>
        </div>

    </div>
    <script src="JS/Java.js"></script>
</body>
</html>