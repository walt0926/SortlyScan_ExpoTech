// JS/app.js

// Esperar estrictamente a que todo el HTML esté cargado antes de operar los nodos
document.addEventListener("DOMContentLoaded", () => {

    // 1. Efecto blur/color en el header al hacer scroll
    window.addEventListener("scroll", () => {
        const header = document.querySelector(".header");
        if(window.scrollY > 40){
            header.style.background = "rgba(255, 255, 255, 0.95)";
            header.style.boxShadow = "0 10px 30px rgba(0,0,0,0.03)";
        } else {
            header.style.background = "rgba(255, 255, 255, 0.85)";
            header.style.boxShadow = "none";
        }
    });

    // 2. Controladores del Menú Desplegable Móvil
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    if(menuToggle && navMenu) {
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('open');
            navMenu.classList.toggle('open');
        });

        // Auto-cerrar menú móvil cuando hacen clic en una sección
        document.querySelectorAll('.menu a').forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.classList.remove('open');
                navMenu.classList.remove('open');
            });
        });
    }


    // 3. Sistema Blindado del Carrusel de Características
// JS/app.js - Sección del Carrusel Blindada

document.addEventListener("DOMContentLoaded", () => {
    
    // --- LÓGICA DEL CARRUSEL ---
    const track = document.getElementById('aboutTrack');
    const prevBtn = document.getElementById('aboutPrev');
    const nextBtn = document.getElementById('aboutNext');
    const dots = document.querySelectorAll('#aboutDots .indicator');
    const slides = document.querySelectorAll('#aboutTrack .feature-slide');
    
    if (track && slides.length > 0) {
        const totalSlides = slides.length;
        let currentIndex = 0;

        function moveCarousel() {
            // Calculamos el ancho exacto que tiene el contenedor en este preciso instante
            const slideWidth = slides[0].getBoundingClientRect().width;
            // Desplazamos de forma matemática pura
            track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
            
            // Actualizar puntitos
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentIndex);
            });
        }

        // Eventos Click
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % totalSlides;
            moveCarousel();
        });

        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            moveCarousel();
        });

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                moveCarousel();
            });
        });

        // Corregir desfases si el usuario cambia el tamaño de la pantalla del navegador
        window.addEventListener('resize', moveCarousel);

        // Soporte Táctil Móvil (Swipe)
        let startX = 0;
        let endX = 0;

        track.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        }, { passive: true });

        track.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            const difference = startX - endX;
            
            if (Math.abs(difference) > 50) { // Umbral de 50px de arrastre
                if (difference > 0) {
                    currentIndex = (currentIndex + 1) % totalSlides; // Izquierda a Derecha
                } else {
                    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; // Derecha a Izquierda
                }
                moveCarousel();
            }
        }, { passive: true });
        
        // Inicializar posición cero al cargar
        moveCarousel();
    }

    // --- LÓGICA DE HAMBURGUESA (Mantenida) ---
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    if(menuToggle && navMenu) {
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('open');
            navMenu.classList.toggle('open');
        });

        document.querySelectorAll('.menu a').forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.classList.remove('open');
                navMenu.classList.remove('open');
            });
        });
    }
});
});