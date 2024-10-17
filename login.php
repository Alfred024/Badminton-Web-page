<?php 
    // if( !isset($_REQUEST['email']) && !isset($_REQUEST['pswd']) ){
    //     // echo('Por favor llene todos los campos');
    // }else{

    //     include './classes/database.php';
    //     $database = new Database();

    //     $email = $_REQUEST['email'];
    //     $pswd = $_REQUEST['pswd'];

    //     $get_user_query = 'SELECT * FROM usuario WHERE email = :email && clave = :pswd';
    //     $params = [':email' => $email, ':pswd' => $pswd];
    //     $database->do_query($get_user_query, $params);

    //     if( $database->query_results_num >= 1 ){
    //         header('location: ./index.php');
    //     }else{
    //         header('location: ./login.php?m=400');
    //     }
    // }

?>

<?php include './views/header.php'  ?>

    <div class="container mt-5">
        <h1 class="text-center color-blue">Iniciar Sesión</h1>
        <form method="post" class="w-50 mx-auto" action="./classes/user.php">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa tu correo">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="pswd" id="password" placeholder="Ingresa tu contraseña">
            </div>
            <div class="mb-2">
                <label for="captcha" class="form-label">Captcha</label>
                <input name="captcha" type="captcha" class="form-control" placeholder="Ingresa el resultado lkd">
            </div>
            <button type="submit" class="btn bg-blue text-white">Entrar</button>
            <input name="action" value="login" type="hidden">
            <br>

            <?php 
                if (isset($_REQUEST['m'])) {
                    $message = $_REQUEST['m'];
                    
                    switch ($message) {
                        case '1':  
                            echo ('<p class="text-end color-blue"><b>Captcha incorrecto, favor de validar.</b></p>');
                            break;
                        case '2': 
                            echo ('<p class="text-end color-blue"><b>El email no está registrado.</b></p>');
                            break;
                        case '3':  
                            echo ('<p class="text-end color-blue"><b>Favor de llenar todos los campos.</b></p>');
                            break;
                        case '4':  
                            echo ('<p class="text-end color-blue"><b>Credenciales inválidas.</b></p>');
                            break;
                    }
                }
            ?>
        </form>
    </div>
</body>

</html>
