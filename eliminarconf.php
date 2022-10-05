<?php
session_start();
if ($_SESSION['usuario_admin']) {
  include('./class/classconferencista.php');
  $conf = new Conferencista();
  $conf->eliminarconf(base64_decode($_GET['id_conf']));
  $conf->eliminarconf2(base64_decode($_GET['id_conf']));
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