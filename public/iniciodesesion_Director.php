<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styleIniciodeSesion.css">
    <title>SortlyScan - Management Access</title>
</head>
<body>
    <div class="tailwind">
        <div class="login-screen">
            <div class="login-card-container">
                
                <div class="text-center mb-8 popi">
                    <h1 class="titulo-principal">
                        <span class="text-white">Management</span><span class="text-scan">Panel</span>
                    </h1>
                    <p id="nombre-institucion" class="subtitle" style="color: #00BCD4; font-weight: bold;"></p>
                    <p class="subtitle">Log in with institutional email</p>
                </div>

                <div class="form-container">
                    <label class="block mb-4">
                        <span class="label-text">Email Address</span>
                        <input type="email" id="user-staff" placeholder="principal@school.com" class="input-codigo">
                    </label>

                    <label class="block mb-4">
                        <span class="label-text">Principal Password</span>
                        <input type="password" id="pass-staff" placeholder="••••••••" class="input-codigo">
                    </label>

                    <!-- Pasamos 'director' como argumento -->
                    <button onclick="validarLoginStaff('director')" class="btn-entrar" style="background-color: #00BCD4;">Enter Panel</button>
                    
                    <div class="btn-link">
                        <a href="registroinstitucional.php" class="btn-secundario">Are you a principal and your school is not registered? Register School</a>
                    </div>

                    <div class="footer" >
                        <button onclick="window.location.href='registroinstitucional.php'" class="link-footer">Back to home</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="JS/sesion_administrativos.js"></script>
</body>
</html>