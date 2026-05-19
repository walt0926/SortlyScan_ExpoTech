<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Registration - SortlyScan</title>
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
</head>
<body class="login-screen">
    <div class="login-card-container">
        <div class="popi">
            <div class="icon-circle">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#00BCD4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18"/>
                    <path d="M3 7v1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7H3l2-4h14l2 4"/>
                    <path d="M5 21V10.85"/>
                    <path d="M19 21V10.85"/>
                    <path d="M9 21v-4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v4"/>
                </svg>
            </div>
            
            <h1 class="titulo-principal">SortlyScan</h1>
            <p class="subtitle">Register your educational institution to get started</p>
            
            <form id="formRegistroEscuela" style="width: 100%;">
                <label class="label-text">School Name</label>
                <input type="text" name="nombre_escuela" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="e.g., National Institute" required>

                <label class="label-text">Infrastructure Number (CCT)</label>
                <input type="text" name="cct" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="Unique code" required>

                <label class="label-text">Principal's Email</label>
                <input type="email" name="email_director" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="email@example.com" required>

                <label class="label-text">Password</label>
                <input type="password" name="password_director" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1.5rem;" placeholder="********" required>

                <button type="submit" class="btn-entrar">REGISTER SCHOOL</button>
            </form>
            
            <div class="opciones-secundarias">
                <button onclick="mostrarLoginMaestro()" class="btn-link">Teacher Access</button>
                <span class="separador">|</span>
                <button onclick="mostrarLoginDirector()" class="btn-link">Principal Access</button>
            </div>

            <div class="footer">
                <a href="iniciodesesion_Director.php" class="btn-link">Already registered? Log In here</a>
            </div>
        </div>
    </div>
</body>
</html>