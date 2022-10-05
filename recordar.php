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
  <title>Cambiar Password</title>
  <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
</head>

<body>

<?php
include('./conexion.inc.php');
include('./funcs/funcs.php');
$con = new Conexion();
$link = $con->conectar();

if(empty($_GET['user_id'])){
    header('Location:login.php');
}
if(empty($_GET['token'])){
    header('Location:login.php');
}

$user_id=$link->real_escape_string($_GET['user_id']);
$token=$link->real_escape_string($_GET['token']);

if(!verificaTokenPass($user_id,$token)){
    echo "<script type='text/javascript'>
              Swal.fire({
              title:'Error',
              text:'No se pudo verificar la información',
              icon : 'error',
              }).then((result)=>{
                  if(result.value){
                    window.location='login.php';
                  }
              });
              </script>";
    exit;
}


?>

  <div class="container">
    <div class="card">
      <div class="card-header bg-info">
        <h3 class="text-white">Recuperar Password</h3>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
           <form name="formu" action="guarda_pass.php" method="post">
           <label for="password" class="col-md-3 control-label">Nuevo Password</label>
            <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
        </div>
            <input type="hidden" id="user_id" name="user_id" value ="<?php echo $_GET['user_id']; ?>" />
			      <input type="hidden" id="token" name="token" value ="<?php echo $_GET['token']; ?>" />
        <div class="col-md-12">
           <label for="password" class="col-md-3 control-label">Nuevo Password</label>
            <input type="password" class="form-control" name="con_password" placeholder="Confirmar Contraseña" required>
        </div>
        
        <div class="col-md-6 mt-4">
          <button id="btn-login" type="submit" class="btn btn-success">Enviar</a>
        </div>
        </form>
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