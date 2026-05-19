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
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#4CAF50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M3 7v1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7H3l2-4h14l2 4"/><path d="M5 21V10.85"/><path d="M19 21V10.85"/><path d="M9 21v-4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v4"/></svg>
            </div>
            <h1 class="titulo-principal"><span class="text-white">Sortly</span><span class="text-scan">Scan</span></h1>
            <p class="subtitle">School Registration</p>
        </div>

        <div class="login-form">
            <form id="formRegistroEscuela">
                <label class="label-text">School Name</label>
                <input type="text" name="nombre_escuela" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="e.g., National Institute" required>

                <label class="label-text">Infrastructure Number (CCT)</label>
                <input type="text" name="cct" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="Unique code" required>

                <hr style="border: 0; border-top: 1px solid #eee; margin: 1.5rem 0;">

                <label class="label-text">Principal's Full Name</label>
                <input type="text" name="nombre_completo" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="e.g., Dr. Alex Smith" required>

                <label class="label-text">Principal's Email</label>
                <input type="email" name="email_director" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="email@example.com" required>

                <label class="label-text">Password</label>
                <input type="password" name="password_director" id="password_director" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="********" required>

                <label class="label-text">Confirm Password</label>
                <input type="password" id="password_confirm" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;" placeholder="********" required>

                <div id="verification-block" style="display: none; background: #f0fdf4; padding: 15px; border-radius: 10px; border: 1px solid #bbf7d0; margin-bottom: 1rem; text-align: center;">
                    <label class="label-text" style="color: #166534; font-weight: bold;">Enter 6-Digit Verification Code</label>
                    <input type="text" name="codigo_verificacion" id="codigo_verificacion" class="input-codigo" style="font-size: 1.8rem; text-align: center; letter-spacing: 0.4rem; color: #166534; margin-top: 5px;" placeholder="000000" maxlength="6">
                    <p style="font-size: 0.8rem; color: #15803d; margin-top: 5px;"><i class="fa-solid fa-envelope"></i> We sent a validation security code to your email.</p>
                </div>

                <button type="submit" id="btn-submit-registro" class="btn-entrar">SEND VERIFICATION CODE</button>
            </form>
            
            <div class="footer">
                <a href="iniciodesesion_Director.php" class="btn-link">Already have an account? Log in</a>
            </div>
        </div>
    </div>
    <script src="JS/registro.js"></script>
</body>
</html>