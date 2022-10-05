<?php
include("./class/classc.php");

if(isset($_POST['envio']))
{
    $all_id = $_POST['arreglo'];
    $extract_id = implode(',' , $all_id);
    $correou=$_REQUEST['correo_u'];
    echo $correou;
    $conf=new Conferencia();
    $usu=new Usuario();
    $conf->correo($_REQUEST['correo_u']);
    for($i=0;$i<count($all_id);$i++){
    $conf->insertarhas($all_id[$i]);
    $conf->idconf($all_id[$i]);
    }

}
?>