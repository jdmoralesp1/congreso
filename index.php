<?php
session_start();
include("./class/classc.php");
if ($_SESSION['correo_u']) {
  $correou = $_SESSION['correo_u'];
  $sql="select nomb_u from usuarios where correo_u='$correou'";
  $res=mysqli_query(Conectar::con(),$sql);
  $sql=mysqli_fetch_assoc($res);
  $idu=$sql;
  $var=json_encode($idu);
  $obj2 = json_decode($var);
  $usu=$obj2->{'nomb_u'};

  $sql3="select id_u from usuarios where correo_u='$correou'";
  $res2=mysqli_query(Conectar::con(),$sql3);
  $sql4=mysqli_fetch_assoc($res2);
  $idu=$sql4;
  $var4=json_encode($idu);
  $obj2 = json_decode($var4);
  $c=$obj2->{'id_u'};

  $sql5="select apel_u from usuarios where correo_u='$correou'";
  $res5=mysqli_query(Conectar::con(),$sql5);
  $sql5=mysqli_fetch_assoc($res5);
  $idu=$sql5;
  $var5=json_encode($idu);
  $obj2 = json_decode($var5);
  $apel=$obj2->{'apel_u'};
?>
  <!doctype html>
  <html lang="es">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
    function deshabilitaRetroceso(){
    window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button" //chrome
    window.onhashchange=function(){window.location.hash="no-back-button";}
    }
    function nav(value) {
      if (value != "") { location.href = value; }
    }
    </script>

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

  <body onload="deshabilitaRetroceso()">
    <div class="container">
      <div class="card">
        <div class="card-header bg-info">
          <div class="card-body">
            <div class="row">
            <div class="col-md-6">
                <center>
                  <h4 class="text-white">Bienvenido <?php echo $usu." ".$apel; ?></h4>
                  <center>
              </div>
              <div class="col-md-4">
              </div>
              <div class="col-md-2 select">
                <select onChange=nav(this.value) name=combo1 class="form-select form-select-sm">
                  <option selected> Opciones </option>
                  <option value="./modificarusu.php">Actualizar datos</option>
                  <option value="./salir.php" class="btn btn-danger">Cerrar Sesión</option>
                </select>
              </div>
              <div class="col-md-12">
                <p></p>
              </div>
              <div class="col-md-12">
                <center>
                  <h3 class="text-white">Conferencias</h3>
                </center>
              </div>
            </div>
          </div>
        </div>

        <?php
        //crear el objeto de la clase usuario
        $conf = new Conferencia;
        $reg = $conf->ver_conf3($_SESSION['correo_u']);
        ?>
        <div>
          <form name="formselec" action="index.php" method="post">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id Conferencia</th>
                  <th>Nombre</th>
                  <th>Conferencista</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Link</th>
                </tr>
                <input type="hidden" name="correo_u" value="<?php echo $_SESSION['correo_u']; ?>">

              </thead>
              <?php

              for ($i = 0; $i < count($reg); $i++) {

                echo "
                <tr>
                    <td>" . $reg[$i]['id_confer'] . "</td>
                    <td>" . $reg[$i]['nomb_c'] . "</td>
                    <td>" . $reg[$i]['nomb_conf'] . "</td>
                    <td>" . $reg[$i]['fecha_c'] . "</td>
                    <td>" . $reg[$i]['hora_c'] . "</td>
                    <td>" . $reg[$i]['link_c'] . "</td> 
                ";
              ?>
                </tr>
              <?php

              } ?>

            </table>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <center><input type="button" value="Agregar o modificar reuniones" class="btn btn-success" title="Agregar" onclick="window.location='agregar_copy.php'"></center>
                </div>
              </div>
            </div>
            <div>


            </div>
          </form>
        </div>
      </div>
    </div>
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
  $_SESSION['correo_u'] = NULL;
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