<?php
		include 'cAdministrador.php';
		include 'cabeceras.php';
		$cab = new cabecera();
        $email =  isset($_REQUEST["correo"]) ?	$_REQUEST["correo"] : "";
        $pass =  isset($_REQUEST["contrasena"]) ? $_REQUEST["contrasena"] : "";
        $token =  isset($_REQUEST["token"]) ? $_REQUEST["token"] : "";
		$oculto =  isset($_REQUEST["oculto"]) ? $_REQUEST["oculto"] : "";
		$respuesta="";
		 
		if($oculto!=""){
			$objeto = new cAdministrador();
			$respuesta=$objeto->agregarAdministrador($email,$pass,$token);
			
		}else{
			$respuesta="Crear cuenta Administrador";	
		}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear cuenta Admin</title>
    <link href="../assets/lib/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="../assets/lib/materialize/css/materialize.min.css" rel="stylesheet">
    <link href="../assets/js/validetta101/dist/validetta.min.css" rel="stylesheet">
    <link href="../assets/css/estilos.css" rel="stylesheet" >
    <link href="../assets/js/confirm334/dist/jquery-confirm.min.css" rel="stylesheet">
    <script src="../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../assets/lib/materialize/js/materialize.min.js"></script>
    <script src="../assets/js/validetta101/dist/validetta.min.js"></script>
    <script src="../assets/js/validetta101/localization/validettaLang-es-ES.js"></script>
    <script src="../assets/js/confirm334/dist/jquery-confirm.min.js"></script>
    <script src="../assets/js/validar.js"></script>

	
</head>
<body>


    <header>
      <section id="encabezado">
			<?=$cab->cabeceraCrearCuentaA();?>

            <div class="container">
                    <h2 class="blue-grey-text center-align"><?=$respuesta?></h2>
                    <hr>
             </div>
      </section>
    </header>


    <main>
        <section id="contenidos">
             <div class="container">
                <div class="row">
                        <form id="formObtComp" autocomplete="off" method="post" action="agregarAdministrador.php">


                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-envelope fa prefix"></i>
                                        <label for="correoObt">Correo:</label>
                                        <input type="email"  id="correo" name="correo" data-validetta="required,email">
                                  </div>


                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-key fa prefix"></i>
                                        <label for="contasenaObt">Contrase&ntilde;a:</label>
                                        <input type="password"  required id="contrasena" name="contrasena" data-validetta="required,minLength[8],maxLength[50]">
                                  </div>
								  
								  <div class="col s12 l6 input-field">
                                        <i class="fa fa-key fa prefix"></i>
                                        <label for="contasenaObt">Token:</label>
                                        <input type="password"  required id="token" max="3" name="token" data-validetta="required,number,minLength[3],maxLength[3]">
                                  </div>

                                
                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="CREAR CUENTA">
                                   
                                </div>
								
								
                                <div class="col s12 8 input-field ">
									<a href="../index.php" class="btn red" style="width:100%;">CANCELAR</a>

                                </div>
								
								<input type="hidden" value="1" name="oculto">
                               
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