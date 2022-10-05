<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <link rel="stylesheet" language="javascript" href="./bootstrap/css/bootstrap.min.css">

    <!--sweetalert-->
    <link rel="stylesheet" href="./sw/dist/sweetalert2.min.css">

    <!-- script JS-->
  <script type="text/javascript" language="javascript" src="js/funciones.js"></script>
    <title>Clase Usuarios</title>
  </head>
  <body>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
	
	function isNull($id_u, $nomb_u, $apel_u, $univ_u, $correo_u, $tel_u, $clave_u, $con_password){
		if(strlen(trim($id_u)) < 1 || strlen(trim($nomb_u)) < 1 || strlen(trim($apel_u)) < 1 || 
		strlen(trim($univ_u)) < 1 || strlen(trim($correo_u)) < 1 || strlen(trim($tel_u)) < 1 || 
		strlen(trim($clave_u)) < 1 || strlen(trim($con_password)) < 1)
		{
			return true;
			} else {
			return false;
		}		
	}
	
	function isEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
			} else {
			return false;
		}
	}
	
	function validaPassword($var1, $var2)
	{
		if (strcmp($var1, $var2) !== 0){
			return false;
			} else {
			return true;
		}
	}
	
	function minMax($min, $max, $valor){
		if(strlen(trim($valor)) < $min)
		{
			return true;
		}
		else if(strlen(trim($valor)) > $max)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function usuarioExiste($usuario)
	{
		global $link;
		
		$stmt = $link->prepare("SELECT id_u FROM usuarios WHERE id_u = ? LIMIT 1");
		$stmt->bind_param("i", $usuario);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}
	
	class Conectar
    {
      public static function con()
      {
        $link = mysqli_connect('localhost', 'root', '') or die("Error al conectar la BD" . mysqli_error($link));
        mysqli_select_db($link, 'congreso_');
        mysqli_query($link, "SET NAMES 'utf8'") or die("Error al seleccionar la BD" . mysqli_error($link));
        return $link;
      }
    }

	$sql3="SELECT usuario_admin FROM admin where id_admin=1";
    $res2=mysqli_query(Conectar::con(),$sql3);
    $sql4=mysqli_fetch_assoc($res2);
    $idu=$sql4;
    $var4=json_encode($idu);
    $obj2 = json_decode($var4);
    $c=$obj2->{'usuario_admin'};

	function emailExiste($email)
	{
		$sql3="SELECT usuario_admin FROM admin where id_admin=1";
		$res2=mysqli_query(Conectar::con(),$sql3);
		$sql4=mysqli_fetch_assoc($res2);
		$idu=$sql4;
		$var4=json_encode($idu);
		$obj2 = json_decode($var4);
		$c=$obj2->{'usuario_admin'};
		if($email != $c){
			global $link;
			
			$stmt = $link->prepare("SELECT id_u FROM usuarios WHERE correo_u = ? LIMIT 1");
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$stmt->store_result();
			$num = $stmt->num_rows;
			$stmt->close();
			
			if ($num > 0){
				return true;
				} else {
				return false;	
			}
		}else{
			return true;
		}
	}
	
	function generateToken()
	{
		//genera un token unico para que nadie pueda suplantar un usuario
		$gen = md5(uniqid(mt_rand(), false));	
		return $gen;
	}
	
	function hashPassword($password) 
	{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		return $hash;
	}
	
	function resultBlock($errors){
		if(count($errors) > 0)
		{
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}
	
	function registraUsuario($id_u, $nomb_u, $apel_u, $univ_u, $correo_u, $clave_u, $estado_u, $token){
		
		global $link;
		
		$stmt = $link->prepare("INSERT INTO usuarios (id_u, nomb_u, apel_u, univ_u, correo_u, clave_u, estado_u, token) VALUES(?,?,?,?,?,?,?,?)");
		$stmt->bind_param('isssssss', $id_u, $nomb_u, $apel_u, $univ_u, $correo_u, $clave_u, $estado_u, $token);
		
		if ($stmt->execute()){
			return $id_u;
			//return true;
			} else {
			return 0;	
		}		
	}
	function registraTel($tel_u, $id_u, $estado){

		$link = mysqli_connect("localhost","root","","congreso_");

		$stmt = $link->prepare("INSERT INTO telefonousuarios (telefono, idUsu, estado_t) VALUES(?,?,?)");
		$stmt->bind_param('iii',$tel_u, $id_u, $estado);
		if ($stmt->execute()){
			//return $id_u;
			return true;
			} else {
			return 0;	
		}
	}
	
	function enviarEmail($email, $nombre, $asunto, $cuerpo){
		
		require 'PHPMailer/src/Exception.php';
		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';

		$mail = new PHPMailer(true);

		
			//Server settings
			$mail->SMTPDebug = 0;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'jdmoralesp@correo.udistrital.edu.co'; //Modificar
			$mail->Password	  = 'chojuanmorales';                              //SMTP password
			$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
			$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom('jdmoralesp@correo.udistrital.edu.co', 'Admin');
			$mail->addAddress($email, $nombre);     //Add a recipient
			$mail->Subject = $asunto;
			$mail->Body    = $cuerpo;
			$mail->isHTML(true);
			if($mail->send()){
			echo"
                    <script type='text/javascript'>
                    Swal.fire({
                    title:'Exito',
                    text:'Para terminar el registro siga las instrucciones enviadas a $email',
                    icon : 'success',
                    }).then((result)=>{
                        if(result.value){
                        window.location='login.php';
                        }
                    });
                    </script>";
					return true;
				}else{
			return false;
				}
	}

	function enviarEmail2($email, $nombre, $asunto, $cuerpo){
		
		require 'PHPMailer/src/Exception.php';
		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';

		$mail = new PHPMailer(true);

		
			//Server settings
			$mail->SMTPDebug = 0;                      					//Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                     	//Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'jdmoralesp@correo.udistrital.edu.co'; 	//Modificar
			$mail->Password	  = 'chojuanmorales';                       //SMTP password
			$mail->SMTPSecure = 'tls';            						//Enable implicit TLS encryption
			$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

			//Recipients
			$mail->setFrom('jdmoralesp@correo.udistrital.edu.co', 'Admin');
			$mail->addAddress($email, $nombre);     //Add a recipient
			$mail->Subject = $asunto;
			$mail->Body    = $cuerpo;
			$mail->isHTML(true);
			if($mail->send()){
			echo"
                    <script type='text/javascript'>
                    Swal.fire({
                    title:'Exito',
                    text:'Registro exitoso, correo de registro enviado',
                    icon : 'success',
                    }).then((result)=>{
                        if(result.value){
                        window.location='crudusu.php';
                        }
                    });
                    </script>";
					return true;
				}else{
			return false;
				}
	}
	
	function validaIdToken($id, $token){
		//global $link;
		$link = mysqli_connect("localhost","root","","congreso_");
		$stmt = $link->prepare("SELECT estado_u FROM usuarios WHERE id_u = ? AND token = ? LIMIT 1");
		$stmt->bind_param("is", $id, $token);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			$stmt->bind_result($activacion);
			$stmt->fetch();
			
			if($activacion == 1){
				$msg = "La cuenta ya se activo anteriormente.";
				} else {
				if(activarUsuario($id)){
					$msg = 'Cuenta activada.';
					} else {
					$msg = 'Error al Activar Cuenta';
				}
			}
			} else {
			$msg = 'No existe el registro para activar.';
		}
		return $msg;
	}
	
	function activarUsuario($id)
	{
		//global $link;
		$link = mysqli_connect("localhost","root","","congreso_");		
		$stmt = $link->prepare("UPDATE usuarios SET estado_u=1 WHERE id_u = ?");
		$stmt->bind_param('i', $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}
	
	function passwhashu($correo){
		$link = mysqli_connect("localhost","root","","congreso_");
		$sql="SELECT clave_u FROM usuarios where correo_u='$correo'";
		$res=mysqli_query($link,$sql) or die ("Error en la consulta $sql");
      while($row = $res->fetch_assoc()) {
          $arrayC =$row; //Almace los datos
          }
          if(empty($arrayC)==False){
			$var = json_encode($arrayC['clave_u']);
			$var2 = json_decode($var);
			return $var2;
		  }
        
	}

	function passwhasha($correo){
		$link = mysqli_connect("localhost","root","","congreso_");
		$sql="SELECT clave_admin FROM admin where usuario_admin='$correo'";
		$res=mysqli_query($link,$sql) or die ("Error en la consulta $sql");
      while($row = $res->fetch_assoc()) {
          $arrayC =$row; //Almace los datos
          }
          
          $var = json_encode($arrayC['clave_admin']);
		  $var2 = json_decode($var);
          return $var2;
        
	}

	function validaestado($correo){

		$link = mysqli_connect("localhost","root","","congreso_");

		$stmt = $link->prepare("SELECT correo_u FROM usuarios where estado_u=1 and correo_u=? LIMIT 1");
		$stmt->bind_param("s", $correo);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();
		
		if ($num > 0){
			return true;
			} else {
			return false;	
		}
	}
	
	function lastSession($correo)
	{
		global $link;
		
		$stmt = $link->prepare("UPDATE usuarios SET last_session=NOW(), token_password='', password_request=0 WHERE correo_u = ?");
		$stmt->bind_param('s', $correo);
		$stmt->execute();
		$stmt->close();
	}
	
	function isActivo($correo)
	{
		$link = mysqli_connect("localhost","root","","congreso_");
		//global $link;
		
		$stmt = $link->prepare("SELECT estado_u FROM usuarios WHERE correo_u = ?  LIMIT 1");
		$stmt->bind_param('s', $correo);
		$stmt->execute();
		$stmt->bind_result($activacion);
		$stmt->fetch();
		
		if ($activacion == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}	
	
	function generaTokenPass($user_id)
	{
		$link = mysqli_connect("localhost","root","","congreso_");
		
		$token = generateToken();
		
		if($user_id != 1){
			$stmt = $link->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE id_u = ?");
			$stmt->bind_param('ss', $token, $user_id);
			$stmt->execute();
			$stmt->close();
		} else {
			$stmt = $link->prepare("UPDATE admin SET token_password=?, password_request=1 WHERE id_admin = ?");
			$stmt->bind_param('ss', $token, $user_id);
			$stmt->execute();
			$stmt->close();
		}
		
		return $token;
	}
	
	function getValor($campo, $campoWhere, $valor)
	{
		global $link;
		
		$stmt = $link->prepare("SELECT $campo FROM usuarios WHERE $campoWhere = ? LIMIT 1");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($campo);
			$stmt->fetch();
			return $campo;
		}
		else
		{
			return null;	
		}
	}

	function getValorAd($campo, $campoWhere, $valor)
	{
		global $link;
		
		$stmt = $link->prepare("SELECT $campo FROM admin WHERE $campoWhere = ? LIMIT 1");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($campo);
			$stmt->fetch();
			return $campo;
		}
		else
		{
			return null;	
		}
	}
	
	function getPasswordRequest($id)
	{
		global $link;
		
		$stmt = $link->prepare("SELECT password_request FROM usuarios WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($id);
		$stmt->fetch();
		
		if ($id == 1)
		{
			return true;
		}
		else
		{
			return null;	
		}
	}
	
	function verificaTokenPass($user_id, $token){
		
		$link = mysqli_connect("localhost","root","","congreso_");
		if($user_id != 1){
			$stmt = $link->prepare("SELECT estado_u FROM usuarios WHERE id_u = ? AND token_password = ? AND password_request = 1 LIMIT 1");
			$stmt->bind_param('is', $user_id, $token);
			$stmt->execute();
			$stmt->store_result();
			$num = $stmt->num_rows;
			
			if ($num > 0)
			{
				$stmt->bind_result($activacion);
				$stmt->fetch();
				if($activacion == 1)
				{
					return true;
				}
				else 
				{
					return false;
				}
			}
			else
			{
				return false;	
			}
		} else {
			$stmt = $link->prepare("SELECT estado_a FROM admin WHERE id_admin = ? AND token_password = ? AND password_request = 1 LIMIT 1");
			$stmt->bind_param('is', $user_id, $token);
			$stmt->execute();
			$stmt->store_result();
			$num = $stmt->num_rows;
			
			if ($num > 0)
			{
				$stmt->bind_result($activacion);
				$stmt->fetch();
				if($activacion == 1)
				{
					return true;
				}
				else 
				{
					return false;
				}
			}
			else
			{
				return false;	
			}
		}
	}
	
	function cambiaPassword($password, $user_id, $token){
		
		global $link;
		if($user_id != 1){
			$stmt = $link->prepare("UPDATE usuarios SET clave_u = ?, token_password='', password_request=0 WHERE id_u = ? AND token_password = ?");
			$stmt->bind_param('sis', $password, $user_id, $token);
			
			if($stmt->execute()){
				return true;
				} else {
				return false;		
			}
		} else {
			$stmt = $link->prepare("UPDATE admin SET clave_admin = ?, token_password='', password_request=0 WHERE id_admin = ? AND token_password = ?");
			$stmt->bind_param('sis', $password, $user_id, $token);
			
			if($stmt->execute()){
				return true;
				} else {
				return false;		
			}
		}
	}	
	
?>


  
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="./jquery/jquery-3.6.0.min.js"></script>

    <script src="./sw/dist/sweetalert2.all.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
    <script src="./bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>