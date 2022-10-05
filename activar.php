<?php
include("./conexion.inc.php");
include("./funcs/funcs.php");

if (isset($_GET["id_u"]) and isset($_GET["val"])) {
	$idUsuario = $_GET["id_u"];
	$token = $_GET["val"];
	$mensaje = validaIdToken($idUsuario, $token);
}

?>
<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registro</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<script src="js/bootstrap.min.js"></script>
	<link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
</head>

<body>
	<div class="container">
		<div class="jumbotron">

			<center>
				<h1><?php echo $mensaje; ?></h1>
			</center>

			<br />
			<center>
				<p><a class="btn btn-primary btn-lg" href="login.php" role="button">Iniciar Sesi&oacute;n</a></p>
			</center>
		</div>
	</div>
</body>

</html>