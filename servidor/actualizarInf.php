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
		$tabla="";
		
		$tabla=$objeto->traerInformacion($idUsuario);
		
		
		$nombre =  isset($_REQUEST["nombre"])  ? $_REQUEST["nombre"] : "";
        $paterno =  isset($_REQUEST["primAp"]) ? $_REQUEST["primAp"] : "";
		$materno =  isset($_REQUEST["segApObt"]) ? $_REQUEST["segApObt"] : "";
        $email =  isset($_REQUEST["correo"]) ?	$_REQUEST["correo"] : "";
        $tel =  isset($_REQUEST["tel"])? $_REQUEST["tel"] : "";
        $pass =  isset($_REQUEST["contrasena"]) ? $_REQUEST["contrasena"] : "";
        $diaN =  isset($_REQUEST["diaNac"]) ? $_REQUEST["diaNac"] : "";
        $mesN =  isset($_REQUEST["mesNac"]) ? $_REQUEST["mesNac"] : "";
        $anioN =  isset($_REQUEST["anioNac"]) ? $_REQUEST["anioNac"] : "";
		$puestoP =  isset($_REQUEST["puesto"]) ? $_REQUEST["puesto"] : "";
        $idInst =  isset($_REQUEST["numEmp"]) ? $_REQUEST["numEmp"] : "";
		$oculto =  isset($_REQUEST["oculto"]) ? $_REQUEST["oculto"] : "";
		$receptor =  isset($_REQUEST["v"]) ? $_REQUEST["v"] : "";

		$respuesta="Actualizar informaci&oacute;n";


		//receptores de parametros url
		$a =  isset($_REQUEST["a"])  ? $objeto->decodificaURL($_REQUEST["a"]) : ""; //numEmp
        $b =  isset($_REQUEST["b"]) ? $objeto->decodificaURL($_REQUEST["b"]) : ""; //puesto
        $c =  isset($_REQUEST["c"]) ? $objeto->decodificaURL($_REQUEST["c"]) : ""; //nombre
        $d =  isset($_REQUEST["d"]) ? $objeto->decodificaURL($_REQUEST["d"]) : "";//paterno
		$e =  isset($_REQUEST["e"])  ? $objeto->decodificaURL($_REQUEST["e"]) : ""; //materno
        $g =  isset($_REQUEST["g"]) ? $objeto->decodificaURL($_REQUEST["g"]) : ""; //dia
        $h =  isset($_REQUEST["h"]) ? $objeto->decodificaURL($_REQUEST["h"]) : "";//mes
        $i =  isset($_REQUEST["i"]) ? $objeto->decodificaURL($_REQUEST["i"]) : ""; //anio
        $j =  isset($_REQUEST["j"]) ? $objeto->decodificaURL($_REQUEST["j"]): ""; //correo
		$k =  isset($_REQUEST["k"]) ? $objeto->decodificaURL($_REQUEST["k"]) : ""; //telefono

		
		if($oculto!=""){
			$objeto->actualizaDatos($idUsuario,$nombre, $paterno, $materno, $email ,$tel,$diaN , $mesN,$anioN,$puestoP,$idInst);
			$tabla=$objeto->traerInformacion($idUsuario);
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
		<?=$cab->cabeceraP();?>
      <section id="encabezado">
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
						<?php 
							if($receptor=="1"){
						?>
				
                        <form id="formObtComp" autocomplete="off" method="post" action="actualizarInf.php">
                                <div class="col s12 l6 input-field">
                                     <i class="fa fa-address-card fa prefix"></i>
                                     <label for="numEmpObt">Num de Empleado:</label>
                                     <input type="text" value='<?=$a?>'  required id="numEmp" name="numEmp" data-validetta="required,number,minLength[8],maxLength[10]"> 
                                </div>
                    
                                <div class="col s12 l6 input-field">
                                      <i class="fa fa-user fa prefix"></i>
                                      <label for="nombreObt">Nombre:</label>
                                      <input type="text" value='<?=$c?>'  required id="nombre" name="nombre" data-validetta="required,minLength[2],maxLength[50]">
                                </div>

                                <div class="col s12 l6 input-field">
                                        <i class="fa fa-user fa prefix"></i>
                                        <label for="primApObt">Primer Apellido:</label>
                                        <input type="text" value='<?=$d?>'  required id="primAp" name="primAp" data-validetta="required,minLength[2],maxLength[50]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-user fa prefix"></i>
                                        <label for="segApObt">Segundo Apellido:</label>
                                        <input type="text" value='<?=$e?>' required id="segAp" name="segApObt" data-validetta="required,minLength[2],maxLength[50]">
                                  </div>

                                  <div class="col s12 l6 input-field">
								  
										<div class="row">
											<label>Dia de nacimiento</label>
										   <select class="browser-default"  id="diaNac" name="diaNac" required>
											<option value="" disabled selected>Dia de nacimiento</option>
											<?=$objeto->traerSelectDias($g)?>
										  </select>
										</div>
								  </div>
								  
								  <div class="col s12 l6 input-field">
										<div class="row">
											<label>Mes de nacimiento</label>
										   <select class="browser-default" id="mesNac" name="mesNac" required>
											<option value="" disabled selected>Escoge un mes</option>
											<?=$objeto->traerSelectMeses($h)?>
										  </select>
									  </div>
								  </div>
								  
								  <div class="col s12 l6 input-field">
                                        <i class="fa fa-calendar-alt fa prefix"></i>
                                        <label for="anioNac">A&ntilde;o de nacimiento:</label>
                                        <input type="number" value='<?=$i?>'  required class="datepicker" id="anioNac" name="anioNac" data-validetta="required,number,minLength[4],maxLength[4]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-wrench fa prefix"></i>
                                        <label for="puestoObt">Puesto:</label>
                                        <input type="text" value='<?=$b?>'  required id="puesto" name="puesto" data-validetta="required,minLength[1],maxLength[50]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-envelope fa prefix"></i>
                                        <label for="correoObt">Correo:</label>
                                        <input type="email" value='<?=$j?>'  required id="correo" name="correo" data-validetta="required,email,minLength[8],maxLength[10]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-phone fa prefix"></i>
                                        <label for="telObt">Tel/Cel:</label>
                                        <input type="number" value='<?=$k?>' required id="tel" name="tel" data-validetta="required,number,minLength[8],maxLength[13]">
                                  </div>
	
                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="Guardar">
                                   
                                </div>
                                <div class="col s12 8 input-field ">
									<a href="./actualizarInf.php" class="btn red" style="width:100%;">CANCELAR</a>
                                </div>
								
								<input type="hidden" value="1" name="oculto">
                               
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
<?php
	}else{
		header("location:../index.php");
	}
?>