<?php
session_start();
//include('./class/class.php');
if ($_SESSION['usuario_admin']) {
?>
  <!doctype html>
  <html lang="es">

  <head >
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <link rel="stylesheet" language="javascript" href="./bootstrap/css/bootstrap.min.css">

    <!--sweetalert-->
    <link rel="stylesheet" href="./sw/dist/sweetalert2.min.css">
    <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">

    <!-- script JS-->
    <script type="text/javascript" language="javascript" src="js/funciones.js"></script>
    <script>
    function deshabilitaRetroceso(){
    window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button" //chrome
    window.onhashchange=function(){window.location.hash="no-back-button";}
    }</script>

    <!--ICONOS Google Materials-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Operaciones</title>
  </head>

  <body onload="deshabilitaRetroceso()">
    <div class="container">
      <div class="card">
        <div class="card-header bg-info">
          <div class="card-body">
            <div class="row">
              <div class="col-md-10">
                <center>
                  <h2 class="text-white">Bienvenido <?php echo $_SESSION['usuario_admin'] ?></h2>
                  <center>
              </div>
              
              <div class="col-md-2" style="text-align: right;">
                <center><a class="btn btn-danger" href="./salir.php" role="button">Cerrar Sesión</a><center>
              </div>
              <div class="col-md-12 mt-3">
                <center>
                  <h3 class="text-white">Operaciones sobre tablas</h3>
                </center>
              </div>

            </div>
          </div>
        </div>


      </div>
    </div>
    <br>
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <center><input type="button" value="Usuarios" class="btn btn-success" title="usuarios" onclick="window.location='crudusu.php'"></center>
        </div>
        <div class="col-md-4">
          <center><input type="button" value="Conferencias" class="btn btn-success" title="conferencias" onclick="window.location='homeconf.php'"></center>
        </div>
        <div class="col-md-4">
          <center><input type="button" value="Conferencistas" class="btn btn-success" title="conferencistas" onclick="window.location='homeconfer.php'"></center>
        </div>
        <div class="col-md-12">
          <br>
          <hr>
        </div>
        
        <div class="col-md-6">
          <center><a href="reporteusuconfe.php" target="_blank"><input type="button" value="Reporte Usuarios y sus Conferencias PDF" class="btn btn-secondary" title="Reporte PDF"></a></center>
        </div>
        <div class="col-md-6">
          <center><a href="reporte_excel_usuconf.php" target="_blank"><input type="button" value="Reporte Usuarios y sus Conferencias EXCEL" class="btn btn-warning" title="Reporte EXCEL"></a></center>
        </div>
      </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="./jquery/jquery-3.6.0.min.js"></script>
    <!--<script>window.history.go(-2);</script>-->

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