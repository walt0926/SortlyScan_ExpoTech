<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan - Reciclaje con Inteligencia Artificial</title>
    <meta name="description" content="Plataforma educativa ambiental que transforma el reciclaje en un juego mediante IA, escaneo inteligente y recompensas.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="CSS/home.css">
</head>

<body>
    <header class="header">
        <div class="container nav">
            <a href="#" class="logo">
                <img src="img/logo2.png" alt="SortlyScan Logo" class="logo-img">
            </a>

            <nav class="menu" id="navMenu">
                <a href="#inicio">Inicio</a>
                <a href="#como-funciona">¿Cómo funciona?</a>
                <a href="#funciones">Características</a>
                <a href="#impacto">Impacto</a>
                <a href="#planes">Planes</a>
                <button class="btn-login mobile-only">Iniciar Sesión</button>
            </nav>

            <div class="nav-actions">
                <button class="btn-login desktop-only">Iniciar Sesión</button>
                <button class="menu-toggle" id="menuToggle" aria-label="Abrir menú">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </header>

    <main>
        <section class="hero" id="inicio">
            <div class="hero-overlay"></div>
            <div class="container hero-content">
                <div class="hero-text-center">
                    <div class="hero-badge">
                        <span class="pulse-dot"></span> 🤖 Impulsado por Inteligencia Artificial
                    </div>
                    <h1>El futuro de la <span>educación ambiental</span> está aquí</h1>
                    <p>SortlyScan convierte el reciclaje escolar en una competencia interactiva. Escanea residuos con tu cámara, aprende a clasificarlos con IA y gana puntos para tu institución.</p>
                    
                    <div class="hero-buttons">
                        <button class="btn-primary">Registrar mi Escuela</button>
                    </div>

                    <div class="hero-mini-stats">
                        <div class="m-stat"><strong>+50k</strong> <span>Residuos Escaneados</span></div>
                        <div class="m-stat"><strong>120+</strong> <span>Centros Educativos</span></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="how-it-works" id="como-funciona">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Método SortlyScan</span>
                    <h2>Reciclar nunca fue tan fácil</h2>
                    <p>Diseñamos un ecosistema digital amigable para estudiantes y profesores dividido en tres pilares mecánicos.</p>
                </div>

                <div class="steps-grid">
                    <div class="step-card">
                        <div class="step-num">01</div>
                        <h3>Apunta y Escanea</h3>
                        <p>Los alumnos usan la cámara de su dispositivo. Nuestra IA identifica instantáneamente plásticos, cartón, aluminio o vidrio.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-num">02</div>
                        <h3>Clasificación Correcta</h3>
                        <p>La app indica el contenedor exacto según las normativas vigentes y despliega una trivia rápida sobre economía circular.</p>
                    </div>
                    <div class="step-card">
                        <div class="step-num">03</div>
                        <h3>Suma y Recompensa</h3>
                        <p>Cada depósito exitoso otorga puntos individuales y colectivos, escalando puestos en el Leaderboard escolar regional.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="features" id="funciones">
            <div class="container main-carousel-container">
                <div class="section-header">
                    <span class="section-tag">Módulos de la Plataforma</span>
                    <h2>Herramientas que transforman hábitos</h2>
                </div>

                <div class="carousel-master-wrapper">
                    <button class="c-arrow prev" id="aboutPrev" aria-label="Anterior">‹</button>
                    <button class="c-arrow next" id="aboutNext" aria-label="Siguiente">›</button>

                    <div class="carousel-viewport">
                        <div class="carousel-track" id="aboutTrack">
                            
                            <div class="feature-slide">
                                <div class="f-slide-icon">🧠</div>
                                <h3>Reconocimiento Óptico con IA</h3>
                                <p>Entrenada específicamente para reconocer empaques y materiales complejos comerciales, reduciendo el margen de error humano en la separación de basura escolar.</p>
                            </div>

                            <div class="feature-slide">
                                <div class="f-slide-icon blue-icon">🏆</div>
                                <h3>Gamificación de Alto Impacto</h3>
                                <p>Tablas de clasificación en tiempo real entre salones y colegios aliados. Logros desbloqueables, medallas digitales y recompensas canjeables en ferias ambientales.</p>
                            </div>

                            <div class="feature-slide">
                                <div class="f-slide-icon yellow-icon">📍</div>
                                <h3>Centros de Acopio Geolocalizados</h3>
                                <p>Mapeo inteligente y rutas hacia los puntos autorizados de reciclaje más cercanos de El Salvador, garantizando que el material recolectado llegue a plantas de procesamiento reales.</p>
                            </div>

                        </div>
                    </div>

                    <div class="carousel-indicators" id="aboutDots">
                        <span class="indicator active"></span>
                        <span class="indicator"></span>
                        <span class="indicator"></span>
                    </div>
                </div>
            </div>
        </section>

        <section class="impact-dashboard" id="impacto">
            <div class="container">
                <div class="grid-dashboard">
                    <div class="dash-text">
                        <span class="section-tag text-left">Estadísticas Globales</span>
                        <h2>Midiendo el cambio ecológico real</h2>
                        <p>Nuestra base de datos centralizada recopila métricas que los docentes pueden descargar para proyectos analíticos o reportes institucionales de sostenibilidad.</p>
                        <div class="live-indicator">
                            <span class="live-dot"></span> Datos actualizados en tiempo real
                        </div>
                    </div>
                    <div class="dash-board-view">
                        <div class="db-card">
                            <span class="db-title">CO₂ Evitado</span>
                            <h3>14,820 kg</h3>
                            <div class="db-bar"><div class="db-progress" style="width: 78%"></div></div>
                        </div>
                        <div class="db-card">
                            <span class="db-title">Material Recogido</span>
                            <h3>8.4 Toneladas</h3>
                            <span class="db-sub text-green">▲ 12% este mes</span>
                        </div>
                        <div class="db-card">
                            <span class="db-title">Trivias Completadas</span>
                            <h3>+25,000</h3>
                            <span class="db-sub">92% respuestas correctas</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pricing" id="planes">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Suscripciones</span>
                    <h2>Planes adaptados a tu institución</h2>
                    <p>Elige el nivel de impacto ambiental y herramientas tecnológicas que deseas desplegar en tu comunidad educativa.</p>
                </div>

                <div class="pricing-grid">
                    <div class="price-card">
                        <div class="price-header">
                            <h3>Plan Piloto</h3>
                            <p>Para probar la experiencia inicial</p>
                            <div class="price-amount">Gratis</div>
                        </div>
                        <ul class="price-features">
                            <li>✨ Escáner IA estándar (Hasta 500 escaneos/mes)</li>
                            <li>✨ 1 Tabla de clasificación general escolar</li>
                            <li>✨ Soporte por correo comunitario</li>
                            <li class="disabled">❌ Panel analítico avanzado para profesores</li>
                            <li class="disabled">❌ Recompensas patrocinadas personalizadas</li>
                        </ul>
                        <button class="btn-price-card">Empezar Gratis</button>
                    </div>

                    <div class="price-card popular">
                        <div class="popular-badge">Más Elegido</div>
                        <div class="price-header">
                            <h3>Escuela Pro</h3>
                            <p>El estándar de gamificación total escolar</p>
                            <div class="price-amount">$29<span>/mes</span></div>
                        </div>
                        <ul class="price-features">
                            <li>✨ Escáner IA ilimitado en todo el campus</li>
                            <li>✨ Subtablas por secciones, grados y aulas</li>
                            <li>✨ Dashboard analítico con reportes exportables</li>
                            <li>✨ Acceso premium a trivias pedagógicas semanales</li>
                            <li>✨ Gestión interna de recompensas físicas</li>
                        </ul>
                        <button class="btn-price-card active">Adquirir Pro</button>
                    </div>

                    <div class="price-card">
                        <div class="price-header">
                            <h3>Distrital / Multi-Sede</h3>
                            <p>Para corporaciones de colegios o alcaldías</p>
                            <div class="price-amount">Custom</div>
                        </div>
                        <ul class="price-features">
                            <li>✨ Escaneo cross-platform centralizado masivo</li>
                            <li>✨ Competencias inter-colegiales a nivel nacional</li>
                            <li>✨ Integración API con sistemas de recolección municipales</li>
                            <li>✨ Gestor de cuentas dedicado y capacitación docente</li>
                            <li>✨ Material promocional e infografías físicas impresas</li>
                        </ul>
                        <button class="btn-price-card">Contactar Asesor</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-modern">
            <div class="container">
                <div class="cta-inner-box">
                    <h2>¿Listo para digitalizar la conciencia ambiental en tu aula?</h2>
                    <p>Únete de forma gratuita como plan piloto institucional y obtén acceso completo al panel de administración para profesores.</p>
                    <div class="cta-action-btns">
                        <button class="btn-primary-dark">Registrar Institución</button>
                        <button class="btn-secondary-white">Hablar con un Asesor</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="container footer-grid">
            <div class="footer-brand">
                <h3>♻️ SortlyScan</h3>
                <p>Uniendo tecnología disruptiva y pedagogía para salvaguardar los recursos del mañana.</p>
            </div>
            <div class="footer-links">
                <h4>Explorar</h4>
                <a href="#inicio">Inicio</a>
                <a href="#como-funciona">Metodología</a>
                <a href="#funciones">Características</a>
                <a href="#planes">Planes de Precios</a>
            </div>
            <div class="footer-contact">
                <h4>Contacto Legal</h4>
                <p>📧 contacto@sortlyscan.com</p>
                <p>📍 San Salvador, El Salvador</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 SortlyScan. Todos los derechos reservados. Desarrollado para Educación Sostenible.</p>
        </div>
    </footer>

    <script src="JS/app.js"></script>
</body>
</html>