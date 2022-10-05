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
  <title>Clase Usuarios</title>
</head>

<body>

  <?php
  //realizar conexion a la BD
  class Conectar
  {
    public static function con()
    {
      $link = mysqli_connect('localhost', 'root', '') or die("Error al conectar la BD" . mysqli_error($link));
      mysqli_select_db($link, 'congreso_');
      mysqli_query($link, "SET NAMES 'utf8'") or die("Error al seleccionar la BD" . mysqli_error($link));
      return $link;
    }
  }

  //clase usuarios
  class Usuario
  {
    private $usuar;
    public function __construct()
    {
      $this->usuar = array();
    }
    //mostrar los usuarios
    public function ver_usu()
    {
      $sql = "select * from usuarios where estado_u=1";
      $res = mysqli_query(Conectar::con(), $sql); //aplicar herencia 
      while ($row = mysqli_fetch_assoc($res)) {
        $this->usuar[] = $row;
      }
      return $this->usuar;
    }


    public function insertaru($idu, $nombu, $apelu, $univu, $correou, $claveu, $estadou)
    {
      $sql = "insert into usuarios values($idu,'$nombu','$apelu','$univu','$correou','$claveu','$estadou')";
      $res = mysqli_query(Conectar::con(), $sql) or die("Error en la consulta $sql");
      echo "
        <script type='text/javascript'>
        Swal.fire({
         title:'Exito',
         text:'El usuario se Registro Correctamente',
         icon : 'success',
        }).then((result)=>{
             if(result.value){
               window.location='crudusu.php';
             }
        });
        </script>";
    }
    public function insertart($telu, $idu, $estadou)
    {
      $sql = "insert into telefonousuarios values (NULL,$telu,$idu,$estadou)";
      $res = mysqli_query(Conectar::con(), $sql) or die("Error en la consulta $sql");
    }

    public function editaru($nombu, $apelu, $univu, $correou, $idu)
    {
      $sql = "UPDATE usuarios SET nomb_u='$nombu',apel_u='$apelu',univ_u='$univu',correo_u='$correou'
       WHERE id_u = '$idu'";
      $res = mysqli_query(Conectar::con(), $sql);
      echo "
         <script type='text/javascript'>
         Swal.fire({
          title:'Exito',
          text:'El usuario con id $idu fue Modificado',
          icon : 'success',
         }).then((result)=>{
              if(result.value){
                window.location='crudusu.php';
              }
         });
         </script>";
    }

    public function editaru2($univu, $correou, $idu)
    {
      $sql = "UPDATE usuarios SET univ_u='$univu',correo_u='$correou'
       WHERE id_u = '$idu'";
      $res = mysqli_query(Conectar::con(), $sql);
      echo "
         <script type='text/javascript'>
         Swal.fire({
          title:'Exito',
          text:'Datos modificados exitosamente',
          icon : 'success',
         }).then((result)=>{
              if(result.value){
                window.location='index.php';
              }
         });
         </script>";
    }


    //funcion para capturar id de los botones de accion
    public function usu_id($idu)
    {
      $sql = "select * from usuarios where id_u=$idu";
      $res = mysqli_query(Conectar::con(), $sql);
      if ($reg = mysqli_fetch_assoc($res)) {
        $this->usuar[] = $reg;
      }
      return $this->usuar;
    }

    //eliminar
    public function eliminaru($idu)
    {
      $sql = "UPDATE `usuarios` SET `estado_u` = '0' WHERE `usuarios`.`id_u` = $idu";
      //$sql="delete from usuarios where id_u=$idu";
      $res = mysqli_query(Conectar::con(), $sql);
      echo "
         <script type='text/javascript'>
         Swal.fire({
          title:'Exito',
          text:'El empleado con id $idu fue Eliminado',
          icon : 'success',
         }).then((result)=>{
              if(result.value){
                window.location='crudusu.php';
              }
         });
         </script>";
    }
    public function eliminaru2($idu)
    {
      $sql = "update telefonousuarios as t
        join usuarios as u
        on t.idUsu=u.id_u
        set t.estado_t=0
        where t.idUsu= $idu";
      $res = mysqli_query(Conectar::con(), $sql);
    }



    //usuario para el que se registra nuevol

  }

  class Usuariou
  {
    private $usuaru;
    public function __construct()
    {
      $this->usuaru = array();
    }

    public function insertaruu($idu, $nombu, $apelu, $univu, $correou, $claveu, $lastsession, $estadou)
    {
      $sql = "insert into usuarios values($idu,'$nombu','$apelu','$univu','$correou','$claveu','$lastsession','$estadou')";
      $res = mysqli_query(Conectar::con(), $sql) or die("Error en la consulta $sql");
      echo "
        <script type='text/javascript'>
        Swal.fire({
         title:'Exito',
         text:'El usuario se Registro Correctamente',
         icon : 'success',
        }).then((result)=>{
             if(result.value){
               window.location='login.php';
             }
        });
        </script>";
    }
    public function insertartu($telu, $idu, $estadou)
    {
      $sql = "insert into telefonousuarios values (NULL,$telu,$idu,$estadou)";
      $res = mysqli_query(Conectar::con(), $sql) or die("Error en la consulta $sql");
    }

    public function recordarp($idu, $correou)
    {
      $sql = "select clave_u from usuarios where id_u='$idu' and correo_u='$correou'";
      $res = mysqli_query(Conectar::con(), $sql) or die("Error en la consulta $sql");
      while ($row = $res->fetch_assoc()) {
        $arrayC = $row; //Almace los datos
      }

      $var = json_encode($arrayC['clave_u']);
      $var2 = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($var));
      echo "
        <script type='text/javascript'>
        Swal.fire({
         title:'Exito',
         text:'Su clave es $var2',
         icon : 'success',
        }).then((result)=>{
             if(result.value){
               window.location='login.php';
             }
        });
        </script>";
    }
  }

  // clase telefono
  class Telefono
  {
    private $tele;
    public function __construct()
    {
      $this->tele = array();
    }
    //mostrar los Telefonos
    public function ver_tele()
    {
      $sql = "SELECT t.telefono
        FROM 
          telefonousuarios t
        
          JOIN usuarios u ON t.idUsu=u.id_u
        
          WHERE t.idUsu=u.id_u and estado_t=1 ORDER BY u.id_u ASC";
      $res = mysqli_query(Conectar::con(), $sql);
      while ($row = mysqli_fetch_assoc($res)) {
        $this->tele[] = $row;
      }
      return $this->tele;
    }
    public function editart($telu, $idu)
    {
      $sql = "UPDATE telefonousuarios SET telefono ='$telu' WHERE idUsu = '$idu'";
      $res = mysqli_query(Conectar::con(), $sql);
    }
    //funcion para capturar id de los botones de accion
    public function tel_id($idu)
    {
      $sql = "SELECT t.telefono
        FROM 
          telefonousuarios t
        
          JOIN usuarios u ON t.idUsu=u.id_u
        
          WHERE t.idUsu=$idu";
      $res = mysqli_query(Conectar::con(), $sql);
      if ($reg2 = mysqli_fetch_assoc($res)) {
        $this->tele[] = $reg2;
      }
      return $this->tele;
    }
  }



  ?>


  <!-- Optional JavaScript; choose one of the two! -->
  <script src="./jquery/jquery-3.6.0.min.js"></script>

  <script src="./sw/dist/sweetalert2.all.min.js"></script>
  <!-- Option 1: Bootstrap Bundle with Popper 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
  <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>

</html>