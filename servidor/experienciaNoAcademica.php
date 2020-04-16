<?php
	session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
	
	if($_SESSION["activada"]=="v"){
    include 'PersonaA.php';
	include 'cabeceras.php';
	$cab = new cabecera();
    //Si la variable existe y su valor no es nulo su valor es igual al request de otro modo es igual a su valor de sesion
    $idUsuario=$_SESSION["identificador"]; //FUTURA VARIABLE DE SESION
    $objeto = new PersonaA();
    $cantidad="";
    $tabla="";
    
    $cantidad=$objeto->cantidadExperienciaNA($idUsuario);

    $tabla=$objeto->traerExperienciaNA($idUsuario);
    
    $identificadorExperiencia=isset($_REQUEST["I"]) ? $_REQUEST["I"] : "0"; //nombreInstancia
        $actividad =  isset($_REQUEST["actividad"]) ? $_REQUEST["actividad"] : ""; //  actividad
        $organizacion =  isset($_REQUEST["organizacion"]) ? $_REQUEST["organizacion"] : ""; //organizacion o empresa
        $mesInicio =  isset($_REQUEST["mesInicio"]) ? $_REQUEST["mesInicio"] : ""; //mes de inicio
        $anioInicio =  isset($_REQUEST["anioInicio"]) ? $_REQUEST["anioInicio"] : ""; //año de inicio
        $mesFin =  isset($_REQUEST["mesFin"]) ? $_REQUEST["mesFin"] : ""; //mes de final
        $anioFin =  isset($_REQUEST["anioFin"]) ? $_REQUEST["anioFin"] : ""; //año de final
    
    $oculto =  isset($_REQUEST["oculto"]) ? $_REQUEST["oculto"] : "";
    $receptor =  isset($_REQUEST["v"]) ? $_REQUEST["v"] : "";
    $respuesta="Experiencia Profesional No acad&eacute;mica"; 
    
    //receptores de parametros url
        $a =  isset($_REQUEST["a"])  ? $objeto->decodificaURL($_REQUEST["a"]) : ""; //actividad
        $b =  isset($_REQUEST["b"]) ? $objeto->decodificaURL($_REQUEST["b"]) : ""; //empresa
        $c =  isset($_REQUEST["c"]) ? $objeto->decodificaURL($_REQUEST["c"]) : ""; //anio de inicio
        $d =  isset($_REQUEST["d"]) ? $objeto->decodificaURL($_REQUEST["d"]) : "";//mes de inicio
        $e =  isset($_REQUEST["e"])  ? $objeto->decodificaURL($_REQUEST["e"]) : ""; //anio final
        $g =  isset($_REQUEST["g"]) ? $objeto->decodificaURL($_REQUEST["g"]) : ""; //mesFinal final

    
    if($receptor=="3"){
      $oculto="3"; // asignacion por URL
      $actividad = $a;
      $organizacion = $b; 
      $mesInicio = $d;  
      $anioInicio =  $c;
      $mesFin = $g;
      $anioFin =  $e;
    }
    
    if($oculto!=""){
       $respuesta= $objeto->registraExperienciaNA($idUsuario,$actividad,$organizacion,$mesInicio,$anioInicio,$mesFin,$anioFin,$oculto,$identificadorExperiencia);
        $cantidad=$objeto->cantidadExperienciaNA($idUsuario);
        $tabla=$objeto->traerExperienciaNA($idUsuario);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Experiencia profesional NA</title>
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
                    <h2 class="blue-grey-text center-align"><?=$respuesta?> <br></h2>
                    <hr>
             </div>
      </section>
    </header>


    <main>
        <section id="contenidos">
             <div class="container">
                <div class="row">
                    <?php 
                      if($cantidad=="0" || $receptor=="1"){ //registro
                    ?>

                        <form id="formObtComp" autocomplete="off" method="post" action="experienciaNoAcademica.php">
                                <div class="col s12 16 input-field">
                                  
                                </div>

                                <div class="col s12 l6 input-field">
                                     <i class="fa fa-tools fa prefix"></i>
                                     <label for="actPuObt">Actividad o Puesto:</label>
                                     <input type="text" id="actividad" name="actividad" data-validetta="required,maxLength[50]">

                                </div>

                                <div class="col s12 l6 input-field">
                                      <i class="fa fa-building fa prefix"></i>
                                      <label for="OrgObt">Organizaci&oacute;n o empresa:</label>
                                      <input type="text" id="organizacion" name="organizacion" data-validetta="required, maxLength[50]">
                                </div>
                                <div class="col s12 16 input-field">
                                  
                                </div>


                                <div class="col s12 l6 input-field", class="row">
                                      <div class="row">
                                      <select class="browser-default" id="mesInicio" name="mesInicio" required>
                                      <option required value="" disabled selected> Mes de inicio </option>
                                      <?=$objeto->traerSelectMeses($l)?>
                                      </select>
                                      </div>
                                </div>

                                <div class="col s12 l6 input-field">
                                      <i class="fas fa-calendar-plus prefix"></i>
                                      <label for="anioIni">A&ntilde;o de inicio: </label>
                                      <input type="text" id="anioInicio" name="anioInicio" data-validetta="required,number,minLength[4], maxLength[4]">
                                </div> 

                                <div class="col s12 16 input-field">
                                  
                                </div>

                                <div class="col s12 l6 input-field", class="row">
                                      <div class="row">
                                      <select class="browser-default" id="mesFin" name="mesFin" required>
                                          <option required value="" disabled selected> Mes de t&eacute;rmino </option>
                                          <?=$objeto->traerSelectMeses($l)?>
                                       </select>
                                      </div>
                                </div>

                                

                                <div class="col s12 l6 input-field">
                                      <i class="fas fa-calendar-times prefix"></i>
                                      <label for="anioFin">A&ntilde;o de t&eacute;rmino: </label>
                                      <input type="text" id="anioFin" name="anioFin" data-validetta="required,number,minLength[4], maxLength[4]">
                                </div> 
                                  
                                <div class="col s2 16 input-field">
                                  
                                </div>
                                

                                
                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="GUARDAR">
                                   
                                </div>
                                <div class="col s12 8 input-field ">
                                   
                                        <a href="./experienciaNoAcademica.php" class="btn red" style="width:100%;">CANCELAR</a>
                                </div>
                               
                                 <input type="hidden" value="1" name="oculto">
                             
                        </form>    
                   <?php

            }else{
              if($receptor=="2") //actualizar
              {
          ?>
                <form id="formObtComp" autocomplete="off" method="post" action="experienciaNoAcademica.php">
                              <div class="col s12 16 input-field">
                                  
                                </div>

                                <div class="col s12 l6 input-field">
                                     <i class="fa fa-tools fa prefix"></i>
                                     <label for="actPuObt">Actividad o Puesto:</label>
                                     <input type="text" id="actividad" value='<?=$a?>' name="actividad" data-validetta="required,maxLength[50]">

                                </div>

                                <div class="col s12 l6 input-field">
                                      <i class="fa fa-building fa prefix"></i>
                                      <label for="OrgObt">Organizaci&oacute;n o empresa:</label>
                                      <input type="text" value='<?=$b?>' id="organizacion" name="organizacion" data-validetta="required,maxLength[50]">
                                </div>
                                <div class="col s12 16 input-field">
                                  
                                </div>


                                <div class="col s12 l6 input-field", class="row">
                                      <div class="row">
                                      <select class="browser-default" id="mesInicio" name="mesInicio" required>
                                      <option required value="" disabled selected> Mes de inicio </option>
                                      <?=$objeto->traerSelectMeses($d)?>
                                      </select>
                                      </div>
                                </div>

                                <div class="col s12 l6 input-field">
                                      <i class="fas fa-calendar-plus prefix"></i>
                                      <label for="anioIni">A&ntilde;o de inicio: </label>
                                      <input type="text" id="anioInicio" value='<?=$c?>' name="anioInicio" data-validetta="required,number,minLength[4], maxLength[4]">
                                </div> 

                                <div class="col s12 16 input-field">
                                  
                                </div>

                                <div class="col s12 l6 input-field", class="row">
                                      <div class="row">
                                      <select class="browser-default" id="mesFin" name="mesFin" required>
                                          <option required value="" disabled selected> Mes de t&eacute;rmino </option>
                                          <?=$objeto->traerSelectMeses($g)?>
                                       </select>
                                      </div>
                                </div>

                                

                                <div class="col s12 l6 input-field">
                                      <i class="fas fa-calendar-times prefix"></i>
                                      <label for="anioFin">A&ntilde;o de t&eacute;rmino: </label>
                                      <input type="text" id="anioFin" value='<?=$e?>' name="anioFin" data-validetta="required,number,minLength[4],maxLength[4]">
                                </div> 
                                  
                                <div class="col s2 16 input-field">
                                  
                                </div>

                                
                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="Actualizar">
                                   
                                </div>
                                <div class="col s12 8 input-field ">
                                    <a href="experienciaNoAcademica.php" class="btn red" style="width:100%;">CANCELAR</a>
                                </div>

                <input type="hidden" value="2" name="oculto">
                <input type="hidden" value=<?=$identificadorExperiencia?> name="I" >                           
                        </form>        
                               
                         
          <?php
              }else{ //tabla para operaciones anteriores y eliminar
          ?>
				<a href='?v=1'>Agregar experiencia no academica</a> <br>

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