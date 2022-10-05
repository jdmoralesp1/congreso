<?php
include("./class/class.php");
$usu=new Usuariou();
$usu->insertaruu($_REQUEST['id_u'],$_REQUEST['nomb_u'],$_REQUEST['apel_u'],$_REQUEST['univ_u'],$_REQUEST['correo_u'],$_REQUEST['clave_u'],"",1);
$usu->insertartu($_REQUEST['tel_u'],$_REQUEST['id_u'],1);
?>