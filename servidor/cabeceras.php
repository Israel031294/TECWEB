<?php
class cabecera{

	public function cabeceraP()
	{
			$retorno='<nav>
				<div class="nav-wrapper light-blue lighten-2">
				  <a href="http://cacei.org.mx/"> <img src="../imgs/cacei.png" align="left" width="95" height="50"> </a>
				  <a href="http://www.escom.ipn.mx/" class="brand-logo center"> <img src="../imgs/logoESCOMBlanco.png" width="92" height="55"> </a>
				  <ul id="nav-mobile" class="right hide-on-med-and-down">
				  					<li><a href="miPDF.php">Ver pdf</a></li>

					<li><a href="menu.php">Men&uacute;</a></li>
					<li><a href="cambiarClave.php">Cambiar clave</a></li>

					<li><a href="cerrarSesion.php">Cerrar sesi&oacute;n</a></li>
				  </ul>
				</div>
			  </nav>';
				
			return $retorno;
	}
	
	public function cabeceraCrearCuenta()
	{
			$retorno='<nav>
				<div class="nav-wrapper light-blue lighten-2">
				 <a href="http://cacei.org.mx/"> <img src="../imgs/cacei.png" align="left" width="95" height="50"> </a>
				  <a href="http://www.escom.ipn.mx/" class="brand-logo center"> <img src="../imgs/logoESCOMBlanco.png" width="92" height="55"> </a>
				  <ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="../index.php">Regresar a inicio de sesi&oacute;n</a></li>
				  </ul>
				</div>
			  </nav>';
				
			return $retorno;
	}

		public function cabeceraCrearCuentaA()
	{
			$retorno='<nav>
				<div class="nav-wrapper light-blue lighten-2">
				 <a href="http://cacei.org.mx/"> <img src="../imgs/cacei.png" align="left" width="95" height="50"> </a>
				  <a href="http://www.escom.ipn.mx/" class="brand-logo center"> <img src="../imgs/logoESCOMBlanco.png" width="92" height="55"> </a>
				  <ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="Administrador.php">Regresar a Administrador</a></li>
					<li><a href="cambiarClave.php">Cambiar clave</a></li>
				  </ul>
				</div>
			  </nav>';
				
			return $retorno;
	}
	public function cabeceraA()
	{
			$retorno='<nav>
				<div class="nav-wrapper" class=" light-blue lighten-2">
				  <a href="http://cacei.org.mx/"> <img src="../imgs/cacei.png" align="left" width="95" height="50"> </a>
				  <a href="http://www.escom.ipn.mx/" class="brand-logo center"> <img src="../imgs/logoESCOMBlanco.png" width="92" height="55"> </a>				  
				  <ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="Administrador.php">Inicio</a></li>
					<li><a href="agregarAdministrador.php">Nuevo administrador</a></li>
					<li><a href="cerrarSesion.php">Cerrar sesi&oacute;n</a></li>
					<li><a href="cambiarClave.php">Cambiar clave</a></li>

				  </ul>
				</div>
			  </nav>';
				//NECESITO ABER QUE VA A A TENER EL ADMINISTRADOR
			return $retorno;
	}


	
}
?>