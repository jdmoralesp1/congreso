<?php
require('conexion.inc.php');
$con = new Conexion();
$mysqli=$con->conectar();
$consulta = "SELECT u.id_u, c.id_confer, c.nomb_c, cf.nomb_conf, c.fecha_c, c.hora_c
            FROM conferencia c, usuarios u, conferencista cf, conferencia_has_usuarios coh
            where c.id_confer=coh.Conferencia_id_confer and coh.Usuarios_id_u=u.id_u 
            and coh.Conferencia_id_conferencista=cf.id_conf ORDER BY u.id_u;";
$resultado = $mysqli->query($consulta);
header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachement; filename=Usuarios-Conferencias.xls");
?>

<meta charset=UTF-8>
<table border="1">
    <caption><strong>Usuarios y Conferencias</strong></caption>
    <tr>
        <th>Id usuario</th>
        <th>Id conferencia</th>
        <th>Conferencia</th>
        <th>Conferencista</th>
        <th>Fecha</th>
        <th>Hora</th>
    </tr>

    <?php while($row = $resultado->fetch_assoc()){?>
    <tr>
        <td><?php echo $row['id_u'];?></td>
        <td><?php echo $row['id_confer'];?></td>
        <td><?php echo $row['nomb_c'];?></td>
        <td><?php echo $row['nomb_conf'];?></td>
        <td><?php echo $row['fecha_c'];?></td>
        <td><?php echo $row['hora_c'];?></td>
    </tr>
    <?php }?>
</table>