<?php

session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
	
	if($_SESSION["activada"]=="v")
	{
// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
 include("../assets/lib/mpdf60/mpdf.php");



// Introducimos HTML de prueba

$htmlPINTADO='';
$identificador=1; //será el receptor de url desde  administrador
$contador="";

$htmlPINTADO.='<html><head><link href="../assets/css/estilosM.css" rel="stylesheet"><link href="../assets/css/responsive.css" rel="stylesheet"></head><body>';
$header='<div id="cabeza">
			<p id="pCabeza"><h2 id="hCabeza">ESCUELA SUPERIOR DE C&Oacute;MPUTO</h2></p>
</div>';
		//DATOS DEL PROFESOR
				
								$mysqli = new mysqli("localhost","root","","curriculum");
								$htmlPINTADO.="<table border='1'>";		
								if($mysqli->set_charset("utf8")){
									
									$cantidad="select idUsuario from profesores";
									if($preparaConsulta=$mysqli->prepare($cantidad)){
										$preparaConsulta->execute();
										$resultadoP = $preparaConsulta->get_result();
										
										while($identificador = $resultadoP->fetch_assoc()){
												$contador=$identificador["idUsuario"];
												$co="select nombre,paterno,materno from profesores where idUsuario=?";
												if($preparaConsulta=$mysqli->prepare($co)){
													$preparaConsulta->bind_param('i', $contador);
													$preparaConsulta->execute();
													$resultado = $preparaConsulta->get_result();
													$htmlPINTADO.="<tr id='fd'><td>NOMBRE DEL PROFESOR</td></tr>";
														while($filas = $resultado->fetch_assoc()){
															$htmlPINTADO.='<tr>'.'<td>'.$filas["nombre"].' '.$filas["paterno"].' '.$filas["materno"].'</td>';
															$htmlPINTADO.='</tr>';
														}
												}
												$co="select DISTINCT nivel from formacionacademica where idUsuario=?";
												if($preparaConsulta=$mysqli->prepare($co)){
													$preparaConsulta->bind_param('i', $contador);
													$preparaConsulta->execute();
													$resultado = $preparaConsulta->get_result();
													$htmlPINTADO.="<tr id='fc'><td>GRADOS ACADEMICOS</td></tr>";
														while($filas = $resultado->fetch_assoc()){
															$htmlPINTADO.='<tr>'.'<td>'.$filas["nivel"].'</td>';
															$htmlPINTADO.='</tr>';
														}
												}
												$co="select DISTINCT * from contratacionactual where idUsuario=?";
												if($preparaConsulta=$mysqli->prepare($co)){
													$preparaConsulta->bind_param('i', $contador);
													$preparaConsulta->execute();
													$resultado = $preparaConsulta->get_result();
													$htmlPINTADO.="<tr id='fc'><td>CONTRATACION ACTUAL</td></tr>";
														while($filas = $resultado->fetch_assoc()){
															$htmlPINTADO.='<tr>'.'<td>'.'Categoria: '.$filas["categoria"].'  '.' Fecha de ingreso: '.$filas["diaIngreso"].' '.$filas["mesIngreso"].' '.$filas["anioIngreso"].'</td>';
															$htmlPINTADO.='</tr>';
														}
												}
												$co="select  * from instanciaspertenecientes where idUsuario=?";
												if($preparaConsulta=$mysqli->prepare($co)){
													$preparaConsulta->bind_param('i', $contador);
													$preparaConsulta->execute();
													$resultado = $preparaConsulta->get_result();
													$htmlPINTADO.="<tr id='fc'><td>INSTANCIAS PERTENECIENTES</td></tr>";
														while($filas = $resultado->fetch_assoc()){
															$htmlPINTADO.='<tr>'.'<td>'.'Nombre instancia: '.$filas["nombreInstancia"].'  '.' Fecha de ingreso: '.$filas["diaIngreso"].' '.$filas["mesIngreso"].' '.$filas["anioIngreso"].'</td>';
															$htmlPINTADO.='</tr>';
														}
												}
												$co="select  * from cursosimpartidos where idUsuario=?";
												if($preparaConsulta=$mysqli->prepare($co)){
													$preparaConsulta->bind_param('i', $contador);
													$preparaConsulta->execute();
													$resultado = $preparaConsulta->get_result();
													$htmlPINTADO.="<tr id='fc'><td>CURSOS IMPARTIDOS</td></tr>";
														while($filas = $resultado->fetch_assoc()){
															$NIVEL=$filas["idNivel"];
															$PERIODO=$filas["idPeriodo"];
															if($PERIODO=="1"){
																$PERIODO="2014-2015";
															}else{
																$PERIODO="2015-2016";
															}
															if($NIVEL=="1"){
																$NIVEL="LICENCIATURA";
															}else{
																$NIVEL="POSGRADO";
															}
															$htmlPINTADO.='<tr>'.'<td>'.'Periodo: '.$PERIODO.'  '.'Nivel: '.$NIVEL.'  '.'Nombre: '.$filas["nombreCurso"].'  '.'Tipo: '.$filas["tipo"].'  '.'Horas: '.$filas["horasTotales"];
															$htmlPINTADO.='</tr>';
														}
												}
												
										}
									}
														
								}else{
									$retorno="No se conectó";
								}				
									$htmlPINTADO.='</tbody></table>';
									$htmlPINTADO.='</body></html>';
	$pie = "";
        $pie .= "<p>Escuela Superior de C&oacute;mputo";
		$mysqli->close();
		
		$mpdf=new mPDF("c","Letter","12","dejavusans",15,10,30,10,5,5);
        $mpdf->SetWatermarkText($boleta." -ESCOM / TWeb 200192-",0.1);
        $mpdf->showWatermarkText = true;
        
        $mpdf->SetHTMLHeader($header);
        $mpdf->WriteHTML($htmlPINTADO);
        $mpdf->SetHTMLFooter($pie);
        $mpdf->Output();


	}else{
		header("location:../index.php");
	}
?>
