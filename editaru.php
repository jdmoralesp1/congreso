<?php
session_start();
if ($_SESSION['usuario_admin']) {
  include("./class/class.php");
  $usu = new Usuario();
  $tele = new Telefono();
  if (isset($_POST['grabar']) && $_POST['grabar'] == "si") {
    $usu->editaru($_POST['nomb_u'], $_POST['apel_u'], $_POST['univ_u'], $_POST['correo_u'], $_POST['id_u']);
    $tele->editart($_POST['tel_u'], $_POST['id_u']);
    exit();
  }
  $reg = $usu->usu_id(base64_decode($_GET['id_u']));
  $reg2 = $tele->tel_id(base64_decode($_GET['id_u']));

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
    <title>Registro de Usuarios</title>
    <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
  </head>

  <body>
    <div class="container">
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="text-white">Modificación de usuario</h3>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <form name="formu" action="editaru.php" method="post">
              <label for="nomb_u">Nombres:</label>
              <input type="text" id="nomb_u" name="nomb_u" class="form-control" value="<?php echo $reg[0]['nomb_u']; ?>" required>
          </div>
          <input type="hidden" name="grabar" value="si">
          <input type="hidden" name="id_u" value="<?php echo base64_decode($_GET["id_u"]); ?>">
          <div class="col-md-6">
            <label for="apel_u">Apelidos:</label>
            <input type="text" id="apel_u" name="apel_u" class="form-control" value="<?php echo $reg[0]['apel_u']; ?>" required>
          </div>
          <div class="col-md-6">
            <label for="univ_u">Universidad o institución a la que pertenece:</label>
            <input type="text" id="univ_u" name="univ_u" class="form-control" value="<?php echo $reg[0]['univ_u']; ?>" required>
          </div>
          <div class="col-md-6">
            <label for="correo_u">Correo:</label>
            <input type="email" id="correo_u" name="correo_u" class="form-control" value="<?php echo $reg[0]['correo_u']; ?>" required>
          </div>
          <div class="col-md-6">
            <label for="tel_u">Telefono:</label>
            <input type="number" min="111111" max="9999999999" id="tel_u" id="tel_u" name="tel_u" class="form-control" value='<?php echo $reg2[0]['telefono']; ?>' required>
          </div>
          <br>
          <div class="col-md-6 mt-3" style="text-align: center;">
            <input type="submit" value="Editar" class="btn btn-primary" title="editar">
          </div>
          <div class="col-md-6 mt-3" style="text-align: center;">
            <input type="button" value="Volver" class="btn btn-success" title="volver" onclick="window.location='crudusu.php'">
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