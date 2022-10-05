<?php
include("./class/classc.php");
$conf=new Conferencia();
$conf->insertarc($_REQUEST['id_confer'],$_REQUEST['nomb_c'],$_REQUEST['fecha_c'],$_REQUEST['hora_c'],$_REQUEST['minuto_c'],
$_REQUEST['estado_c'],$_REQUEST['link_c'],$_REQUEST['id_conferencista']);
?>