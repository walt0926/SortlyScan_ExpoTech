<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="color-scheme" content="light dark">
  <link rel="stylesheet" href="public/CSS/styleIniciodeSesion.css">
  <link rel="stylesheet" href="public/JS/scriptIniciodesesion.js">
  <title>Inicio_de_sesion_SortlyScan</title>
</head>
<body>
  <div class="tailwind">
    <div class="login-screen">
      <div class="login-card-container"> 
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
          <p class="subtitle">¡Aprende y gana puntos reciclando!</p>
        </div>
        <form class="login-form">
          <div class="form-container">
            <label class="block mb-4">
              <span class="label-text">Ingresa tu código de clase</span>
              <input type="text" placeholder="ABC123" class="input-codigo" maxlength="8">
            </label>
            <button type="submit" class="btn-entrar">Entrar</button>
          </div>
        </form>
        <div class="text-center mt-8 footer">
          <button class="link-footer">¿Eres docente o director? Ingresa aquí</button>
        </div>
      </div>
    </div>
    <div class="tailwind"></div>
</body>
</html>