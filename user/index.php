<?php 
    session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos de Bádminton</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/jquery-confirm.css">
    <!-- JS -->
    <script src="../js/lib/jquery-3.7.1.min.js"></script>
    <script src="../js/lib/jquery-confirm.js"></script>
</head>
<body class="vh-100">
    <div class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Sidebar -->
            <?php 
                include './views/navbar-user.php';
            ?>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-auto">
                <h1 class="my-4 text-center">Equipos de Bádminton</h1>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <!-- Card 1 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="../images/products/gallitos-de-colores.jpg" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Raqueta Pro 500</h5>
                                <p class="card-text">Raqueta profesional de alto rendimiento, ligera y resistente.</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="../images/products/mochila-negra.jpg" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Raqueta Básica</h5>
                                <p class="card-text">Raqueta ideal para principiantes. Resistente y económica.</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="../images/products/Rauqetas azules.jpg" class="card-img-top" alt="Equipo de Bádminton">
                            <div class="card-body">
                                <h5 class="card-title">Set de Volantes</h5>
                                <p class="card-text">Pack de volantes de alta resistencia para entrenamiento intensivo.</p>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100">Ver detalles</button>
                            </div>
                        </div>
                    </div>
                    <!-- Additional cards can be added similarly -->
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
