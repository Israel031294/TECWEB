<?php
	session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
if($_SESSION["activadaA"]=="v"){
	$_SESSION["activada"] = "v";
include 'cAdministrador.php';
include 'cabeceras.php';
$cab = new cabecera();

$obj = new cAdministrador();

$tablaProfesores = "";
$idUsuario = "";
$res  = "";
$a = "0";
$correoAct = $_SESSION["correo"];

$tablaProfesores = $obj->tablaProfesores();


$a = isset($_REQUEST["a"]) ? $_REQUEST["a"] : "0";
$idUsuario = isset($_REQUEST["Iu"]) ? $obj->decodificaURL($_REQUEST["Iu"]) : "";
$menuProf = $obj->menuFormularios($idUsuario);

$_SESSION["identificador"] = $idUsuario;//idUsr que recibirán todos los formularios
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrador</title>
    <link href="../assets/lib/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="../assets/lib/materialize/css/materialize.min.css" rel="stylesheet">
    <link href="../assets/lib/jquery/plugins/slippry/slippry.css" rel="stylesheet">
    <link href="../assets/js/validetta101/validetta.min.css" rel="stylesheet">
    <link href="../assets/css/estilos.css" rel="stylesheet" >
    <!--<link href="./js/confirm/jquery-confirm.min.css" rel="stylesheet">--->
    <script src="../assets/lib/jquery-3.4.0.min.js"></script>
    <script src="../assets/lib/materialize/js/materialize.min.js"></script>
    <script src="../assets/js/validetta101/validetta.min.js"></script>
    <!--<script src="./js/validetta101/localization/validettaLang-es-ES.js"></script>-->
    <script src="../assets/js/confirm/js/jquery-confirm.js"></script>


   
</head>
<body>
    <header>
      <section id="encabezado">
			<?=$cab->cabeceraA();?>
      </section>
    </header>
				

    <main>
        <section id="contenidos">
             <div class="container">
                <div class="row">
					<?php
					if($a == "0"){
				?>
				<h5 class="center-align">Profesores Registrados</h5>
						<?=$tablaProfesores?>
				<?php
				}else{
				?>
					<a class="waves-effect waves-light btn-small" href="?a=0">Regresar</a>
					<?=$menuProf?>
					<?php
				}
					?>
				</div>
            </div>
         </section>      
    </main>
					
    <footer class="page-footer blue  darken-3">
            <section id="pie">
           
            <div class="footer-copyright">
              <div class="container">
              © 2019 Escuela Superior de C&oacute;mputo 
              <a class="grey-text text-lighten-4 right" href="https://www.ipn.mx/">IPN</a>
              </div>
            </div>
        </section>
     </footer>
</body>
</html>
<?php
	}else{
		header("location:../index.php");
	}
?>