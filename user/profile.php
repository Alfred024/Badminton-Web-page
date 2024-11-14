<?php 
session_start();

if ( isset($_REQUEST['action']) ){
        include '../classes/class_usuarios.php';
        $userObject->get_query('SELECT * FROM usuario WHERE id_usuario = '.$_SESSION['user_id'].';');
        $userData = $userObject->query_results;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos de Bádminton</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex">
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar h-100">
        <div class="position-sticky">
            <div class="text-center my-4">
                <img src="
                    <?php 
                        if ( $_SESSION['photo'] > "" ){
                            echo '../images/users/'.$_SESSION['user_id'].'.'.$_SESSION['photo'].'';
                        } else{
                            echo '../images/users/user.webp';
                        }
                    ?>
                " alt="Foto de perfil" class="rounded-circle mb-2" width="80" height="80">
                <h5>
                    <?php 
                        echo $_SESSION['user_name'];
                    ?>
                </h5>
                <p class="text-muted">Miembro desde 2023</p>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">
                        <i class="bi bi-house-door-fill me-2"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="profile.php">
                        <i class="bi bi-house-door-fill me-2"></i>Perfil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-clipboard-data-fill me-2"></i>Equipos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-clipboard-data-fill me-2"></i>Rentas
                    </a>
                </li>
            </ul>
            <div class="mt-4 text-center">
                <a class="btn btn-outline-danger" href="../index.php">
                    <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-3">
        <h1 class="text-center" style="color: var(--blue);">Editar perfil</h1>
        <form method="post" enctype="multipart/form-data" action="../classes/class_usuarios.php" class="w-50 mx-auto">
            <div class="mb-2">
                <label for="name" class="form-label">Nombres</label>
                <input name="nombres" type="text" class="form-control" id="name" value="<?php echo $userData[0]['nombres'] ?>">
            </div>
            <div class="mb-2">
                <label for="name" class="form-label">Apellidos</label>
                <input name="apellidos" type="text" class="form-control" id="last_name" value="<?php echo $userData[0]['apellidos'] ?>">
            </div>
            <!-- <div class="mb-2">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Ingresa tu correo">
            </div> -->
            <div class="mb-2">
                <label for="password" class="form-label">Contraseña</label>
                <input name="clave" type="password" class="form-control" id="password" value="<?php echo $userData[0]['clave'] ?>">
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Foto de perfil</label>
                <input name="foto_perfil" type="file" class="form-control" id="password" value="<?php echo $userData[0]['foto'] ?>">
            </div>

            <!-- <label for="password" class="form-label">Genero</label>
            <select name="genero" class="form-select mb-2" aria-label="Default select example">
                <option value="h">Hombre</option>
                <option value="m">Mujer</option>
                <option value="o">Otro</option>
            </select> -->
            <button type="submit" class="btn bg-blue">Actualizar</button>
            <input name="action" value="update_profile" type="hidden">

            <?php 
                if (isset($_REQUEST['m'])) {
                    $message = $_REQUEST['m'];
                    
                    switch ($message) {
                        case '2': 
                            echo ('<p class="text-end color-blue"><b>El email ya está registrado.</b></p>');
                            break;
                        case '3':  
                            echo ('<p class="text-end color-blue"><b>Favor de llenar todos los campos.</b></p>');
                            break;
                        case '4':  
                            echo ('<p class="text-end color-blue"><b>Usuario registrado exitosamente!!.</b></p>');
                            break;
                        case '5':  
                            echo ('<p class="text-end color-blue"><b>Captcha incorrecto.</b></p>');
                            break;
                    }
                }
            ?>
        </form>
    </div>
</body>