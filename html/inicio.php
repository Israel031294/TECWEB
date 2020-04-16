<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    include('./../layouts/sesion_usuario.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('./../layouts/libs.php');
    ?>
    <title>Casa - CACEI</title>
</head>
<body>
    <header>
        <?php
            //session_start();
            switch($_SESSION["sesion"]["tipo"]){
                case "Profesor":
                    include('./../layouts/nav_prof.php');
                    break;
                case "Administrador":
                    include('./../layouts/nav_admon.php');
                    break;
            }
        ?>
    </header>
    <main>

        <?php
            //session_start();
            switch($_SESSION["sesion"]["tipo"]){
                case "Profesor":
        ?>
        <div></div>
        <?php
                    break;
                case "Administrador":
        ?>
        <div></div>
        <?php
                    break;
            }
        ?>
    
    </main>
    <?php
        include("./../layouts/footer.php");
    ?>
    <script src="./../assets/js/header.js"></script>
</body>
</html>