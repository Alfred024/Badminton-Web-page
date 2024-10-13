<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - Badminton para todos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>
    <nav class="navbar navbar-light bg-light-blue">
        <a class="navbar-brand" href="./">
            <img style="width: 60px;" src="./assets/badminton-icon.png" alt="Logo Badminton" srcset="">
            Badminton para todos
        </a>
        <ul class="nav">
            <li>
                <a class="nav-item nav-link" href="./login.php">Entrar</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="./register.php">Registro</a></li>
            <li class="nav-item"><a class="nav-link" href="./about-us.php">Sobre Nosotros</a></li>
        </ul>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center" style="color: var(--blue);">Recuperar Contraseña</h1>
        <form class="w-50 mx-auto">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" placeholder="Ingresa tu correo">
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: var(--blue);">Recuperar</button>
        </form>
    </div>
</body>

</html>
