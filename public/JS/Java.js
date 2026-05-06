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

        // Revisamos las mejores predicciones de la IA
        for (let pred of predictions) {
            const label = pred.className.toLowerCase();
            
            // Buscamos si alguna palabra de la IA está en nuestro diccionario
            for (let [category, keywords] of Object.entries(RECYCLE_MAP)) {
                if (keywords.some(key => label.includes(key))) {
                    matchFound = {
                        category: category,
                        name: label.split(',')[0], // Nombre simplificado
                        probability: pred.probability
                    };
                    break;
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