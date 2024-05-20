<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DIGITALTEI S.A.C - Login</title>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../util/css/main.min.css" type="text/css" rel="stylesheet">
  <link href="../util/css/sweetalert2.css" type="text/css" rel="stylesheet">

</head>

<body class="bg-gradient-warnning jquery-ripples" style="background:#111">

    <div class="container mt-5">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 rounded shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-logdin-image"><img src="../util/img/avatarlogo.png" width="430px" alt=""></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">PLATAFORMA WEB</h1>
                                        <P class="text-muted">DIGITALTEI S.A.C</P>
                                    </div>
                                    <form class="user" id="form_usuario">
                                        <div class="form-group">
                                        <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                            <input type="text" class="form-control"
                                                    id="usuario" name="usuario"
                                                    placeholder="Ingrese DNI">
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>
                                            <input type="password" class="form-control"
                                                id="password" name="password" autocomplete="additional-name" placeholder="Contraseña">
                                        </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-dark btn-block">Login</button>
                                        <hr>         <!--guion-->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="recuperar_cuenta">¿Has olvidado tu contraseña?</a>
                                    </div>
                                    <!--<div class="text-center">
                                        <a class="small" href="register">¡Crea una cuenta!</a>
                                    </div>-->
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
  <script src="../util/js/login.js"></script>
  <script src="../util/js/jquery.ripples.min.js"></script>
  <script>
      $(document).ready(function(){
      $('body').ripples({
          resolution: 512, // Resolución más alta para una mayor precisión
          dropRadius: 15, // Radio de las gotas, no muy grande para evitar saturar la pantalla
          perturbance: 0.03, // Perturbación para generar pequeñas variaciones en las gotas
          interactive: true, // Interacción con el usuario para hacer ondas con el mouse
          interactionEvent: 'mousemove', // Evento de interacción con el mouse
          hover: false, // Sin efecto al poner el mouse encima para evitar distracciones
          frameRate: 30, // Frecuencia de actualización de las gotas
          opacity: 0.3, // Opacidad de las gotas, no muy alta para evitar distracciones
          background: '#000000' // Color de fondo, que contrasta bien con el efecto de agua
      });
  })
  
  </script>
</body>
</html>

