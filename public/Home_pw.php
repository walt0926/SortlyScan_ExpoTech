<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SortlyScan</title>
    <meta name="description" content="Official website of SortlyScan.">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#0A1A0B',
                            'green-dark': '#4CAF50',
                            'green-light': '#CDDC39',
                            yellow: '#FFEB3B',
                            cyan: '#00BCD4',
                            light: '#F7FDF5',
                        }
                    },
                    fontFamily: {
                        baloo: ['"Baloo 2"', 'sans-serif'],
                        nunito: ['Nunito', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="home.css">
</head>
<body class="font-nunito bg-brand-light text-brand-dark">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a class="flex items-center gap-2 group" href="#">
                    <img src="img/logo2.png" alt="SortlyScan Logo" class="h-10 w-auto object-contain transition-transform group-hover:scale-105" onerror="this.src='img/logo2.png'; this.onerror=null;">
                </a>
                
                <nav class="hidden md:flex items-center gap-6">
                    <a href="#home" class="font-semibold text-brand-cyan">Home</a>
                    <a href="#about-us" class="text-gray-500 hover:text-brand-cyan transition-colors">About Us</a>
                    <a href="#benefits" class="text-gray-500 hover:text-brand-cyan transition-colors">Benefits</a>
                    <a href="#join" class="text-gray-500 hover:text-brand-cyan transition-colors">Register</a>
                </nav>

                <div class="flex items-center gap-4">
                    <button onclick="window.location.href='ValidarInstitucion.php'" class="bg-brand-cyan text-white hover:bg-opacity-90 px-5 py-2 rounded-xl font-bold transition-all shadow-sm">
                        Log In
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section id="home" class="bg-brand-green-dark text-white py-12 md:py-20 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-brand-cyan px-4 py-1.5 rounded-full mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-white">
                                <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                            </svg>
                            <span class="text-xs font-mono font-bold tracking-wider text-white">// TECHNOLOGY + ENVIRONMENTAL EDUCATION</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-baloo font-extrabold text-white mb-6 leading-tight">
                            Teaching how to recycle with <span class="text-brand-yellow">technology and fun</span>
                        </h1>
                        <p class="text-lg text-white/90 mb-8 max-w-xl">
                            A solution that transforms questions and small actions into an experience that changes the future.
                        </p>
                        <div class="mb-10">
                            <button class="bg-brand-cyan text-white hover:bg-opacity-90 px-6 py-2.5 rounded-xl font-bold transition-all shadow-md" onclick="window.location.href='registroinstitucional.php'">
                                Register Now
                            </button>
                        </div>
                        <div class="grid grid-cols-3 text-center gap-4 border-t border-white/20 pt-6 max-w-md">
                            <div>
                                <div class="text-3xl font-baloo font-bold text-brand-white">7-12</div>
                                <div class="text-xs text-white/75">Years Old</div>
                            </div>
                            <div>
                                <div class="text-3xl font-baloo font-bold text-brand-white">100%</div>
                                <div class="text-xs text-white/75">Interactive</div>
                            </div>
                            <div>
                                <div class="text-3xl font-mono font-bold text-brand-whites">AI</div>
                                <div class="text-xs text-white/75">Assisted</div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <img src="https://www.prensalibre.com/wp-content/uploads/2022/05/BV-17052022-TECNO-Y-RECICLAJE-02_67685413.jpg" alt="SortlyScan Robot" class="rounded-3xl shadow-2xl w-full max-w-lg h-[350px] md:h-[400px] object-cover border-4 border-brand-cyan">
                    </div>
                </div>
            </div>
        </section>

        <section id="about-us" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-baloo font-extrabold text-brand-cyan mb-6">What is SortlyScan?</h2>
                    <div class="max-w-3xl mx-auto space-y-4 text-gray-600 text-lg">
                        <p>According to MARN, El Salvador recycles less than 5% of its waste. Every day, more than 4,000 tons of waste are generated, polluting our ecosystems due to a lack of environmental education.</p>
                        <p class="font-semibold text-gray-700"><strong>SortlyScan</strong> is an innovative educational project that combines technology and gamification to build real sustainable habits in primary school students from first to sixth grade in public schools.</p>
                    </div>
                </div>                      
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center pt-6">
                    <div class="lg:col-span-5">
                        <img src="https://images.unsplash.com/photo-1732187821884-56dc80ec9367?q=80&w=1080" alt="Green Planet" class="rounded-2xl shadow-md w-full h-[300px] md:h-[350px] object-cover">
                    </div>
                    <div class="lg:col-span-7 space-y-6">
                        <div>
                            <h3 class="text-xl font-bold text-brand-green-dark flex items-center gap-2 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                                Our Mission
                            </h3>
                            <p class="text-gray-600">To foster environmental awareness and recycling in primary school children through an interactive digital educational platform, inspiring responsible habits from an early age.</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-brand-cyan flex items-center gap-2 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Our Vision
                            </h3>
                            <p class="text-gray-600">To become the national benchmark for children's digital environmental education in El Salvador, making recycling a natural and everyday practice within the school environment.</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-brand-dark mb-2">Core Values</h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-1 pl-1">
                                <li>Sustainability: Caring for the environment for future generations.</li>
                                <li>Education: Accessible, clear, and fun knowledge transmission for children.</li>
                                <li>Environmental Resilience: Adaptive capacity to face current ecological challenges.</li>
                                <li>Commitment: Constant dedication toward social transformation.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="benefits" class="py-16 bg-[#fffdf9]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-baloo font-extrabold text-brand-cyan mb-4">Benefits for Educational Institutions</h2>
                    <p class="text-lg text-gray-600">We transform recycling into a motivating and competitive experience inside the classrooms.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center">
                        <div class="p-3 rounded-xl mb-4 text-white bg-brand-cyan shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold mb-2">Inter-Grade Competitions</h4>
                        <p class="text-sm text-gray-500">Encourages a healthy motivational competition between different school levels.</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center">
                        <div class="p-3 rounded-xl mb-4 text-brand-dark bg-brand-yellow shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="6"></circle><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold mb-2">Leaderboard</h4>
                        <p class="text-sm text-gray-500">Real-time interactive rankings that drive active participation among students.</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center">
                        <div class="p-3 rounded-xl mb-4 text-white bg-brand-green-light shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline></svg>
                        </div>
                        <h4 class="text-lg font-bold mb-2">Progress Metrics</h4>
                        <p class="text-sm text-gray-500">Detailed reports on environmental impact and total weight of waste recovered by the school.</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm text-center flex flex-col items-center">
                        <div class="p-3 rounded-xl mb-4 text-white bg-brand-cyan shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <h4 class="text-lg font-bold mb-2">Collection Centers</h4>
                        <p class="text-sm text-gray-500">Structured mapping to locate and coordinate waste delivery with authorized local recyclers.</p>
                    </div>
                </div>

                <div class="mt-12 bg-white rounded-3xl shadow-sm p-6 md:p-10 border-2 border-brand-cyan">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                        <div class="lg:col-span-5">
                            <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1080" alt="Children learning" class="rounded-xl object-cover w-full h-[220px]">
                        </div>
                        <div class="lg:col-span-7">
                            <h3 class="text-2xl font-baloo font-bold mb-3 text-brand-cyan">Constant Motivation</h3>
                            <p class="text-gray-600 mb-4">Intelligent scanning awards interactive points that celebrate collective milestones, displaying the progress of each classroom in real time.</p>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-start gap-2">
                                    <span class="inline-flex items-center justify-center bg-brand-cyan text-white rounded-full w-5 h-5 text-xs font-bold mt-0.5">✓</span> Fosters group collaborative work.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="inline-flex items-center justify-center bg-brand-cyan text-white rounded-full w-5 h-5 text-xs font-bold mt-0.5">✓</span> Develops long-lasting ecological habits.
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="inline-flex items-center justify-center bg-brand-cyan text-white rounded-full w-5 h-5 text-xs font-bold mt-0.5">✓</span> Builds a measurable local environmental impact.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="join" class="bg-brand-cyan text-white py-16 text-center">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-baloo font-extrabold mb-4 text-white">Ready to transform environmental education?</h2>
                <p class="text-lg text-white/90 mb-6 max-w-2xl mx-auto">Join SortlyScan and lead the sustainable change within your educational center in El Salvador.</p>
                <button onclick="window.location.href='registroinstitucional.php'" class="bg-white text-brand-dark hover:bg-brand-light px-6 py-3 rounded-xl font-bold shadow-md transition-transform hover:scale-105">
                    Create Institutional Account
                </button>
            </div>
        </section>
    </main>

    <footer class="bg-brand-dark text-white pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <div class="md:col-span-6">
                    <h3 class="text-xl font-baloo font-bold mb-3 flex items-center gap-2">
                        <img src="img/logo3.png" alt="SortlyScan Logo" class="h-6 w-auto object-contain" onerror="this.src='img/logo3.png'; this.onerror=null;">
                        <span></span>
                    </h3>
                    <p class="text-sm text-gray-400 max-w-md">Educating the new generations of El Salvador to take care of the planet through adaptive and fun technological dynamics.</p>
                </div>
                <div class="col-span-6 md:col-span-3">
                    <h5 class="text-sm font-bold tracking-wider text-white uppercase mb-3">Quick Links</h5>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#home" class="hover:text-brand-cyan transition-colors">Home</a></li>
                        <li><a href="#about-us" class="hover:text-brand-cyan transition-colors">About Us</a></li>
                        <li><a href="#benefits" class="hover:text-brand-cyan transition-colors">Benefits</a></li>
                    </ul>
                </div>
                <div class="col-span-6 md:col-span-3">
                    <h5 class="text-sm font-bold tracking-wider text-white uppercase mb-3">Contact</h5>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>📍 El Salvador</li>
                        <li>✉ contact@sortlyscan.com</li>
                    </ul>
                </div>
            </div>
            <div class="text-center text-sm text-gray-500 mt-12 pt-6 border-t border-gray-800">
                <p>&copy; 2026 SortlyScan. All rights reserved. A project for a greener future.</p>
            </div>
        </div>
    </footer>

</body>
</html>