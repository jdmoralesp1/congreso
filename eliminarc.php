<?php
session_start();
if($_SESSION['usuario_admin']){
include ('./class/classc.php');
$con = new Conferencia();
$con->eliminarc(base64_decode($_GET['id_confer']));
}else{
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