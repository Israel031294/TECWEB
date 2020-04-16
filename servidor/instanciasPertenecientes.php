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
		
		$cantidad=$objeto->cantidadInstancias($idUsuario);
		$tabla=$objeto->traerInstancias($idUsuario);
		
		$identificadorRegistro=isset($_REQUEST["I"]) ? $_REQUEST["I"] : "0"; //nombreInstancia
		$nombreInstancia =  isset($_REQUEST["instancia"])  ? $_REQUEST["instancia"] : ""; //nombreInstancia
        $diaN =  isset($_REQUEST["diaIn"]) ? $_REQUEST["diaIn"] : ""; // dia Ingreso
        $mesN =  isset($_REQUEST["mesIn"]) ? $_REQUEST["mesIn"] : ""; //mes Ingreso
        $anioN =  isset($_REQUEST["anioIn"]) ? $_REQUEST["anioIn"] : ""; //anio Ingreso
		$oculto =  isset($_REQUEST["oculto"]) ? $_REQUEST["oculto"] : "";
		$receptor =  isset($_REQUEST["v"]) ? $_REQUEST["v"] : "";
		$respuesta="Instancias pertenecientes";	
		
		//receptores de parametros url
		$n =  isset($_REQUEST["n"])  ? $objeto->decodificaURL($_REQUEST["n"]) : ""; //instancia
        $l =  isset($_REQUEST["l"]) ? $objeto->decodificaURL($_REQUEST["l"]) : ""; //diaIn
        $o =  isset($_REQUEST["o"]) ? $objeto->decodificaURL($_REQUEST["o"]) : ""; //mesIn
        $h =  isset($_REQUEST["h"]) ? $objeto->decodificaURL($_REQUEST["h"]) : "";//anioIn
		
		if($receptor=="3"){
			$oculto="3"; // asignacion por URL
			$nombreInstancia =$n; 
			$diaN =$l;
			$mesN =$o; 
			$anioN =$h;
		}
		
		if($oculto!=""){
				$objeto->registraInstancia($idUsuario,$nombreInstancia,$diaN,$mesN,$anioN,$oculto,$identificadorRegistro);
				$cantidad=$objeto->cantidadInstancias($idUsuario);
				$tabla=$objeto->traerInstancias($idUsuario);
		}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar datos</title>
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

	<script>
            $(document).ready(function(){
                $('.datepicker').datepicker();
        
            });
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
						
                        <form id="formObtComp" autocomplete="off" method="post" action="instanciasPertenecientes.php">
                                
                                <div class="col s12 l6 input-field">
                                      <i class="fa fa-user fa prefix"></i>
                                      <label for="instancia">Instancia:</label>
                                      <input type="text"  required id="instancia" name="instancia" data-validetta="required,minLength[1],maxLength[50]">
                                </div>

                                  <div class="col s12 l6 input-field">
                                        
										<div class="row">
											<label>Dia de ingreso</label>
										   <select class="browser-default"  id="diaIn" name="diaIn" required>
											<option value="" disabled selected>Dia de ingreso</option>
											<?=$objeto->traerSelectDias($l)?>
										  </select>
										</div>
								  </div>
								  
								  <div class="col s12 l6 input-field">
										<div class="row">
											<label>Mes de nacimiento</label>
										   <select class="browser-default" id="mesIn" name="mesIn" required>
											<option value="" disabled selected>Escoge un mes</option>
											<?=$objeto->traerSelectMeses($o)?>
										  </select>
									  </div>
								  </div>
								  
								  <div class="col s12 l6 input-field">
                                        <label for="anioIn">A&ntilde;o de ingreso:</label>
                                        <input type="number"  required class="datepicker" id="anioIn" name="anioIn" data-validetta="required,number,minLength[4],maxLength[4]">
                                  </div>

                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="Guardar">
                                </div>
                                <div class="col s12 8 input-field ">
									<a href="./instanciasPertenecientes.php" class="btn red" style="width:100%;">CANCELAR</a>
                                </div>
								
								<input type="hidden" value="1" name="oculto">
                               
                         </form>
					<?php
						}else{
							if($receptor=="2") //actualizar
							{
					?>
								<form id="formObtComp" autocomplete="off" method="post" action="instanciasPertenecientes.php">
                                
                                <div class="col s12 l6 input-field">
                                      <i class="fa fa-user fa prefix"></i>
                                      <label for="instancia">Instancia:</label>
                                      <input type="text" value='<?=$n?>'  required id="instancia" name="instancia" data-validetta="required,minLength[1],maxLength[50]">
                                </div>

                                  <div class="col s12 l6 input-field">
                                        
										<div class="row">
											<label>Dia de ingreso</label>
										   <select class="browser-default"  id="diaIn" name="diaIn" required>
											<option value="" disabled selected>Dia de ingreso</option>
											<?=$objeto->traerSelectDias($l)?>
										  </select>
										</div>
								  </div>
								  
								  <div class="col s12 l6 input-field">
										<div class="row">
											<label>Mes de nacimiento</label>
										   <select class="browser-default" id="mesIn" name="mesIn" required>
											<option value="" disabled selected>Escoge un mes</option>
											<?=$objeto->traerSelectMeses($o)?>
										  </select>
									  </div>
								  </div>
								  
								  <div class="col s12 l6 input-field">
                                        <label for="anioIn">A&ntilde;o de ingreso:</label>
                                        <input type="number" value=<?=$h?>  required class="datepicker" id="anioIn" name="anioIn" data-validetta="required,number,minLength[4],maxLength[4]">
                                  </div>

                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="Actualizar">
                                </div>
                                <div class="col s12 8 input-field ">
									<a href="./instanciasPertenecientes.php" class="btn red" style="width:100%;">CANCELAR</a>
                                </div>
								
								<input type="hidden" value="2" name="oculto">
								<input type="hidden" value=<?=$identificadorRegistro?> name="I" >
                               
                         </form>
					<?php
							}else{ //tabla para operaciones anteriores y eliminar
					?>
								
								<a href='?v=1'>Agregar otra instancia</a> <br>
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