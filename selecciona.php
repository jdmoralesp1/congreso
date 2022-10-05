<?php
session_start();
include('./class/classc.php');
if($_SESSION['correo_u']){
$conf = new Conferencia();
$con = mysqli_connect("localhost","root","","congreso_");

if(isset($_POST['envio']))
{
    $correou=$_REQUEST['correo_u'];
    $query = "select fecha_c,hora_c from conferencia group by fecha_c,hora_c ORDER by fecha_c;";
    $query_run  = mysqli_query($con, $query);
    $k=0;
    foreach($query_run as $row){
        $arrayf[$k]=$row['fecha_c'];
        $k++;
        $conteo=count($arrayf);
    }
    for($i=0;$i<$conteo;$i++){
        $ids[$i]=$_POST['id_conferencista'.$i];
        if($ids[$i] != 0){
          $query2 = "SELECT id_conferencista from conferencia WHERE id_confer=$ids[$i]";
          $query_run2  = mysqli_query($con, $query2);
          $sql=mysqli_fetch_assoc($query_run2);
          $idc=$sql;
          $var=json_encode($idc);
          $obj = json_decode($var);
          $c=$obj->{'id_conferencista'};
          $idcon[$i]=$c;
        }
    }

    $sql3="select id_u from usuarios where correo_u='$correou'";
    $res2=mysqli_query(Conectar::con(),$sql3);
    $sql4=mysqli_fetch_assoc($res2);
    $idu=$sql4;
    $var4=json_encode($idu);
    $obj2 = json_decode($var4);
    $usu=$obj2->{'id_u'};
    $query3 = "DELETE FROM conferencia_has_usuarios WHERE Usuarios_id_u=$usu ";
    $query_run3 = mysqli_query($con, $query3);

    for($i=0;$i<count($ids);$i++){
      if($ids[$i] != 0){
        $query4 = "INSERT INTO conferencia_has_usuarios values ($ids[$i], $idcon[$i], $usu)";
        $query_run4 = mysqli_query($con, $query4);
      }
    }

    if($query_run4)
    {
        echo"
        <script type='text/javascript'>
        Swal.fire({
         title:'Exito',
         text:'Las conferencias se Registraron Correctamente',
         icon : 'success',
        }).then((result)=>{
             if(result.value){
               window.location='index.php';
             }
        });
        </script>";
    }
    else
    {
        echo "<script type='text/javascript'>
        Swal.fire({
         title:'Error',
         text:'Fallo la inserción',
         icon : 'error',
        }).then((result)=>{
             if(result.value){
               window.location='agregar_copy.php';
             }
        });
        </script>";
    }








}else {
    echo "<script type='text/javascript'>
    Swal.fire({
     title:'Error',
     text:'Fallo en envio de datos',
     icon : 'error',
    }).then((result)=>{
         if(result.value){
           window.location='agregar_copy.php';
         }
    });
    </script>";
}


}else{
    $_SESSION['correo_u']=NULL;
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