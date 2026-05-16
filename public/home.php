<!DOCTYPE html>
<html lang="es" style="--canvas-color: rgba(30, 30, 30, 1);"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan</title>
    <meta name="description" content="Sitio web del proyecto SortlyScan.">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/home.css">
</head>
<body class="fullscreen_view">

    <header class="navbar navbar-expand-md bg-white shadow-sm sticky-top z-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="img/logo2.png" alt="SortlyScan" style="height: 70px; width: auto; object-fit: contain;" class="transition-transform logo-icon py-1">
            </a>

            <button class="navbar-toggler border-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSortly" aria-controls="navbarSortly" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu">
                    <line x1="4" x2="20" y1="12" y2="12"></line>
                    <line x1="4" x2="20" y1="6" y2="6"></line>
                    <line x1="4" x2="20" y1="18" y2="18"></line>
                </svg>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarSortly">
                <nav class="navbar-nav mx-auto gap-3 text-center py-3 py-md-0">
                    <a href="#inicio" class="nav-link text-green-600 font-medium active">Inicio</a>
                    <a href="#sobre-nosotros" class="nav-link text-gray-700 hover-green">Sobre Nosotros</a>
                    <a href="#beneficios" class="nav-link text-gray-700 hover-green">Beneficios</a>
                    <a href="#unite" class="nav-link text-gray-700 hover-green">Registro</a>
                </nav>
                <div class="d-flex justify-content-center pb-3 pb-md-0">
                    <button onclick="window.location.href='ValidarInstitucion.php'" class="btn btn-custom-primary px-4 py-2 shadow-sm font-medium">
                        Iniciar Sesión / Registrarse
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section id="inicio" class="hero-section position-relative overflow-hidden bg-gradient-hero text-white py-5 d-flex align-items-center">
            <div class="hero-grid-pattern position-absolute inset-0 opacity-20"></div>
            <div class="container position-relative z-1 py-4 py-md-5">
                <div class="row g-5 align-items-center">
                    <div class="col-12 col-lg-6">
                        <div class="d-inline-flex align-items-center gap-2 bg-white-20 backdrop-blur px-4 py-2 rounded-pill mb-4 animated-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles">
                                <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                            </svg>
                            <span class="small font-medium">Tecnología + Educación Ambiental</span>
                        </div>
                        <h1 class="display-4 fw-bold mb-4 class-title">
                            Enseñando a reciclar con <span class="text-yellow-300 d-block d-sm-inline">tecnología y diversión</span>
                        </h1>
                        <p class="fs-5 mb-4 text-green-50 max-w-xl">
                            Una solución que convierte preguntas y acciones pequeñas en una experiencia que cambia el futuro.
                        </p>
                        <div class="mb-5">
                            <button class="btn btn-outline-light px-4 py-2 btn-hero fw-medium">Registrarse ahora</button>
                        </div>
                        <div class="row g-4 text-center text-sm-start">
                            <div class="col-4">
                                <div class="fs-2 fw-bold text-white">7-12</div>
                                <div class="text-green-100 small">Años de edad</div>
                            </div>
                            <div class="col-4">
                                <div class="fs-2 fw-bold text-white">100%</div>
                                <div class="text-green-100 small">Interactivo</div>
                            </div>
                            <div class="col-4">
                                <div class="fs-2 fw-bold text-white">IA</div>
                                <div class="text-green-100 small">Que ayuda.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 position-relative text-center">
                        <div class="hero-blur-bg position-absolute inset-0 bg-gradient-orange rounded-5 blur-3xl opacity-20"></div>
                        <img src="https://www.prensalibre.com/wp-content/uploads/2022/05/BV-17052022-TECNO-Y-RECICLAJE-02_67685413.jpg" alt="Robot SortlyScan" class="img-fluid rounded-5 shadow-lg position-relative main-hero-img">
                    </div>
                </div>
            </div>
        </section>

        <section id="sobre-nosotros" class="py-5 bg-white">
            <div class="container py-4">
                <div class="text-center mb-5 max-w-3xl mx-auto">
                    <h2 class="display-5 fw-bold mb-4 text-gradient-green">¿Qué es SortlyScan?</h2>
                    <p class="fs-5 text-gray-700 lh-lg">
                        Según el Ministerio de Medio Ambiente y Recursos Naturales (MARN), El Salvador recicla menos del 5% de sus residuos. Cada día se generan más de 4000 toneladas de desechos y la mayoría de estas terminan siendo contaminantes de ríos, quebradas y calles.
                    </p>
                    <p class="fs-5 text-gray-700 lh-lg mt-3">
                        La causa principal es la falta de educación ambiental. <strong>SortlyScan</strong> es un innovador proyecto educativo que combina tecnología y conciencia ambiental para enseñar a los niños de 7 a 12 años el hábito del reciclaje de forma divertida e interactiva.
                    </p>
                    <p class="fs-5 text-gray-700 lh-lg mt-3">
                        Ayudamos a centros escolares públicos de El Salvador a formar hábitos sostenibles reales en sus estudiantes, mediante una plataforma con escaneo inteligente y gamificación.
                    </p>
                </div>
            </div>
        </section>

        <section class="py-5 bg-gradient-cards">
            <div class="container py-4">
                <div class="row g-5 align-items-center">
                    <div class="col-12 col-lg-5 order-lg-2">
                        <img src="https://images.unsplash.com/photo-1732187821884-56dc80ec9367?crop=entropy&ixlib=rb-4.1.0&q=80&w=1080" alt="Planeta verde" class="img-fluid rounded-5 shadow-lg info-section-img">
                    </div>
                    <div class="col-12 col-lg-7 order-lg-1">
                        <div class="d-flex flex-column flex-sm-row align-items-start gap-3 mb-4 card-info-box">
                            <div class="bg-green-600 p-3 rounded-3 text-white shrink-0 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                            </div>
                            <div>
                                <h3 class="h4 fw-bold text-green-900 mb-2">Nuestra Misión</h3>
                                <p class="text-gray-700 lh-relaxed">Fomentar en los niños de primero a sexto grado la conciencia y práctica del reciclaje mediante una plataforma educativa digital, que inspire hábitos sostenibles desde temprana edad y contribuya a la construcción de un futuro más limpio y responsable.</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-sm-row align-items-start gap-3 mb-4 card-info-box">
                            <div class="bg-emerald-600 p-3 rounded-3 text-white shrink-0 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </div>
                            <div>
                                <h3 class="h4 fw-bold text-emerald-900 mb-2">Nuestra Visión</h3>
                                <p class="text-gray-700 lh-relaxed">Convertirnos en el referente nacional en educación ambiental digital para la niñez, logrando que el reciclaje sea parte natural de la vida cotidiana y formando generaciones comprometidas con la protección del planeta.</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-sm-row align-items-start gap-3 card-info-box">
                            <div class="bg-emerald-600 p-3 rounded-3 text-white shrink-0 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award"><circle cx="12" cy="8" r="6"></circle><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path></svg>
                            </div>
                            <div>
                                <h3 class="h4 fw-bold text-emerald-900 mb-2">Nuestros Valores</h3>
                                <ul class="list-unstyled text-gray-700 lh-relaxed d-flex flex-column gap-2 values-list">
                                    <li><strong>Sostenibilidad:</strong> Promover acciones que aseguren el cuidado del medio ambiente para las futuras generaciones.</li>
                                    <li><strong>Enseñanza:</strong> Transmitir conocimientos de manera clara, divertida y accesible para los niños.</li>
                                    <li><strong>Resiliencia ambiental:</strong> Impulsar la capacidad de adaptarse y responder positivamente a los retos ecológicos.</li>
                                    <li><strong>Compromiso:</strong> Mantener una dedicación constante hacia la educación y la transformación social a través del reciclaje.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="beneficios" class="py-5 bg-gradient-benefits">
            <div class="container py-4">
                <div class="text-center mb-5 max-w-xl mx-auto">
                    <h2 class="display-5 fw-bold mb-3 text-gradient-orange">Beneficios para Instituciones Educativas</h2>
                    <p class="fs-5 text-gray-600">SortlyScan transforma el reciclaje en una experiencia competitiva y motivadora</p>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
                    <div class="col">
                        <div class="card h-100 border-orange-custom card-hover p-4 bg-white rounded-xl shadow-sm">
                            <div class="bg-gradient-orange-card w-14 h-14 rounded-4 d-flex align-items-center justify-center mb-4 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trophy"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>
                            </div>
                            <h3 class="h5 fw-bold mb-2 text-orange-900">Competencias entre Grados</h3>
                            <p class="text-gray-600 small mb-0">Fomenta la sana competencia entre diferentes niveles escolares</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 border-yellow-custom card-hover p-4 bg-white rounded-xl shadow-sm">
                            <div class="bg-gradient-yellow-card w-14 h-14 rounded-4 d-flex align-items-center justify-center mb-4 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award"><circle cx="12" cy="8" r="6"></circle><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path></svg>
                            </div>
                            <h3 class="h5 fw-bold mb-2 text-yellow-900">Sistema de Rankings</h3>
                            <p class="text-gray-600 small mb-0">Tablas de posiciones que motivan la participación activa</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 border-green-custom card-hover p-4 bg-white rounded-xl shadow-sm">
                            <div class="bg-gradient-to-br w-14 h-14 rounded-4 d-flex align-items-center justify-center mb-4 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline></svg>
                            </div>
                            <h3 class="h5 fw-bold mb-2 text-green-900">Métricas de Progreso</h3>
                            <p class="text-gray-600 small mb-0">Reportes detallados del impacto ambiental generado</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100 border-blue-custom card-hover p-4 bg-white rounded-xl shadow-sm">
                            <div class="bg-gradient-blue-card w-14 h-14 rounded-4 d-flex align-items-center justify-center mb-4 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            </div>
                            <h3 class="h5 fw-bold mb-2 text-blue-900">Centros de Acopio</h3>
                            <p class="text-gray-600 small mb-0">Mapa interactivo con puntos de reciclaje cercanos</p>
                        </div>
                    </div>
                </div>

                <div class="mt-5 bg-white rounded-5 shadow p-4 p-md-5 box-motivation">
                    <div class="row g-4 align-items-center">
                        <div class="col-12 col-md-5">
                            <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?crop=entropy&ixlib=rb-4.1.0&q=80&w=1080" alt="Niños aprendiendo" class="img-fluid rounded-4 object-cover h-100 min-h-250">
                        </div>
                        <div class="col-12 col-md-7">
                            <h3 class="h2 fw-bold mb-3 text-gray-900">Motivación Constante</h3>
                            <p class="fs-6 text-gray-600 mb-4">
                                El sistema de puntos y rankings mantiene a los estudiantes entusiasmados y comprometidos. Cada escaneo suma puntos, cada logro se celebra, y cada salón puede ver su progreso en tiempo real.
                            </p>
                            <ul class="list-unstyled d-flex flex-column gap-2 check-list">
                                <li class="d-flex align-items-center gap-2">
                                    <div class="check-bullet"><svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                                    <span class="text-gray-700 font-medium">Fomenta el trabajo en equipo</span>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <div class="check-bullet"><svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                                    <span class="text-gray-700 font-medium">Desarrolla hábitos sostenibles</span>
                                </li>
                                <li class="d-flex align-items-center gap-2">
                                    <div class="check-bullet"><svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></div>
                                    <span class="text-gray-700 font-medium">Crea conciencia ambiental duradera</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="unite" class="py-5 bg-gradient-cta text-white text-center">
            <div class="container py-4 max-w-2xl">
                <h2 class="display-5 fw-bold mb-4">¿Listo para transformar la educación ambiental?</h2>
                <p class="fs-5 mb-4 text-green-50">
                    Únete a SortlyScan y sé parte del cambio. Registra tu institución hoy y comienza a enseñar reciclaje de forma innovadora.
                </p>
                <div>
                    <button onclick="window.location.href='registroinstitucional.php'" class="btn btn-light text-green-600 px-5 py-3 rounded-3 shadow-lg fw-bold hover-scale">
                        Crear cuenta ahora
                    </button>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gradient-footer text-white py-5">
        <div class="container">
            <div class="row g-4 justify-content-between">
                <div class="col-12 col-md-5">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="bg-white-10 p-2 rounded-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path></svg>
                        </div>
                        <span class="fs-3 fw-bold">SortlyScan</span>
                    </div>
                    <p class="text-green-100 max-w-md">
                        Enseñando a las nuevas generaciones a cuidar el planeta mediante tecnología innovadora y educación divertida.
                    </p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="social-btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                        <a href="#" class="social-btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg></a>
                        <a href="#" class="social-btn"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line></svg></a>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <h4 class="h6 fw-bold mb-3 tracking-wider text-uppercase">Enlaces Rápidos</h4>
                    <ul class="list-unstyled d-flex flex-column gap-2 footer-links">
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#sobre-nosotros">Sobre Nosotros</a></li>
                        <li><a href="#beneficios">Beneficios</a></li>
                        <li><a href="#unite">Únete</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3">
                    <h4 class="h6 fw-bold mb-3 tracking-wider text-uppercase">Contacto</h4>
                    <ul class="list-unstyled d-flex flex-column gap-3 contact-info">
                        <li class="d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-300"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                            <span class="text-green-100 small">contacto@sortlyscan.com</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-300"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            <span class="text-green-100 small">#########</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-300"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <span class="text-green-100 small">El Salvador</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-top border-white-10 mt-4 pt-4 text-center text-green-100 small">
                <p class="mb-0">© 2026 SortlyScan. Todos los derechos reservados. Un proyecto para un futuro más verde.</p>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="JS/home.js"></script>
</body>
</html>