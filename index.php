<?php include './views/header.php'; ?>


<?php
if (isset($_GET['m'])){

    $message = $_GET['m'];
    echo $message;
}

?>
</body>
</html>