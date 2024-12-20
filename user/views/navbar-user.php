<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar h-100">
    <div class="position-sticky">
        <div class="text-center my-4">
            <img src="
                <?php 
                    if ( $_SESSION['photo'] > "" ){
                        echo '../images/users/'.$_SESSION['user_id'].'.'.$_SESSION['photo'].'';
                    } else{
                        echo '../images/users/user.jpg';
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
                <a class="nav-link active" aria-current="page" href="#">
                    <i class="bi bi-house-door-fill me-2"></i>Home
                </a>
            </li>
            <li class="nav-item">
                <form method="post" action="./profile.php" class="px-2">
                    <button type="submit" class="nav-link active">Perfil</button>
                    <!-- <a class="nav-link active" aria-current="page">
                        <i class="bi bi-house-door-fill me-2"></i>Perfil
                    </a> -->
                    <input type="hidden" name="action" value="get_user">
                </form>
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