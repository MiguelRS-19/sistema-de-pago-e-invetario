<?php ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DIGITALTEI S.A.C - Recuperar cuenta</title>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="../util/css/main.min.css" type="text/css" rel="stylesheet">
  <link href="../util/css/sweetalert2.css" type="text/css" rel="stylesheet">

</head>

<body class="bg-gradient-warninng" style="background:#111">

  <div class="container mt-5">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-passsword-image"><img src="../util/img/avatarlogo.png" width="430px" alt=""></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">¿Olvidaste tu contraseña?</h1>
                    <p class="mb-4">Lo entendemos, suceden cosas. Sólo tienes que introducir tu dirección de correo electrónico a continuación
                      ¡Y te enviaremos un enlace para restablecer tu contraseña!</p>
                  </div>
                  <span id="aviso1" class="text-success text-bold">texto</span>
                  <span id="aviso" class="text-danger text-bold">texto</span>
                  <form class="user" id="form-recuperar">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" id="dni-recuperar" placeholder="DNI">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="far fa-address-card"></span>
                        </div>
                      </div>
                    </div>
                    <div class="input-group mb-3">
                      <input type="email" class="form-control" id="email-recuperar" aria-describedby="emailHelp" placeholder="Ingrese su correo...">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-outline-dark btn-block">Enviar</button>
                  </form>
                  <hr>
                  <!--<div class="text-center">
                    <a class="small" href="register.php">Crear cuenta</a>
                  </div>-->
                  <div class="text-center">
                    <a class="small" href="../index">¿Ya tienes una cuenta? ¡Acceso!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../util/js/sb-admin-2.js"></script>
  <script src="../util/js/sweetalert2.js"></script>
  <script src="../util/js/recuperar_cuenta.js"></script>

</body>

</html>