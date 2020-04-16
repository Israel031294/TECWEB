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
		
		$cantidad=$objeto->cantidadContratacion($idUsuario);
		$tabla=$objeto->traerContratacion($idUsuario);

		$categoria =  isset($_REQUEST["categoria"])  ? $_REQUEST["categoria"] : "";
        $diaN =  isset($_REQUEST["diaIn"]) ? $_REQUEST["diaIn"] : "";
        $mesN =  isset($_REQUEST["mesIn"]) ? $_REQUEST["mesIn"] : "";
        $anioN =  isset($_REQUEST["anioIn"]) ? $_REQUEST["anioIn"] : "";
		$oculto =  isset($_REQUEST["oculto"]) ? $_REQUEST["oculto"] : "";
		$receptor =  isset($_REQUEST["v"]) ? $_REQUEST["v"] : "";
		$respuesta="Contrataci&oacute;n actual";
		
		//receptores de parametros url
		$n =  isset($_REQUEST["n"])  ? $objeto->decodificaURL($_REQUEST["n"]) : ""; //categoria
        $l =  isset($_REQUEST["l"]) ? $objeto->decodificaURL($_REQUEST["l"]) : ""; //diaIn
        $o =  isset($_REQUEST["o"]) ? $objeto->decodificaURL($_REQUEST["o"]) : ""; //mesIn
        $h =  isset($_REQUEST["h"]) ? $objeto->decodificaURL($_REQUEST["h"]) : "";//anioIn
		
		if($oculto!=""){
				$objeto->registraCA($idUsuario,$categoria,$diaN,$mesN,$anioN,$oculto);
				$cantidad=$objeto->cantidadContratacion($idUsuario);
				$tabla=$objeto->traerContratacion($idUsuario);
		}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contrataci&oacute;n Actual</title>
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
	<link rel="stylesheet" type="text/css" href="../assets/css/estilosM.css"/>


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
						if($cantidad=="0" || $receptor=="2"){
					?>
                        <form id="formObtComp" autocomplete="off" method="post" action="contratacionActual.php">
                                
                                <div class="col s12 l12 input-field" id="cambio">
                                      
									 <?php
										if($cantidad=="0")
										{
									  ?>
										<?=$objeto->traerCategoriaActual("1")?>
									<?php
										}else{
										?>
											<?=$objeto->traerCategoriaActual($n)?>

										<?php
										}
										?>
								</div>

                                  <div class="col s12 l12 input-field">
										<div class="row">
										<label>Día de ingreso</label>
										<select class="browser-default" id="diaIn" name="diaIn" required>
										<option value="" disabled selected>Dia de ingreso</option>
									<?php
										if($cantidad=="0")
										{
									 ?>
											<?=$objeto->traerSelectDias($l)?>
									<?php
										}else{
									?>
											<?=$objeto->traerSelectDias($l)?>
									<?php
										}
									?>
										  </select>
										</div>

								  </div>
								  
								  <div class="col s12 l12 input-field">
                                       <div class="row">
										<label>Mes de ingreso</label>
										<select class="browser-default" id="mesIn" name="mesIn" required>
										<option value="" disabled selected>Mes de ingreso</option>
									<?php
										if($cantidad=="0")
										{
									 ?>
											<?=$objeto->traerSelectMeses($o)?>
									 <?php
										}else{
									?>
											<?=$objeto->traerSelectMeses($o)?>

									<?php
										}
									?>
										  </select>
									</div>
                                  </div>
								  
								  <div class="col s12 l12 input-field">
                                        <label for="anioIn">A&ntilde;o de ingreso:</label>
										
										<?php
										if($cantidad=="0")
										{
									 ?>
                                        <input type="number"  required class="datepicker" id="anioIn" name="anioIn" data-validetta="required,number,minLength[4],maxLength[4]">
									 <?php
										}else{
									?>
                                        <input type="number" value='<?=$h?>'  required class="datepicker" id="anioIn" name="anioIn" data-validetta="required,number,minLength[4],maxLength[4]">

									<?php
										}
									?>
                                  </div>

   
								<?php
									if($cantidad=="0"){ //preparamos oculto para registrar
								?>
									<input type="hidden" value="1" name="oculto">
									<div class="col s12 8 input-field  ">
										<input type="submit" class="btn blue darken-3" style="width:100%;" value="Guardar">
									</div>
								<?php 
									}else{ // preparamos oculto para actualizar
								?>
									<input type="hidden" value="2" name="oculto">
									<div class="col s12 8 input-field  ">
										<input type="submit" class="btn blue darken-3" style="width:100%;" value="Actualizar">
									</div>
								<?php
									}
								?>
								
								<div class="col s12 8 input-field ">
									<a href="menuLaboral.php" class="btn red" style="width:100%;">CANCELAR</a>
                                </div>
                               
                         </form>
					<?php
						}else{
					?>
								<?=$tabla?>
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
<script src="../assets/js/funciones.js" type="text/javascript"></script>
<?php
	}else{
		header("location:../index.php");
	}
?>
