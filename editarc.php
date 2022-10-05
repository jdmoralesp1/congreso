<?php
session_start();
include('./class/classc.php');
$con = mysqli_connect("localhost", "root", "", "congreso_");
$Object = new DateTime();  
$Date = $Object->format("Y-m-d"); 
if ($_SESSION['usuario_admin']) {
    $conf = new Conferencia();
    if (isset($_POST['grabar']) && $_POST['grabar'] == "si") {
        $conf->editarc(
            $_POST['nomb_c'],
            $_POST['fecha_c'],
            $_POST['hora_c'],
            $_POST['minuto_c'],
            $_POST['estado_c'],
            $_POST['link_c'],
            $_POST['id_conferencista'],
            $_POST['id_confer']
        );
        exit();
    }
    $reg = $conf->conf_id(base64_decode($_GET['id_confer']));
    $id = base64_decode($_GET['id_confer']);
    $estado;
    if($reg[0]['estado_c'] == 0){
        $estado="Inactiva";
    }else{
        $estado="Activa";
    }
    $query2 = "select hora_c from conferencia where id_confer=$id";
    $gethora = mysqli_query($con,$query2);
    $sql=mysqli_fetch_assoc($gethora);
    $idu=$sql;
    $var=json_encode($idu);
    $obj2 = json_decode($var);
    $c=$obj2->{'hora_c'};
    $separador = ":";
    $separada = explode($separador, $c);




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
        <title>Registro de Conferencia</title>
        <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
    </head>

    <body>
        <div class="container">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white">Modificación de conferencia</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form name="formc" action="editarc.php" method="post">
                            <label for="nomb_c">Nombre:</label>
                            <input type="text" id="nomb_c" name="nomb_c" class="form-control" value="<?php echo $reg[0]['nomb_c']; ?>">
                    </div>
                    <input type="hidden" name="grabar" value="si">
                    <input type="hidden" name="id_confer" value="<?php echo base64_decode($_GET["id_confer"]); ?>">
                    <div class="col-md-6">
                        <label for="fecha_c">Fecha:</label>
                        <input type="date" id="fecha_c" name="fecha_c" class="form-control" value="<?php echo $reg[0]['fecha_c']; ?>" min="<?php echo $Date ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="hora_c">Hora:</label>
                        <select id="hora_c" name="hora_c" class="form-control" required>
                            <option value="<?php echo $separada[0]; ?>"><?php echo $separada[0];?></option>
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
                            <option value="<?php echo $separada[1]; ?>"><?php echo $separada[1];?></option>
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
                        <select id="estado_c" name="estado_c" class="form-control">
                            <option value="<?php echo $reg[0]['estado_c']; ?>"><?php echo $estado ?></option>
                            <option value=0>Inactiva</option>
                            <option value=1>Activa</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="link_c">Link:</label>
                        <input type="text" id="link_c" name="link_c" class="form-control" value="<?php echo $reg[0]['link_c']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="id_conferencista">Conferencista:</label>
                        <select id="id_conferencista" name="id_conferencista" class="form-control">
                            <option value="<?php echo $reg[0]['id_conferencista']; ?>"><?php echo $reg[0]['id_conferencista']." - ".$reg[0]['nomb_conf']; ?></option>
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
                    <div class="col-md-6 mt-3" style="text-align: center;">
                        <input type="button" value="Volver" class="btn btn-primary" title="volver" onclick="window.location='homeconf.php'">
                    </div>
                    <div class="col-md-6 mt-3" style="text-align: center;">
                        <input type="submit" value="Editar" class="btn btn-success" title="editar">
                    </div>
                    </form>
                </div>

            </div>
        </div>        
            </table>
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