<?php
session_start();

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
    <link rel="stylesheet" href="CSS/IA_style.css">
    <link rel="stylesheet" href="CSS/barraNavIA.css">
    <style>
        .icon-exit-btn {
            position: absolute; 
            top: 70px;          
            right: 120px;       
            background: transparent;
            border: none;
            color: #ffffff; 
            cursor: pointer;
            z-index: 100;     
            transition: all 0.3s ease; 
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
        }
        
        .icon-exit-btn:hover {
            transform: scale(1.1);
            color: #000000;
        }
        
        .icon-exit-btn svg {
            display: block;
            width: 35px;  
            height: 35px;
            stroke-width: 2.5; 
        }
    </style>
</head>
<body>
    <button id="btnSalir" class="icon-exit-btn" title="Guardar y Salir">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
            <polyline points="16 17 21 12 16 7"></polyline>
            <line x1="21" y1="12" x2="9" y2="12"></line>
        </svg>
    </button>
    <input type="hidden" id="studentId" value="<?php echo htmlspecialchars($id_alumno_actual); ?>">

    <div id="arduinoStatus" class="arduino-status-conecting" style="display:none;">
        🔌 Arduino Disconnected
    </div>

    <div id="loadingScreen" class="loading-screen">
        <div class="loading-container">
            <div class="loading-spinner"></div>
            <div class="loading-text">Loading your experience...</div>
            <div class="loading-details" id="loadingDetails">
                Are you ready to start recycling?
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
            <video id="video" autoplay muted playsinline></video>
            <canvas id="detectionCanvas" class="detection-overlay"></canvas>
        </div>

        <div id="statusIndicator" class="status-indicator info">
            l
        </div>

        <div id="autoIndicator" class="auto-indicator">
            🔄 AUTODETECTING...
        </div>
    
        <div class="controls-panel" style="display: block;" >
            <button id="connectArduino" class="control-button arduino" style="display: none;">🔌 Connect Arduino</button>
            <button id="startBtn" class="control-button primary">🎥 Start</button>
            <button id="stopBtn" class="control-button danger" disabled>⏹️ Stop</button>
            <button id="detectBtn" class="control-button" disabled>🔍 Detect</button>
            <div class="auto-toggle"  style="display: none;">
                <span class="auto-toggle-label">Auto</span>
                <label class="toggle-switch">
                    <input type="checkbox" id="autoToggle">
                    <span class="slider"></span>
                </label>
            </div>
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

        <div class="serial-panel" style="display: none;">
            <h3 class="serial-title">📡 Serial Monitor</h3>
            <div id="serialLog" class="serial-log">
                > Arduino Serial Monitor<br>
                > Waiting for connection...<br>
            </div>
            <div class="serial-commands">
                <div class="command-item">
                    <span>Organic:</span>
                    <span class="command-code">'w'</span>
                </div>
                <div class="command-item">
                    <span>Paper:</span>
                    <span class="command-code">'p'</span>
                </div>
                <div class="command-item">
                    <span>Plastic:</span>
                    <span class="command-code">'l'</span>
                </div>
                <div class="command-item">
                    <span>Glass:</span>
                    <span class="command-code">'g'</span>
                </div>
                <div class="command-item">
                    <span>Electronic:</span>
                    <span class="command-code">'e'</span>
                </div>
                <div class="command-item">
                    <span>Aluminum:</span>
                    <span class="command-code">'c'</span>
                </div>
            </div>
        </div>
    </div>

    <script src="JS/Java.js"></script>
</body>
</html>