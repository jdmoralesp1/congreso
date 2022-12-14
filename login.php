<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Congreso - Inicio de Sesión</title>
    <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <link rel="stylesheet" language="javascript" href="./bootstrap/css/bootstrap.min.css">

    <!--sweetalert-->
    <link rel="stylesheet" href="./sw/dist/sweetalert2.min.css">
    
    <!-- script JS-->
  <script type="text/javascript" language="javascript" src="js/funciones.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js?render=6LffmIEfAAAAAL3JM_3VHxkI9sHx4hfbtz7SAOLk"></script><!-- Url del captcha y clave principal -->

<!--implementación del captcha v3-->
  <script>
			$(document).ready(function() {
				$('#entrar').click(function() {
					grecaptcha.ready(function() {
						grecaptcha.execute('6LffmIEfAAAAAL3JM_3VHxkI9sHx4hfbtz7SAOLk', {//clave principal
							action: 'validarUsuario'
							}).then(function(token) {
							$('#form-login').prepend('<input type="hidden" name="token" value="' + token + '" >');//envio hidden del token y el action
							$('#form-login').prepend('<input type="hidden" name="action" value="validarUsuario" >');
							$('#form-login').submit();
						});
					});
				});
			});
		</script>
        <style>
            .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
            }

            @media (min-width: 768px) {
            .gradient-form {
            height: 100vh !important;
            }
            }
            @media (min-width: 769px) {
            .gradient-custom-2 {
            border-top-right-radius: .3rem;
            border-bottom-right-radius: .3rem;
            }
            }
        </style>
        <link rel="shortcut icon" href="img/udistrital.ico" type="img/x-icon">
    
  </head>
  <body onload="limpiar();">
  

  <section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Escudo_UD.svg/2118px-Escudo_UD.svg.png"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1"> </h4>
                </div>

                <form id="form-login" name="formlogin" action="validar.php" method="post">

                  <div class="form-outline mb-4">
                    <input type="text" name="user" class="form-control" placeholder="Digite su correo" required/>
                    <label class="form-label" for="form2Example11" style="padding-top: 7px;">Correo Electronico</label>
                  </div>

                  <div class="form-outline mb-4">
                  <input type="password" name="pass" class="form-control" placeholder="Digite su clave" required/>
                    <label class="form-label" for="form2Example22" style="padding-top: 7px;">Contraseña</label>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1 lg-5">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button" id="entrar">Iniciar Sesion</button>
                      <br>
                    <a class="text-muted" href="recuperar.php">¿Olvidó su contraseña?</a>
                  </div>

                  <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">¿No tiene una cuenta?</p>
                    <button type="button" class="btn btn-outline-danger" onclick="window.location='home.php'">Crear una nueva</button>
                  </div>

                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4" style="text-align: center;">Congreso Internacional de ingenieria civil</h4>
                
                  <img src="https://www.periodicolacampana.com/wp-content/uploads/2016/09/Sabio-Caldas-2.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



  




  <!-- Optional JavaScript; choose one of the two! -->
  <script src="./jquery/jquery-3.6.0.min.js"></script>
    <script src="./sw/dist/sweetalert2.all.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
    <script src="./bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
