<?php
session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
	
	if($_SESSION["activada"]=="v")
	{
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
        include("../assets/lib/mpdf60/mpdf.php");
		include 'cAdministrador.php';

		$obj = new cAdministrador();
		
		// Introducimos HTML de prueba
		$identificador=isset($_REQUEST["Iu"]) ? $obj->decodificaURL($_REQUEST["Iu"]) : $_SESSION["identificador"];

		$htmlPINTADO='';
		$boleta="";
		$htmlPINTADO.='<html><head><link href="../assets/css/estilosM.css" rel="stylesheet"><link href="../assets/css/responsive.css" rel="stylesheet"></head><body>';
		$header='<div id="cabeza">
					<p id="pCabeza"><h2 id="hCabeza">ESCUELA SUPERIOR DE C&Oacute;MPUTO</h2></p>
		</div>';
		//DATOS DEL PROFESOR
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';

								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">Datos del profesor</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">No. Identificaci&oacute;n</th>
										  <th class="titulosTabla">Nombre</th>
										  <th class="titulosTabla">Apellido paterno</th>
										  <th class="titulosTabla">Apellido materno</th>
										  <th class="titulosTabla">Correo</th>
										  <th class="titulosTabla">Tel&eacute;fono</th>
									  </tr>
									</thead><tbody>';
								$mysqli = new mysqli("localhost","root","","curriculum");
								
								if($mysqli->set_charset("utf8")){
									
									$consulta="select * from profesores where idUsuario=?";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["idInstitucion"].'</td>';
											$boleta=$filas["idInstitucion"];
											$htmlPINTADO.='<td>'.$filas["nombre"].'</td>';
											$htmlPINTADO.='<td>'.$filas["paterno"].'</td>';
											$htmlPINTADO.='<td>'.$filas["materno"].'</td>';
											$htmlPINTADO.='<td>'.$filas["correo"].'</td>';
											$htmlPINTADO.='<td>'.$filas["telefono"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$retorno="No se conectó";
								}
							 $htmlPINTADO.='</tbody></table>';
						$htmlPINTADO.='</div>';	 
					 $htmlPINTADO.='</div>';
			 $htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';
			 
			 //************NACIMIENTOS y PUESTO EN LA INSTITUCION
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">Fecha de nacimiento y puesto en la instituci&oacute;n</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">D&iacute;a</th>
										  <th class="titulosTabla">Mes</th> 
										  <th class="titulosTabla">A&ntilde;o</th>
										  <th class="titulosTabla">Edad</th>
										  <th class="titulosTabla">Puesto en la instituci&oacute;n</th>
									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from nacimientos inner join puestosinstitucionales where nacimientos.idUsuario=puestosinstitucionales.idUsuario and nacimientos.idUsuario=?";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["dia"].'</td>';
											$htmlPINTADO.='<td>'.$filas["mes"].'</td>';
											$htmlPINTADO.='<td>'.$filas["anio"].'</td>';
											$htmlPINTADO.='<td>'.(2019-$filas["anio"]).'</td>';
											$htmlPINTADO.='<td>'.$filas["puesto"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$retorno="No se conectó";
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';
			
			
			 //************FORMACION ACADEMICA
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">Formaci&oacute;n acad&eacute;mica</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">Nivel</th>
										  <th class="titulosTabla">Nombre especialidad</th> 
										  <th class="titulosTabla">Insituci&oacute;n</th>
										  <th class="titulosTabla">Pa&iacute;s</th>
										  <th class="titulosTabla">A&ntilde;o de obtencion</th>
										  <th class="titulosTabla">C&eacute;dula profesional</th>
									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from formacionacademica where idUsuario=? order by anio asc";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["nivel"].'</td>';
											$htmlPINTADO.='<td>'.$filas["nombre"].'</td>';
											$htmlPINTADO.='<td>'.$filas["institucion"].'</td>';
											$htmlPINTADO.='<td>'.$filas["pais"].'</td>';
											$htmlPINTADO.='<td>'.$filas["anio"].'</td>';
											$htmlPINTADO.='<td>'.$filas["cedulaP"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$retorno="No se conectó";
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';

			//************CAPACITACIÓN DOCENTE 
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">Capacitaci&oacute;n docente</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">Tipo de capacitaci&oacute;n</th>
										  <th class="titulosTabla">Instituci&oacute;n</th>
										  <th class="titulosTabla">Pa&iacute;s</th>
										  <th class="titulosTabla">A&ntilde;o de obtencion</th>
										  <th class="titulosTabla">Horas invertidas</th>
									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from capacitaciondocente where idUsuario=? order by anio asc";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["tipoC"].'</td>';
											$htmlPINTADO.='<td>'.$filas["institucion"].'</td>';
											$htmlPINTADO.='<td>'.$filas["pais"].'</td>';
											$htmlPINTADO.='<td>'.$filas["anio"].'</td>';
											$htmlPINTADO.='<td>'.$filas["horas"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$htmlPINTADO.='TODO SE DERRUMBO DENTRO DE MI DENTRO DE MI';
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';
			
			//************ACTUALIZACION DISCIPLINAR
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">Actualizaci&oacute;n disciplinar</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">Tipo de capaitaci&oacute;n</th>
										  <th class="titulosTabla">Insituci&oacute;n</th>
										  <th class="titulosTabla">Pa&iacute;s</th>
										  <th class="titulosTabla">A&ntilde;o de obtencion</th>
										  <th class="titulosTabla">Horas invertidas</th>
									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from actualizaciond where idUsuario=? order by anio asc";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["tipoAct"].'</td>';
											$htmlPINTADO.='<td>'.$filas["institucion"].'</td>';
											$htmlPINTADO.='<td>'.$filas["pais"].'</td>';
											$htmlPINTADO.='<td>'.$filas["anio"].'</td>';
											$htmlPINTADO.='<td>'.$filas["horas"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$htmlPINTADO.='TODO SE DERRUMBO DENTRO DE MI DENTRO DE MI';
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';
			
			
			//************GESTION ACADEMICA
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">Gesti&oacute;n acad&eacute;mica</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">Actividad</th>
										  <th class="titulosTabla">Ingreso en</th>
										  <th class="titulosTabla">Finalizaci&oacute;n en</th>
									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from gestionacademica where idUsuario=? order by anio anioInicio";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["actividad"].'</td>';
											$htmlPINTADO.='<td>'.$filas["mesinicio"].' '.$filas["anioInicio"].'</td>';
											$htmlPINTADO.='<td>'.$filas["mesFinal"].' '.$filas["anioFinal"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$htmlPINTADO.='TODO SE DERRUMBO DENTRO DE MI DENTRO DE MI';
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';
			
			//************PRODUCTOS ACADEMICOS
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">Productos acad&eacute;micos relevantes</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">A&ntilde;o</th>
										  <th class="titulosTabla">Nombre del producto</th>
										  <th class="titulosTabla">Descripci&oacute;n</th>
									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from productosrelevantes where idUsuario=? order by anio";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["anio"].'</td>';
											$htmlPINTADO.='<td>'.$filas["nombre"].'</td>';
											$htmlPINTADO.='<td>'.$filas["descripcion"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$htmlPINTADO.='TODO SE DERRUMBO DENTRO DE MI DENTRO DE MI';
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';
			
			//************EXPERIENCIA PROFESIONAL NO ACADEMICA
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">Experiencia no acad&eacute;mica</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">Actividad</th>
										  <th class="titulosTabla">Empresa</th>
										  <th class="titulosTabla">Ingreso en</th>
										  <th class="titulosTabla">Finaliaci&oacute;n en</th>
									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from experiencianoacademica where idUsuario=?";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["actividad"].'</td>';
											$htmlPINTADO.='<td>'.$filas["empresa"].'</td>';
											$htmlPINTADO.='<td>'.$filas["mesinicio"].' '.$filas["anioInicio"].'</td>';
											$htmlPINTADO.='<td>'.$filas["mesFinal"].' '.$filas["anioFinal"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$htmlPINTADO.='TODO SE DERRUMBO DENTRO DE MI DENTRO DE MI';
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';
		
		//************EXPERIENCIA DISENIO INGENIERIL
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">Experiencia en dise&ntilde;o ingenieril</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">Organismo</th>
										  <th class="titulosTabla">Lugar</th>
										  <th class="titulosTabla">N&uacute;mero de a&ntilde;os</th>
										  <th class="titulosTabla">Nivel de experiencia</th>
									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from experienciadisenioingenieril where idUsuario=?";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["tipoExperiencia"].'</td>';
											$htmlPINTADO.='<td>'.$filas["lugar"].'</td>';
											$htmlPINTADO.='<td>'.$filas["numeroAnios"].'</td>';
											$htmlPINTADO.='<td>'.$filas["infAdicionar"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$htmlPINTADO.='TODO SE DERRUMBO DENTRO DE MI DENTRO DE MI';
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';
		
		//************LOGROS PROFESIONALES NO ACADEMICOS
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">Logros profesionales no academicos</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">A&ntilde;o</th>
										  <th class="titulosTabla">Nombre</th>
										  <th class="titulosTabla">Descripci&oacute;n</th>
									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from logrosprofesionales where idUsuario=? order by anio";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["anio"].'</td>';
											$htmlPINTADO.='<tr>'.'<td>'.$filas["nombre"].'</td>';
											$htmlPINTADO.='<td>'.$filas["descripcion"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$htmlPINTADO.='TODO SE DERRUMBO DENTRO DE MI DENTRO DE MI';
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';
			
			//************MEMBRESIAS
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">MEMBRESIAS</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">Nombre</th>
										  <th class="titulosTabla">A&ntilde;</th>
										  <th class="titulosTabla">Nivel participaci&oacute;n</th>
										  <th class="titulosTabla">Informaci&oacute;n</th>


									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from membresias where idUsuario=?";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["organismo"].'</td>';
											$htmlPINTADO.='<td>'.$filas["anios"].'</td>';
											$htmlPINTADO.='<td>'.$filas["nivelParticipacion"].'</td>';
											
											if($filas["informacionRelevante"]!=""){
												$htmlPINTADO.='<td>'.$filas["informacionRelevante"].'</td>';
											}else{
												$htmlPINTADO.='<td>No especificado</td>';
											}

											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$htmlPINTADO.='TODO SE DERRUMBO DENTRO DE MI DENTRO DE MI';
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';
			
			
			//************PREMIOS
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">PREMIOS</caption>
									<thead>
									  <tr>
										  <th class="titulosTabla">Nombre</th>
										  <th class="titulosTabla">A&ntilde;o</th>
										  <th class="titulosTabla">Descripci&oacute;n</th>
									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from premios where idUsuario=? order by anio asc";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["nombre"].'</td>';
											$htmlPINTADO.='<td>'.$filas["anio"].'</td>';
											$htmlPINTADO.='<td>'.$filas["descripcion"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$htmlPINTADO.='TODO SE DERRUMBO DENTRO DE MI DENTRO DE MI';
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br>';
			
		//************PARTICIPACION PROGRAMA DE ESTUDIOS
				$htmlPINTADO.='<div class="contenedor">';
						$htmlPINTADO.='<div class="fila">';
							$htmlPINTADO.='<div class="col-l-12">';
								$htmlPINTADO.='<table border=1>
									<caption class="table-caption-div">Participaci&oacute;n programa de estudios</caption>
									<thead>
									  <tr>
										<th class="titulosTabla">Nombre</th>
										  <th class="titulosTabla">Descripci&oacute;n</th>
									  </tr>
									</thead><tbody>';
									
								if($mysqli){
									$consulta="select * from participacionpe where idUsuario=?";
									if($preparaConsulta=$mysqli->prepare($consulta)){
										$preparaConsulta->bind_param('i', $identificador);
										$preparaConsulta->execute();
										$resultado = $preparaConsulta->get_result();
										while($filas = $resultado->fetch_assoc()){
											$htmlPINTADO.='<tr>'.'<td>'.$filas["nombre"].'</td>';
											$htmlPINTADO.='<tr>'.'<td>'.$filas["descripcion"].'</td>';
											$htmlPINTADO.='</tr>';
										}
									}
														
								}else{
									$htmlPINTADO.='TODO SE DERRUMBO DENTRO DE MI DENTRO DE MI';
								}
								$htmlPINTADO.='</tbody></table>';
							$htmlPINTADO.='</div>';
						$htmlPINTADO.='</div>';
			$htmlPINTADO.='</div>';
			$htmlPINTADO.='<br><br>';
			$htmlPINTADO .= "<barcode code='$boleta' size='1' type='QR' />";

		$htmlPINTADO.='</body></html>';
		$pie = "";
        $pie .= "<p>Escuela Superior de C&oacute;mputo";
		$mysqli->close();
		
		$mpdf=new mPDF("c","Letter","12","dejavusans",15,10,30,10,5,5);
        $mpdf->SetWatermarkText($boleta." -ESCOM / TWeb 200192-",0.1);
        $mpdf->showWatermarkText = true;
        
        $mpdf->SetHTMLHeader($header);
		$htmlPINTADO = utf8_encode($htmlPINTADO);
        $mpdf->WriteHTML($htmlPINTADO);
        $mpdf->SetHTMLFooter($pie);
        $mpdf->Output();
		$mpdf->charset_in='windows-1252';
        //$mpdf->Output("./../$boleta.pdf");


	
	}else{
		header("location:../index.php");
	}
?>