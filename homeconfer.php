<?php
session_start();
include('./class/classconferencista.php');
if ($_SESSION['usuario_admin']) {
?>
    <!doctype html>
    <html lang="es">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
        <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
        <link rel="stylesheet" language="javascript" href="./bootstrap/css/bootstrap.min.css">

        <!--sweetalert-->
        <link rel="stylesheet" href="./sw/dist/sweetalert2.min.css">

        <!-- script JS-->
        <script type="text/javascript" language="javascript" src="js/funciones.js"></script>

        <!--ICONOS Google Materials-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Registro de Conferencista</title>
    </head>

    <body onload="limpiarconfer();">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white">Nuevo registro de Conferencista</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form name="formconfer" action="insertconf.php" method="post">
                            <label for="id_conf">Id de Conferencista:</label>
                            <input type="number" id="id_conf" name="id_conf" class="form-control" placeholder="Digite id de conferencista" value="<?php if (isset($id_conf)) echo $id_conf; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="nomb_conf">Nombres y Apellidos:</label>
                        <input type="text" id="nomb_conf" name="nomb_conf" class="form-control" placeholder="Digite nombre conferencista" value="<?php if (isset($nomb_conf)) echo $nomb_conf; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="correo_c">Correo:</label>
                        <input type="text" id="correo_c" name="correo_c" class="form-control" placeholder="Digite correo conferencista" value="<?php if (isset($nomb_conf)) echo $nomb_conf; ?>" required>
                    </div>
                    <div class="col-md-6">
                    </div>
                    
                    <div class="col-md-4 mt-4">
                        <center><input type="button" value="Registrar" class="btn btn-success" title="Registrar" onclick="validarconfer();"></center>
                    </div>
                    <div class="col-md-4 mt-4">
                        <center><input type="reset" value="Limpiar" class="btn btn-info"></center>
                    </div>
                    <div class="col-md-4 mt-4">
                        <center><input type="button" value="Volver" class="btn btn-success" title="volver" onclick="window.location='homeadmin.php'"></center>
                    </div>
                    </form>
                </div>

            </div>
        </div>



        <?php
        //crear el objeto de la clase usuario

        $confer = new Conferencista;
        $reg = $confer->ver_conf();
        ?>
        <div class="card-footer">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Identificación</th>
                        <th>Nombres y Apellidos</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <?php
                //traer los datos de la funcion ver_usu
                for ($i = 0; $i < count($reg); $i++) {
                    echo "
            <tr>
                <td>" . $reg[$i]['id_conf'] . "</td>
                <td>" . $reg[$i]['nomb_conf'] . "</td>
                <td>" . $reg[$i]['correo_c'] . "</td>
            ";

                ?>
                    <td>
                        <button class="btn btn-warning" onclick=window.location="./editarconf.php?id_conf=<?php echo base64_encode($reg[$i]['id_conf']); ?>">
                            <span class="material-icons">edit</span>
                        </button>

                        <button class="btn btn-danger" onclick="eliminar('eliminarconf.php?id_conf=<?php echo base64_encode($reg[$i]['id_conf']); ?>')">
                            <span class="material-icons">delete</span>
                        </button>
                    </td>
                <?php } ?>

            </table>
            <div class="row">
                <div class="col-md-6 mt-4">
                    <center><a href="reporte_conferencistas.php" target="_blank"><input type="button" value="Reporte Conferencistas en PDF" class="btn btn-secondary" title="Reporte PDF"></a></center>
                </div>
                <div class="col-md-6 mt-4">
                    <center><a href="reporte_excel_conferencista.php" target="_blank"><input type="button" value="Reporte Conferencistas en EXCEL" class="btn btn-success" title="Reporte EXCEL"></a></center>
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