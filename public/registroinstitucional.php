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
                <!-- Icono de escuela -->
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M3 7v1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7H3l2-4h14l2 4"/><path d="M5 21V10.85"/><path d="M19 21V10.85"/><path d="M9 21v-4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v4"/></svg>
            </div>
            <h1 class="titulo-principal"><span class="text-white">Sortly</span><span class="text-scan">Scan</span></h1>
            <p class="subtitle">School Registration</p>
        </div>

        <div class="login-form">
            <form id="formRegistroEscuela">
                <!-- SCHOOL SECTION -->
                <label class="label-text">School Name</label>
                <input type="text" name="nombre_escuela" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="e.g., National Institute" required>

                <label class="label-text">Infrastructure Number (CCT)</label>
                <input type="text" name="cct" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="Unique code" required>

                <hr style="border: 0; border-top: 1px solid #eee; margin: 1.5rem 0;">

                <!-- PRINCIPAL SECTION -->
                <label class="label-text">Principal's Email</label>
                <input type="email" name="email_director" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="email@example.com" required>

                <label class="label-text">Password</label>
                <input type="password" name="password_director" class="input-codigo" style="font-size: 1.1rem;" placeholder="********" required>

                <button type="submit" class="btn-entrar">REGISTER SCHOOL</button>
            </form>
            
            <div class="footer">
                <a href="iniciodesesion_Director.php" class="btn-link">Already have an account? Log in</a>
            </div>
        </div>
    </div>
    <script src="js/registro.js"></script>
</body>
</html>