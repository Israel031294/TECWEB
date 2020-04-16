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
		
		$cantidad=$objeto->cantidadCursos($idUsuario);
		$tabla=$objeto->traerCursos($idUsuario);
		$identificadorRegistro=isset($_REQUEST["I"]) ? $_REQUEST["I"] : "0"; //nombreInstancia

        $idPeriodo =  isset($_REQUEST["periodo"]) ? $_REQUEST["periodo"] : "";
        $idNivel =  isset($_REQUEST["nivel"]) ? $_REQUEST["nivel"] : "";
        $nombreCurso =  isset($_REQUEST["curso"]) ? $_REQUEST["curso"] : "";
		$tipo =  isset($_REQUEST["tipo"]) ? $_REQUEST["tipo"] : "";
        $horasTotales =  isset($_REQUEST["horas"]) ? $_REQUEST["horas"] : "";

		$oculto =  isset($_REQUEST["oculto"]) ? $_REQUEST["oculto"] : "";
		$receptor =  isset($_REQUEST["v"]) ? $_REQUEST["v"] : "";
		$respuesta="Cursos";	

		//receptores de parametros url
		$n =  isset($_REQUEST["n"])  ? $objeto->decodificaURL($_REQUEST["n"]) : ""; //idPeriodo
        $l =  isset($_REQUEST["l"]) ? $objeto->decodificaURL($_REQUEST["l"]) : ""; //idNivel
        $o =  isset($_REQUEST["o"]) ? $objeto->decodificaURL($_REQUEST["o"]) : ""; //nombreCurso
        $h =  isset($_REQUEST["h"]) ? $objeto->decodificaURL($_REQUEST["h"]) : "";//tipo
		$j =  isset($_REQUEST["j"]) ? $objeto->decodificaURL($_REQUEST["j"]) : "";//horasTotalesS

		
		if($receptor=="3"){
			$oculto="3"; 
			$idPeriodo =$n; 
			$idNivel =$l;
			$nombreCurso=$o;  
			$tipo =$h; 
			$horasTotales =$j;
		}
		
		if($oculto!=""){
			
			$objeto->registraCurso($idUsuario,$idPeriodo,$idNivel,$nombreCurso,$tipo,$horasTotales,$oculto,$identificadorRegistro);
			$cantidad=$objeto->cantidadCursos($idUsuario);
			$tabla=$objeto->traerCursos($idUsuario);
		}
?>


<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cursos</title>
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
	
	<link rel="stylesheet" type="text/css" href="../assets/css/estilosM.css" />
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
		if($_SESSION["activadaA"] != "v"){//si no es la de administrador
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
                        <form id="formObtComp" autocomplete="off" method="post" action="cursos.php">
                                
                                <div class="col s12 l6 input-field">
                                       <?=$objeto->traerPeriodos("N")?>
								</div>

                                  <div class="col s12 l6 input-field">
                                        <?=$objeto->traerNiveles("N")?>
                                  </div>
								  
								  <div class="col s12 l6 input-field">
                                        <label for="curso">Nombre curso:</label>
                                        <input type="text"  required  id="curso" name="curso" data-validetta="required,minLength[1],maxLength[50]">
                                  </div>
								  
								  
								  <div class="col s12 l6 input-field">
                                        <label for="horas">Horas invertidas:</label>
                                        <input type="number"  required id="horas" name="horas" data-validetta="required,number,minLength[1],maxLength[3]">
                                  </div>
								  
								<div class="col s12 l6 input-field" id="cambio">
                                       <?=$objeto->traeSelectTipo("N")?>
								</div>

                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="Guardar">
                                </div>
                                <div class="col s12 8 input-field ">
									<a href="./menuLaboral.php" class="btn red" style="width:100%;">CANCELAR</a>
                                </div>
								
								<input type="hidden" value="1" name="oculto">
                               
                         </form>
					<?php
						}else{
							if($receptor=="2") //actualizar
							{
					?>
					
						<form id="formObtComp" autocomplete="off" method="post" action="cursos.php">
                                
                                <div class="col s12 l6 input-field">
                                         <?=$objeto->traerPeriodos($n)?>
								</div>

                                  <div class="col s12 l6 input-field">
                                        <?=$objeto->traerNiveles($l)?>
								  </div>
								  
								  <div class="col s12 l6 input-field">
                                        <label for="curso">Nombre curso:</label>
                                        <input type="text" value='<?=$o?>' required id="curso" name="curso" data-validetta="required,number,minLength[2],maxLength[50]">
                                  </div>
								  
								  
								  <div class="col s12 l6 input-field">
                                        <label for="horas">Horas invertidas:</label>
                                        <input type="number" value='<?=$j?>' required id="horas" name="horas" data-validetta="required,number,minLength[1],maxLength[3]">
                                  </div>
								  
								  <div class="col s12 l6 input-field" id="cambio">
                                        <?=$objeto->traeSelectTipo($h)?>
								  </div>

                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="Guardar">
                                </div>
                                <div class="col s12 8 input-field ">
									<a href="cursos.php" class="btn red" style="width:100%;">CANCELAR</a>
                                </div>
								<input type="hidden" value='<?=$identificadorRegistro?>' name="I" >

								<input type="hidden" value="2" name="oculto">
                               
                         </form>
						<?php
							}else{ //tabla para operaciones anteriores y eliminar
						?>
								a href='?v=1'>Agregar otro curso</a> <br>
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
<script src="../assets/js/funciones.js" type="text/javascript"></script>
<?php
	}else{
		header("location:../index.php");
	}
?>
