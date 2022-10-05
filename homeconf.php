<?php
session_start();
include('./class/classc.php');
$con = mysqli_connect("localhost", "root", "", "congreso_");
$Object = new DateTime();  
$Date = $Object->format("Y-m-d");                   
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
        <title>Registro de Conferencias</title>

        <!--ICONOS Google Materials-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>

    <body onload="limpiarc();">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white">Nuevo registro de Conferencia</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form name="formc" action="insertc.php" method="post">
                            <label for="nomb_c">Nombre:</label>
                            <input type="text" id="nomb_c" name="nomb_c" class="form-control" placeholder="Digite nombre" required>
                    </div>
                    <input type="hidden" id="id_confer" name="id_confer" class="form-control" placeholder="Digite numero conferencia" required>
                    <div class="col-md-6">
                        <label for="fecha_c">Fecha:</label>
                        <input type="date" id="fecha_c" name="fecha_c" class="form-control" placeholder="Digite la fecha" value="<?php echo $Date ?>" min="<?php echo $Date ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label for="hora_c">Hora:</label>
                        <select id="hora_c" name="hora_c" class="form-control" required>
                            <option value="1">1</option>
                            <?php
                            for($i=2;$i<24;$i++){
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="minuto_c">Minuto:</label>
                        <select id="minuto_c" name="minuto_c" class="form-control" required>
                            <option value="00">00</option>
                            <option value="05">05</option>
                            <?php
                            for($i=10;$i<56;$i++){
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                                <?php
                                $i=$i+4;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="estado_c">Estado:</label>
                        <select id="estado_c" name="estado_c" class="form-control" required>
                            <option value="1">Activa</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="link_c">Link:</label>
                        <input type="text" id="link_c" name="link_c" class="form-control" placeholder="Digite link de la reunion">
                    </div>
                    <div class="col-md-6">
                        <label for="id_conferencista">Conferencista:</label>
                        <select id="id_conferencista" name="id_conferencista" class="form-control">
                            <option value="1">Por Asignar</option>
                            <?php
                            $query = "select * from conferencista where estado_co=1";
                            $getconferencista = mysqli_query($con,$query);
                            while($row = mysqli_fetch_array($getconferencista)){
                                $id_conf = $row['id_conf'];
                                $nomb_conf = $row['nomb_conf'];
                            ?>
                            <option value="<?php echo $id_conf; ?>"><?php echo $id_conf." - ".$nomb_conf ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="col-md-4 mt-4">
                        <!--<center><input type="button" value="Registrar" class="btn btn-success" title="Registrar" onclick="validarc();"></center>-->
                        <center><input type="submit" value="Registrar" class="btn btn-success" title="Registrar"></center>
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

        <hr>

        <?php
        //crear el objeto de la clase usuario
        $conf = new Conferencia;
        $reg = $conf->ver_conf();
        $idconf = new idconf;
        ?>
        <div class="card-footer">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id Conferencia</th>
                        <th>Nombre</th>
                        <th>Conferencista</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Link</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <?php

                for ($i = 0; $i < count($reg); $i++) {
                    if ($reg[$i]['estado_c'] == 0) {
                        $variable = "Inactiva";
                    } else {
                        $variable = "Activa";
                    }
                    echo "
                <tr>
                    <td>" . $reg[$i]['id_confer'] . "</td>
                    <td>" . $reg[$i]['nomb_c'] . "</td>
                    <td>" . $reg[$i]['nomb_conf'] . "</td>
                    <td>" . $reg[$i]['fecha_c'] . "</td>
                    <td>" . $reg[$i]['hora_c'] . "</td>
                    <td>" . $variable . "</td>
                    <td>" . $reg[$i]['link_c'] . "</td>
                ";

                ?>
                    <td>
                        <button class="btn btn-warning" onclick=window.location='./editarc.php?id_confer=<?php echo base64_encode($reg[$i]['id_confer']); ?>'>
                            <span class="material-icons">edit</span>
                        </button>

                        <button class="btn btn-danger" onclick="eliminar('eliminarc.php?id_confer=<?php echo base64_encode($reg[$i]['id_confer']); ?>')">
                            <span class="material-icons">delete</span>
                        </button>
                    </td>
                    </tr>
                <?php } ?>

            </table>
            <div class="row">
                <div class="col-md-6">
                    <center><a href="reporte_conferencias.php" target="_blank"><input type="button" value="Reporte Conferencias PDF" class="btn btn-secondary" title="Reporte PDF"></a></center>
                </div>
                <div class="col-md-6">
                    <center><a href="reporte_excel_conferencias.php" target="_blank"><input type="button" value="Reporte Conferencias EXCEL" class="btn btn-success" title="Reporte EXCEL"></a></center>
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