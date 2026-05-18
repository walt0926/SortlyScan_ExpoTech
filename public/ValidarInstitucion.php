<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
    <title>SortlyScan - Institutional Access</title>
</head>
<body>
    <div class="tailwind">
        <div class="login-screen">
            <div class="login-card-container">
                
                <div class="text-center mb-8 popi">
                    <div class="icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 22v-4a2 2 0 1 0-4 0v4"></path><path d="m18 10 3.447 1.724a1 1 0 0 1 .553.894V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7.382a1 1 0 0 1 .553-.894L6 10"></path><path d="M18 5v17"></path><path d="m4 6 7.106-3.553a2 2 0 0 1 1.788 0L20 6"></path><path d="M6 5v17"></path><circle cx="12" cy="9" r="2"></circle></svg>
                    </div>
                    <h1 class="titulo-principal">
                        <span class="text-white">Sortly</span><span class="text-scan">Scan</span>
                    </h1>
                    <p id="setup-subtitle" class="subtitle">Identify your school</p>
                </div>

                <div id="form-acceso">
                    <div class="form-container">
                        <label class="block mb-4">
                            <span class="label-text">School CCT Code</span>
                            <input type="text" id="cct-input" placeholder="e.g., 15EPR0001X" class="input-codigo">
                        </label>
                        <button onclick="procesarAcceso()" id="btn-principal" class="btn-entrar">Validate School</button>
                    </div>
                </div>

                <div class="opciones-secundarias">
                    <button onclick="mostrarLoginMaestro()" class="btn-link">Teacher Access</button>
                    <span class="separador">|</span>
                    <button onclick="mostrarLoginDirector()" class="btn-link">Principal Access</button>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/Validacion_Institucional.js"></script>
</body>
</html>