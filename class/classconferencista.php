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

  //clase Conferencista
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

    public function insertarconf($idcon, $nombcon, $correocon, $estadon)
    {
      $sql2 ="SELECT id_conf FROM conferencista WHERE id_conf = $idcon LIMIT 1";
      $res2 = mysqli_query(Conectar::con(), $sql2);
      $num = $res2->num_rows;
      if ($num > 0){
        echo "
          <script type='text/javascript'>
          Swal.fire({
          title:'ERROR',
          text:'El Id $idcon ya existe',
          icon : 'error',
          }).then((result)=>{
              if(result.value){
                window.location='homeconfer.php';
              }
          });
          </script>";
      } else {
        $sql3 ="SELECT correo_c FROM conferencista WHERE correo_c = '$correocon' LIMIT 1";
        $res3 = mysqli_query(Conectar::con(), $sql3);
        $num3 = $res3->num_rows;
        if ($num3 > 0){
          echo "
          <script type='text/javascript'>
          Swal.fire({
          title:'ERROR',
          text:'El correo $correocon ya existe',
          icon : 'error',
          }).then((result)=>{
              if(result.value){
                window.location='homeconfer.php';
              }
          });
          </script>";
        }else{
          $sql = "insert into conferencista values($idcon,'$nombcon','$correocon', '$estadon')";
          $res = mysqli_query(Conectar::con(), $sql) or die("Error en la consulta $sql");
          echo "
            <script type='text/javascript'>
            Swal.fire({
            title:'Exito',
            text:'El usuario se Registro Correctamente',
            icon : 'success',
            }).then((result)=>{
                if(result.value){
                  window.location='homeconfer.php';
                }
            });
            </script>";
        }
      }
    }

    public function editarconf($nombcon, $correocon, $idcon)
    {
      $sql = "UPDATE conferencista SET nomb_conf='$nombcon',correo_c='$correocon' WHERE id_conf = '$idcon'";
      $res = mysqli_query(Conectar::con(), $sql);
      echo "
         <script type='text/javascript'>
         Swal.fire({
          title:'Exito',
          text:'El usuario con id $idcon fue Modificado',
          icon : 'success',
         }).then((result)=>{
              if(result.value){
                window.location='homeconfer.php';
              }
         });
         </script>";
    }


    //funcion para capturar id de los botones de accion
    public function confer_id($idcon)
    {
      $sql = "select * from conferencista where id_conf=$idcon";
      $res = mysqli_query(Conectar::con(), $sql);
      if ($reg = mysqli_fetch_assoc($res)) {
        $this->confer[] = $reg;
      }
      return $this->confer;
    }

    //eliminar
    public function eliminarconf($idconf)
    {
      $sql = "UPDATE `conferencista` SET `estado_co` = '0' WHERE `conferencista`.`id_conf` = $idconf";
      $res = mysqli_query(Conectar::con(), $sql);
      echo "
         <script type='text/javascript'>
         Swal.fire({
          title:'Exito',
          text:'El conferencista con id $idconf fue Eliminado',
          icon : 'success',
         }).then((result)=>{
              if(result.value){
                window.location='homeconfer.php';
              }
         });
         </script>";
    }
    public function eliminarconf2($idconf)
    {
      $sql = "update conferencia as c
        join conferencista as co
        on c.id_conferencista=co.id_conf
        set c.id_conferencista=1
        where c.id_conferencista= $idconf";
      $res = mysqli_query(Conectar::con(), $sql);
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