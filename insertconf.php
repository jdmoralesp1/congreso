<?php
include("./class/classconferencista.php");
$conf=new Conferencista();
$conf->insertarconf($_REQUEST['id_conf'],$_REQUEST['nomb_conf'],$_REQUEST['correo_c'],1);
?>