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

  //clase conferencia
  class Conferencia
  {
    private $conf;
    public function __construct()
    {
      $this->conf = array();
    }
    //mostrar las conferencias
    public function ver_conf()
    {
      $sql = "SELECT c.id_confer,c.nomb_c, cf.nomb_conf, c.fecha_c,c.hora_c, c.estado_c, c.link_c 
        FROM conferencia c, conferencista cf 
        where c.id_conferencista=cf.id_conf order by c.fecha_c";
      $res = mysqli_query(Conectar::con(), $sql); //aplicar herencia 
      while ($row = mysqli_fetch_assoc($res)) {
        $this->conf[] = $row;
      }
      return $this->conf;
    }

    public function ver_conf2()
    {
      $sql = "SELECT c.id_confer,c.nomb_c, cf.nomb_conf, c.fecha_c,c.hora_c, c.estado_c, c.link_c 
      FROM conferencia c, conferencista cf 
      where c.id_conferencista=cf.id_conf ORDER BY c.fecha_c";
      $res = mysqli_query(Conectar::con(), $sql); //aplicar herencia 
      while ($row = mysqli_fetch_assoc($res)) {
        $this->conf[] = $row;
      }
      return $this->conf;
    }

    public function ver_conf3($correo)
    {
      $sql = "SELECT c.id_confer,c.nomb_c, cf.nomb_conf, c.fecha_c,c.hora_c, c.link_c 
      FROM conferencia c, usuarios u, conferencista cf, conferencia_has_usuarios coh
      where c.id_confer=coh.Conferencia_id_confer and '$correo'=u.correo_u and coh.Usuarios_id_u=u.id_u 
      and coh.Conferencia_id_conferencista=cf.id_conf ORDER BY c.fecha_c;";
      $res = mysqli_query(Conectar::con(), $sql); //aplicar herencia 
      while ($row = mysqli_fetch_assoc($res)) {
        $this->conf[] = $row;
      }
      return $this->conf;
    }
    

    public function insertarc($idc, $nombc, $fechac, $horac, $minutoc, $estadoc, $linkc, $idco)
    {
      $horaf = $horac.":".$minutoc;
      
      $sql = "insert into conferencia values('','$nombc','$fechac','$horaf','$estadoc','$linkc',$idco)";
      $res = mysqli_query(Conectar::con(), $sql) or die("Error en la consulta $sql");
      echo "
        <script type='text/javascript'>
        Swal.fire({
         title:'Exito',
         text:'La conferencia se Registro Correctamente',
         icon : 'success',
        }).then((result)=>{
             if(result.value){
               window.location='homeconf.php';
             }
        });
        </script>";
    }

    public function editarc($nombc, $fechac, $horac, $minutoc, $estadoc, $linkc, $idco, $idc)
    {
      $horaf = $horac.":".$minutoc;
      $sql = "UPDATE conferencia SET nomb_c='$nombc',fecha_c='$fechac',hora_c='$horaf',estado_c='$estadoc',
        link_c='$linkc', id_conferencista='$idco' WHERE id_confer = '$idc'";
      $res = mysqli_query(Conectar::con(), $sql);
      echo "
         <script type='text/javascript'>
         Swal.fire({
          title:'Exito',
          text:'La conferencia con id $idc fue Modificada',
          icon : 'success',
         }).then((result)=>{
              if(result.value){
                window.location='homeconf.php';
              }
         });
         </script>";
    }
    //funcion para capturar id de los botones de accion
    public function conf_id($idc)
    {
      $sql = "select c.id_confer, c.nomb_c, c.fecha_c, c.hora_c, c.estado_c, c.link_c, c.id_conferencista, co.nomb_conf 
      from conferencia c, conferencista co 
      where c.id_confer=$idc and c.id_conferencista=co.id_conf";
      $res = mysqli_query(Conectar::con(), $sql);
      if ($reg = mysqli_fetch_assoc($res)) {
        $this->conf[] = $reg;
      }
      return $this->conf;
    }
    public function eliminarc($idc)
    {
      $sql = "delete from conferencia where id_confer=$idc";
      $res = mysqli_query(Conectar::con(), $sql);
      echo "
         <script type='text/javascript'>
         Swal.fire({
          title:'Exito',
          text:'La conferencia con id $idc fue Eliminado',
          icon : 'success',
         }).then((result)=>{
              if(result.value){
                window.location='homeconf.php';
              }
         });
         </script>";
    }

    public function insertarhas($id)
    {

      $sql = "select id_confer from conferencia where id_confer=$id";
      $res = mysqli_query(Conectar::con(), $sql);
      if ($reg = mysqli_fetch_assoc($res)) {
        $this->conf[] = $reg;
      }
      return $this->conf;
    }
    public function idconf($id)
    {
      $sql = "select id_conferencista from conferencia where id_confer=$id";
      $res = mysqli_query(Conectar::con(), $sql);
    }
    public function correo($correo)
    {
      $sql = "select id_u from usuarios where correo_u='$correo'";
      $res = mysqli_query(Conectar::con(), $sql);
    }
    /*public function final($id, $correo){
      $var1=insertarhas($id);
      $var2=idconf($id);
      $sql="INSERT INTO conferencia_has_usuarios values ($var1, '$query_run2', '$query_run1')";
    }*/
  }
  // clase id conferencista
  class idconf
  {
    private $idconf;
    public function __construct()
    {
      $this->idconf = array();
    }
    //mostrar los nombres de conferencistas

    public function ver_idconf()
    {
      //echo $idc;
      $sql = "SELECT c.nomb_conf
        FROM 
          conferencista c
        
          JOIN conferencia co ON c.id_conf=co.id_conferencista
        
          WHERE c.id_conf=co.id_conferencista";
      $res = mysqli_query(Conectar::con(), $sql);
      while ($row = mysqli_fetch_assoc($res)) {
        $i = 0;
        $this->idconf[$i] = $row;
        $i++;
      }
      return $this->idconf;
    }
  }
  class Conferencista
  {
    private $confer;
    public function __construct()
    {
      $this->confer = array();
    }
    //mostrar los conferencistas
    public function ver_conf()
    {
      $sql = "select * from conferencista where estado_co=1";
      $res = mysqli_query(Conectar::con(), $sql); //aplicar herencia 
      while ($row = mysqli_fetch_assoc($res)) {
        $this->confer[] = $row;
      }
      return $this->confer;
    }
  }

  class Usuario
  {
    private $usu;
    public function __construct()
    {
      $this->usu = array();
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