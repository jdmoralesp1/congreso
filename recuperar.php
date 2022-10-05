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
  <title>Recuperar Password</title>
  <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
</head>

<body>

<?php
include('./conexion.inc.php');
include('./funcs/funcs.php');
$con = new Conexion();
$link = $con->conectar();

$sql3="SELECT usuario_admin FROM admin where id_admin=1";
$res2=mysqli_query($link,$sql3);
$sql4=mysqli_fetch_assoc($res2);
$idu=$sql4;
$var4=json_encode($idu);
$obj2 = json_decode($var4);
$corr=$obj2->{'usuario_admin'};

# Se crea variable de arrays
$errors=array();
#mira si los datos enviados por post estan vacios
if(!empty($_POST)){
  #extrae el correo enviado por post
  $correo_u = $link->real_escape_string($_POST['correo_u']);
  #revisa si tiene un formato de correo valido
  if(!isEmail($correo_u)){
    $errors[]= "Debe ingresar un correo electronico valido";
  }
    #verifica si el correo existe en la BD
    if(emailExiste($correo_u)){
      #revisa si el correo es de un usuario o del admin
      if($correo_u != $corr){
        #extrae los datos del usuario de la BD para crear el correo de restablecimiento
        $user_id = getValor('id_u', 'correo_u', $correo_u);
        $nombre = getValor('nomb_u', 'correo_u', $correo_u);
        $apellido = getValor('apel_u', 'correo_u', $correo_u);
        #se genera un token unico para el restablecimiento
        $token = generaTokenPass($user_id);
        #la url se genera para que en la clase recordar.php se valide el id y el token enviado por correo
        $url = "http://".$_SERVER["SERVER_NAME"]."/congreso/recordar.php?user_id=".$user_id."&token=".$token;
        $asunto = utf8_decode('Recuperar contraseña - Sistema de Usuarios');
        $cuerpo = "Hola $nombre: <br /><br />Se ha solicitado un restablecimiento de contraseña.<br /><br /> Haga click en la siguiente dirección <a href='$url'>Cambiar Password</a>";
        if(enviarEmail($correo_u, $nombre, $asunto, $cuerpo)){
          echo "<script type='text/javascript'>
                Swal.fire({
                title:'Exito',
                text:'Enviamos un correo a $correo_u para restablecer su contraseña',
                icon : 'success',
                }).then((result)=>{
                    if(result.value){
                      window.location='login.php';
                    }
                });
          </script>";
          exit;
        }
    # el si no de cuando es correo de admin
    } else {
      $user_id = getValorAd('id_admin', 'usuario_admin', $correo_u);
      $token = generaTokenPass($user_id);
      $nombre = "Admin";
      $url = "http://".$_SERVER["SERVER_NAME"]."/congreso/recordar.php?user_id=".$user_id."&token=".$token;
        $asunto = utf8_decode('Recuperar contraseña - Sistema de Usuarios');
        $cuerpo = utf8_decode('Hola $nombre: <br /><br />Se ha solicitado un restablecimiento de contraseña.<br /><br /> Haga click en la siguiente dirección <a href="$url">Cambiar Password</a>');
        if(enviarEmail($correo_u, $nombre, $asunto, $cuerpo)){
          echo "<script type='text/javascript'>
                Swal.fire({
                title:'Exito',
                text:'Enviamos un correo a $correo_u para restablecer su contraseña',
                icon : 'success',
                }).then((result)=>{
                    if(result.value){
                      window.location='login.php';
                    }
                });
          </script>";
          exit;
        }
    }
    } else {
      $errors[]= "No existe el correo electrónico";
    }
}

?>


  <div class="container">
    <div class="card">
      <div class="card-header bg-info">
        <center><h3 class="text-white">Recuperar Password</h3></center>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
         <!--<div class="col-md-6">
          <form name="formu" action="recuperar.php" method="post">
            <label for="id_u">Id:</label>
            <input type="number" id="id_u" name="id_u" class="form-control" placeholder="Digite su id">
        </div>-->
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
           <form name="formu" action="recuperar.php" method="post">
          <center><label for="correo_u">Correo electrónico</label>:</label></center>
          <input type="text" id="correo_u" name="correo_u" class="form-control" placeholder="Digite su correo">
        </div>
        <div class="col-md-3 mt-4" >
        </div>
        <!--<div class="col-md-6">
          <label for="pregunta_u">Color favorito:</label>
          <input type="text" id="pregunta_u" name="pregunta_u" class="form-control" placeholder="Digite su color">
        </div>-->
        <hr class="mt-4">
        <div class="col-md-4">
          <center><input type="reset" value="Limpiar" class="btn btn-success"></center>
        </div>
        <div class="col-md-4">
          <center><input type="submit" value="Enviar" class="btn btn-info" title="Enviar"></center>
        </div>
        <div class="col-md-4">
            <center><input type="button" value="Volver" class="btn btn-success" title="volver" onclick="window.location='login.php'"></center>
        </div>
        </form>
        <?php echo resultBlock($errors); ?>
      </div>
    </div>
  </div>


  <!-- Optional JavaScript; choose one of the two! -->
  <script src="./jquery/jquery-3.6.0.min.js"></script>
  <script src="./sw/dist/sweetalert2.all.min.js"></script>
  <!-- Option 1: Bootstrap Bundle with Popper 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
  <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php
		/*$hash = password_hash('ingrese clave', PASSWORD_DEFAULT);
		echo $hash;*/
?>