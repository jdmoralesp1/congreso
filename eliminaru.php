<?php
session_start();
if ($_SESSION['usuario_admin']) {
  include('./class/class.php');
  $usu = new Usuario();
  $usu->eliminaru(base64_decode($_GET['id_u']));
  $usu->eliminaru2(base64_decode($_GET['id_u']));
} else {
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