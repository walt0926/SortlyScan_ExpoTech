<?php
// We start the session to get the ID of the student using the platform.
session_start();

// We validate if the student ID exists in the session.
// If not, we assign a default value of 1 to prevent errors during your testing.
$id_alumno_actual = isset($_SESSION['id_alumno']) ? $_SESSION['id_alumno'] : 1; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Classifier</title>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4.10.0/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet@2.1.0/dist/mobilenet.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/coco-ssd@2.2.2/dist/coco-ssd.min.js"></script>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/barraNavIA.css">
</head>
<body>
    <input type="hidden" id="studentId" value="<?php echo htmlspecialchars($id_alumno_actual); ?>">

    <div id="loadingScreen" class="loading-screen">
        <div class="loading-container">
            <div class="loading-spinner"></div>
            <div class="loading-text">Loading AI Model</div>
            <div class="loading-details" id="loadingDetails">
                Initializing TensorFlow.js and MobileNet for waste classification...
            </div>
        </div>
    </div>

    <div id="mainInterface" class="main-container" style="display: none;">
        <div class="header">
            <div class="header-card">
                <h1 class="header-title">SortlyScan Scanner</h1>
            </div>
        </div>

        <div class="camera-container">
            <div class="auto-toggle-container" style="margin-bottom: 10px; display:none">
                <span class="auto-toggle-label" style="color: white; margin-right: 8px; font-weight: bold;">Escaneo Automático:</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="autoToggle" checked>
                    <span class="slider"></span>
                </label>
            </div>
            <video id="video" autoplay muted playsinline></video>
            <canvas id="detectionCanvas" class="detection-overlay"></canvas>
        </div>

        <div id="statusIndicator" class="status-indicator info">
            Ready
        </div>

        <div id="autoIndicator" class="auto-indicator" style="display: none;">
            🔄 AUTODETECTING...
        </div>
    
        <div class="controls-panel" style="display: block;">
            <button id="startBtn" class="control-button primary">🎥 Start</button>
            <button id="stopBtn" class="control-button danger" disabled>⏹️ Stop</button>
            <button id="detectBtn" class="control-button" disabled>🔍 Detect</button>
        </div>
    

        <div id="infoPanel" class="info-panel">
            <div class="waste-category-display">
                <div class="waste-category-large unknown" id="wasteCategoryLarge">
                    Ready!
                </div>
            </div>
           
            <div class="info-details">
                <div class="info-item">
                    <div class="info-value" id="confidenceValue">--</div>
                    <div class="info-label">Confidence</div>
                </div>
                <div class="info-item" style="display:none;">
                    <div class="info-value" id="processingValue">--</div>
                    <div class="info-label">Time (s)</div>
                </div>
                <div class="info-item">
                    <div class="info-value" id="totalCount">0</div>
                    <div class="info-label">Total</div>
                </div>
                <div class="info-item" style="display:none;">
                    <div class="info-value" id="accuracyValue">--</div>
                    <div class="info-label">Average</div>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/Java.js"></script>
</body>
</html>