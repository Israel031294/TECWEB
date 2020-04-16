<?php
class cAdministrador{
	public function tablaProfesores(){
	$res = "";
	$respBd;
	
	
	$mysqli = new mysqli("localhost","root","","curriculum");
	
	if($mysqli){
		$procedimiento = "select * from profesores;";
		
		if($stmt = $mysqli->prepare($procedimiento)){
			
			$stmt->execute();
			$respBd = $stmt->get_result();
			if($respBd->num_rows > 0){
				$resp = "<table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
								$resp = $resp."<a href=PDFresume.php>Generar PDF cursos impartidos</a>";
								$resp =$resp."<tr>";

									$resp = $resp."<th>Nombre</th>";
									$resp = $resp."<th>A.Paterno</th>";
									$resp = $resp."<th>A.Materno</th>";
									$resp = $resp."<th>Correo</th>";
									$resp = $resp."<th>T&eacute;lefono</th>";
									$resp = $resp."<th>Informaci&oacute;n adicional</th>";
									$resp = $resp."<th>Curriculum</th>";
								$resp = $resp."</tr>";
					   
					   while($row = $respBd->fetch_assoc()){
						   $resp = $resp."<tr>";
						   
									$this->verificaTablaAdminListos($pendiente = $row['idUsuario']);//para ver desde el menu que usuario tiene formularios pendientes
									$bandera = $this->formulariosCompletos($idUser = $row['idUsuario']);
									
									if($bandera = 0){
									$resp = $resp."<td>";
									$resp = $resp.$row['nombre']."**";
									$resp = $resp."</td>";
									}else{
									$resp = $resp."<td>";
									$resp = $resp.$row['nombre'];
									$resp = $resp."</td>";
									}

									
									$resp = $resp."<td>";
									$resp = $resp.$row['paterno'];
									$resp = $resp."</td>";
									
									$resp = $resp."<td>";
									$resp = $resp.$row['materno'];
									$resp = $resp."</td>";
									
									$resp = $resp."<td>";
									$resp = $resp.$row['correo'];
									$resp = $resp."</td>";
									
									$resp = $resp."<td>";
									$resp = $resp.$row['telefono'];
									$resp = $resp."</td>";

									$resp = $resp."<td>";
									$resp = $resp."<a href="."?a=1&Iu=".$this->codificaURL($row['idUsuario']).">Ver</a>";
									$resp = $resp."</td>";
									
									$resp = $resp."<td>";
									$resp = $resp."<a href=miPDF.php"."?Iu=".$this->codificaURL($row['idUsuario']).">Generar PDF</a>";
									$resp = $resp."</td>";
									
									
									$resp = $resp."</td>";
									$resp = $resp."</tr>";
									
									
					   }
					   $resp = $resp."</table>";
			}else{
					$resp = "<h2>no hay registros</h2>";
			}
			
			}else{
			printf("no hubo respuesta");
		}
		
	}
	return $resp;
}

public function menuFormularios($idUsr){
	$respBd;

	$resp = "<table class=\"bordered centered responsive-table tablaTSCH\"  border=\"2\">";
	$resp =$resp."<tr>";
		$resp = $resp."<th class='center-align'>Formulario</th>";
		$resp = $resp."<th class='center-align'>Estado actual</th>";
		$resp = $resp."</tr>";
	
	$this->verificaTablaAdminListos($idUsr);
	
	$mysqli = new mysqli("localhost","root","","curriculum");
	if($mysqli){
		$procedimiento = "select * from adminListos where idUsuario = ?;";
		if($stmt = $mysqli->prepare($procedimiento)){
			$stmt -> bind_param('i',$idUsr);
			$stmt->execute();
			
			$respBd = $stmt->get_result();
			
			if($respBd->num_rows > 0){
					if($row = $respBd->fetch_assoc()){
                        if($row["CP"] == 0){
							$resp = $resp."<tr>
									<td><a href = 'capacitacionDocente.php?A=1'>Capacitaci&oacute;n Docente </a></td>
									  <td><i class='fas fa-ban'></i></td></tr>
                                " ;
						}else{
							$resp = $resp."<tr>
							<td><a href = 'capacitacionDocente.php?tl=1&A=1'>Capacitaci&oacute;n Docente </a></td>
							<td><i class='fas fa-check'></i></td></tr>";
						}
					if($row["AD"] == 0){
							$resp = $resp."
							<tr>
                            <td><a href = 'actualizacionDis.php?A=1'>Actualizaci&oacute;n Disciplinaria </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";
					}else{
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'actualizacionDis.php?tl=1&A=1'>Actualizaci&oacute;n Disciplinaria </a></td>
							<td><i class='fas fa-check'></i></td></tr>
                            ";
					}
					if($row["CI"] == 0){
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'cursos.php?A=1'>Cursos impartidos </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";
					}else{
						$resp = $resp."
							
                            <tr>
                            <td><a href = 'cursos.php?A=1'>Cursos impartidos </a></td>
							<td><i class='fas fa-check'></i></td></tr>
                            ";
					}
					if($row["GA"] == 0){
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'gestionAcademica.php?A=1'>Gesti&oacute;n acad&eacute;mica </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";
					}else{
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'gestionAcademica.php?A=1'>Gesti&oacute;n acad&eacute;mica </a></td>
							<td><i class='fas fa-check'></i></td></tr>
                            ";
					}
					/*
					if($row["PI"] == 0){
							$resp = $resp."
							
                            
                            <a href = ''>Productos Relevantes** </a>
                            ";
					}else{
							$resp = $resp."
							
                            
                            <a href = ''>Prodcutos Relevantes** </a>
                            ";
					}
					*/
					if($row["PR"] == 0){
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'ProductosAc.php?A=1'>Productos Relevantes </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";
					}else{
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'ProductosAc.php?A=1'>Productos Relevantes </a></td>
							<td><i class='fas fa-check'></i></td></tr>
                            ";
					}
					if($row["M"] == 0){
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'membresia.php?A=1'>Membres&iacute;as </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";
					}else{
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'membresia.php?A=1'>Membres&iacute;as </a></td>
							<td><i class='fas fa-check'></i></td></tr>
                            ";
					}
						
					if($row["EDI"] == 0){
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'expDisIng.php?A=1'>Experiencia Diseño Ingenieril </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";
					}else{
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'expDisIng.php?A=1'>Experiencia Diseño Ingenieril </a></td>
							<td><i class='fas fa-check'></i></td></tr>
                            ";
					}
						
					if($row["EA"] == 0){
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'experienciaNoAcademica.php?A=1'>Experiencia No Acad&eacute;mica </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";
					}else{
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'experienciaNoAcademica.php?A=1'>Experiencia No Acad&eacute;mica </a></td>
							<td><i class='fas fa-check'></i></td></tr>
                            ";
					}
					
					if($row["P"] == 0){
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'premios.php?A=1'>Premios </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";
						
					}else{
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'premios.php?A=1'>Premios </a></td>
							<td><i class='fas fa-check'></i></td></tr>
                            ";
						
					}
					
					if($row["LP"] == 0){
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'logrosProfRelevantes.php?A=1'>Logros Profesionales Relevantes </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";	
					}else{
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'logrosProfRelevantes.php?A=1'>Logros Profesionales Relevantes </a></td>
							<td><i class='fas fa-check'></i></td></tr>
                            ";
					}
					
					if($row["FA"] == 0){
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'registroFormacionAcademica.php?A=1'>Formaci&oacute;n Acad&eacute;mica  </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";
					}else{
						$resp = $resp."
							
                            <tr>
                            <td><a href = 'registroFormacionAcademica.php?A=1'.php'>Formaci&oacute;n Acad&eacute;mica  </a></td>
							<td><i class='fas fa-check'></i></td></tr>
                            ";
					}
					
					if($row["IP"] == 0){
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'instanciasPertenecientes.php?A=1'>Instancias Pertenecientes </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";
					}else{
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'instanciasPertenecientes.php?A=1'>Instancias Pertenecientes </a></td>
							<td><i class='fas fa-check'></i></tr>
                            ";
					}
					
					if($row["CA"] == 0){
							$resp = $resp."
							
                            <tr>
                            <td><a href = 'contratacionActual.php?A=1'>Contrataci&oacute;n actual </a></td>
							<td><i class='fas fa-ban'></i></td></tr>
                            ";
					}else{
						$resp = $resp."
							
                            <tr>
                            <td><a href = 'contratacionActual.php?A=1'>Contrataci&oacute;n actual </a></td>
							<td><i class='fas fa-check'></i></td></tr>
                            ";
					}	$resp =$resp."</table>";
                    }else{
						printf("no hay nombre asociados");
					}	
			}
			$stmt->close();
		}
	}else{
		printf("error en conexión");
	}
	
	
	return $resp;
}

public function verificaTablaAdminListos($idUsr){
	$resp;
	$respBd;	
	
	$mysqli = new mysqli("localhost","root","","curriculum");
	
	if($mysqli){
		$procedimiento = "call sp_verificaFormularios(?);";
		
		if($stmt = $mysqli->prepare($procedimiento)){
			$stmt->bind_param('i',$idUsr);
			
				$stmt->execute();
				$respBd = $stmt->get_result();
				
				if($respBd->num_rows > 0){
					if($row = $respBd->fetch_assoc()){
						$resp = $row["notificacion"];
					}
				}else{
					printf ("no hay registros 1");
				}
				$respBd->close();
		}
	}else{
		printf("error en la conexión");
	}
	
	return $resp;
}

public function formulariosCompletos($idUsr){//funcion que nos indica si ya están llenos todos los formularios
$resp = 0;
$respBd;
$mysqli = new mysqli("localhost","root","","curriculum");

if($mysqli){
	$procedimiento = "select * from adminListos where idUsuario = ?";
			
			if($stmt = $mysqli->prepare($procedimiento)){
			$stmt->bind_param('i',$idUsr);
			
				$stmt->execute();
				$respBd = $stmt->get_result();
				
				if($respBd->num_rows > 0){
					if($row = $respBd->fetch_assoc()){
						if($row["CP"] == 0){
							$resp = $resp + 1;
						}else{
							if($row["AD"] == 0){
								$resp = $resp + 1;
							}else{
								if($row["CI"] == 0){
									$resp = $resp + 1;
								}else{
									if($row["GA"] == 0){
										$resp = $resp + 1;
									}else{
										if($row["PI"] == 0){
											$resp = $resp;//no se toma en cuenta
										}else{
											if($row["PR"] == 0){
												$resp = $resp + 1;
											}else{
												if($row["M"] == 0){
													$resp = $resp + 1;
												}else{
													if($row["EDI"] == 0){
														$resp = $resp + +1;
													}else{
														if($row["EA"] == 0){
															$resp = $resp + 1;
														}else{
														if($row["P"] == 0){
															$resp = $resp + 1;
														}else{
															if($row["N"] == 0){
																$resp = $resp;//no se toma en cuenta
															}else{
																if($row["LP"] == 0){
																	$resp = $resp + 1;
																}else{
																	if($row["FA"] == 0){
																		$resp = $resp + 1;
																	}else{
																		if($row["IP"] == 0){
																			$resp = $resp + 1;
																		}else{
																			if($row["CA"] == 0){
																				$resp = $resp + 1;
																			}
																		}
																	}
																}
															}
														}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}else{
					printf ("no hay registros2");
				}
				$respBd->close();
		}
		
	}
return $resp;
}

public function agregarAdministrador($correo,$psw,$token){
	$resp;
	$respBd;
	$mysqli = new mysqli("localhost","root","","curriculum");
	if($mysqli){
		$procedimiento = "call sp_registraAdmin(?,?,?);";
		
		if($stmt = $mysqli->prepare($procedimiento)){
			$stmt->bind_param('ssi',$correo,$psw,$token);
			
				$stmt->execute();
				$respBd = $stmt->get_result();
				
				if($respBd->num_rows > 0){
					if($row = $respBd->fetch_assoc()){
						$resp = $row["notificacion"];
					}
				}else{
					printf ("no hay registros 1");
				}
				$respBd->close();
		}
	}
	
	return $resp;
}

public function codificaURL($cadena){
		return rawurlencode(base64_encode($cadena));
	}
	
	public function decodificaURL($cadena){
		return rawurldecode(base64_decode($cadena));
	}

}



?>