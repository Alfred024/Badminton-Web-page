<?php 
    if( !isset($_REQUEST['email']) && !isset($_REQUEST['pswd']) ){
        echo('Por favor llene todos los campos');
    }else{

        include './classes/database.php';
        $database = new Database();

        $email = $_REQUEST['email'];
        $pswd = $_REQUEST['pswd'];

        $get_user_query = 'SELECT * FROM usuario WHERE email = :email';
        $params = [':email' => $email];
        $database->do_query($get_user_query, $params);

        if( $database->query_results_num >= 1 ){
            header('location: ./index.php');
        }else{
            echo('Revise las credenciales');
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Badminton para todos</title>
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
                <a class="nav-item nav-link" href="./password.php">Contraseña</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="./register.php">Registro</a></li>
            <li class="nav-item"><a class="nav-link" href="./about-us.php">Sobre Nosotros</a></li>
        </ul>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center" style="color: var(--blue);">Iniciar Sesión</h1>
        <form class="w-50 mx-auto" method="POST" action="./login.php">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa tu correo">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="pswd" id="password" placeholder="Ingresa tu contraseña">
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: var(--blue);">Entrar</button>
        </form>
    </div>
</body>

</html>
