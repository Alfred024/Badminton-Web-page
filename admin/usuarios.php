<?php
    session_start();

    if( !( isset($_SESSION['rol']) && $_SESSION['id_rol'] == 1 ) ){
        // Redirección a no c dónde
    }

    include './views/header-admin.php';
?>
    
    <h1 class="text-center mb-4 color-dark-blue">Pestaña de usuarios</h1>

    <div class="container mt-4">
        <?php 
            include '../classes/class_usuarios.php';
        ?>

    </div>
</body>
</html>