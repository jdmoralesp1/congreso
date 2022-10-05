<?php
class Conexion{
public static function conectar(){
    $link=mysqli_connect("localhost","root","") or die("Error al conectar la BD");
    mysqli_select_db($link,'congreso_') or die("Error al seleccionar la BD");
    return $link;
    }
}
?>