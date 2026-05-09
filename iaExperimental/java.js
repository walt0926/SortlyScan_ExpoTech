// Java.js - Versión Final (Software Only)
// Este código conecta la cámara y la IA directamente con el backend PHP.

let video = null;
let stream = null;
let mobileNetModel = null;
let cocoSsdModel = null;
let isDetecting = false;
let currentDetectionResult = null;

// Categorías traducidas para coincidir con tu Base de Datos
const wasteClassification = {
    'banana': 'Organico', 'apple': 'Organico', 'orange': 'Organico', 'food': 'Organico',
    'book': 'Papel', 'paper': 'Papel', 'notebook': 'Papel', 'newspaper': 'Papel',
    'bottle': 'Plastico', 'plastic': 'Plastico', 'plastic bag': 'Plastico',
    'wine glass': 'Vidrio', 'cup': 'Vidrio', 'glass': 'Vidrio',
    'can': 'Metal', 'aluminum': 'Metal', 'metal': 'Metal'
};

const puntosPorCategoria = {
    'Organico': 5, 'Papel': 10, 'Plastico': 15, 'Vidrio': 20, 'Metal': 25, 'Desconocido': 0
};

document.addEventListener('DOMContentLoaded', async function() {
    await loadAIModels();
    video = document.getElementById('video');
    
    document.getElementById('startBtn')?.addEventListener('click', startCamera);
    document.getElementById('detectBtn')?.addEventListener('click', detectCurrentFrame);
    document.getElementById('confirmBtn')?.addEventListener('click', confirmDetection);
    document.getElementById('cancelBtn')?.addEventListener('click', () => {
        document.getElementById('confirmationPanel').style.display = 'none';
        updateStatus('Escaneo cancelado.', 'info');
    });
});

async function loadAIModels() {
    try {
        updateStatus('Cargando modelos de IA...', 'info');
        mobileNetModel = await mobilenet.load();
        cocoSsdModel = await cocoSsd.load();
        updateStatus('IA lista. Inicia la cámara.', 'success');
    } catch (e) {
        updateStatus('Error al cargar IA.', 'error');
    }
}

async function startCamera() {
    try {
        stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
        video.srcObject = stream;
        video.play();
        updateStatus('Cámara activa. Coloca el residuo.', 'success');
    } catch (e) {
        updateStatus('Error de acceso a cámara.', 'error');
    }
}

async function detectCurrentFrame() {
    if (!video || isDetecting) return;
    isDetecting = true;
    updateStatus('Analizando...', 'info');

    try {
        const classifications = await mobileNetModel.classify(video);
        const detections = await cocoSsdModel.detect(video);
        
        // Procesar resultados
        let obj = detections.length > 0 ? detections[0].class.toLowerCase() : 
                  (classifications.length > 0 ? classifications[0].className.split(',')[0].toLowerCase() : 'unknown');

        let categoria = wasteClassification[obj] || 'Desconocido';
        currentDetectionResult = { categoria, puntos: puntosPorCategoria[categoria] };

        // Mostrar panel de confirmación (Paso obligatorio por tus directrices)
        document.getElementById('detectedItemLabel').textContent = `¿Es ${categoria}? (+${currentDetectionResult.puntos} pts)`;
        document.getElementById('confirmationPanel').style.display = 'block';

    } catch (e) {
        updateStatus('Error en detección.', 'error');
    } finally {
        isDetecting = false;
    }
}

async function confirmDetection() {
    if (!currentDetectionResult) return;

    // Obtener ID del alumno desde el localStorage (guardado al hacer login)
    const id_alumno = localStorage.getItem('id_alumno');

    const formData = new FormData();
    formData.append('id_alumno', id_alumno);
    formData.append('tipo_residuo', currentDetectionResult.categoria);
    formData.append('puntos', currentDetectionResult.puntos);

    try {
        const res = await fetch('puntos/registrar_puntos.php', { method: 'POST', body: formData });
        const data = await res.json();

        if (data.success) {
            updateStatus(`¡Éxito! +${currentDetectionResult.puntos} puntos.`, 'success');
        } else {
            updateStatus('Error al guardar puntos.', 'error');
        }
    } catch (e) {
        updateStatus('Error de conexión con el servidor.', 'error');
    }

    document.getElementById('confirmationPanel').style.display = 'none';
}

function updateStatus(msg, type) {
    const el = document.getElementById('statusIndicator');
    if (el) { el.textContent = msg; el.className = `status-indicator ${type}`; }
}