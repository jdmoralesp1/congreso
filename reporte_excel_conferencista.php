<?php
require('conexion.inc.php');
$con = new Conexion();
$mysqli=$con->conectar();
$consulta = "SELECT *
            FROM conferencista";
$resultado = $mysqli->query($consulta);
header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachement; filename=Conferencistas.xls");
?>

<meta charset=UTF-8>
<table border="1">
    <caption><strong>Conferencistas</strong></caption>
    <tr>
        <th>Identificación</th>
        <th>Nombre</th>
        <th>Correo</th>
    </tr>

    <?php while($row = $resultado->fetch_assoc()){?>
    <tr>
        <td><?php echo $row['id_conf'];?></td>
        <td><?php echo $row['nomb_conf'];?></td>
        <td><?php echo $row['correo_c'];?></td>
    </tr>
    <?php }?>
</table>