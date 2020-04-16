<?php
    session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

   $correo =  isset($_REQUEST["correo"])  ? $_REQUEST["correo"] : ""; //correo
   $clave =  isset($_REQUEST["clave"]) ? $_REQUEST["clave"] : ""; //clave
   $mensaje="";

    if(isset($_SESSION["activada"])){
        if($_SESSION["activada"] == "v"){
            header("Location: servidor/Administrador.php");
        }else if($_SESSION["activada"] != "v"){
            header("Location: servidor/menu.php");
        }
       
        exit();
    }
   
   if($correo!="" && $clave!=""){
	   $mysqli = new mysqli("localhost","root","","curriculum");
								
		if($mysqli->set_charset("utf8")){
			
			$consulta="select * from usuario where contrasenia=md5(?) and correo=?";
			if($preparaConsulta=$mysqli->prepare($consulta)){
				
				$preparaConsulta->bind_param('ss', $clave,$correo);
				$preparaConsulta->execute();
				$resultado = $preparaConsulta->get_result();
				if($resultado->num_rows > 0){
                    if($filas = $resultado->fetch_assoc()){
                        $_SESSION["identificador"] = $filas["idUsuario"];
						$_SESSION["idTipoU"] = $filas["idTipo"];
						$_SESSION["activada"]="v";
						
						if($_SESSION["idTipoU"]=="1"){ // si el usuario es un administrador
								$_SESSION["activadaA"] = "v";//para diferenciar administrador de profesor
								$_SESSION["correo"] = $filas["correo"];
								$_SESSION["idAdministrador"] = $filas["idUsuario"];
								header("location:servidor/Administrador.php");
						}else{
							if($_SESSION["idTipoU"]=="2") // si el usuario es un maestro{
								$_SESSION["activadaA"] = "f";//para diferenciar administrador de profesor
								header("location:servidor/menu.php");
							}
						}
                }else{
					$mensaje = "Los datos ingresados son incorrectos";
				}
            }else{//No hubo un usuario
                    $mensaje = "Ocurri&ocute; un error";
            }
		}
								
		}else{
			$retorno="Campos no completos";
		}
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>inicio</title>
    <link href="./assets/lib/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="./assets/lib/materialize/css/materialize.min.css" rel="stylesheet">
    <link href="./assets/js/validetta101/dist/validetta.min.css" rel="stylesheet">
    <link href="./assets/css/estilos.css" rel="stylesheet" >
    <link href="./assets/js/confirm334/dist/jquery-confirm.min.css" rel="stylesheet">
    <script src="./assets/js/jquery-3.4.1.min.js"></script>
    <script src="./assets/lib/materialize/js/materialize.min.js"></script>
    <script src="./assets/js/validetta101/dist/validetta.min.js"></script>
    <script src="./assets/js/validetta101/localization/validettaLang-es-ES.js"></script>
    <script src="./assets/js/confirm334/dist/jquery-confirm.min.js"></script>
    <script src="./assets/js/validar.js"></script>
	
</head>
<body>


<header>
<section id="encabezado">
    <div class="container">
        <img src="./imgs/header.png" class="responsive-img">
    </div>
</section>
</header>

   

    <main>
        <section id="contenidos">
             <div class="container">
                <div class="row">
                <h1 class="blue-grey-text center-align">Acceso</h1>
				<div class="container">
				<p class="red darken-1 white-text text-white center-align s6 l6"><?=$mensaje?></p>
			</div>
                <hr>
					
                        <form id="formObtComp" autocomplete="off" method="post" action="index.php">
                                
                            <div class="col s12 l6 input-field">
                               <i class="fa fa-at fa prefix"></i>
								<label for="correo">Correo electr&oacute;nico:</label>
								<input type="email"  id="correo" name="correo" data-validetta="required,email">
							</div>
							
							<div class="col s12 l6 input-field">
                               <i class="fa fa-key fa prefix"></i>
								<label for="clave">Contrase&ntilde;a:</label>
                                <input type="password" id="clave" name="clave" data-validetta="required">
                                <p>
                                    <label>
                                    <input type="checkbox" id="show">
                                    <span>Show Password</span>
                                    </label>
                                </p> 
                             </div>
							
							<div class="col s12 8 input-field  ">
								<input type="submit" class="btn blue darken-3" style="width:100%;" value="Iniciar sesi&oacute;n">
							</div>
							
                            <div class="col s6 m6 8 center-align">
                                    <a class="flow-text"  style="font-weight:bold"  href="servidor/crearCuenta.php"> Crear cuenta como profesor</a>
                            </div>
							
							<div class="col s6 m6 8 center-align">
                                    <a class="flow-text"  style="font-weight:bold"  href="servidor/agregarAdministrador.php"> Crear cuenta como administrador</a>
                            </div>
							
                            <div class="col s6 m6 8 center-align">
                                 <a class="flow-text"  style="font-weight:bold"  href="./recupera.php"> Recuperar Contrase&ntilde;a</a>
                             </div>
                                            
                               
                         </form>
					
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