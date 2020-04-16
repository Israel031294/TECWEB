<?php
    session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    if(isset($_SESSION["sesion"])){
        //Checar que tipo de sesion es
        echo $_SESSION["sesion"]["nombre"];
        header("Location: "."./inicio.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('./../layouts/libs.php');
    ?>

    <title>Inicia Sesión - CACEI</title>
</head>
<body class="bg">
	<header>
        <nav class="blue darken-4">
            <div class="nav-wrapper">
                <a href="" class="brand-logo">CACEI</a>
            </div>
        </nav>
    </header>
    <main >
        <div class="wrapper_trapper valign-wrapper">
            <div class="container">
                <div class="row">

                    <!-- Resp -->
                    <div class="col s12 m6 offset-m3">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title center">Inicia Sesión</span>
                                <hr class="" />
                                <form id="inicioSesion">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="fa fa-user prefix"></i>
                                            <label for="nom">Correo</label>
                                            <input type="text" id="nom" name="nombre"/>
                                        </div>
                                        <div class="input-field col s12">
                                            <i class="fa fa-unlock-alt prefix"></i>
                                            <label for="pas">Contraseña</label>
                                            <input type="password" id="pas" name="password"/>
                                        </div>
                                        <div class="col s12 center">
                                            <button class="btn purple col s12" id="submit" >Entrar</button>
                                        </div>
                                        <div class="col s12 center" id="msg">
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="padding0 card-action center">
                                <div class="row">
                                    <div class="col s12 center"><a href="recuperar.php">Olvidaste tu contraseña?</a></div>
                                    <div class="col s12">&nbsp;</div>
                                    <div class="col s12 center"><a href="">Crear Cuenta</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
        include("./../layouts/footer.php");
    ?>
</body>
<script src="./../assets/js/index.js"></script>
<link href="./../assets/css/index.css" rel="stylesheet"/>
</html>