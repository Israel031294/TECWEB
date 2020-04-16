<?php
   session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
	
	if($_SESSION["activada"]=="v")
	{
		include 'Persona.php';
		include 'cabeceras.php';
		$cab = new cabecera();
		//Si la variable existe y su valor no es nulo su valor es igual al request de otro modo es igual a su valor de sesion
		if($_SESSION["idAdministrador"] != ""){
			$idUsuario=$_SESSION["idAdministrador"];
		}else{
				$idUsuario=$_SESSION["identificador"];
		}
		
		$objeto = new Persona();

	   $actual =  isset($_REQUEST["actual"])  ? $_REQUEST["actual"] : ""; //correo
	   $nueva =  isset($_REQUEST["nueva"]) ? $_REQUEST["nueva"] : ""; //clave
	   $mensaje="";
	   $color="";
	   
	   
	   if($actual!="" && $nueva!=""){
		   
				$resultado=$objeto->cambiaClave($idUsuario,$actual,$nueva);
				
				if($resultado=="0"){
					$mensaje="Las clave actual no es correcta";
					$color="red darken-1 white-text text-white center-align s6 l6";
				}else{
					if($resultado=="1"){
						$mensaje="Clave actualizada";
						$color="teal accent-3 white-text text-white center-align s6 l6";
					}else{
						$mensaje=$resultado;
						$color="red darken-1 white-text text-white center-align s6 l6";
					}
					
				}
				
		}
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cambio clave</title>
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
	  <?php
			if($_SESSION["activadaA"] != "v"){
	  ?>
			<?=$cab->cabeceraP();?>
		<?php
			}else{
		?>
		<?=$cab->cabeceraA();?>
		<?php
			}
		?>
            <div class="container">
                    <h2 class="blue-grey-text center-align">Cambio de clave</h2>
             </div>
			 <div class="container">
				<p class="<?=$color?>"><?=$mensaje?></p>
			</div>
      </section>
    </header>


    <main>
        <section id="contenidos">
             <div class="container">
                <div class="row">
					
                        <form id="formObtComp" autocomplete="off" method="post" action="cambiarClave.php">
                             
							 
                            <div class="col s12 l12 input-field">
								<label for="correo">Clave actual</label>
								<input type="password"  required  id="actual" name="actual" data-validetta="required,minLength[8],maxLength[50]">
							</div>
							
							
							<div class="col s12 l12 input-field">
								<label for="clave">Clave nueva</label>
								<input type="password"  required  id="nueva" name="nueva" data-validetta="required,minLength[8],maxLength[50]">
							</div>
							
							<div class="col s12 8 input-field  ">
								<input type="submit" class="btn blue darken-3" style="width:100%;" value="Guardar">
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
<?php
	}else{
		header("location:../index.php");
	}
?>