<?php


class Persona
{ 
	

    public function registrarDatos($idTipoU, $username, $pat, $mat, $email ,$tel, $pass ,$diaN , $mesN,$anioN,$puestoP,$idInst)
    {
		$retorno="";
		if($idTipoU!="" and $username!="" and $pat!="" and $mat!="" and $email !="" and $tel!="" and $pass !="" and $diaN !="" and $mesN!="" and $anioN!="" and $puestoP!="" and $idInst!="")
		{
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call registraUsuario('$idTipoU','$username','$pat','$mat','$email','$tel','$pass','$diaN','$mesN','$anioN','$puestoP','$idInst');";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
					
					/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
					$fila = mysqli_fetch_assoc($resultado);

					/* Ahora liberamos el resultado y continuamos con nuestro script */
					mysqli_free_result($resultado);
					$retorno=$fila['respuesta'];
					
						if($retorno=="0"){
							$retorno="<font color='green'>Cuenta registrada</font>";
						}else{
							$retorno="<font color='red'>Cuenta ya existente</font>";
						}
					
					$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		}else{
				$retorno="<font color='red'>Falta llenar campos</font>";
		}
		return $retorno;
	}
																		//1=guarda,2=actualiza
	public function registraCA($idUsuario,$categoria,$diaN,$mesN,$anioN,$operacion)
    {
		$retorno="";
		if($categoria!="" and $diaN !="" and $mesN!="" and $anioN!="")
		{
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call registraContratacionActual('$idUsuario','$categoria','$diaN','$mesN','$anioN','$operacion');";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
					
					/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
					$fila = mysqli_fetch_assoc($resultado);

					/* Ahora liberamos el resultado y continuamos con nuestro script */
					mysqli_free_result($resultado);
					$retorno=$fila['respuesta'];
					
					$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		}else{
				$retorno="<font color='red'>Falta llenar campos</font>";
		}
		return $retorno;
	}
	
	
	public function cantidadContratacion($idUsuario)
    {
		$retorno="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call cantidadContrataciones('$idUsuario');";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
					
					/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
					$fila = mysqli_fetch_assoc($resultado);
					/* Ahora liberamos el resultado y continuamos con nuestro script */
					mysqli_free_result($resultado);
					$retorno=$fila['respuesta'];
					$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		return $retorno;
	}
	
	public function traerContratacion($idUser){
		
		$retorno="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="select * from contratacionActual where idUsuario='$idUser';";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
						
								$retorno = "<div class=\"container\"><table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
								$retorno =$retorno."<tr>";
									$retorno = $retorno."<th>Categoria</th>";
									$retorno = $retorno."<th>Día de ingreso</th>";
									$retorno = $retorno."<th>Mes de ingreso</th>";
									$retorno = $retorno."<th>A&ntilde;o de ingreso</th>";
									$retorno = $retorno."<th>Actualizar</th>";
								$retorno = $retorno."</tr>";
					
						/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
						while($fila=mysqli_fetch_assoc($resultado)){
							$retorno = $retorno."<tr>";

								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['categoria'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['diaIngreso'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['mesIngreso'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['anioIngreso'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									  $retorno = $retorno.'<a href='.'?v=2&n='.$this->codificaURL($fila['categoria']).'&l='.$this->codificaURL($fila['diaIngreso']).'&o='.$this->codificaURL($fila['mesIngreso']).'&h='.$this->codificaURL($fila['anioIngreso']).'>Modificar</a>';
								$retorno = $retorno."</td>";
							  
							  $retorno = $retorno."</tr>";
							}
							 $retorno = $retorno."</table></div>";
						
									
						$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		return $retorno;
		
	}
	
	public function registraInstancia($idUsuario,$nombreInstancia,$diaN,$mesN,$anioN,$operacion,$idRegistro)
    {
		$retorno="";
		if($nombreInstancia!="" and $diaN !="" and $mesN!="" and $anioN!="")
		{
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call registraInstancia('$idUsuario','$nombreInstancia','$diaN','$mesN','$anioN','$operacion','$idRegistro');";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
					
					/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
					$fila = mysqli_fetch_assoc($resultado);

					/* Ahora liberamos el resultado y continuamos con nuestro script */
					mysqli_free_result($resultado);
					$retorno=$fila['respuesta'];
					
					$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		}else{
				$retorno="<font color='red'>Falta llenar campos</font>";
		}
		return $retorno;
	}
	
	public function cantidadInstancias($idUsuario)
    {
		$retorno="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call cantidadInstancias('$idUsuario');";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
					
					/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
					$fila = mysqli_fetch_assoc($resultado);
					/* Ahora liberamos el resultado y continuamos con nuestro script */
					mysqli_free_result($resultado);
					$retorno=$fila['respuesta'];
					$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		return $retorno;
	}
	
	
	public function registraCurso($idUsuario,$idPeriodo,$idNivel,$nombreCurso,$tipo,$horasTotales,$operacion,$idReg)
    {
		$retorno="";
				
		if($idPeriodo!=""  and $idNivel!=""  and $nombreCurso!=""  and  $tipo!=""  and $horasTotales!=""  and $operacion!="")
		{
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call registraCursosImpartidos('$idUsuario','$idPeriodo','$idNivel','$nombreCurso','$tipo','$horasTotales','$operacion','$idReg');";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
					
					/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
					$fila = mysqli_fetch_assoc($resultado);

					/* Ahora liberamos el resultado y continuamos con nuestro script */
					mysqli_free_result($resultado);
					$retorno=$fila['respuesta'];
					
					$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		}else{
				$retorno="<font color='red'>Falta llenar campos</font>";
		}
		return $retorno;
	}
	public function traerCursos($idUser){
		$PeriodoV="";	
		$retorno="";
		$NivelV="";
		
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="select * from cursosImpartidos where idUsuario='$idUser';";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
						
								$retorno = "<div class=\"container\"><table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
								$retorno =$retorno."<tr>";
									$retorno = $retorno."<th>Periodo</th>";
									$retorno = $retorno."<th>Nivel</th>";
									$retorno = $retorno."<th>Nombre curso</th>";
									$retorno = $retorno."<th>Tipo</th>";
									$retorno = $retorno."<th>Horas invertidas</th>";
									$retorno = $retorno."<th>Actualizar</th>";
									$retorno = $retorno."<th>Eliminar</th>";
								$retorno = $retorno."</tr>";
					
						/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
						while($fila=mysqli_fetch_assoc($resultado)){
							$retorno = $retorno."<tr>";
									
									if($fila['idPeriodo']=="1"){
										$PeriodoV="2014-2015";	
									}else{
										if($fila['idPeriodo']=="2"){
											$PeriodoV="2015-2016";	
										}
									}
									
									if($fila['idNivel']=="1"){
										$NivelV="LICENCIATURA";
									}else{
										if($fila['idNivel']=="2"){
											$NivelV="POSGRADO";
										}
									}
	
								$retorno = $retorno."<td>";
									$retorno = $retorno.$PeriodoV;
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$NivelV;
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['nombreCurso'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['tipo'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['horasTotales'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									  $retorno = $retorno.'<a href='.'?v=2&n='.$this->codificaURL($fila['idPeriodo']).'&l='.$this->codificaURL($fila['idNivel']).'&o='.$this->codificaURL($fila['nombreCurso']).'&h='.$this->codificaURL($fila['tipo']).'&I='.$fila['idCurso'].'&j='.$this->codificaURL($fila['horasTotales']).'>Modificar</a>';
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									  $retorno = $retorno."<a onclick=\"return confirm('¿Seguro de eliminar informacion?')\"".' href='.'?v=3&n='.$this->codificaURL($fila['idPeriodo']).'&l='.$this->codificaURL($fila['idNivel']).'&o='.$this->codificaURL($fila['nombreCurso']).'&h='.$this->codificaURL($fila['tipo']).'&j='.$this->codificaURL($fila['horasTotales']).'>Eliminar</a>';
								$retorno = $retorno."</td>";
							  
							  $retorno = $retorno."</tr>";
							}
							 $retorno = $retorno."</table></div>";
						
									
						$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		return $retorno;
		
	}
	
	public function cantidadCursos($idUsuario)
    {
		$retorno="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call cantidadCursos('$idUsuario');";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
					
					/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
					$fila = mysqli_fetch_assoc($resultado);
					/* Ahora liberamos el resultado y continuamos con nuestro script */
					mysqli_free_result($resultado);
					$retorno=$fila['respuesta'];
					$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		return $retorno;
	}
	
	
	public function traerInstancias($idUser){
		
		$retorno="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="select * from instanciasPertenecientes where idUsuario='$idUser';";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
						
								$retorno = "<div class=\"container\"><table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
								$retorno =$retorno."<tr>";
									$retorno = $retorno."<th>Nombre instancia</th>";
									$retorno = $retorno."<th>Día de ingreso</th>";
									$retorno = $retorno."<th>Mes de ingreso</th>";
									$retorno = $retorno."<th>A&ntilde;o de ingreso</th>";
									$retorno = $retorno."<th>Actualizar</th>";
									$retorno = $retorno."<th>Eliminar</th>";
								$retorno = $retorno."</tr>";
					
						/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
						while($fila=mysqli_fetch_assoc($resultado)){
							$retorno = $retorno."<tr>";

								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['nombreInstancia'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['diaIngreso'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['mesIngreso'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['anioIngreso'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									  $retorno = $retorno.'<a href='.'?v=2&n='.$this->codificaURL($fila['nombreInstancia']).'&l='.$this->codificaURL($fila['diaIngreso']).'&o='.$this->codificaURL($fila['mesIngreso']).'&h='.$this->codificaURL($fila['anioIngreso']).'&I='.$fila['idInstancia'].'>Modificar</a>';
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									  $retorno = $retorno."<a onclick=\"return confirm('¿Seguro de eliminar informacion?')\"".' href='.'?v=3&n='.$this->codificaURL($fila['nombreInstancia']).'&l='.$this->codificaURL($fila['diaIngreso']).'&o='.$this->codificaURL($fila['mesIngreso']).'&h='.$this->codificaURL($fila['anioIngreso']).'>Eliminar</a>';
								$retorno = $retorno."</td>";
							  
							  $retorno = $retorno."</tr>";
							}
							 $retorno = $retorno."</table></div>";
						
									
						$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		return $retorno;
		
	}
	
	public function actualizaDatos($idUsuario, $username, $pat, $mat, $email ,$tel,$diaN , $mesN,$anioN,$puestoP,$idInst)
    {
		
		$retorno="";
		if($username!="" and $pat!="" and $mat!="" and $email !="" and $tel!="" and $diaN !="" and $mesN!="" and $anioN!="" and $puestoP!="" and $idInst!="")
		{
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call ActualizaUsuario('$idUsuario','$username','$pat','$mat','$email','$tel','$diaN','$mesN','$anioN','$puestoP','$idInst');";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
					
					/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
					$fila = mysqli_fetch_assoc($resultado);

					/* Ahora liberamos el resultado y continuamos con nuestro script */
					mysqli_free_result($resultado);
					$retorno=$fila['respuesta'];
					
					$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		}else{
				$retorno="<font color='red'>Falta llenar campos</font>";
		}
		return $retorno;
	}
	
	public function traerInformacion($idUsuario){
		
		
		$retorno="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="select * from profesores inner join  nacimientos on profesores.idUsuario=nacimientos.idUsuario inner join puestosInstitucionales on profesores.idUsuario=puestosInstitucionales.idUsuario where profesores.idUsuario='$idUsuario';";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
						
								$retorno = "<table class=\"bordered centered responsive-table\"  border=\"2\">";
								$retorno =$retorno."<tr>";
									$retorno = $retorno."<th>Clave instituto</th>";
									$retorno = $retorno."<th>Puesto</th>";
									$retorno = $retorno."<th>Nombre</th>";
									$retorno = $retorno."<th>Paterno</th>";
									$retorno = $retorno."<th>Materno</th>";
									$retorno = $retorno."<th>Dia de nacimiento</th>";
									$retorno = $retorno."<th>Mes de nacimiento</th>";
									$retorno = $retorno."<th>A&ntilde;o de nacimiento</th>";
									$retorno = $retorno."<th>Correo</th>";
									$retorno = $retorno."<th>Telefono</th>";
									$retorno = $retorno."<th>Actualizar</th>";
								$retorno = $retorno."</tr>";
					
						/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
						while($fila=mysqli_fetch_assoc($resultado)){
							$retorno = $retorno."<tr>";

								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['idInstitucion'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['puesto'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['nombre'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['paterno'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['materno'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['dia'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['mes'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['anio'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['correo'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['telefono'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									  $retorno = $retorno.'<a href='.'?v=1&a='.$this->codificaURL($fila['idInstitucion']).'&b='.$this->codificaURL($fila['puesto']).'&c='.$this->codificaURL($fila['nombre']).'&d='.$this->codificaURL($fila['paterno']).'&e='.$this->codificaURL($fila['materno']).'&g='.$this->codificaURL($fila['dia']).'&h='.$this->codificaURL($fila['mes']).'&i='.$this->codificaURL($fila['anio']).'&j='.$this->codificaURL($fila['correo']).'&k='.$this->codificaURL($fila['telefono']).'>Modificar</a>';
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."</tr>";
							}
							 $retorno = $retorno."</table>";
						
									
						$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		return $retorno;
		
		
	}
	
	
	public function cantidadFormaciones($idUsuario)
    {
		$retorno="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call cantidadFormacion('$idUsuario');";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
					
					/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
					$fila = mysqli_fetch_assoc($resultado);
					/* Ahora liberamos el resultado y continuamos con nuestro script */
					mysqli_free_result($resultado);
					$retorno=$fila['respuesta'];
					$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		return $retorno;
	}

	
	
	public function registraFormacion($idUser,$niv,$nombreC,$institucionA,$paisA,$anioA,$cedulaA,$op,$idRegistro)
    {
		$retorno="";
		if($idUser !="" and $niv !="" and $nombreC !="" and $institucionA !="" and $paisA !="" and $anioA !="" and $cedulaA !="" and $op !="" and $idRegistro!="")
		{
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call registraFormacion('$idUser','$niv','$nombreC','$institucionA','$paisA','$anioA','$cedulaA','$op',$idRegistro);";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
					
					/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
					$fila = mysqli_fetch_assoc($resultado);

					/* Ahora liberamos el resultado y continuamos con nuestro script */
					mysqli_free_result($resultado);
					$retorno=$fila['respuesta'];
					
					$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		}else{
				$retorno="<font color='red'>Falta llenar campos</font>";
		}
		return $retorno;
	}
	

	public function traerFormaciones($idUser){
		
		$retorno="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="select * from formacionAcademica where idUsuario='$idUser';";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
						
								$retorno = "<div class=\"container\"><table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
								$retorno =$retorno."<tr>";
									$retorno = $retorno."<th>Nivel</th>";
									$retorno = $retorno."<th>Nombre curso</th>";
									$retorno = $retorno."<th>Instituci&oacute;n</th>";
									$retorno = $retorno."<th>Pa&iacute;s</th>";
									$retorno = $retorno."<th>A&ntilde;o</th>";
									$retorno = $retorno."<th>C&eacute;dula</th>";
									$retorno = $retorno."<th>Actualizar</th>";
									$retorno = $retorno."<th>Eliminar</th>";
								$retorno = $retorno."</tr>";
					
						/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
						while($fila=mysqli_fetch_assoc($resultado)){
							$retorno = $retorno."<tr>";

								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['nivel'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['nombre'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['institucion'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['pais'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['anio'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['cedulaP'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									  $retorno = $retorno.'<a href='.'?v=2&n='.$this->codificaURL($fila['nivel']).'&l='.$this->codificaURL($fila['nombre']).'&o='.$this->codificaURL($fila['institucion']).'&h='.$this->codificaURL($fila['pais']).'&z='.$this->codificaURL($fila['anio']).'&w='.$this->codificaURL($fila['cedulaP']).'&I='.$fila['idFormacion'].'>Modificar</a>';
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									  $retorno = $retorno."<a onclick=\"return confirm('¿Seguro de eliminar informacion?')\"".' href='.'?v=3&n='.$this->codificaURL($fila['nombre']).'&l='.$this->codificaURL($fila['institucion']).'&o='.$this->codificaURL($fila['institucion']).'&h='.$this->codificaURL($fila['pais']).'&z='.$this->codificaURL($fila['anio']).'&w='.$this->codificaURL($fila['cedulaP']).'>Eliminar</a>';
								$retorno = $retorno."</td>";
							  
							  $retorno = $retorno."</tr>";
							}
							 $retorno = $retorno."</table></div>";
						
									
						$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
		return $retorno;
		
	}
	

	
	public function traerSelectDias($entrada){
		$arreglo=['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
		$html="";
		
		$html.="";
		for ($i = 0; $i < count($arreglo); $i++) {
			if($arreglo[$i]==$entrada){
				$html.="<option value='$arreglo[$i]' selected>$arreglo[$i]</option>";
			}else{
				$html.="<option value='$arreglo[$i]'>$arreglo[$i]</option>";			
			}
		}
		return $html;
	}
	
	public function traerSelectMeses($entrada){
		$arreglo=['ENERO','FEBRERO','MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE'];
		$html="";
		
		$html.="";
		for ($i = 0; $i < count($arreglo); $i++) {
			if($arreglo[$i]==$entrada){
				$html.="<option value='$arreglo[$i]' selected>$arreglo[$i]</option>";
			}else{
				$html.="<option value='$arreglo[$i]'>$arreglo[$i]</option>";			
			}
		}
		return $html;
	}
	
	public function traerCategoriaActual($cadena){
		
		$html="";
		
		if($cadena=="PTC" || $cadena=="PMT" || $cadena=="PPH" || $cadena=="PDA" || $cadena=="1"){
			$html.="<div class='row'>";
			$html.="<label>Categoria actual</label>";
			$html.="<select class='browser-default' id='categoria' name='categoria' required>";
			$html.="<option value='' disabled selected>Categoria actual</option>";
			
			if($cadena=="PTC"){
				$html.="<option value='PTC' selected>Profesor de tiempo completo</option>";
			}else{
				$html.="<option value='PTC'>Profesor de tiempo completo</option>";
			}
			
			if($cadena=="PMT"){
				$html.="<option value='PMT' selected>Profesor de medio tiempo</option>";
			}else{
				$html.="<option value='PMT'>Profesor de tiempo completo</option>";
			}
			
			if($cadena=="PPH"){
				$html.="<option value='PPH' selected>Profesor por horas</option>";
			}else{
				$html.="<option value='PPH'>Profesor por horas</option>";
			}
			
			if($cadena=="PDA"){
				$html.="<option value='PDA' selected>Profesor de asignatura</option>";
			}else{
				$html.="<option value='PDA'>Profesor de asignatura</option>";
			}
			$html.="</select>";
			$html.="<b id='nvoForm' onclick='otraCategoria();'>Si no aparece tu categoria da click aqui.</b>";
			$html.="</div>";
		}else{
			//$html.= '<div class="row">';
			$html.= '<i class="fa fa-user fa prefix"></i>';
			$html.='<label for="categoria">Categoria:</label>';
			$html.="<input type='text' value='$cadena' placeholder='Ingresa tu categoria'  required id='categoria' name='categoria' data-validetta='required,number,minLength[8],maxLength[10]'>";
			$html.="<b  onclick='regresoOpciones();'  id='regresoOpciones'>Mostrar de nuevo opciones</b>";
			//$html.= '<i class="fa fa-user fa prefix"></i>';
		}
		
		return $html;
	}
	
	public function traerPeriodos($cadena){
		
		$html="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="select * from catalogoPeriodos;";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
						
								$html.="<div class='row'>";
								$html.="<label>Periodos</label>";
								$html.="<select class='browser-default' id='periodo' name='periodo' required>";
								$html.="<option value='' disabled selected>Periodo actual</option>";
					
						/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
						while($fila=mysqli_fetch_assoc($resultado)){
									
									if($cadena==$fila['idPeriodo']){
										$html.="<option value="."'".$fila['idPeriodo']."'"."selected>".$fila['descripcion']."</option>";
									}else{
										$html.="<option value="."'".$fila['idPeriodo']."'".">".$fila['descripcion']."</option>";
									}
		
							}
							 $html.="</select>";
							$html.="</div>";
									
						$mysqli->close();
				}
			}else{
				$html.="No se conectó";
			}
		return $html;
		
		
	}
	
	public function traeSelectTipo($cadena){
		$html="";
		
		if($cadena=="ECO" || $cadena=="N"){
			$html.="<div class='row'>";
			$html.="<label>Tipo de curso</label>";
			$html.="<select class='browser-default' id='tipo' name='tipo' required>";
			$html.="<option value='' disabled selected>Tipo de curso</option>";
			
			if($cadena=="ECO"){
				$html.="<option value='ECO' selected>Educaci&oacute;n continua</option>";
			}else{
				$html.="<option value='ECO'>Educaci&oacute;n continua</option>";
			}
			
			$html.="</select>";
			$html.="<b id='nvoForm' onclick='otroTipoE();'>Si no aparece tu categoria da click aqui.</b>";
			$html.="</div>";
		}else{
			$html.='<label for="tipo">Tipo curso:</label>';
			$html.="<input  type='text' value='$cadena' placeholder='Tipo curso'  required id='tipo' name='tipo' data-validetta='required,number,minLength[8],maxLength[10]'>";
			$html.="<b  onclick='regresoOpcionesECO();'  id='regresoOpciones'>Mostrar de nuevo opciones</b>";
		}
		
		return $html;
		
	}
	
	public function traerNiveles($cadena){
		
		$html="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="select * from catalogoNivelCursos;";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
						
								$html.="<div class='row'>";
								$html.="<label>Nivel</label>";
								$html.="<select class='browser-default' id='nivel' name='nivel' required>";
								$html.="<option value='' disabled selected>Nivel curso</option>";
					
						/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
						while($fila=mysqli_fetch_assoc($resultado)){
									
									if($cadena==$fila['idNivel']){
										$html.="<option value="."'".$fila['idNivel']."'"."selected>".$fila['descripcion']."</option>";
									}else{
										$html.="<option value="."'".$fila['idNivel']."'".">".$fila['descripcion']."</option>";
									}
		
							}
							 $html.="</select>";
							$html.="</div>";
									
						$mysqli->close();
				}
			}else{
				$html.="No se conectó";
			}
		return $html;
		
		
	}
	
	
	public function cambiaClave($idUsuario,$actual,$nueva){
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call cambioClave('$idUsuario','$actual','$nueva');";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
					
					/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
					$fila = mysqli_fetch_assoc($resultado);

					/* Ahora liberamos el resultado y continuamos con nuestro script */
					mysqli_free_result($resultado);
					$retorno=$fila['respuesta'];
					
					$mysqli->close();
				}
			}else{
				$retorno="No se conectó";
			}
			return $retorno;
			
	}
	
	public function codificaURL($cadena){
		return rawurlencode(base64_encode($cadena));
	}
	
	public function decodificaURL($cadena){
		return rawurldecode(base64_decode($cadena));
	}
}

?>