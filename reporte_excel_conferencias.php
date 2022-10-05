<?php
require('conexion.inc.php');
$con = new Conexion();
$mysqli=$con->conectar();
$consulta = "SELECT c.id_confer,c.nomb_c, cf.nomb_conf, c.fecha_c,c.hora_c, c.link_c 
FROM conferencia c, conferencista cf 
where c.id_conferencista=cf.id_conf ORDER BY c.fecha_c";
$resultado = $mysqli->query($consulta);
header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachement; filename=Conferencias.xls");
?>

<meta charset=UTF-8>
<table border="1">
    <caption><strong>Conferencias</strong></caption>
    <tr>
        <th>Id Conferencia</th>
        <th>Nombre</th>
        <th>Conferencista</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>URL</th>
    </tr>

    <?php while($row = $resultado->fetch_assoc()){?>
    <tr>
        <td><?php echo $row['id_confer'];?></td>
        <td><?php echo $row['nomb_c'];?></td>
        <td><?php echo $row['nomb_conf'];?></td>
        <td><?php echo $row['fecha_c'];?></td>
        <td><?php echo $row['hora_c'];?></td>
        <td><?php echo $row['link_c'];?></td>
    </tr>
    <?php }?>
</table>