<?php
class productos{

	public function cantidadParticipacion($idUsuario)
	{
			$retorno="";
				$mysqli = new mysqli("localhost","root","","curriculum"); 
				if($mysqli){
					
					//vamos a ejecutar un procedimiento almacenado
					$procedimiento="call cantidadParticipacion('$idUsuario');";
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

	public function cantidadPremio($idUsuario)
	{
			$retorno="";
				$mysqli = new mysqli("localhost","root","","curriculum"); 
				if($mysqli){
					
					//vamos a ejecutar un procedimiento almacenado
					$procedimiento="call cantidadPremio('$idUsuario');";
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

	public function cantidadLogro($idUsuario)
	{
			$retorno="";
				$mysqli = new mysqli("localhost","root","","curriculum"); 
				if($mysqli){
					
					//vamos a ejecutar un procedimiento almacenado
					$procedimiento="call cantidadLogro('$idUsuario');";
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

	public function cantidadProducto($idUsuario)
	{
			$retorno="";
				$mysqli = new mysqli("localhost","root","","curriculum"); 
				if($mysqli){
					
					//vamos a ejecutar un procedimiento almacenado
					$procedimiento="call cantidadProducto('$idUsuario');";
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

	public function cantidadEDI($idUsuario)
	{
			$retorno="";
				$mysqli = new mysqli("localhost","root","","curriculum"); 
				if($mysqli){
					
					//vamos a ejecutar un procedimiento almacenado
					$procedimiento="call cantidadEDI('$idUsuario');";
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
		

	public function traerLogro($idUser){
			
		$retorno="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="select * from logrosprofesionales where idUsuario='$idUser';";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
						
								$retorno = "<div class=\"container\"><table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
									$retorno =$retorno."<tr>";
									$retorno = $retorno."<th>a&ntilde;o</th>";
									$retorno = $retorno."<th>Nombre </th>";
									$retorno = $retorno."<th>Descripci&oacute;n</th>";
									$retorno = $retorno."<th>Actualizar</th>";
									$retorno = $retorno."<th>Eliminar</th>";
								$retorno = $retorno."</tr>";
					
						/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
						while($fila=mysqli_fetch_assoc($resultado)){
							$retorno = $retorno."<tr>";

								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['anio'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['nombre'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['descripcion'];
								$retorno = $retorno."</td>";
								
							
								$retorno = $retorno."<td>";
								$retorno = $retorno.'<a href='.'?v=2&n='.$this->codificaURL($fila['anio']).'&l='.$this->codificaURL($fila['nombre']).'&o='.$this->codificaURL($fila['descripcion']).'&I='.$fila['idLogro'].'>Modificar</a>';
								$retorno = $retorno."</td>";
		
								$retorno = $retorno."<td>";
										$retorno = $retorno."<a onclick=\"return confirm('¿Seguro de eliminar informacion?')\"".' href='.'?v=3&n='.$this->codificaURL($fila['anio']).'&l='.$this->codificaURL($fila['nombre']).'&o='.$this->codificaURL($fila['descripcion']).'>Eliminar</a>'; 
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

	public function traerPremio($idUser){
			
		$retorno="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="select * from premios where idUsuario='$idUser';";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
						
								$retorno = "<div class=\"container\"><table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
									$retorno =$retorno."<tr>";
									$retorno = $retorno."<th>a&ntilde;o</th>";
									$retorno = $retorno."<th>Nombre </th>";
									$retorno = $retorno."<th>Descripci&oacute;n</th>";
									$retorno = $retorno."<th>Actualizar</th>";
									$retorno = $retorno."<th>Eliminar</th>";
								$retorno = $retorno."</tr>";
					
						/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
						while($fila=mysqli_fetch_assoc($resultado)){
							$retorno = $retorno."<tr>";

								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['anio'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['nombre'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['descripcion'];
								$retorno = $retorno."</td>";
								
							
								$retorno = $retorno."<td>";
								$retorno = $retorno.'<a href='.'?v=2&n='.$this->codificaURL($fila['anio']).'&l='.$this->codificaURL($fila['nombre']).'&o='.$this->codificaURL($fila['descripcion']).'&I='.$fila['idPremio'].'>Modificar</a>';
								$retorno = $retorno."</td>";
		
								$retorno = $retorno."<td>";
										$retorno = $retorno."<a onclick=\"return confirm('¿Seguro de eliminar informacion?')\"".' href='.'?v=3&n='.$this->codificaURL($fila['anio']).'&l='.$this->codificaURL($fila['nombre']).'&o='.$this->codificaURL($fila['descripcion']).'>Eliminar</a>'; 
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

	public function traerParticipacion($idUser){
			
		$retorno="";
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="select * from participacionpe where idUsuario='$idUser';";
				$resultado=mysqli_query($mysqli,$procedimiento);
				
				if (!$resultado) {
					$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
				}else{
						
								$retorno = "<div class=\"container\"><table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
									$retorno =$retorno."<tr>";
									$retorno = $retorno."<th>Nombre </th>";
									$retorno = $retorno."<th>Descripci&oacute;n;</th>";
									$retorno = $retorno."<th>Actualizar</th>";
									$retorno = $retorno."<th>Eliminar</th>";
								$retorno = $retorno."</tr>";
					
						/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
						while($fila=mysqli_fetch_assoc($resultado)){
							$retorno = $retorno."<tr>";

							
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['nombre'];
								$retorno = $retorno."</td>";
								
								$retorno = $retorno."<td>";
									$retorno = $retorno.$fila['descripcion'];
								$retorno = $retorno."</td>";
								
							
								$retorno = $retorno."<td>";
								$retorno = $retorno.'<a href='.'?v=2&l='.$this->codificaURL($fila['nombre']).'&o='.$this->codificaURL($fila['descripcion']).'&I='.$fila['idParticipacion'].'>Modificar</a>';
								$retorno = $retorno."</td>";
		
								$retorno = $retorno."<td>";
										$retorno = $retorno."<a onclick=\"return confirm('¿Seguro de eliminar informacion?')\"".' href='.'?v=3&l='.$this->codificaURL($fila['nombre']).'&o='.$this->codificaURL($fila['descripcion']).'>Eliminar</a>'; 
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


		
	public function traerProducto($idUser){
			
			$retorno="";
				$mysqli = new mysqli("localhost","root","","curriculum"); 
				if($mysqli){
					
					//vamos a ejecutar un procedimiento almacenado
					$procedimiento="select * from productosrelevantes where idUsuario='$idUser';";
					$resultado=mysqli_query($mysqli,$procedimiento);
					
					if (!$resultado) {
						$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
					}else{
							
									$retorno = "<div class=\"container\"><table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
									  $retorno =$retorno."<tr>";
										$retorno = $retorno."<th>a&ntilde;o</th>";
										$retorno = $retorno."<th>Nombre </th>";
										$retorno = $retorno."<th>Descripci&oacute;n;n</th>";
										$retorno = $retorno."<th>Actualizar</th>";
										$retorno = $retorno."<th>Eliminar</th>";
									$retorno = $retorno."</tr>";
						
							/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
							while($fila=mysqli_fetch_assoc($resultado)){
								$retorno = $retorno."<tr>";

									$retorno = $retorno."<td>";
										$retorno = $retorno.$fila['anio'];
									$retorno = $retorno."</td>";
									
									$retorno = $retorno."<td>";
										$retorno = $retorno.$fila['nombre'];
									$retorno = $retorno."</td>";
									
									$retorno = $retorno."<td>";
										$retorno = $retorno.$fila['descripcion'];
									$retorno = $retorno."</td>";
									
								
									$retorno = $retorno."<td>";
								  $retorno = $retorno.'<a href='.'?v=2&n='.$this->codificaURL($fila['anio']).'&l='.$this->codificaURL($fila['nombre']).'&o='.$this->codificaURL($fila['descripcion']).'&I='.$fila['idProducto'].'>Modificar</a>';
								  $retorno = $retorno."</td>";
			
									$retorno = $retorno."<td>";
										  $retorno = $retorno."<a onclick=\"return confirm('¿Seguro de eliminar informacion?')\"".' href='.'?v=3&n='.$this->codificaURL($fila['anio']).'&l='.$this->codificaURL($fila['nombre']).'&o='.$this->codificaURL($fila['descripcion']).'>Eliminar</a>'; 
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

		public function traerEDI($idUser){
			
			$retorno="";
				$mysqli = new mysqli("localhost","root","","curriculum"); 
				if($mysqli){
					
					//vamos a ejecutar un procedimiento almacenado
					$procedimiento="select * from experienciadisenioingenieril where idUsuario='$idUser';";
					$resultado=mysqli_query($mysqli,$procedimiento);
					
					if (!$resultado) {
						$retorno='No se pudo ejecutar la consulta: '.$mysqli->error;
					}else{
							
									$retorno = "<div class=\"container\"><table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
									  $retorno =$retorno."<tr>";
										$retorno = $retorno."<th>Organismo</th>";
										$retorno = $retorno."<th>Lugar </th>";
										$retorno = $retorno."<th>Periodo</th>";
										$retorno = $retorno."<th>Nivel experiencia</th>";
										$retorno = $retorno."<th>Actualizar</th>";
										$retorno = $retorno."<th>Eliminar</th>";
									$retorno = $retorno."</tr>";
						
							/* Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él */
							while($fila=mysqli_fetch_assoc($resultado)){
								$retorno = $retorno."<tr>";

									$retorno = $retorno."<td>";
										$retorno = $retorno.$fila['tipoExperiencia'];
									$retorno = $retorno."</td>";
									
									$retorno = $retorno."<td>";
										$retorno = $retorno.$fila['lugar'];
									$retorno = $retorno."</td>";
									
									$retorno = $retorno."<td>";
										$retorno = $retorno.$fila['numeroAnios'];
									$retorno = $retorno."</td>";

									$retorno = $retorno."<td>";
										$retorno = $retorno.$fila['infAdicionar'];
									$retorno = $retorno."</td>";
									
								
									$retorno = $retorno."<td>";
								  $retorno = $retorno.'<a href='.'?v=2&n='.$this->codificaURL($fila['tipoExperiencia']).'&l='.$this->codificaURL($fila['lugar']).'&o='.$this->codificaURL($fila['numeroAnios']).'&e='.$this->codificaURL($fila['infAdicionar']).'&I='.$fila['idExperienciaIng'].'>Modificar</a>';
								  $retorno = $retorno."</td>";
			
									$retorno = $retorno."<td>";
										  $retorno = $retorno."<a onclick=\"return confirm('¿Seguro de eliminar informacion?')\"".' href='.'?v=3&n='.$this->codificaURL($fila['tipoExperiencia']).'&l='.$this->codificaURL($fila['lugar']).'&o='.$this->codificaURL($fila['numeroAnios']).'&e='.$this->codificaURL($fila['infAdicionar']).'>Eliminar</a>'; 
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

		public function registraPremio($idUsuario,$anio,$nombre,$descri,$operacion,$idRegistro)
    {
		$retorno="";
		if($idUsuario !="" and $anio !="" and $nombre !="" and $descri !="")
		{
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call registraPremio('$idUsuario','$anio','$nombre','$descri','$idRegistro','$operacion');";
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


	public function registraParticipacion($idUsuario,$nombre,$descri,$operacion,$idRegistro)
	{
	$retorno="";
	if($idUsuario !="" and $nombre !="" and $descri !="")
	{
		$mysqli = new mysqli("localhost","root","","curriculum"); 
		if($mysqli){
			
			//vamos a ejecutar un procedimiento almacenado
			$procedimiento="call registraParticipacion('$idUsuario','$nombre','$descri','$idRegistro','$operacion');";
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





	public function registraProducto($idUsuario,$anio,$nombre,$descri,$operacion,$idRegistro)
    {
		$retorno="";
		if($idUsuario !="" and $anio !="" and $nombre !="" and $descri !="")
		{
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call registraProducto('$idUsuario','$anio','$nombre','$descri','$idRegistro','$operacion');";
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

	public function registraLogro($idUsuario,$anio,$nombre,$descri,$operacion,$idRegistro)
    {
		$retorno="";
		if($idUsuario !="" and $anio !="" and $nombre !="" and $descri !="")
		{
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call registraLogro('$idUsuario','$anio','$nombre','$descri','$idRegistro','$operacion');";
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



	public function registraEDI($idUsuario,$org,$lugar,$per,$exp,$idRegistro,$operacion)
    {
		$retorno="";
		if($idUsuario !="" and $org !="" and $lugar !="" and $per !="" and $exp !="")
		{
			$mysqli = new mysqli("localhost","root","","curriculum"); 
			if($mysqli){
				
				//vamos a ejecutar un procedimiento almacenado
				$procedimiento="call registraEDI('$idUsuario','$org','$lugar','$per','$exp','$idRegistro','$operacion');";
			//$procedimiento="INSERT INTO experienciadisenioingenieril values (1,'$idUsuario','$org','$lugar','$per','$exp') ;";
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



		public function codificaURL($cadena){
			return rawurlencode(base64_encode($cadena));
		}
		
		public function decodificaURL($cadena){
			return rawurldecode(base64_decode($cadena));
		}
}
?>