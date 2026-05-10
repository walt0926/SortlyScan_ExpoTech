<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="color-scheme" content="light dark">
  <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
  <title>SortlyScan - Login</title>
</head>
<body>
  <div class="tailwind">
    <div class="login-screen">
      <div class="login-card-container"> 
        
        <!-- Encabezado -->
        <div class="text-center mb-12 popi">
          <div class="icon-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-school">
              <path d="M14 22v-4a2 2 0 1 0-4 0v4"></path>
              <path d="m18 10 3.447 1.724a1 1 0 0 1 .553.894V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7.382a1 1 0 0 1 .553-.894L6 10"></path>
              <path d="M18 5v17"></path>
              <path d="m4 6 7.106-3.553a2 2 0 0 1 1.788 0L20 6"></path>
              <path d="M6 5v17"></path>
              <circle cx="12" cy="9" r="2"></circle>
            </svg>
          </div>
          <h1 class="titulo-principal">
            <span class="text-white">Sortly</span><span class="text-scan">Scan</span>
          </h1>
          <p id="dynamic-subtitle" class="subtitle">¡Aprende y gana puntos reciclando!</p>
        </div>

        <!-- FORMULARIO 1: ACCESO ALUMNO (PIN Y SELECTOR) -->
        <!-- Este se muestra por defecto o tras validar código de clase -->
        <div id="section-alumno">
          <div class="form-container">
            <label class="block mb-4">
              <span class="label-text">Selecciona tu nombre</span>
              <select id="selectAlumno" class="input-codigo">
                <option value="">Cargando compañeros...</option>
                <!-- Los nombres se cargarán desde la DB -->
              </select>
            </label>
            <label class="block mb-4">
              <span class="label-text">Ingresa tu código de clase (4 dígitos)</span>
              <input type="password" id="pin" placeholder="****" class="input-codigo" maxlength="4" inputmode="numeric">
            </label>
            <button onclick="loginAlumno()" class="btn-entrar">¡Empezar a Reciclar!</button>
          </div>
        </div>

        <!-- FORMULARIO 2: ACCESO PERSONAL (MAESTRO/DIRECTOR) -->
        <!-- Se activa al hacer clic en el botón del footer -->
        <div id="section-staff" style="display: none;">
          <div class="form-container">
            <label class="block mb-4">
              <span class="label-text">Usuario o Correo</span>
              <input type="text" id="username" placeholder="usuario@escuela.com" class="input-codigo">
            </label>
            <label class="block mb-4">
              <span class="label-text">Contraseña</span>
              <input type="password" id="password" placeholder="********" class="input-codigo">
            </label>
            <button onclick="login()" class="btn-entrar">Ingresar al Panel</button>
          </div>
        </div>

        <!-- Footer / Cambio de Vista -->
        <div class="text-center mt-8 footer">
          <button id="toggle-view" class="link-footer" onclick="toggleView()">¿Eres docente o director? Ingresa aquí</button>
        </div>
      </div>
    </div>
  </div>

  <script src="JS/Inicio_de_sesion.js"></script>
</body>
</html>