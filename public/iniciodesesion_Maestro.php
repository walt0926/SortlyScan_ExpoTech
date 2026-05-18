<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
    <title>SortlyScan - Teacher Access</title>
</head>
<body>
    <div class="tailwind">
        <div class="login-screen">
            <div class="login-card-container">
                
                <div class="text-center mb-8 popi">
                    <h1 class="titulo-principal">
                        <span class="text-white">Teacher</span><span class="text-scan">Access</span>
                    </h1>
                    <p id="nombre-institucion" class="subtitle" style="color: #F57C00; font-weight: bold;"></p>
                    <p class="subtitle">Enter your teacher credentials</p>
                </div>

                <div class="form-container">
                    <label class="block mb-4">
                        <span class="label-text">Username or Payroll No.</span>
                        <input type="text" id="user-staff" placeholder="e.g., TCH12345" class="input-codigo">
                    </label>

                    <label class="block mb-4">
                        <span class="label-text">Password</span>
                        <input type="password" id="pass-staff" placeholder="••••••••" class="input-codigo">
                    </label>

                    <!-- Pasamos 'maestro' como argumento -->
                    <button onclick="validarLoginStaff('maestro')" class="btn-entrar">Log In</button>
                    
                    <div class="footer">
                        <button onclick="window.location.href='index.html'" class="link-footer">Change school</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="JS/sesion_administrativos.js"></script>
</body>
</html>