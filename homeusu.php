<?php
session_start();
if ($_SESSION['usuario_admin']) {
?>
  <!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <link rel="stylesheet" language="javascript" href="./bootstrap/css/bootstrap.min.css">

    <!--sweetalert-->
    <link rel="stylesheet" href="./sw/dist/sweetalert2.min.css">

    <!-- script JS-->
    <script type="text/javascript" language="javascript" src="js/funciones.js"></script>
    <title>Registro de Usuarios</title>
    <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
</head>

<body>

    <?php
    include("conexion.inc.php");
    include("./funcs/funcs.php");
    $con = new Conexion();
    $link = $con->conectar();

    $errors = array();
    if (!empty($_POST)) {
        $id_u = $link->real_escape_string($_POST["id_u"]);
        $nomb_u = $link->real_escape_string($_POST["nomb_u"]);
        $apel_u = $link->real_escape_string($_POST["apel_u"]);
        $univ_u = $link->real_escape_string($_POST["univ_u"]);
        $correo_u = $link->real_escape_string($_POST["correo_u"]);
        $tel_u = $link->real_escape_string($_POST["tel_u"]);
        $clave_u = $link->real_escape_string($_POST["clave_u"]);
        $con_password = $link->real_escape_string($_POST["con_password"]);
        $estado_u = 0;
        $estado_tel = 1;

        if (isNull($id_u, $nomb_u, $apel_u, $univ_u, $correo_u, $tel_u, $clave_u, $con_password)) {
            $errors[] = "Debe llenar todos los campos";
        }

        if (!isEmail($correo_u)) {
            $errors[] = "Dirección de correo invalida";
        }

        if (!validaPassword($clave_u, $con_password)) {
            $errors[] = "Las contraseñas no coinciden";
        }

        if (minMax(4, 1999999999, $id_u)) {
            $errors[] = "Ingrese un numero de identificación valido";
        }

        if (minMax(4, 3999999999, $tel_u)) {
            $errors[] = "Ingrese un numero de telefono valido";
        }

        if (usuarioExiste($id_u)) {
            $errors[] = "El numero de identificación $id_u ya existe";
        }

        if (emailExiste($correo_u)) {
            $errors[] = "El correo $correo_u ya existe";
        }

        if (count($errors) == 0) {
            $pass_hash = hashPassword($clave_u);
            $token = generateToken();
            $registro = registraUsuario($id_u, $nomb_u, $apel_u, $univ_u, $correo_u, $pass_hash, $estado_u, $token);
            $registroTel = registraTel($tel_u, $id_u, $estado_tel);
            if ($registro > 0) {
                $url = "http://" . $_SERVER["SERVER_NAME"] . "/congreso/activar.php?id_u=" . $registro . "&val=" . $token;
                $asunto = 'Activar cuenta - Sistema de Usuarios';
                $cuerpo = "Estimad@ $nomb_u: <br /><br />Para continuar con el proceso de registro, es indispensable
             haga click en el siguiente enlace <a href='$url'>Activar cuenta</a>";

                if (enviarEmail2($correo_u, $nomb_u, $asunto, $cuerpo)) {
                    exit;
                } else {
                    $errors[] = "Error al enviar el email";
                }
            } else {
                $errors[] = "Error al registrar";
            }
        } else {
        }
    }


    ?>


    <div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-white">Registro de Usuario</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form name="formu" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <label for="id_u">Numero de identificación:</label>
                        <input type="number" id="id_u" name="id_u" class="form-control" placeholder="Digite su numero de documento" value="<?php if (isset($id_u)) echo $id_u; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="nomb_u">Nombres:</label>
                    <input type="text" id="nomb_u" name="nomb_u" class="form-control" placeholder="Digite sus nombres" value="<?php if (isset($nomb_u)) echo $nomb_u; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="apel_u">Apelidos:</label>
                    <input type="text" id="apel_u" name="apel_u" class="form-control" placeholder="Digite sus apellidos" value="<?php if (isset($apel_u)) echo $apel_u; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="univ_u">Universidad o institución a la que pertenece:</label>
                    <input type="text" id="univ_u" name="univ_u" class="form-control" placeholder="Si no es su caso entonces N/A" value="<?php if (isset($univ_u)) echo $univ_u; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="correo_u">Correo:</label>
                    <input type="text" id="correo_u" name="correo_u" class="form-control" placeholder="Digite su correo" value="<?php if (isset($correo_u)) echo $correo_u; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="tel_u">Telefono:</label>
                    <input type="number" id="tel_u" name="tel_u" class="form-control" placeholder="Digite su numero" value="<?php if (isset($tel_u)) echo $tel_u; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="clave_u">Clave:</label>
                    <input type="password" id="clave_u" name="clave_u" class="form-control" placeholder="Digite su clave" value="<?php if (isset($clave_u)) echo $clave_u; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="clave_u">Confirmar clave:</label>
                    <input type="password" id="con_password" name="con_password" class="form-control" placeholder="Digite su clave" value="<?php if (isset($con_password)) echo $con_password; ?>" required>
                </div>
                
                <div class="col-md-4 mt-4">
                    
                    <center><button id="btn-signup" type="submit" class="btn btn-success">Registrar</button> </center>
                </div>
                <div class="col-md-4 mt-4">
                    <center><input type="reset" value="Limpiar" class="btn btn-info"></center>
                </div>
                <div class="col-md-4 mt-4">
                    <center><input type="button" value="Volver" class="btn btn-success" title="volver" onclick="window.location='crudusu.php'"></center>
                </div>
                </form>
                <?php echo resultBlock($errors); ?>
            </div>

        </div>
    </div>



    <!-- Optional JavaScript; choose one of the two! -->
    <script src="./jquery/jquery-3.6.0.min.js"></script>

    <script src="./sw/dist/sweetalert2.all.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
    <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php
} else {
  $_SESSION['usuario_admin'] = NULL;
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