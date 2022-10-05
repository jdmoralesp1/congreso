<?php
session_start();
include('./class/classc.php');
if ($_SESSION['correo_u']) {
?>
    <!doctype html>
    <html lang="es">
<?php
$correo=$_SESSION['correo_u'];
$con = mysqli_connect("localhost", "root", "", "congreso_");
$query = "select fecha_c,hora_c from conferencia group by fecha_c,hora_c ORDER by fecha_c;";
$query_run  = mysqli_query($con, $query);
$k=0;
foreach($query_run as $row){
    $arrayf[$k]=$row['fecha_c'];
    $arrayh[$k]=$row['hora_c'];
    $k++;
}
?>
<!DOCTYPE html>
<html lang="en">
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
    <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
    <title>Registro de Conferencias</title>
</head>
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white">Inscripción a conferencias</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    for($i=0;$i<(count($arrayf));$i++){
                        $query2 = "SELECT c.id_confer,c.nomb_c, cf.nomb_conf, c.fecha_c, c.hora_c 
                        FROM conferencia c, conferencista cf 
                        where c.id_conferencista=cf.id_conf and c.fecha_c='$arrayf[$i]' and c.hora_c='$arrayh[$i]' and c.estado_c=1
                        ORDER BY c.fecha_c;";
                        $query_run2  = mysqli_query($con, $query2);
                        $j=0;
                        foreach($query_run2 as $row2){                                                       
                            $arrayidc[$j]=$row2['id_confer'];
                            $arraync[$j]=$row2['nomb_c'];
                            $arrayncf[$j]=$row2['nomb_conf'];
                            $arrayfec[$j]=$row2['fecha_c'];
                            $arrayhor[$j]=$row2['hora_c'];
                            $j++;
                        }
                        
                    ?>
                    <form action="selecciona.php" method="post">
                    <div class="col-md-12">
                        <label for="id_conferencista<?php echo $i;?>"><h5><strong><?php echo "Conferencias del ".$arrayfec[0]." a las ".$arrayhor[0]; ?></strong></h5></label> 
                        <select class="form-select form-select-lg" id="id_conferencista<?php echo $i;?>" name="id_conferencista<?php echo $i;?>" class="form-control">
                        <!--<option value="<?php //echo $arrayidc[0]; ?>"><?php //echo $arrayidc[0]." - ".$arraync[0]." - ".$arrayncf[0]." - ".$arrayfec[0]." - ".$arrayhor[0]; ?></option>-->
                        <option value="0">No asistiré</option>
                        <option value="<?php echo $arrayidc[0]; ?>"><?php echo $arraync[0]." - ".$arrayncf[0]; ?></option>
                        <?php for($c=1;$c<count($arrayidc);$c++){ ?>
                        <option value="<?php echo $arrayidc[$c]; ?>"><?php echo $arraync[$c]." - ".$arrayncf[$c]; ?></option>
                        <?php    
                        }
                        ?>
                        </select>
                        <br>
                    </div>
                    
                    <?php
                    #Vaciar los array para no repetir valores
                    for($t=0;$t<count($arrayf);$t++){
                        unset($arrayidc[$t]);
                        unset($arraync[$t]);
                        unset($arrayncf[$t]);
                        unset($arrayfec[$t]);
                        unset($arrayhor[$t]); 
                    }
                    }
                    ?>
                    <br>
                    <input type="hidden" name="correo_u" value="<?php echo $_SESSION['correo_u']; ?>">
                    <div class="col-md-12 text-center">
                        <input type="button" value="Volver" class="btn btn-primary " title="volver" onclick="window.location='index.php'">
                        <button type="submit" name="envio" class="btn btn-success ">Enviar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
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