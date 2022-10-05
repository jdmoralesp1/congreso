<?php
$con = mysqli_connect("localhost","root","","congreso_");

if(isset($_POST['envio']))
{
    $all_id = $_POST['arreglo'];
    $extract_id = implode(',' , $all_id);
    $correou=$_REQUEST['correo_u'];
    echo $extract_id;
   
    for($i=0;$i<count($all_id);$i++){
     // echo $i;
    
    $idu = "select id_u from usuarios where correo_u='$correou'";
    $query_run1 = mysqli_query($con, $idu);
    $idc = "select id_conferencista from conferencia where id_confer = $all_id[$i]";
    echo $idc;
    $query_run2 = mysqli_query($con, $idc);
    $idco = "select id_confer from conferencia where id_confer = $all_id[$i]";
    $query_run3 = mysqli_query($con, $idco);
    $query = "INSERT INTO conferencia_has_usuarios values ('$query_run3', '$query_run2', '$query_run1')";
    $query_run = mysqli_query($con, $query);
    }

    if($query_run)
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
         text:'Debe iniciar sesion',
         icon : 'error',
        }).then((result)=>{
             if(result.value){
               window.location='agregar.php';
             }
        });
        </script>";
    }
}
?>