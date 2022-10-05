
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

$user_id=$link->real_escape_string($_POST['user_id']);
$token=$link->real_escape_string($_POST['token']);
$password=$link->real_escape_string($_POST['password']);
$con_password=$link->real_escape_string($_POST['con_password']);

if(validaPassword($password,$con_password)){
    $pass_hash=hashPassword($password);
    if(cambiaPassword($pass_hash,$user_id,$token)){
        echo "<script type='text/javascript'>
              Swal.fire({
              title:'Exito',
              text:'Contraseña modificada',
              icon : 'success',
              }).then((result)=>{
                  if(result.value){
                    window.location='login.php';
                  }
              });
        </script>";
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