<?php
    session_start();

    if( !( isset($_SESSION['rol']) && $_SESSION['id_rol'] == 1 ) ){
        // Redirección a no c dónde
    }

    include './views/header-admin.php';
?>
    
    <h1 class="text-center mb-4 color-dark-blue">Pestaña de roles</h1>

    <div class="container mt-4">
        <div class="d-flex justify-content-end mb-3">
            
            <button class="btn btn-success btn-sm" title="Agregar nuevo rol">
                <i class="bi bi-plus-lg"></i> Agregar Rol
            </button>
        </div>

        <?php 
            include '../classes/class_role.php';
        ?>

    </div>
</body>
</html>