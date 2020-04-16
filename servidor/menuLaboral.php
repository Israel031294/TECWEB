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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>menu laboral</title>
    <title>Cursos</title>
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
                    <h2 class="blue-grey-text center-align">Men&uacute; laboral</h2>
                    
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
                                                  <span class="title">Mi informaci&oacute;n personal</span>
                                                 <a href="../servidor/actualizarInf.php"> <p>Ver  </p> </a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                    <i class="fa fa-user-tie circle blue"> </i>
                                                      <span class="title">Contrataci&oacute;n actual</span>
                                                     <a href="../servidor/contratacionActual.php"> <p>Ver  </p> </a>
                                                </li>
												
												<li class="collection-item avatar">
                                                    <i class="fa fa-user-tie circle blue"> </i>
                                                      <span class="title">Instancias pertenecientes</span>
                                                     <a href="../servidor/instanciasPertenecientes.php"> <p>Ver  </p> </a>
                                                </li>
                                
                                                <li class="collection-item avatar">
                                                    <i class="fa fa-user-tie circle blue"> </i>
                                                      <span class="title">Cursos impartidos</span>
                                                     <a href="../servidor/cursos.php"> <p>Ver  </p> </a>
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