<!DOCTYPE html>
<html lang="es" style="--canvas-color: rgba(30, 30, 30, 1);"> 
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <title>SortlyScan</title>
    <meta name="description" content="Sitio web del proyecto SortlyScan.">
    <link rel="stylesheet" href="home.css">
</head>
<body class="fullscreen_view">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a class="flex items-center gap-2 group" href="/" data-discover="true">
                    <div class="bg-gradient-to-br from-green-500 to-emerald-600 p-2 rounded-xl group-hover:scale-105 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf h-6 w-6 text-white">
                            <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path>
                            <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent">SortlyScan</span>
                </a>
                <nav class="hidden md:flex items-center gap-6">
                    <a href="#inicio" class="transition-colors text-green-600 font-medium">Inicio</a>
                    <a href="#sobre nosotros" class="transition-colors text-gray-700 hover:text-green-600">Sobre Nosotros</a>
                    <a href="#beneficios" class="transition-colors text-gray-700 hover:text-green-600">Beneficios</a>
                    <a href="#unite" class="transition-colors text-gray-700 hover:text-green-600">Únete</a>
                </nav>
                <div class="hidden md:flex items-center gap-3">
                    <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2 has-[>svg]:px-3 bg-gradient-to-r from-green-600 to-emerald-500 hover:from-green-700 hover:to-emerald-600">Iniciar Sesión / Registrarse</button>
                </div>
                <button class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu h-6 w-6">
                        <line x1="4" x2="20" y1="12" y2="12"></line>
                        <line x1="4" x2="20" y1="6" y2="6"></line>
                        <line x1="4" x2="20" y1="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </header>
    <main class="flex-1">
        <div class="min-h-screen bg-gradient-to-b from-green-50 to-white">
            <section id="inicio" class="relative overflow-hidden bg-gradient-to-br from-green-500 via-emerald-500 to-teal-400">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PHBhdHRlcm4gaWQ9ImdyaWQiIHdpZHRoPSI2MCIgaGVpZ2h0PSI2MCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+PHBhdGggZD0iTSAxMCAwIEwgMCAwIDAgMTAiIGZpbGw9Im5vbmUiIHN0cm9rZT0icmdiYSgyNTUsMjU1LDI1NSwwLjEpIiBzdHJva2Utd2lkdGg9IjEiLz48L3BhdHRlcm4+PC9kZWZzPjxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JpZCkiLz48L3N2Zz4=')] opacity-20"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div class="text-white">
                            <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles h-4 w-4">
                                    <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                                    <path d="M20 3v4"></path>
                                    <path d="M22 5h-4"></path>
                                    <path d="M4 17v2"></path>
                                    <path d="M5 18H3"></path>
                                </svg>
                                <span class="text-sm font-medium">Tecnología + Educación Ambiental</span>
                            </div>
                            <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                                Enseñando a reciclar con
                                <span class="block text-yellow-300">tecnología y diversión</span>
                            </h1>
                            <p class="text-xl mb-8 text-green-50">
                              Una solución que convierte preguntas y acciones pequeñas en una experiencia que cambia el futuro.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive hover:text-accent-foreground dark:bg-input/30 dark:border-input dark:hover:bg-input/50 h-10 rounded-md px-6 has-[>svg]:px-4 bg-transparent border-2 border-white text-white hover:bg-white/10">Registrarse ahora</button>
                            </div>
                            <div class="grid grid-cols-3 gap-6 mt-12">
                                <div class="text-center">
                                    <div class="text-3xl font-bold mb-1">7-12</div>
                                    <div class="text-green-100 text-sm">Años de edad</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-3xl font-bold mb-1">100%</div>
                                    <div class="text-green-100 text-sm">Interactivo</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-3xl font-bold mb-1">IA</div>
                                    <div class="text-green-100 text-sm">Que ayuda.</div>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-3xl blur-3xl opacity-20"></div>
                            <img src="https://www.prensalibre.com/wp-content/uploads/2022/05/BV-17052022-TECNO-Y-RECICLAJE-02_67685413.jpg" alt="Robot SortlyScan" class="relative rounded-3xl shadow-2xl w-full h-[500px] object-cover">
                        </div>
                    </div>
                </div>
            </section>
            <section id="sobre nosotros" class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent">¿Qué es SortlyScan?</h2>
                        <div class="max-w-4xl mx-auto">
                            <p class="text-xl text-gray-700 leading-relaxed">
                                Según el Ministerio de Medio Ambiente y Recursos Naturales (MARN), El Salvador recicla menos del 5% de sus residuos. Cada día se generan más de 4000 toneladas de desechos y la mayoría de estas terminan siendo contaminantes de ríos, quebrasas y calles.
                                La causa principal es la falta de educación ambiental.  <br> SortlyScan es un innovador proyecto educativo que combina tecnología y conciencia ambiental para enseñar a los niños de 7 a 12 años el hábito del reciclaje de forma divertida e interactiva. <br>
                                Ayudamos a centros escolares públicos de El Salvador a formar hábitos sostenibles reales en sus estudiantes, mediante una plataforma con escaneo inteligente y gamificación.
                           </p>
                        </div>
                    </div>                      
            <section class="py-20 bg-gradient-to-br from-green-50 to-emerald-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <img src="https://images.unsplash.com/photo-1732187821884-56dc80ec9367?crop=entro…aWxpdHklMjBwbGFuZXR8ZW58MXx8fHwxNzc2MjczMDA1fDA&ixlib=rb-4.1.0&q=80&w=1080" alt="Planeta verde" class="rounded-3xl shadow-2xl w-full h-[400px] object-cover">
                        </div>
                        <div>
                          <div class="mb-10">
                            <div class="flex items-center gap-3 mb-4">
                              <div class="bg-green-600 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target h-6 w-6 text-white">
                                  <circle cx="12" cy="12" r="10"></circle>
                                  <circle cx="12" cy="12" r="6"></circle>
                                  <circle cx="12" cy="12" r="2"></circle>
                                </svg>
                              </div>
                              <h2 class="text-3xl font-bold text-green-900">Nuestra Misión</h2>
                            </div>
                            <p class="text-lg text-gray-700 leading-relaxed">
                              Fomentar en los niños de primero a sexto grado la conciencia y práctica del reciclaje mediante una plataforma educativa digital, que inspire hábitos sostenibles desde temprana edad y contribuya a la construcción de un futuro más limpio y responsable. 
                            </p>
                          </div>
                          <div>
                            <div class="flex items-center gap-3 mb-4">
                              <div class="bg-emerald-600 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye h-6 w-6 text-white">
                                  <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
                                  <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                              </div>
                              <h2 class="text-3xl font-bold text-emerald-900">Nuestra Visión</h2>
                            </div>
                            <p class="text-lg text-gray-700 leading-relaxed">
                              Convertirnos en el referente nacional en educación ambiental digital para la niñez, logrando que el reciclaje sea parte natural de la vida cotidiana y formando generaciones comprometidas con la protección del planeta. 
                            </p>
                          </div>
                          <div>
                            <div class="flex items-center gap-3 mb-4">
                              <div class="bg-emerald-600 p-2 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye h-6 w-6 text-white">
                                  <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path>
                                  <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                              </div>
                              <h2 class="text-3xl font-bold text-emerald-900">Nuestros Valores</h2>
                            </div>
                            <ol class="text-lg text-gray-700 leading-relaxed">
                              <li>Sostenibilidad: promover acciones que aseguren el cuidado del medio ambiente para las futuras generaciones. </li>
                              <li>Enseñanza: transmitir conocimientos de manera clara, divertida y accesible para los niños.</li>
                              <li>Resiliencia ambiental: impulsar la capacidad de adaptarse y responder positivamente a los retos ecológicos. </li>
                              <li>Compromiso: mantener una dedicación constante hacia la educación y la transformación social a través del reciclaje.</li>
                              </ol>
                          </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="beneficios" class="py-20 bg-gradient-to-br from-orange-50 to-yellow-50">
              <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                  <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-orange-600 to-yellow-500 bg-clip-text text-transparent">Beneficios para Instituciones Educativas</h2>
                  <p class="text-xl text-gray-600 max-w-3xl mx-auto">SortlyScan transforma el reciclaje en una experiencia competitiva y motivadora</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                  <div data-slot="card" class="text-card-foreground flex flex-col gap-6 rounded-xl bg-white border-2 border-orange-100 hover:border-orange-300 transition-all hover:shadow-xl">
                    <div data-slot="card-content" class="[&:last-child]:pb-6 p-6">
                      <div class="bg-gradient-to-br from-orange-500 to-red-500 w-14 h-14 rounded-2xl flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trophy h-7 w-7 text-white">
                          <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                          <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                          <path d="M4 22h16"></path>
                          <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                          <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                          <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                        </svg>
                      </div>
                      <h3 class="text-lg font-bold mb-2 text-orange-900">Competencias entre Grados</h3>
                      <p class="text-gray-600">Fomenta la sana competencia entre diferentes niveles escolares</p>
                    </div>
                  </div>
                  <div data-slot="card" class="text-card-foreground flex flex-col gap-6 rounded-xl bg-white border-2 border-yellow-100 hover:border-yellow-300 transition-all hover:shadow-xl">
                    <div data-slot="card-content" class="[&:last-child]:pb-6 p-6">
                      <div class="bg-gradient-to-br from-yellow-500 to-amber-500 w-14 h-14 rounded-2xl flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award h-7 w-7 text-white">
                          <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path>
                          <circle cx="12" cy="8" r="6"></circle>
                        </svg>
                      </div>
                      <h3 class="text-lg font-bold mb-2 text-yellow-900">Sistema de Rankings</h3>
                      <p class="text-gray-600">Tablas de posiciones que motivan la participación activa</p>
                    </div>
                  </div>
                  <div data-slot="card" class="text-card-foreground flex flex-col gap-6 rounded-xl bg-white border-2 border-green-100 hover:border-green-300 transition-all hover:shadow-xl">
                    <div data-slot="card-content" class="[&:last-child]:pb-6 p-6">
                      <div class="bg-gradient-to-br from-green-500 to-emerald-500 w-14 h-14 rounded-2xl flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trending-up h-7 w-7 text-white">
                          <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                        </svg>
                      </div>
                      <h3 class="text-lg font-bold mb-2 text-green-900">Métricas de Progreso</h3>
                      <p class="text-gray-600">Reportes detallados del impacto ambiental generado</p>
                    </div>
                  </div>
                  <div data-slot="card" class="text-card-foreground flex flex-col gap-6 rounded-xl bg-white border-2 border-blue-100 hover:border-blue-300 transition-all hover:shadow-xl">
                    <div data-slot="card-content" class="[&:last-child]:pb-6 p-6">
                      <div class="bg-gradient-to-br from-blue-500 to-cyan-500 w-14 h-14 rounded-2xl flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-7 w-7 text-white">
                          <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                          <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                      </div>
                      <h3 class="text-lg font-bold mb-2 text-blue-900">Centros de Acopio</h3>
                      <p class="text-gray-600">Mapa interactivo con puntos de reciclaje cercanos</p>
                    </div>
                  </div>
                </div>
                <div class="mt-16 bg-white rounded-3xl shadow-xl p-8 md:p-12">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                      <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?crop=entropy&…b29tJTIwbGVhcm5pbmd8ZW58MXx8fHwxNzc2MjczMDA0fDA&ixlib=rb-4.1.0&q=80&w=1080" alt="Niños aprendiendo" class="rounded-2xl w-full h-[300px] object-cover">
                    </div>
                    <div>
                      <h3 class="text-3xl font-bold mb-4 text-gray-900">Motivación Constante</h3>
                      <p class="text-lg text-gray-600 mb-6">
                        El sistema de puntos y rankings mantiene a los estudiantes entusiasmados y comprometidos. Cada escaneo suma puntos, cada logro se celebra, y cada salón puede ver su progreso en tiempo real.
                      </p>
                      <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                          <div class="bg-green-500 rounded-full p-1 mt-1">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                          </div>
                          <span class="text-gray-700">Fomenta el trabajo en equipo</span>
                        </li>
                        <li class="flex items-start gap-3">
                          <div class="bg-green-500 rounded-full p-1 mt-1">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                          </div>
                          <span class="text-gray-700">Desarrolla hábitos sostenibles</span>
                        </li>
                        <li class="flex items-start gap-3">
                          <div class="bg-green-500 rounded-full p-1 mt-1">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                          </div>
                          <span class="text-gray-700">Crea conciencia ambiental duradera</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <section id="unite" class="py-20 bg-gradient-to-br from-green-600 to-emerald-600 text-white">
              <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">¿Listo para transformar la educación ambiental?</h2>
                <p class="text-xl mb-8 text-green-50">
                  Únete a SortlyScan y sé parte del cambio. Registra tu institución hoy y comienza a enseñar reciclaje de forma innovadora.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                  <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive h-10 rounded-md px-6 has-[>svg]:px-4 bg-white text-green-600 hover:bg-green-50 shadow-xl">Crear cuenta ahora</button>
                </div>
              </div>
            </section>
        </div>
    </main>
    <footer class="bg-gradient-to-br from-green-900 to-emerald-800 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div class="col-span-1 md:col-span-2">
            <div class="flex items-center gap-2 mb-4">
              <div class="bg-white/10 p-2 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf h-6 w-6">
                  <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"></path>
                  <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path>
                </svg>
              </div>
              <span class="text-2xl font-bold">SortlyScan</span>
            </div>
            <p class="text-green-100 mb-4">
              Enseñando a las nuevas generaciones a cuidar el planeta mediante tecnología innovadora y educación divertida.
            </p>
            <div class="flex gap-3">
              <a href="#" class="bg-white/10 p-2 rounded-lg hover:bg-white/20 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook h-5 w-5">
                  <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                </svg>
              </a>
              <a href="#" class="bg-white/10 p-2 rounded-lg hover:bg-white/20 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-twitter h-5 w-5">
                  <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                </svg>
              </a>
              <a href="#" class="bg-white/10 p-2 rounded-lg hover:bg-white/20 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram h-5 w-5">
                  <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                  <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                  <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                </svg>
              </a>
            </div>
          </div>
          <div>
            <h3 class="font-semibold mb-4">Enlaces Rápidos</h3>
            <ul class="space-y-2">
              <li>
                <a class="text-green-100 hover:text-white transition-colors" href="/" data-discover="true">Inicio</a>
              </li>
              <li>
                <a href="#sobre-nosotros" class="text-green-100 hover:text-white transition-colors">Sobre Nosotros</a>
              </li>
              <li>
                <a href="#beneficios" class="text-green-100 hover:text-white transition-colors">Beneficios</a>
              </li>
              <li>
                <a href="#unite" class="text-green-100 hover:text-white transition-colors">Únete</a>
              </li>
            </ul>
          </div>
          <div>
            <h3 class="font-semibold mb-4">Contacto</h3>
            <ul class="space-y-3">
              <li class="flex items-start gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail h-5 w-5 text-green-300 mt-0.5">
                  <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                  <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                </svg>
                <span class="text-green-100">contacto@sortlyscan.com</span>
              </li>
              <li class="flex items-start gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone h-5 w-5 text-green-300 mt-0.5">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <span class="text-green-100">#########</span>
              </li>
              <li class="flex items-start gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-5 w-5 text-green-300 mt-0.5">
                  <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
                <span class="text-green-100">El Salvador</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="border-t border-white/10 mt-8 pt-8 text-center text-green-100">
          <p>
            © 2026 SortlyScan. Todos los derechos reservados. Un proyecto para un futuro más verde.
          </p>
        </div>
      </div>
    </footer>
    
</body>
</html>
