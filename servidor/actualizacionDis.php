<?php
session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
	
	if($_SESSION["activada"]=="v"){
	include 'cCapacitacionActAdm.php';
	include 'cabeceras.php';
	$cab = new cabecera();

	$idUsuario = $_SESSION["identificador"];//variable de sesion
	$obj = new cCapacitacionActAdm();
	$res´= "";
	$idTabla;
	$tabla = "";
	$a = 0;//para la actualización
	$tipoForm = "Act";//para saber que formulario es
	
	$tipoC = "";
	$institucion = "";
	$pais = "";
	$anio = "";
	$horas = "";
	
	$tipoC = isset($_REQUEST["tipo"]) ? $_REQUEST["tipo"] : "";
	$institucion = isset($_REQUEST["institucion"]) ? $_REQUEST["institucion"] : "";
	$pais = isset($_REQUEST["pais"]) ? $_REQUEST["pais"] : "";
	$anio = isset($_REQUEST["anio"]) ? $_REQUEST["anio"] : "";
	$horas = isset($_REQUEST["horas"]) ? $_REQUEST["horas"] : "";
	$actualiza = isset($_REQUEST["actualiza"]) ? $_REQUEST["actualiza"] : "";
	$idCapacitacion = isset($_REQUEST["idCa"]) ? $_REQUEST["idCa"] : "";
	
	$a = isset($_REQUEST["a"]) ? $obj->decodificaURL($_REQUEST["a"]) : "0";//1 si es actualización
	$t = isset($_REQUEST["t"]) ? $obj->decodificaURL($_REQUEST["t"]) : "";//tipo
	$i = isset($_REQUEST["i"]) ? $obj->decodificaURL($_REQUEST["i"]) : "";//institucion
	$p = isset($_REQUEST["p"]) ? $obj->decodificaURL($_REQUEST["p"]) : "";//pais
	$h = isset($_REQUEST["h"]) ? $obj->decodificaURL($_REQUEST["h"]) : "";//horas
	$an = isset($_REQUEST["an"]) ? $obj->decodificaURL($_REQUEST["an"]) : "";//anio
	$idCap = isset($_REQUEST["idC"]) ? $obj->decodificaURL($_REQUEST["idC"]) : "";
	$e = isset($_REQUEST["e"]) ? $obj->decodificaURL($_REQUEST["e"]) : "";
	$A = isset($_REQUEST["A"]) ? $_REQUEST["A"] : "";
	
	
	
	if($e == 1){
		$res = "<h2>".$obj->borraCapacitacionActDis($idCap,$tipoForm)."</h2>";
	}else{
					if($actualiza == ""){
					$res = '<h2>'.$obj->agregaCapacitacionDocenteActDis($idUsuario,$tipoC,$institucion,$pais,$anio,$horas,$tipoForm)."</h2>";
					}else{
					$res = "<h2>".$obj->actualizacionCapacitacionActDis($idCapacitacion,$idUsuario,$tipoC,$institucion,$pais,$anio,$horas,$tipoForm)."</h2>";

				}

	}
	
	
	$idTabla = isset($_REQUEST["tl"]) ? $_REQUEST["tl"] : "";
	
	
	


	$tabla = $obj->tablaCapacitacionDocenteActDis($idUsuario,$tipoForm,$A);
	

	
	
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



   
</head>
<body>

	
    <header>
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
      <section id="encabezado">
            <div class="container">
                    <h5 class="blue-grey-text center-align">Actualizaci&oacute;n Disciplinar</h5>
                    <hr>
					
					<?=$res?>
					
             </div>
      </section>
    </header>
				

    <main>
        <section id="contenidos">
             <div class="container">
                <div class="row">
			<?php
					if($idTabla == 1){
				?>
						<?=$tabla?>
						
						
					<?php
					}else{
					?>
						<a href="?tl=1" class="waves-effect waves-light btn-small">Ver actualizaciones</a>

                        <form id="formObtComp" autocomplete="off" method = "POST" action = "actualizacionDis.php">
                                <div class="col s12 l6 input-field">
                                     <!--<i class="fa fa-paste fa prefix"></i>-->
									 <br>
									 <label for="institucionObt">Tipo:</label>
									 <br>
									 <select class="browser-default" name = "tipo" id = "tipo" required>
									 <div class = "row">
										<?=$obj->traerSelectDisciplina($t);?>
									</div>
									 </select>
                                    
                                </div>
                    
                            
                                <div class="col s12 l6 input-field">
                                        <i class="fa fa-building fa prefix"></i>
                                        <label for="institucionObt">Instituci&oacute;n:</label>
                                        <input type="text" required value="<?=$i?>" placeholder="Institución" id="institucion" name="institucion" data-validetta="required,minLength[2],maxLength[50]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-flag-usa fa prefix"></i>
                                        <label for="paisObt">Pa&iacute;s:</label>
                                        <input type="text" required value="<?=$p?>" placeholder = "País" id="pais" name="pais" data-validetta="required,minLength[2],maxLength[50]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-calendar-alt fa prefix"></i>
                                        <label for="anocObt">A&ntilde;o:</label>
                                        <input type="number" value="<?=$an?>" placeholder = "Año"id="anio" name="anio" min = "1970" max = "2019" data-validetta="required,number,minLength[4],maxLength[4]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-clock fa prefix"></i>
                                        <label for="horasObt">Horas:</label>
                                        <input type="text" required value="<?=$h?> "placeholder = "Horas" min = "1" max="800" id="horas" name="horas" data-validetta="required,number,minLength[1],maxLength[3]">
                                  </div>


                                
                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="GUARDAR">
                                   
                                </div>
										<?php
										if($a == 1){
										?>
                                <div class="col s12 8 input-field ">

											<a href = "?tl=1" class="btn red" style="width:100%;">CANCELAR</a>
											<input type = "hidden" value = "1" id = "actualiza" name = "actualiza"/><!--el quen os dice si es actualizacion-->
											<input type = "hidden" value = "<?=$idCap?>" id="idCa" name="idCa"/>
										<?php
										}else{
										?>
                                        <a href="./menu.php" class="btn red" style="width:100%;">CANCELAR</a>
										<?php
										}
										?>
                                </div>
                               <input type="hidden" value = "1" id="tl" name="tl"/> <!--el que activa la tabla-->
                               
                             
                        </form>     
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