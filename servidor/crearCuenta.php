<?php
		include 'Persona.php';
		include 'cabeceras.php';
		$cab = new cabecera();
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
		$respuesta="";
		
		if($oculto!=""){
			$objeto = new Persona();
			$respuesta=$objeto->registrarDatos(2,$nombre, $paterno, $materno, $email ,$tel, $pass ,$diaN , $mesN,$anioN,$puestoP,$idInst);
			
		}else{
			$respuesta="Crear cuenta";	
		}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear cuenta</title>
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
			<?=$cab->cabeceraCrearCuenta();?>

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
                        <form id="formObtComp" autocomplete="off" method="post" action="crearCuenta.php">
                                <div class="col s12 l6 input-field">
                                     <i class="fa fa-address-card fa prefix"></i>
                                     <label for="numEmpObt">Num de Empleado:</label>
                                     <input type="text"  required id="numEmp" name="numEmp" data-validetta="required,number,minLength[8],maxLength[10]"> 
                                </div>
                    
                                <div class="col s12 l6 input-field">
                                      <i class="fa fa-user fa prefix"></i>
                                      <label for="nombreObt">Nombre:</label>
                                      <input type="text"  required id="nombre" name="nombre" data-validetta="required">
                                </div>

                                <div class="col s12 l6 input-field">
                                        <i class="fa fa-user fa prefix"></i>
                                        <label for="primApObt">Primer Apellido:</label>
                                        <input type="text"  required id="primAp" name="primAp" data-validetta="required">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-user fa prefix"></i>
                                        <label for="segApObt">Segundo Apellido:</label>
                                        <input type="text"  required id="segAp" name="segApObt" data-validetta="required">
                                  </div>

                                  <div class="col s12 l6 input-field">
										<div class="row">
											<label>Dia de nacimiento</label>
										   <select class="browser-default"  id="diaNac" name="diaNac" required>
											<option value="" disabled selected>Dia de nacimiento</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
											<option value="31">31</option>

										  </select>
										</div>
								  </div>
									
									  <div class="col s12 l6 input-field">
										<div class="row">
											<label>Mes de nacimiento</label>
										   <select class="browser-default" id="mesNac" name="mesNac" required>
											<option value="" disabled selected>Escoge un mes</option>
											<option value="ENERO">ENERO</option>
											<option value="FEBRERO">FEBRERO</option>
											<option value="MARZO">MARZO</option>
											<option value="ABRIL">ABRIL</option>
											<option value="MAYO">MAYO</option>
											<option value="JUNIO">JUNIO</option>
											<option value="JULIO">JULIO</option>
											<option value="AGOSTO">AGOSTO</option>
											<option value="SEPTIEMBRE">SEPTIEMBRE</option>
											<option value="OCTUBRE">OCTUBRE</option>
											<option value="NOVIEMBRE">NOVIEMBRE</option>
											<option value="DICIEMBRE">DICIEMBRE</option>
										  </select>
										</div>
									  </div>
								  
								  <div class="col s12 l6 input-field">
                                        <i class="fa fa-calendar-alt fa prefix"></i>
                                        <label for="anioNac">A&ntilde;o de nacimiento:</label>
                                        <input type="text"   class="datepicker" id="anioNac" name="anioNac" data-validetta="required,number,minLength[4],maxLength[4]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-wrench fa prefix"></i>
                                        <label for="puestoObt">Puesto:</label>
                                        <input type="text"   id="puesto" name="puesto" data-validetta="required">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-envelope fa prefix"></i>
                                        <label for="correoObt">Correo:</label>
                                        <input type="email"   id="correo" name="correo" data-validetta="required,email">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-phone fa prefix"></i>
                                        <label for="telObt">Tel/Cel:</label>
                                        <input type="number"  id="tel" name="tel" data-validetta="required,number,minLength[8]">
                                  </div>

                                  <div class="col s12 l6 input-field">
                                        <i class="fa fa-key fa prefix"></i>
                                        <label for="contasenaObt">Contrase&ntilde;a:</label>
                                        <input type="text"  required id="contrasena" name="contrasena" data-validetta="required,minLength[8],maxLength[50]">
                                  </div>

                                
                                <div class="col s12 8 input-field  ">
                                    <input type="submit" class="btn blue darken-3" style="width:100%;" value="CREAR CUENTA">
                                   
                                </div>
								
								
                                <div class="col s12 8 input-field ">
									<a href="./menuLaboral.php" class="btn red" style="width:100%;">REGRESAR</a>
                                </div>
								
								<input type="hidden" value="1" name="oculto">
                               
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