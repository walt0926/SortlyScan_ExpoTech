let net;
const video = document.getElementById('video');
const categoryDisplay = document.getElementById('wasteCategoryLarge');
const confidenceDisplay = document.getElementById('confidenceValue');
const countDisplay = document.getElementById('totalCount');
const historyList = document.getElementById('historyList');

let score = 0;
let isDetecting = false;
let lastAddedItem = "";

// DICCIONARIO EXTENDIDO DE RECICLAJE
// Añadimos más palabras clave para que sea mucho más asertivo
const RECYCLE_MAP = {
    organico: ['banana', 'apple', 'orange', 'lemon', 'fruit', 'vegetable', 'pineapple', 'meat', 'pizza', 'bread', 'food'],
    papel: ['paper', 'notebook', 'book', 'carton', 'cardboard', 'envelope', 'magazine', 'paper towel'],
    plastico: ['bottle', 'water bottle', 'pill bottle', 'plastic', 'cup', 'toy', 'container', 'wrapper'],
    vidrio: ['wine bottle', 'beer bottle', 'glass', 'jar', 'vial', 'beaker'],
    metal: ['can', 'tin', 'soda can', 'aluminum', 'pot', 'pan', 'foil', 'screw'],
    electronico: ['mouse', 'keyboard', 'laptop', 'cellphone', 'remote', 'battery', 'screen', 'monitor', 'joystick']
};

// Configuración inicial
async function setupApp() {
    try {
        // Cargamos MobileNet v2 (más preciso)
        net = await mobilenet.load({version: 2, alpha: 1.0});
        
        document.getElementById('loadingScreen').style.display = 'none';
        document.getElementById('mainInterface').style.display = 'grid';
    } catch (error) {
        console.error("Error al cargar la IA:", error);
        alert("Hubo un problema al cargar los modelos. Revisa tu internet.");
    }
}

// Iniciar Cámara
async function startCamera() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({ 
            video: { facingMode: "environment" } 
        });
        video.srcObject = stream;
        isDetecting = true;
        document.getElementById('scanLine').style.display = 'block';
        detectFrame();
    } catch (err) {
        alert("No se pudo acceder a la cámara.");
    }
}

// Bucle de Detección
async function detectFrame() {
    if (!isDetecting || video.paused || video.ended) return;

    // Pedimos a la IA que analice el video
    const predictions = await net.classify(video);
    
    if (predictions.length > 0) {
        let matchFound = null;

        function setupEventListeners() {
            document.getElementById('connectArduino').addEventListener('click', connectToArduino);
            document.getElementById('startBtn').addEventListener('click', startCamera);
            document.getElementById('stopBtn').addEventListener('click', stopCamera);
            document.getElementById('detectBtn').addEventListener('click', detectNow);
            document.getElementById('autoToggle').addEventListener('change', toggleAutoDetect);
           
            document.addEventListener('keydown', function(e) {
                if (e.code === 'Space' && !e.target.matches('input, textarea, button')) {
                    e.preventDefault();
                    detectNow();
                }
            });
        }

        function logSerial(message) {
            const serialLog = document.getElementById('serialLog');
            serialLog.innerHTML += message + '<br>';
            serialLog.scrollTop = serialLog.scrollHeight;
        }

        function updateArduinoStatus(message, status) {
            const statusElement = document.getElementById('arduinoStatus');
            statusElement.textContent = `🔌 ${message}`;
            statusElement.className = `arduino-status ${status}`;
        }

        async function startCamera() {
            try {
                updateStatus('🎥 Starting camera...', 'info');
               
                const constraints = {
                    video: {
                        width: { ideal: 1920 },
                        height: { ideal: 1080 },
                        facingMode: 'environment'
                    }
                };
               
                stream = await navigator.mediaDevices.getUserMedia(constraints);
                video.srcObject = stream;
               
                video.onloadedmetadata = () => {
                    video.play();
                   
                    detectionCanvas.width = video.videoWidth;
                    detectionCanvas.height = video.videoHeight;
                    detectionCanvas.style.width = '100%';
                    detectionCanvas.style.height = '100%';
                   
                    document.getElementById('startBtn').disabled = true;
                    document.getElementById('stopBtn').disabled = false;
                    document.getElementById('detectBtn').disabled = false;
                   
                    document.getElementById('wasteCategoryLarge').textContent = 'CAMERA READY';
                    updateStatus('✅ Camera started! Show items for detection.', 'success');
                   
                    logSerial('📹 Camera started - ready for detection');
                };
               
            } catch (error) {
                console.error('Camera error:', error);
                updateStatus('❌ Camera access denied. Please allow permissions.', 'error');
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
           
            if (autoDetectInterval) {
                clearInterval(autoDetectInterval);
                autoDetectInterval = null;
                document.getElementById('autoToggle').checked = false;
                document.getElementById('autoIndicator').style.display = 'none';
            }
           
            detectionCtx.clearRect(0, 0, detectionCanvas.width, detectionCanvas.height);
           
            document.getElementById('startBtn').disabled = false;
            document.getElementById('stopBtn').disabled = true;
            document.getElementById('detectBtn').disabled = true;
           
            document.getElementById('wasteCategoryLarge').textContent = 'READY';
            document.getElementById('wasteCategoryLarge').className = 'waste-category-large unknown';
            document.getElementById('confidenceValue').textContent = '--';
            document.getElementById('processingValue').textContent = '--';
           
            updateStatus('📱 Camera stopped', 'info');
            logSerial('📹 Camera stopped');
        }

        function detectNow() {
            if (stream && !isDetecting) {
                detectCurrentFrame();
            }
        }

        function toggleAutoDetect() {
            const isChecked = document.getElementById('autoToggle').checked;
           
            if (isChecked && stream) {
                startAutoDetection();
            } else {
                stopAutoDetection();
            }
        }

        function startAutoDetection() {
            if (autoDetectInterval) return;
           
            autoDetectInterval = setInterval(() => {
                if (stream && !isDetecting) {
                    detectCurrentFrame();
                }
            }, 3000);
           
            document.getElementById('autoIndicator').style.display = 'block';
            updateStatus('🔄 Auto-detection enabled - analyzing every 3 seconds', 'success');
            logSerial('🔄 Auto-detection enabled');
        }

        function stopAutoDetection() {
            if (autoDetectInterval) {
                clearInterval(autoDetectInterval);
                autoDetectInterval = null;
            }
           
            document.getElementById('autoIndicator').style.display = 'none';
            updateStatus('⏸️ Auto-detection disabled', 'info');
            logSerial('⏸️ Auto-detection disabled');
        }

        async function detectCurrentFrame() {
            if (!video || !stream || isDetecting || !mobileNetModel || !cocoSsdModel) return;
           
            isDetecting = true;
            const startTime = performance.now();
           
            try {
                document.getElementById('wasteCategoryLarge').textContent = 'ANALYZING...';
                document.getElementById('infoPanel').classList.add('detection-animation');
               
                const classifications = await mobileNetModel.classify(video);
                const detections = await cocoSsdModel.detect(video);

                const processingTime = (performance.now() - startTime) / 1000;
               
                const result = processAIResults(classifications, detections, processingTime);
               
                updateResults(result);
                updateStatistics(result);
               
                await sendWasteCommand(result.wasteCategory);
               
                updateStatus(`🎯 Detected: ${result.wasteCategory} → Arduino`, 'success');
               
            } catch (error) {
                console.error('Detection error:', error);
                updateStatus('❌ Detection failed', 'error');
                document.getElementById('wasteCategoryLarge').textContent = 'ERROR';
                document.getElementById('wasteCategoryLarge').className = 'waste-category-large unknown';
            } finally {
                isDetecting = false;
                document.getElementById('infoPanel').classList.remove('detection-animation');
            }
        }
       
        async function sendWasteCommand(wasteCategory) {
            const commands = {
                'WET': 'w',
                'PAPER': 'p',
                'PLASTIC': 'l',
                'GLASS': 'g',
                'ELECTRONIC': 'e',
                'CAN': 'c',
                'UNKNOWN': 'u'
            };
           
            const command = commands[wasteCategory] || 'u';
           
            if (isArduinoConnected) {
                await sendToArduino(command);
            } else {
                logSerial('⚠️ Arduino not connected. Command not sent.');
            }
        }

        function processAIResults(classifications, detections, processingTime) {
            let detectedObject = 'unknown';
            let confidence = 0;

            if (detections.length > 0) {
                const topDetection = detections.reduce((prev, current) =>
                    (prev.score > current.score) ? prev : current
                );
                detectedObject = topDetection.class.toLowerCase();
                confidence = topDetection.score;
            } else if (classifications.length > 0) {
                const topClassification = classifications[0];
                detectedObject = topClassification.className.split(',')[0].toLowerCase();
                confidence = topClassification.probability;
            }

            let wasteCategory = 'UNKNOWN';
            const mappedCategory = wasteClassification[detectedObject];
           
            if (mappedCategory) {
                wasteCategory = mappedCategory.toUpperCase();
            } else {
                for (const [key, value] of Object.entries(wasteClassification)) {
                    if (detectedObject.includes(key) || key.includes(detectedObject)) {
                        wasteCategory = value.toUpperCase();
                        break;
                    }
                }
            }
            if (matchFound) break;
        }

        if (matchFound && matchFound.probability > 0.5) {
            updateUI(matchFound);
        } else {
            // Si no está seguro o no conoce el objeto
            categoryDisplay.innerText = "Analizando...";
            categoryDisplay.className = "category-tag unknown";
            confidenceDisplay.innerText = "--";
        }
    }

    // Ejecutar cada 600ms para que sea fluido pero no lento
    setTimeout(detectFrame, 600);
}

// Actualizar Interfaz
function updateUI(match) {
    const labels = {
        organico: "🍎 ORGÁNICO",
        papel: "📄 PAPEL / CARTÓN",
        plastico: "🥤 PLÁSTICO",
        vidrio: "🍷 VIDRIO",
        metal: "🥫 METAL / LATAS",
        electronico: "💻 ELECTRÓNICO"
    };

    categoryDisplay.innerText = labels[match.category];
    categoryDisplay.className = `category-tag ${match.category}`;
    confidenceDisplay.innerText = Math.round(match.probability * 100) + "%";

    // Sistema de Puntos e Historial
    // Solo agregamos si estamos muy seguros (>75%) y es un objeto distinto al anterior
    if (match.probability > 0.75 && lastAddedItem !== match.name) {
        lastAddedItem = match.name;
        addToHistory(match.name, labels[match.category]);
        
        score += 10;
        countDisplay.innerText = score;

        // Efecto visual de "Pop" en los puntos
        countDisplay.style.transform = "scale(1.3)";
        setTimeout(() => countDisplay.style.transform = "scale(1)", 200);
    }
}

// Agregar al Registro (Historial)
function addToHistory(item, categoryName) {
    // Quitar el mensaje de "vacío" si existe
    const emptyState = document.querySelector('.empty-state');
    if (emptyState) emptyState.remove();

    const entry = document.createElement('div');
    entry.className = 'history-item';
    entry.innerHTML = `
        <span><strong>${item.toUpperCase()}</strong></span>
        <span style="font-size: 0.8rem; color: #666;">${categoryName}</span>
    `;
    
    // Insertar al principio de la lista
    historyList.prepend(entry);

    // Limitar historial a 10 elementos para no llenar la pantalla
    if (historyList.children.length > 10) {
        historyList.removeChild(historyList.lastChild);
    }
}

// Botones de Control
document.getElementById('startBtn').addEventListener('click', () => {
    startCamera();
    document.getElementById('startBtn').disabled = true;
    document.getElementById('stopBtn').disabled = false;
});

document.getElementById('stopBtn').addEventListener('click', () => {
    // Reiniciar la página es la forma más limpia de resetear la cámara y la IA
    location.reload();
});

// Arrancar la aplicación
setupApp();