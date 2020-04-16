<?php
    session_start();
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
	
	if($_SESSION["activada"]=="v")
	{
		include 'cabeceras.php';
	$cab = new cabecera(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>
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
			<?=$cab->cabeceraP();?>

            <div class="container">
                    <h2 class="blue-grey-text center-align">Men&uacute; general</h2>
                    <hr>
             </div>
      </section>
    </header>

	<main>
        <section id="contenidos">
             <div class="container">
                <div class="row">
                        <form id="formObtComp" autocomplete="off">
                               
                            
                                <div class="col s12 8 input-field">
                                        <ul class="collection">

                                                <li class="collection-item avatar">
                                                    <i class="fa fa-user-tie circle blue"> </i>
                                                  <span class="title">Informaci&oacute;n laboral</span>
                                                 <a href="../servidor/menuLaboral.php"> <p>Ver  </p> </a>
                                                 <a href="../servidor/menuLaboral.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                        <i class="fa fa-user-graduate circle green"> </i>
                                                      <span class="title">Formaci&oacute;n Acad&eacute;mica</span>
                                                     <a href="../servidor/registroFormacionAcademica.php"> <p>Ver  </p> </a>
                                                      <a href="registroFormacionAcademica.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                        <i class="fa fa-chalkboard-teacher circle red"> </i>
                                                      <span class="title">Capacitaci&oacute;n Docente</span>
                                                     <a href="capacitacionDocente.php"> <p>Ver  </p> </a>
                                                      <a href="capacitacionDocente.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                        <i class="fa fa-user-edit circle pink"> </i>
                                                      <span class="title">Actualizaci&oacute;n Disciplinar</span>
                                                     <a href="actualizacionDis.php"> <p>Ver  </p> </a>
                                                      <a href="actualizacionDis.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                        <i class="fa fa-user-edit circle brown"> </i>
                                                      <span class="title">Gesti&oacute;n Acad&eacute;mica</span>
                                                     <a href="gestionAcademica.php"> <p>Ver  </p> </a>
                                                      <a href="gestionAcademica.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                        <i class="fa fa-lightbulb circle orange"> </i>
                                                      <span class="title">Productos Acad&eacute;micos releventes</span>
                                                     <a href="productosAc.php"> <p>Ver  </p> </a>
                                                      <a href="productosAc.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                        <i class="fa fa-tools circle black"> </i>
                                                      <span class="title">Experiencia profesional (no acad&eacute;mica)</span>
                                                     <a href="experienciaNoAcademica.php"> <p>Ver  </p> </a>
                                                      <a href="experienciaNoAcademica.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                        <i class="fa fa-atom circle purple"> </i>
                                                      <span class="title">Experiencia en dise&ntilde;o ingenieril</span>
                                                     <a href="expDisIng.php"> <p>Ver  </p> </a>
                                                      <a href="expDisIng.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                        <i class="fa fa-award circle gray"> </i>
                                                      <span class="title">Logros profesionales (no acad&eacute;micos) relevantes</span>
                                                     <a href="logrosProfRelevantes.php"> <p>Ver  </p> </a>
                                                      <a href="logrosProfRelevantes.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                        <i class="fa fa-id-card circle blue"> </i>
                                                      <span class="title">Membres&iacute;as</span>
                                                     <a href="membresia.php"> <p>Ver  </p> </a>
                                                      <a href="membresia.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                     <i class="fa fa-medal circle green"> </i>
                                                      <span class="title">Premios, distinciones o reconocimientos recibidos</span>
                                                     <a href="premios.php"> <p>Ver  </p> </a>
                                                      <a href="premios.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                        <i class="fa fa-diagnoses circle pink"> </i>
                                                      <span class="title">Participaci&oacute;n en el an&aacute;lisis o actualizaci&oacute;n del PE</span>
                                                     <a href="participacionPE.php"> <p>Ver  </p> </a>
                                                      <a href="participacionPE.php" class="secondary-content"><i class="fa fa-plus-circle fa-3x"></i></a>
                                                </li>
                                    
                                    
                                    
                                        </ul>

                                      


                                  </div>

                              
                             
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
<?php
	}else{
		header("location:../index.php");
	}
?>