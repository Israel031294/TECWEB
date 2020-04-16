<?php

	session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
	
	if($_SESSION["activada"]=="v")
	{
		include 'productos.php';
		include 'cabeceras.php';
		$cab = new cabecera();
		//Si la variable existe y su valor no es nulo su valor es igual al request de otro modo es igual a su valor de sesion
		$idUsuario=$_SESSION["identificador"];
		$objeto = new productos();
		$cantidad="";
		$tabla="";
		
		$cantidad=$objeto->cantidadEDI($idUsuario);
		$tabla=$objeto->traerEDI($idUsuario);
		
		$identificadorRegistro=isset($_REQUEST["I"]) ? $_REQUEST["I"] : "0"; //nombreInstancia
		$org =  isset($_REQUEST["org"])  ? $_REQUEST["org"] : ""; //organismo
        $lugar =  isset($_REQUEST["lugar"]) ? $_REQUEST["lugar"] : ""; // lugar
        $per =  isset($_REQUEST["periodo"]) ? $_REQUEST["periodo"] : ""; //periodo
        $exp =  isset($_REQUEST["exp"]) ? $_REQUEST["exp"] : ""; //exp
		$oculto =  isset($_REQUEST["oculto"]) ? $_REQUEST["oculto"] : "";
		$receptor =  isset($_REQUEST["v"]) ? $_REQUEST["v"] : "";
		$respuesta="Experiencia en dise&ntilde;o ingenieril";	
		
		//receptores de parametros url
		$n =  isset($_REQUEST["n"])  ? $objeto->decodificaURL($_REQUEST["n"]) : ""; //organismo
        $l =  isset($_REQUEST["l"]) ? $objeto->decodificaURL($_REQUEST["l"]) : ""; //lugar
        $o =  isset($_REQUEST["o"]) ? $objeto->decodificaURL($_REQUEST["o"]) : ""; //periodo
        $e =  isset($_REQUEST["e"]) ? $objeto->decodificaURL($_REQUEST["e"]) : ""; //experiencia
       
       
		
		if($receptor=="3"){
			$oculto="3"; // asignacion por URL
			$org = $n;
			$lugar = $l; 
            $per = $o; 
            $exp=$e; 
			
		}
		
		if($oculto!=""){
      $respuesta=$objeto->registraEDI($idUsuario,$org,$lugar,$per,$exp,$identificadorRegistro,$oculto);
	   $cantidad=$objeto->cantidadEDI($idUsuario);
	  $tabla=$objeto->traerEDI($idUsuario);
		}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Experiencia en dise&ntilde;o ingenieril</title>

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
                    <h5 class="blue-grey-text center-align">Las actividades o puestos van en orden cronol&oacute;gico, primero la m&aacute;s reciente (o actual) y de &uacute;ltimo la m&aacute;s antigua. </h5>
                    <hr>
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
                        <form id="formObtComp" autocomplete="off" method="post" action="expDisIng.php">
                               
                            
                                <div class="col s12 l6 input-field">
                                        <i class="fa fa-building fa prefix"></i>
                                        <label for="orgObt">Organismo:</label>
                                        <input type="text" id="org" name="org" data-validetta="required,minLength[1],maxLength[50]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-globe-americas fa prefix"></i>
                                        <label for="lugarObt">Lugar:</label>
                                        <input type="text" id="lugar" name="lugar" data-validetta="required,minLength[1],maxLength[50]">
                                  </div>


                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-calendar-alt fa prefix"></i>
                                        <label for="periodoObt">Periodo(a&ntilde;os):</label>
                                        <input type="text" id="periodo" name="periodo" data-validetta="required,number,minLength[1],maxLength[3]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-arrow-alt-circle-up fa prefix"></i>
                                        <label for="expObt">Nivel de experiencia:</label>
                                        <input type="text" id="exp" name="exp" data-validetta="required,minLength[1],maxLength[50]">
                                  </div>

                                
                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="GUARDAR">
                                   
                                </div>
                                <div class="col s12 8 input-field ">
                                   
                                        <a href="expDisIng.php" class="btn red" style="width:100%;">CANCELAR</a>
                                </div>
                                <input type="hidden" value="1" name="oculto">
                                 
                             
                        </form>        
                        <?php
                            }else{
                              if($receptor=="2") //actualizar
                              {
                          ?>

           <form id="formObtComp" autocomplete="off" method="post" action="expDisIng.php">
                               
                            
                               <div class="col s12 l6 input-field">
                                       <i class="fa fa-building fa prefix"></i>
                                       <label for="orgObt">Organismo:</label>
                                       <input type="text" value='<?=$n?>' id="org" name="org" data-validetta="required,minLength[1],maxLength[50]">
                                 </div>

                                 <div class="col s12 l6 input-field">
                                       <i class="fa fa-globe-americas fa prefix"></i>
                                       <label for="lugarObt">Lugar:</label>
                                       <input type="text" id="lugar" value='<?=$l?>' name="lugar" data-validetta="required,minLength[1],maxLength[50]">
                                 </div>


                                 <div class="col s12 l6 input-field">
                                       <i class="fa fa-calendar-alt fa prefix"></i>
                                       <label for="periodoObt">Periodo(a&ntilde;os):</label>
                                       <input type="text" id="periodo" value='<?=$o?>' name="periodo" data-validetta="required,minLength[1],maxLength[3]">
                                 </div>

                                 <div class="col s12 l6 input-field">
                                       <i class="fa fa-arrow-alt-circle-up fa prefix"></i>
                                       <label for="expObt">Nivel de experiencia:</label>
                                       <input type="text" id="exp" value='<?=$e?>' name="exp" data-validetta="required,minLength[1],maxLength[50]">
                                 </div>

                               
                               <div class="col s12 8 input-field  ">
                                   <input type="submit" class="btn blue darken-3" style="width:100%;" value="ACTUALIZAR">
                                  
                               </div>
                               <div class="col s12 8 input-field ">
                                  
                                       <a href="expDisIng.php" class="btn red" style="width:100%;">CANCELAR</a>
                               </div>
                               <input type="hidden" value="2" name="oculto">
			                	<input type="hidden" value=<?=$identificadorRegistro?> name="I" >
                            
                       </form>     
                       
                       
                       <?php
							}else{ //tabla para operaciones anteriores y eliminar
					?>
								
								<a href='?v=1'>Agregar experiencia en dise&ntilde;o ingenieril</a> <br>
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