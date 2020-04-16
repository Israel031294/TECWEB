<?php
	session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
	
	if($_SESSION["activada"]=="v"){
	include 'cabeceras.php';
  include 'PersonaA.php';
	$cab = new cabecera();
  $idUsuario=$_SESSION["identificador"];; //FUTURA VARIABLE DE SESION
    $objeto = new PersonaA();
    $cantidad="";
    $tabla="";
    
    $cantidad=$objeto->cantidadMembresia($idUsuario);

    $tabla=$objeto->traerMembresia($idUsuario);
    
    $identificadorMembresia=isset($_REQUEST["I"]) ? $_REQUEST["I"] : "0"; //nombreInstancia
    $organismo =  isset($_REQUEST["organismo"]) ? $_REQUEST["organismo"] : ""; //organismo
    $anios =  isset($_REQUEST["anios"]) ? $_REQUEST["anios"] : ""; //anios
    $nivelParticipacion =  isset($_REQUEST["nivelParticipacion"]) ? $_REQUEST["nivelParticipacion"] : ""; //nivelParticipacion
    $informacionRelevante =  isset($_REQUEST["informacionRelevante"]) ? $_REQUEST["informacionRelevante"] : ""; //informacion Relevante

    $oculto =  isset($_REQUEST["oculto"]) ? $_REQUEST["oculto"] : "";
    $receptor =  isset($_REQUEST["v"]) ? $_REQUEST["v"] : "";
    $respuesta="Membres&iacute;a o participaci&oacute;n"; 
    
    //receptores de parametros url
        $u =  isset($_REQUEST["u"])  ? $objeto->decodificaURL($_REQUEST["u"]) : ""; //organismo
        $z =  isset($_REQUEST["z"]) ? $objeto->decodificaURL($_REQUEST["z"]) : ""; //anios
        $l =  isset($_REQUEST["l"]) ? $objeto->decodificaURL($_REQUEST["l"]) : ""; //nivel de Participación
        $k =  isset($_REQUEST["k"]) ? $objeto->decodificaURL($_REQUEST["k"]) : "";//información Relevante

    
    if($receptor=="3"){
      $oculto="3"; // asignacion por URL
      $organismo = $u;
      $anios = $z; 
      $nivelParticipacion = $l;  
      $informacionRelevante =  $k;
    }
    
    if($oculto!=""){
       $respuesta= $objeto->registraMembresia($idUsuario,$organismo,$anios,$nivelParticipacion,$informacionRelevante,$oculto,$identificadorMembresia);
       echo($respuesta);
        $cantidad=$objeto->cantidadMembresia($idUsuario);
        $tabla=$objeto->traerMembresia($idUsuario);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Membres&iacute;a</title>
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

    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.dropdown-trigger');
        var instances = M.Dropdown.init(elems, options);
      });
      // Or with jQuery
      $('.dropdown-trigger').dropdown();
    </script>
   
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
                    <h4 class="blue-grey-text center-align">Membres&iacute;a o participaci&oacute;n en Colegios, C&aacute;maras, asociaciones cient&iacute;ficas o alg&uacute;n otro tipo de organismo profesional</h4>
                   
                    <hr>
             </div>
      </section>
    </header>


    <main>
        <section id="contenidos">
             <div class="container">
                <div class="row">
                    <?php
                      if($cantidad=="0" || $receptor=="1") {
                    ?>
                            <form id="formObtComp" autocomplete="off" method="post" action="membresia.php">
                                
                                                           <div class="col s12 20 input-field">
                                    <i class="fa fa-building fa prefix"></i>
                                    <label for="OrgObt">Organismo:</label>
                                    <input type="text" id="organismo" name="organismo" data-validetta="required,maxLength[50]">
                              </div>

                              <div class="col s12 l6 input-field">
                                    <i class="fa fa-calendar-alt fa prefix"></i>
                                    <label for="periodoObt">Periodo (n&uacute;mero de a&ntilde;os):</label>
                                    <input type="text" id="anios" name="anios" data-validetta="required,number,minLength[1],maxLength[2]">
                              </div>

                              <div class="col s12 l6 input-field">
                                    <i class="fa fa-arrow-alt-circle-up fa prefix"></i>
                                    <label for="partObt">Nivel de participaci&oacute;n (1- nivel m&iacute;nimo, 10- nivel m&aacute;ximo):</label>
                                    <input type="text" id="nivelParticipacion" name="nivelParticipacion" data-validetta="required,number,minLength[1],maxLength[2]">
                              </div>

                              <div class="input-field col s12 16">
                              		<label for="textarea1">Otra informaci&oacute;n relevante</label>
    							                <textarea id="informacionRelevante" name="informacionRelevante" rows="10" cols="40" class="materialize-textarea" data-validetta="required,maxLength[500]"></textarea>  										
    				                  </div> 
                            
                              <div class="col s12 8 input-field  ">
                                  <input type="submit" class="btn blue darken-3" style="width:100%;" value="GUARDAR">
                              </div>

                              <div class="col s12 8 input-field ">
                                  <a href="./membresia.php" class="btn red" style="width:100%;">CANCELAR</a>
                              </div>

                              <input type="hidden" value="1" name="oculto">
                      
                        </form>  
            <?php
            }else{
              if($receptor=="2") //actualizar
              {
            ?> 

                        <form id="formObtComp" autocomplete="off" method="post" action="membresia.php">
                                
                              <div class="col s12 20 input-field">
                                    <i class="fa fa-building fa prefix"></i>
                                    <label for="OrgObt">Organismo:</label>
                                    <input type="text" id="organismo" value='<?=$u?>' name="organismo" data-validetta="required,maxLength[50]">
                              </div>

                              <div class="col s12 l6 input-field">
                                    <i class="fa fa-calendar-alt fa prefix"></i>
                                    <label for="periodoObt">Periodo (n&uacute;mero de a&ntilde;os):</label>
                                    <input type="text" id="anios" value='<?=$z?>' name="anios" data-validetta="required,number,minLength[1],maxLength[2]">
                              </div>

                              <div class="col s12 l6 input-field">
                                    <i class="fa fa-arrow-alt-circle-up fa prefix"></i>
                                    <label for="partObt">Nivel de participaci&oacute;n (1- nivel m&iacute;nimo, 10- nivel m&aacute;ximo):</label>
                                    <input type="text" id="nivelParticipacion" value='<?=$l?>' name="nivelParticipacion" data-validetta="required,number,minLength[1],maxLength[2]">
                              </div>

                              <div class="input-field col s12 16">
                                  <label for="textarea1">Otra informaci&oacute;n relevante</label>
                                  <textarea id="informacionRelevante" value='<?=$k?>'name="informacionRelevante" rows="10" cols="40" class="materialize-textarea"><?php echo($k) ?></textarea>                     
                              </div>  

                            
                              <div class="col s12 8 input-field  ">
                                  <input type="submit" class="btn blue darken-3" style="width:100%;" value="Actualizar">
                              </div>

                              <div class="col s12 8 input-field ">
                                  <a href="./menu.html" class="btn red" style="width:100%;">CANCELAR</a>
                              </div>
                              <input type="hidden" value="2" name="oculto">
                              <input type="hidden" value=<?=$identificadorMembresia?> name="I">
                      
                        </form> 
                <?php
                  }else{ // tabla
                ?>                          
                      <br>
                      <div class="col s12 8" align="left">
                          <a href='?v=1'><i class="fas fa-plus fa-1x"></i></a>
                           <br>
					  </div>
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