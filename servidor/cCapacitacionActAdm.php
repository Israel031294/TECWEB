<?php
class cCapacitacionActAdm{
	
	public function traerSelectCapacitaciones($entrada){
		$arreglo=['Certificacion','Curso','Diplomado'];
		$html="";
		
		$html.="<option value='' disabled selected>Tipo de capacitaci&oacute;n</option>";

		for ($i = 0; $i < count($arreglo); $i++) {
			if($arreglo[$i]==$entrada){
				$html.="<option value='$arreglo[$i]' selected>$arreglo[$i]</option>";
			}else{
				$html.="<option value='$arreglo[$i]'>$arreglo[$i]</option>";			
			}
		}
		return $html;
	}
	
	public function traerSelectDisciplina($entrada){
		$arreglo=['TICS','LIDERAZGO','CRECIMIENTO INTEGRAL'];
		$html="";
		
		$html.="<option value='' disabled selected>Tipo de capacitaci&oacute;n</option>";

		for ($i = 0; $i < count($arreglo); $i++) {
			if($arreglo[$i]==$entrada){
				$html.="<option value='$arreglo[$i]' selected>$arreglo[$i]</option>";
			}else{
				$html.="<option value='$arreglo[$i]'>$arreglo[$i]</option>";			
			}
		}
		return $html;
	}
	public function agregaCapacitacionDocenteActDis($idUsuario,$tipoC,$institucion,$pais,$anio,$horas,$tipoForm){//$idUsuario proviene de la sesion
	$resp = "";
	$respBd;
	if($tipoC == "" and $institucion == "" and $pais == "" and $anio == "" and $horas == ""){
		$resp = "<h3 style='color:red'>Hay campos que faltan por completar </h3>";
		
	}else{
		$mysqli = new mysqli("localhost","root","","curriculum");
		if($mysqli){ 
		//echo $tipoForm;
			if($tipoForm == "Cap"){
				$procedimiento = "call sp_capacitacionDocente(?,?,?,?,?,?);";
			}else{
				$procedimiento = "call sp_agregaActualizacionDis(?,?,?,?,?,?);";
			}

			if($stmt = $mysqli->prepare($procedimiento)){
				$stmt->bind_param('isssii',$idUsuario,$tipoC,$institucion,$pais,$anio,$horas);
				
				$stmt->execute();
				$respBd = $stmt->get_result();
				if($respBd->num_rows > 0){//si hay una respuesta por parte de la bd
				if($row = $respBd->fetch_assoc()){
                        $resp = $row["notificacion"];
                    }else{
						printf("no hay nombre asociados");
					}
				
				}else{
					printf("no hubo respuesta");
				}
				$stmt->close();
				
			}
			/*
			$respBd = mysqli_query($mysqli,$procedimiento);
			
			if($respBd){
				//Usamos el resultado, asumiendo que, acto seguido, hemos terminado con él
					$fila = mysqli_fetch_assoc($respBd);

					// Ahora liberamos el resultado y continuamos con nuestro script
					mysqli_free_result($respBd);
					$resp=$fila['notificacion'];
					$mysqli->close();
			}else{
					$resp = "Se produjo un error: ".$mysqli_error($respBd);
			}
			*/
		}else{
			$resp = "<font color = 'red'> error en la conexión</font>";
		}
	
	return $resp;
}
	}
	
	public function tablaCapacitacionDocenteActDis($idUsr,$tipoForm,$A){
		$resp = "";
		$respBd;
		$mysqli = new mysqli("localhost","root","","curriculum");
		
		if($mysqli){
			if($tipoForm == "Cap"){
				$query = "select * from capacitaciondocente where idUsuario = ?;";
			}else{
				$query = "select * from actualizaciond where idUsuario = ?;";
			}

			if($stmt = $mysqli->prepare($query)){
				$stmt->bind_param("i",$idUsr);
				$stmt->execute();
				$respBd = $stmt->get_result();
			if($respBd->num_rows > 0){//si hay una respuesta por parte de la bd
						if($A != 1){
						$resp = $resp."<a href=?tl=0>Regresar</a>";//si entra el administrador   
					   }else{
						$resp = $resp."<a href=?tl=0&A=1>Agregar otra capacitaci&oacute;n</a>";   
					   }
                       $resp.= "<table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
								$resp =$resp."<tr>";
								if($tipoForm == "Cap"){
									$resp = $resp."<th>Tipo Capacitaci&oacute;n</th>";
								}else{
									$resp = $resp."<th>Tipo Actualizaci&oacute;n</th>";
								}

									$resp = $resp."<th>Institución</th>";
									$resp = $resp."<th>País</th>";
									$resp = $resp."<th>Año de Realización</th>";
									$resp = $resp."<th>Horas invertidas</th>";
									$resp = $resp."<th>Actualizar</th>";
									$resp = $resp."<th>Eliminar</th>";
								$resp = $resp."</tr>";
					   
					   while($row = $respBd->fetch_assoc()){
						   $resp = $resp."<tr>";
						   
									$resp = $resp."<td>";
								if($tipoForm == "Cap"){
									$resp = $resp.$row['tipoC'];
								}else{
									$resp = $resp.$row['tipoAct'];
								}
									
									$resp = $resp."</td>";
									
									$resp = $resp."<td>";
									$resp = $resp.$row['institucion'];
									$resp = $resp."</td>";
									
									$resp = $resp."<td>";
									$resp = $resp.$row['pais'];
									$resp = $resp."</td>";
									
									$resp = $resp."<td>";
									$resp = $resp.$row['anio'];
									$resp = $resp."</td>";
									
									$resp = $resp."<td>";
									$resp = $resp.$row['horas'];
									$resp = $resp."</td>";
									
									
									if($tipoForm == "Cap"){
										$resp = $resp."<td>";
										$resp = $resp."<a href="."?a=".$this->codificaURL("1")."&t=".$this->codificaURL($row['tipoC'])."&i=".$this->codificaURL($row['institucion'])."&p=".$this->codificaURL($row['pais'])."&an=".$this->codificaURL($row['anio'])."&h=".$this->codificaURL($row['horas'])."&tl=0"."&idC=".$this->codificaURL($row['idCapacitacion'])."&A=".$A.">Actualizar</a>";
									$resp = $resp."</td>";
									}else{
										$resp = $resp."<td>";
										$resp = $resp."<a href="."?a=".$this->codificaURL("1")."&t=".$this->codificaURL($row['tipoAct'])."&i=".$this->codificaURL($row['institucion'])."&p=".$this->codificaURL($row['pais'])."&an=".$this->codificaURL($row['anio'])."&h=".$this->codificaURL($row['horas'])."&tl=0"."&idC=".$this->codificaURL($row['idActualizacion']).">Actualizar</a>";
									$resp = $resp."</td>";
									}

									if($tipoForm == "Cap"){
									$resp = $resp."<td>";
									$resp = $resp."<a onclick=\"return confirm('¿Está seguro de eliminar el registro?')\"".' href='."?tl=1&e=".$this->codificaURL('1')."&idC=".$this->codificaURL($row['idCapacitacion'])."&A=".$A.">Eliminar</a>";
									$resp = $resp."</td>";
									}else{
									$resp = $resp."<td>";
									$resp = $resp."<a onclick=\"return confirm('¿Está seguro de eliminar el registro?')\"".' href='."?tl=1&e=".$this->codificaURL('1')."&idC=".$this->codificaURL($row['idActualizacion']).">Eliminar</a>";
									$resp = $resp."</td>";
									}

									
									$resp = $resp."</td>";
									$resp = $resp."</tr>";
									
									
					   }
					   $resp = $resp."</table>";
					
				}else{
					if($A != 1){
						$resp = $resp."<a href=?a=2>Regresar</a>";
					}else{
						$resp = $resp."<a href=?Administrador.php>Regresar</a><br>";
						$resp = $resp."<a href=?tl=0>Agregar otra capacitaci&oacute;n</a>";  
					}
					
					printf("no hay registros");
				}
			}else{
				
			}
			
		}else{
			$resp = "Error en la conexión con la bd ".mysqli_error;
		}
		
		
		return $resp;
		
	}
	
	public function actualizacionCapacitacionActDis($idCapAct,$idUsr,$tipoCapAct,$instCapAct,$paisCapAct,$anioCapAct,$horaCapAct,$tipoForm){
		$resp;
		$respBD;
		
		$mysqli = new mysqli("localhost","root","","curriculum");
		
		if($mysqli){
			if($tipoForm == "Cap"){
				$procedimiento = "call sp_actualizaCapacitacion(?,?,?,?,?,?,?);";
			}else{
				$procedimiento = "call sp_actualizaActDis(?,?,?,?,?,?,?);";
			}

			if($stmt = $mysqli->prepare($procedimiento)){
				$stmt->bind_param('iisssii',$idCapAct,$idUsr,$tipoCapAct,$instCapAct,$paisCapAct,$anioCapAct,$horaCapAct);
				
				$stmt->execute();
				$respBd = $stmt->get_result();
				if($respBd->num_rows > 0){//si hay una respuesta por parte de la bd
				if($row = $respBd->fetch_assoc()){
                        $resp = $row["notificacion"];
                    }else{
						printf("no hay nombre asociados");
					}
				
				}else{
					printf("no hubo respuesta");
				}
				$stmt->close();
				
			}
		
		
		}else{
			$resp = "Se produjo un error";
		}
		
		return $resp;
	}
	
	public function borraCapacitacionActDis($idCapacitacion,$tipoForm){
		$resp;
		$respBd;
		$mysqli = new mysqli("localhost","root","","curriculum");
		
		if($mysqli){
			if($tipoForm == "Cap"){
				$procedimiento = "call sp_borraCapacitacion(?);";
			}else{
				$procedimiento = "call sp_eliminaActDis(?);";
			}

			if($stmt = $mysqli->prepare($procedimiento)){
				$stmt->bind_param('i',$idCapacitacion);
				$stmt->execute();
				
				$respBd = $stmt->get_result();
				
				if($respBd->num_rows>0){
					if($row = $respBd->fetch_assoc()){
						$resp = $row["notificacion"];
					}else{
						printf("no hay nombre asociados");
					}
				}else{
					printf("la consulta no arrojó resultados");
				}
			}
		
		}
		
	return $resp;
	}

public function actualizacionDisciplinar(){
	
}

	public function codificaURL($cadena){
		return rawurlencode(base64_encode($cadena));
	}
	
	public function decodificaURL($cadena){
		return rawurldecode(base64_decode($cadena));
	}
}





?>