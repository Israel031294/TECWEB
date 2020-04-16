<?php
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';
	
	session_start();
	
	if(isset($_SESSION["id_usuario"])){
		header("Location: welcome.php");
	}
	
	$errors = array();
	
	if(!empty($_POST))
	{
		$email = $mysqli->real_escape_string($_POST['email']);
		$captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);
		$secret = '6LddbqYUAAAAAH2wAlzA95e_6505JgMyU1a_xN1m';
		
		if(!$captcha){
			$errors[] = "Por favor verifica el captcha";
		}
		
		if(!isEmail($email))
		{
			$errors[] = "Debe ingresar un correo electronico valido";
		}

		
		if(count($errors) == 0)
		{
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

				
		
		if(emailExiste($email))
		{			
			$user_id = getValor('idUsuario', 'correo', $email);
			$nombre = getValor('nombre', 'correo', $email);
			
			$token = generaTokenPass($user_id);
			
			$url = 'http://'.$_SERVER["SERVER_NAME"].'/TecWeb/cambia_pass.php?user_id='.$user_id.'&token='.$token;
			
			$asunto = 'Recuperar Password - Sistema de Usuarios';
			$cuerpo = "Hola $nombre: <br /><br />Se ha solicitado un reinicio de contrase&ntilde;a. <br/><br/>Para restaurar la contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='$url'>$url</a>";
			
			if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
				echo "Hemos enviado un correo electronico a las direcion $email para restablecer tu password.<br />";
				echo "<a href='index.php' >Iniciar Sesion</a>";
				exit;
			}
			} else 
			{
			$errors[] = "La direccion de correo electronico no existe";
			}
		}
		        else 
				{
				$errors[] = 'Error al comprobar Captcha';
			}
	}
?>
<html>
	<head>
		<title>Recuperar Password</title>
		<link href="./assets/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
		<link href="./assets/lib/bootstrap/bootstrap-theme.min.css" rel="stylesheet">
		<link href="./assets/lib/fontawesome/css/all.min.css" rel="stylesheet">
		<script src="./assets/js/js/bootstrap.min.js" ></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	
	<body>
		
		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Recuperar Password</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"> <i class="fa fa-user fa prefix"></i></span>
								<input id="email" type="email" class="form-control" name="email" placeholder="email" required>                                        
							</div>

							<div class="form-group">
								<label for="captcha" class="col-md-3 control-label"></label>
								<div class="g-recaptcha col-md-9" data-sitekey="6LddbqYUAAAAADx6CMilaH09ZcrMo66P6cERdIVs"></div>
							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-primary btn-lg btn-block">Enviar</a>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12 control">
									<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
										No tiene una cuenta! <a href="./servidor/crearCuenta.php">Registrate aquí</a>
									</div>
								</div>
							</div>    
						</form>
						<?php echo resultBlock($errors); ?>
					</div>                     
				</div>  
			</div>
		</div>
	</body>
</html>							