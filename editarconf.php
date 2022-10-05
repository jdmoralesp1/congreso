<?php
session_start();
include("./class/classconferencista.php");
if ($_SESSION['usuario_admin']) {
  $conf = new Conferencista();
  if (isset($_POST['grabar']) && $_POST['grabar'] == "si") {
    $conf->editarconf($_POST['nomb_conf'], $_POST['correo_c'], $_POST['id_conf']);
    exit();
  }
  $reg = $conf->confer_id(base64_decode($_GET['id_conf']));

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

    <!-- script JS-->
    <script type="text/javascript" language="javascript" src="js/funciones.js"></script>
    <title>Registro de Conferencista</title>
    <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
  </head>

  <body>
    <div class="container">
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="text-white">Modificación de conferencista</h3>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <form name="formconfer" action="editarconf.php" method="post">
              <label for="nomb_conf">Nombre:</label>
              <input type="text" id="nomb_conf" name="nomb_conf" class="form-control" value="<?php echo $reg[0]['nomb_conf']; ?>">
          </div>
          <input type="hidden" name="grabar" value="si">
          <input type="hidden" name="id_conf" value="<?php echo base64_decode($_GET["id_conf"]); ?>">
          <div class="col-md-6">
            <label for="correo_c">Correo:</label>
            <input type="text" id="correo_c" name="correo_c" class="form-control" value="<?php echo $reg[0]['correo_c']; ?>">
          </div>

          <div class="col-md-6 mt-3" style="text-align: center;">
            <input type="button" value="Volver" class="btn btn-primary" title="volver" onclick="window.location='homeconfer.php'">
          </div>
          <div class="col-md-6 mt-3" style="text-align: center;">
            <input type="submit" value="Editar" class="btn btn-success" title="editar">
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
<?php
} else {
  $_SESSION['usuario_admin'] = NULL;
  echo "<script type='text/javascript'>
  Swal.fire({
   title:'Error',
   text:'Debe iniciar sesion',
   icon : 'error',
  }).then((result)=>{
       if(result.value){
         window.location='login.php';
       }
  });
  </script>";
}

?>