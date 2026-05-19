<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
    <title>SortlyScan - Teacher Access</title>
</head>
<body class="login-screen">
    <div class="login-card-container">
        <div class="popi">
            <h1 class="titulo-principal">
                Teacher Access
            </h1>
            <p id="nombre-institucion" style="color: #00BCD4; font-weight: bold; margin-bottom: 0.5rem;"></p>
            <p class="subtitle">Enter your teacher credentials</p>

            <div class="form-container" style="width: 100%;">
                <label class="label-text">School CCT Code</label>
                <input type="text" id="cct-input" placeholder="e.g., 15EPR0001X" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;">
                    
                <label class="label-text">Username or Payroll No.</label>
                <input type="text" id="user-staff" placeholder="e.g., TCH12345" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;">

                <label class="label-text">Password</label>
                <input type="password" id="pass-staff" placeholder="••••••••" class="input-codigo" style="font-size: 1.1rem; margin-bottom: 1rem;">

                <button onclick="validarLoginStaff('maestro')" class="btn-entrar">Log In</button>
                
                <div class="footer">
                    <button onclick="window.location.href='index.html'" class="btn-link">Change school</button>
                </div>
            </div>
        </div>
    </div>
    <script src="JS/sesion_administrativos.js"></script>
</body>
</html>