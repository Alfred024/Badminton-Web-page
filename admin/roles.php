<?php
    session_start();

    if( !( isset($_SESSION['rol']) && $_SESSION['id_rol'] == 1 ) ){
        // Redirección a no c dónde
    }

    include './views/header-admin.php';
?>
    
    <h1>Pestaña de roles</h1>
    <?php 
        include '../classes/role.php';
    ?>
</body>
</html>