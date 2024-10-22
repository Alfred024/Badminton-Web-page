<?php 
    if( isset($_SESSION['admin']) ){
        header('location: ../index.php?m="NO eres admin"');
    }
?>

<?php include './views/header-admin.php';  ?>
    <h1>SOY EL ADMIN</h1>
</body>
</html>