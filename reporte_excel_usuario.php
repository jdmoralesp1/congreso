<?php
require('conexion.inc.php');
$con = new Conexion();
$mysqli=$con->conectar();
$consulta = "SELECT u.id_u, u.nomb_u, u.apel_u, u.univ_u, u.correo_u, t.telefono, u.clave_u
            FROM usuarios u, telefonousuarios t
            where u.id_u=t.idUsu and u.estado_u=1";
$resultado = $mysqli->query($consulta);
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachement; filename=Usuarios.xls");
?>
<meta charset=UTF-8>
<table border="1">
    <caption><strong>Usuarios</strong></caption>
    <tr>
        <th>Identificación</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Institución</th>
        <th>Correo</th>
        <th>Telefono</th>
    </tr>

    <?php while($row = $resultado->fetch_assoc()){?>
    <tr>
        <td><?php echo $row['id_u'];?></td>
        <td><?php echo $row['nomb_u'];?></td>
        <td><?php echo $row['apel_u'];?></td>
        <td><?php echo $row['univ_u'];?></td>
        <td><?php echo $row['correo_u'];?></td>
        <td><?php echo $row['telefono'];?></td>
    </tr>
    <?php }?>
</table>