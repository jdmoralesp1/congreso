<?php
session_start();
include('./class/class.php');
if($_SESSION['usuario_admin']){
?>
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

  <!--ICONOS Google Materials-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      
    <title>Gestión de Usuarios</title>
    <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
  </head>
  <body>

  
<?php
//crear el objeto de la clase usuario
$usu=new Usuario;
$reg=$usu->ver_usu();
$tele= new Telefono;
$regt=$tele->ver_tele();
?>
<div class="card-footer">
    <table class ="table table-striped">
        <thead>
            <tr>
                <th>Identificación</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Universidad</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <?php
        //traer los datos de la funcion ver_usu
        for($i=0;$i<count($reg);$i++){
            echo "
            <tr>
                <td>".$reg[$i]['id_u']."</td>
                <td>".$reg[$i]['nomb_u']."</td>
                <td>".$reg[$i]['apel_u']."</td>
                <td>".$reg[$i]['univ_u']."</td>
                <td>".$reg[$i]['correo_u']."</td>
                <td>".$regt[$i]['telefono']."</td>
                
            ";
        
        ?>
        <td>
          <button class="btn btn-warning" onclick=window.location='./editaru.php?id_u=<?php echo base64_encode($reg[$i]['id_u']);?>'>
            <span class="material-icons">edit</span>
            </button>
        
            <button class="btn btn-danger" onclick="eliminar('eliminaru.php?id_u=<?php echo base64_encode($reg[$i]['id_u']);?>')">
            <span class="material-icons">delete</span>
            </button>
            
        </td>
    </tr>
    
    <?php } ?>

    </table>
    
    <div class="row">
        <div class="col-md-3">
              <center><input type="button" value="Agregar" class="btn btn-primary" title="agregar" onclick="window.location='homeusu.php'"></center>
        </div>
        
        <div class="col-md-3">
              <center><input type="button" value="Volver" class="btn btn-success" title="volver" onclick="window.location='homeadmin.php'"></center>
        </div> 
        <div class="col-md-3">
              <center><a href="reporte_usuarios.php" target="_blank"><input type="button" value="Reporte PDF" class="btn btn-secondary" title="reporte PDF"></a></center>
        </div>
        <div class="col-md-3">
              <center><a href="reporte_excel_usuario.php" target="_blank"><input type="button" value="Reporte EXCEL" class="btn btn-info" title="reporte EXCEL"></a></center>
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
}else{
  $_SESSION['usuario_admin']=NULL;
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