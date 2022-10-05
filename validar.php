<?php
//definición de la clave del captcha y la clave secreta
define('CLAVE', '6LffmIEfAAAAAD8W_NhwXlmJ3IaZkK8nyYp4LR2h');
//recepción de los datos del captcha
$token = $_POST['token'];
$action = $_POST['action'];

$cu = curl_init();
curl_setopt($cu, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($cu, CURLOPT_POST, 1);
curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query(array('secret' => CLAVE, 'response' => $token)));
curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($cu);
curl_close($cu);

$datos = json_decode($response, true);


//verifique que sea exitoso y que no sea un bot usando el score
if ($datos['success'] == 1 && $datos['score'] >= 0.5) {
  if ($datos['action'] == 'validarUsuario') {
    session_start();
?>
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
      <script src="./sw/dist/sweetalert2.all.min.js"></script>

      <!-- script JS-->
      <script type="text/javascript" language="javascript" src="js/funciones.js"></script>

      <!--ICONOS Google Materials-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
      <title>Operaciones</title>
    </head>

    <body>
  <?php
    include("conexion.inc.php");
    include("funcs/funcs.php");
    $con = new Conexion();
    $link = $con->conectar();

    $sql3="SELECT usuario_admin FROM admin where id_admin=1";
    $res2=mysqli_query($link,$sql3);
    $sql4=mysqli_fetch_assoc($res2);
    $idu=$sql4;
    $var4=json_encode($idu);
    $obj2 = json_decode($var4);
    $corr=$obj2->{'usuario_admin'};

    $user = (isset($_POST['user'])) ? $_POST['user'] : ''; //trae el dato y si no lo trae dejelo vacio
    $pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';

    //validar el usuario y el password
    if ($user == $corr) {
      $pass2 = passwhasha($user);
      $validaclave = password_verify($pass, $pass2);
      if ($validaclave) {
        $sql = "select clave_admin, usuario_admin from admin where usuario_admin='$user' and clave_admin='$pass2'";
        $result = mysqli_query($link, $sql);
        if ($row = mysqli_fetch_array($result)) {
          //crea la variable de sesion del usuario
          $_SESSION['usuario_admin'] = $row['usuario_admin'];
          echo "<script type='text/javascript'>
          Swal.fire({
          title:'Exito',
          text:'Bienvenido $user al sistema',
          icon : 'success',
          }).then((result)=>{
              if(result.value){
                window.location='homeadmin.php';
              }
          });
          </script>";
        }
      } else {
        $_SESSION['usuario_admin'] = NULL;
        echo "<script type='text/javascript'>
        Swal.fire({
         title:'Error',
         text:'Usuario o password incorrectos',
         icon : 'error',
        }).then((result)=>{
             if(result.value){
               window.location='login.php';
             }
        });
        </script>";
      }
    } else {
      $pass2 = passwhashu($user);
      $validaest=validaestado($user);
      $validaclave = password_verify($pass, $pass2);
      if ($validaclave) {
        if($validaest){
        $sql = "select correo_u,clave_u from usuarios where correo_u='$user' and clave_u='$pass2' and estado_u=1";
        $result = mysqli_query($link, $sql);
        if ($row = mysqli_fetch_array($result)) {
          lastSession($user);
          //crea la variable de sesion del usuario
          $_SESSION['correo_u'] = $row['correo_u'];
          echo "<script type='text/javascript'>
        Swal.fire({
         title:'Exito',
         text:'Bienvenido $user al sistema',
         icon : 'success',
        }).then((result)=>{
             if(result.value){
               window.location='index.php';
             }
        });
        </script>";
        }
      } else {
        echo "<script type='text/javascript'>
        Swal.fire({
         title:'Error',
         text:'Usuario no activado',
         icon : 'error',
        }).then((result)=>{
             if(result.value){
               window.location='login.php';
             }
        });
        </script>";
      }
      } else {
        $_SESSION['correo_u'] = NULL;
        echo "<script type='text/javascript'>
        Swal.fire({
         title:'Error',
         text:'Usuario o password incorrectos',
         icon : 'error',
        }).then((result)=>{
             if(result.value){
               window.location='login.php';
             }
        });
        </script>";
      }
    }
  }
} else {
  //si es un bot el que intenta iniciar sesión mostrar este error
  echo "<script type='text/javascript'>
  Swal.fire({
   title:'Error',
   text:'Captcha incorrecto',
   icon : 'error',
  }).then((result)=>{
       if(result.value){
         window.location='login.php';
       }
  });
  </script>";
}

  ?>




  <!-- Optional JavaScript; choose one of the two! -->
  <script src="./jquery/jquery-3.6.0.min.js"></script>
  <!-- Option 1: Bootstrap Bundle with Popper 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
  <script src="./bootstrap/js/bootstrap.min.js"></script>
    </body>

    </html>