<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SortlyScan</title>
<meta name="description"
      content="Plataforma educativa ambiental para enseñar reciclaje a niños mediante tecnología y gamificación.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@700;800&family=Nunito:wght@400;500;600;700;800&display=swap"
      rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="CSS/home.css">

</head>
<body>
<!-- Header -->

<header class="main-header">

    <div class="container header-container">

        <!-- Logo -->
        <a href="/" class="logo-container">
            <div class="logo-icon">
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="24"
                     height="24"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">

                    <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path>
                    <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path>
                </svg>
            </div>
            <span class="logo-text">
                SortlyScan
            </span>
        </a>

        <!-- Navegación -->
        <nav class="nav-menu">
            <a href="#inicio">Inicio</a>
            <a href="#sobre-nosotros">
                Sobre Nosotros
            </a>
            <a href="#beneficios">
                Beneficios
            </a>
            <a href="#unete">
                Registro
            </a>
        </nav>

        <!-- Botón -->
        <div class="header-button">
            <button onclick="window.location.href='ValidarInstitucion.php'">
                Iniciar Sesión
            </button>
        </div>
    </div>
</header>

<!-- Hero -->

<section id="inicio" class="hero-section">

    <div class="hero-overlay"></div>

    <div class="container hero-grid">

        <!-- Texto -->
        <div class="hero-content">

            <div class="hero-badge">
                <span>
                    🌱 Tecnología + Educación Ambiental
                </span>
            </div>

            <h1 class="hero-title">
                Enseñando a reciclar con
                <span>
                    tecnología y diversión
                </span>
            </h1>
            <p class="hero-description">

                Una plataforma educativa que convierte el reciclaje
                en una experiencia divertida, interactiva y moderna
                para niños de El Salvador.

            </p>
            <div class="hero-buttons">
                <button class="btn-primary">
                    Registrarse ahora
                </button>
                <button class="btn-secondary">
                    Conocer más
                </button>
            </div>

            <!-- Estadísticas -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>7-12</h3>
                    <p>
                        Años de edad
                    </p>
                </div>
                <div class="stat-card">
                    <h3>100%</h3>
                    <p>
                        Interactivo
                    </p>
                </div>
                <div class="stat-card">
                    <h3>IA</h3>
                    <p>
                        Tecnología educativa
                    </p>
                </div>
            </div>
        </div>

        <!-- Imagen -->
        <div class="hero-image-container">
            <div class="image-glow"></div>
            <img
                src="https://www.prensalibre.com/wp-content/uploads/2022/05/BV-17052022-TECNO-Y-RECICLAJE-02_67685413.jpg"
                alt="SortlyScan"
                class="hero-image">
        </div>
    </div>
</section>

<!-- Sobre Nosotros -->

<section id="sobre-nosotros" class="about-section">

    <div class="container">
        <!-- Encabezado -->
        <div class="section-header">
            <span class="section-badge">
                Educación Ambiental Inteligente
            </span>
            <h2 class="section-title">
                ¿Qué es SortlyScan?
            </h2>
            <p class="section-description">
                Según el Ministerio de Medio Ambiente y Recursos Naturales (MARN),
                El Salvador recicla menos del 5% de sus residuos.

                Cada día se generan más de 4000 toneladas de desechos y gran parte
                termina contaminando ríos, quebradas y calles.
            </p>
            <p class="section-description">
                SortlyScan combina tecnología, reciclaje y gamificación
                para enseñar hábitos sostenibles de manera divertida.
            </p>
        </div>

        <!-- Grid -->
        <div class="about-grid">

            <!-- Imagen -->
            <div class="about-image-container">
                <div class="image-glow"></div>
                <img
                    src="https://images.unsplash.com/photo-1491841550275-ad7854e35ca6?q=80&w=1200&auto=format&fit=crop"
                    alt="Niños reciclando"
                    class="about-image">
            </div>

            <!-- Información -->
            <div class="about-content">

                <!-- Misión -->
                <div class="info-card">
                    <div class="info-icon">
                        🎯
                    </div>
                    <div>
                        <h3>
                            Nuestra Misión
                        </h3>
                        <p>
                            Fomentar conciencia ambiental mediante herramientas
                            educativas digitales e interactivas.
                        </p>
                    </div>
                </div>

                <!-- Visión -->
                <div class="info-card">

                    <div class="info-icon blue">
                        👁️
                    </div>

                    <div>
                        <h3>
                            Nuestra Visión
                        </h3>
                        <p>
                            Convertirnos en el referente nacional en educación
                            ambiental digital para niños.
                        </p>
                    </div>
                </div>

                <!-- Valores -->
                <div class="values-card">
                    <h3>
                        Nuestros Valores
                    </h3>
                    <ul>
                        <li>
                            🌱 Sostenibilidad
                        </li>
                        <li>
                            📚 Enseñanza divertida
                        </li>
                        <li>
                            ♻️ Conciencia ambiental
                        </li>
                        <li>
                            🤝 Compromiso social
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Beneficios -->

<section id="beneficios" class="benefits-section">

    <div class="container">

        <div class="section-header">
            <span class="section-badge">
                Beneficios Educativos
            </span>
            <h2 class="section-title">
                Beneficios para Instituciones
            </h2>
        </div>

        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon orange">
                    🏆
                </div>
                <h3>
                    Competencias
                </h3>
                <p>
                    Motiva a los estudiantes mediante retos y rankings.
                </p>
            </div>

            <div class="benefit-card">
                <div class="benefit-icon yellow">
                    ⭐
                </div>
                <h3>
                    Recompensas
                </h3>
                <p>
                    Sistema de puntos y logros para incentivar el reciclaje.
                </p>
            </div>

            <!-- Métricas -->
            <div class="benefit-card">
                <div class="benefit-icon green">
                    📈
                </div>
                <h3>
                    Métricas
                </h3>
                <p>
                    Seguimiento del impacto ambiental generado.
                </p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon blue">
                    📍
                </div>
                <h3>
                    Centros de Acopio
                </h3>
                <p>
                    Mapa interactivo con puntos de reciclaje cercanos.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Registrar Nueva Institución-->

<section id="unete" class="cta-section">
    <div class="container cta-content">
        <h2>
            ¿Listo para transformar la educación ambiental?
        </h2>
        <p>
            Únete a SortlyScan y sé parte del cambio ecológico
            en las escuelas de El Salvador.
        </p>
        <button onclick="window.location.href='registroinstitucional.php'">
            Registrar nueva institución
        </button>
    </div>
</section>


<!-- FOOTER -->

<footer class="main-footer">

    <div class="container footer-grid">

        <!-- Logo -->
        <div>
            <h2>
                🌱 SortlyScan
            </h2>
            <p>
                Enseñando a las nuevas generaciones a cuidar
                el planeta mediante tecnología educativa.
            </p>
        </div>

        <!-- Navegación -->
        <div>
            <h3>
                Navegación
            </h3>
            <ul>
                <li>
                    <a href="#inicio">
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="#sobre-nosotros">
                        Sobre Nosotros
                    </a>
                </li>
                <li>
                    <a href="#beneficios">
                        Beneficios
                    </a>
                </li>
            </ul>
        </div>

        <!-- Contacto -->
        <div>
            <h3>
                Contacto
            </h3>
            <p>
                contacto@sortlyscan.com
            </p>
            <p>
                El Salvador
            </p>
        </div>
    </div>

</footer>
</body>
</html>