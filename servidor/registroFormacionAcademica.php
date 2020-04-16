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
		$idUsuario=$_SESSION["identificador"];
		$objeto = new Persona();
		$cantidad="";
		$tabla="";
		
		$cantidad=$objeto->cantidadFormaciones($idUsuario);
		$tabla=$objeto->traerFormaciones($idUsuario);
		
		$identificadorRegistro=isset($_REQUEST["I"]) ? $_REQUEST["I"] : "0"; //nombreInstancia
		$nivel =  isset($_REQUEST["nivel"])  ? $_REQUEST["nivel"] : ""; //niveldel curso
        $nombre =  isset($_REQUEST["nombrefa"]) ? $_REQUEST["nombrefa"] : ""; //  nombre del curso nivel
        $institucion =  isset($_REQUEST["institucion"]) ? $_REQUEST["institucion"] : ""; //Intitucion donde se cursó el nivel
        $pais =  isset($_REQUEST["pais"]) ? $_REQUEST["pais"] : ""; //País donde se curso el nivel
        $anio =  isset($_REQUEST["ano"]) ? $_REQUEST["ano"] : ""; //Anio de graducacion
        $cedula =  isset($_REQUEST["cedula"]) ? $_REQUEST["cedula"] : ""; //cedula profesional del nivel

		
		$oculto =  isset($_REQUEST["oculto"]) ? $_REQUEST["oculto"] : "";
		$receptor =  isset($_REQUEST["v"]) ? $_REQUEST["v"] : "";
		$respuesta="Formaci&oacute;n acad&eacute;mica";	
		
		//receptores de parametros url
		$n =  isset($_REQUEST["n"])  ? $objeto->decodificaURL($_REQUEST["n"]) : ""; //nivel
        $l =  isset($_REQUEST["l"]) ? $objeto->decodificaURL($_REQUEST["l"]) : ""; //nombre
        $o =  isset($_REQUEST["o"]) ? $objeto->decodificaURL($_REQUEST["o"]) : ""; //institucion
        $h =  isset($_REQUEST["h"]) ? $objeto->decodificaURL($_REQUEST["h"]) : "";//pais
		$z =  isset($_REQUEST["z"])  ? $objeto->decodificaURL($_REQUEST["z"]) : ""; //anio
        $w =  isset($_REQUEST["w"]) ? $objeto->decodificaURL($_REQUEST["w"]) : ""; //cedula
       
		
		if($receptor=="3"){
			$oculto="3"; // asignacion por URL
			$nivel = $n;
			$nombre = $l; 
			$institucion = $o;  
			$pais =  $h;
			$anio = $z;
			$cedula =  $w;
		}
		
		if($oculto!=""){
				$objeto->registraFormacion($idUsuario,$nivel,$nombre,$institucion,$pais,$anio,$cedula,$oculto,$identificadorRegistro);
				$cantidad=$objeto->cantidadFormaciones($idUsuario);
				$tabla=$objeto->traerFormaciones($idUsuario);
		}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formaci&oacute;n Acad&eacute;mica</title>
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
                    <h2 class="blue-grey-text center-align"><?=$respuesta?></h2>
             </div>
      </section>
    </header>

    <main>
        <section id="contenidos">
             <div class="container">
                <div class="row">
					<?php 
						if($cantidad=="0" or $receptor=="1"){ //registro
					?>
						
                        <form id="formObtComp" autocomplete="off" method="post" action="registroFormacionAcademica.php">
                                <div class="col s12 l6 input-field">
                                     <i class="fa fa-user-graduate fa prefix"></i>
                                     <label for="nivelObt">Nivel:</label>
                                     <input type="text" id="nivel" name="nivel" data-validetta="required">
                                </div>
                                
                                <div class="col s12 l6 input-field">
                                      <i class="fa fa-scroll fa prefix"></i>
                                      <label for="nombrefaObt">Nombre:</label>
                                      <input type="text" id="nombrefa" name="nombrefa" data-validetta="required">
                                </div>

                                <div class="col s12 l6 input-field">
                                        <i class="fa fa-building fa prefix"></i>
                                        <label for="institucionObt">Instituci&oacute;n:</label>
                                        <input type="text" id="institucion" name="institucion" data-validetta="required">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-flag-usa fa prefix"></i>
                                        <label for="paisObt">Pa&iacute;s:</label>
                                        <input type="text" id="pais" name="pais" data-validetta="required">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-calendar-alt fa prefix"></i>
                                        <label for="anocObt">A&ntilde;o:</label>
                                        <input type="text" id="ano" name="ano" data-validetta="required,number,minLength[4],maxLength[4]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-address-card fa prefix"></i>
                                        <label for="cedulaObt">C&eacute;dula:</label>
                                        <input type="text" id="cedula" name="cedula" data-validetta="required,number">
                                  </div>


                                
                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="GUARDAR">
                                   
                                </div>
                                <div class="col s12 8 input-field ">
                                   
                                    <a href="./menu.php" class="btn red" style="width:100%;">REGRESAR</a>
                                </div>
								<input type="hidden" value="1" name="oculto">

                        </form>        
					<?php
						}else{
							if($receptor=="2") //actualizar
							{
					?>
								<form id="formObtComp" autocomplete="off" method="post" action="registroFormacionAcademica.php">
                                <div class="col s12 l6 input-field">
                                     <i class="fa fa-user-graduate fa prefix"></i>
                                     <label for="nivelObt">Nivel:</label>
                                     <input type="text" value=<?=$n?> id="nivel" name="nivel" data-validetta="required">
                                     

                                </div>
                    
                                <div class="col s12 l6 input-field">
                                      <i class="fa fa-scroll fa prefix"></i>
                                      <label for="nombrefaObt">Nombre:</label>
                                      <input type="text" value=<?=$l?> id="nombrefa" name="nombrefa" data-validetta="required">
                                </div>

                                <div class="col s12 l6 input-field">
                                        <i class="fa fa-building fa prefix"></i>
                                        <label for="institucionObt">Instituci&oacute;n:</label>
                                        <input type="text" value=<?=$o?> id="institucion" name="institucion" data-validetta="required">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-flag-usa fa prefix"></i>
                                        <label for="paisObt">Pa&iacute;s:</label>
                                        <input type="text" value=<?=$h?> id="pais" name="pais" data-validetta="required">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-calendar-alt fa prefix"></i>
                                        <label for="anocObt">A&ntilde;o:</label>
                                        <input type="text" value=<?=$z?> id="ano" name="ano" data-validetta="required,number,minLength[4],maxLength[4]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-address-card fa prefix"></i>
                                        <label for="cedulaObt">C&eacute;dula:</label>
                                        <input type="text" value=<?=$w?> id="cedula" name="cedula" data-validetta="required,number">
                                  </div>


                                
                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="Actualizar">
                                   
                                </div>
                                <div class="col s12 8 input-field ">
                                   
                                    <a href="./menu.php" class="btn red" style="width:100%;">REGRESAR</a>
                                </div>
								<input type="hidden" value="2" name="oculto">
								<input type="hidden" value=<?=$identificadorRegistro?> name="I" >                           
                        </form>        
                               
                         
					<?php
							}else{ //tabla para operaciones anteriores y eliminar
					?>
								
								<a href='?v=1'>Agregar curso formativo</a> <br>
								<?=$tabla?>
					<?php
							}
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
