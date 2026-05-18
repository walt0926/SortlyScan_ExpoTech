<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoftlyScan - Login</title>
    <link rel="stylesheet" href="registros.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="main-container">
        <header class="header-text">
            <h1>SortlyScan</h1>
            <p>Teacher Panel</p>
        </header>

        <div class="login-card">
            <div class="role-selector">
                <button class="role-btn active" id="btn-docente">Teacher</button>
                <button class="role-btn" id="btn-director">Principal</button>
            </div>

            <form id="login-form">
                <div class="input-group">
                    <label for="username"><i class="fa-regular fa-user"></i> Username</label>
                    <input type="text" id="username" placeholder="Enter your username" required>
                </div>

                <div class="input-group">
                    <label for="password"><i class="fa-solid fa-lock"></i> Password</label>
                    <input type="password" id="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="login-btn">Log In</button>
            </form>
        </div>

        <a href="#" class="back-link">← Back to student access</a>
    </div>

    <script src="registros.js"></script>
</body>
</html>