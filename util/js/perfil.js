$(document).ready(function(){
  Loader();
  //setTimeout(verificar_sesion,2000);
  bsCustomFileInput.init();
  verificar_sesion();
  toastr.options={
    "preventDuplicates":true,
  }
  function llenar_menu_superior(usuario) {
    let template = `
        <button type="button" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" aria-label="presionar">
            <i class="fa fa-bars"></i>
        </button>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" aria-label="buscar">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <li id="cart-carrito" class="nav-item dropdown no-arrow mx-1" role="button">
                <a class="nav-link dropdown-toggle"  id="messagesDropdown">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="contador" class="badge badge-danger badge-counter">9</span>
                </a>
            </li>
           
            <!-- Nav Item - Alerts -->
            <li id="notificar" class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span id="notif_contador" class="badge badge-danger badge-counter">3</span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerta de efectivo de pago
                </h6>
                    <div id="notificacion">

                    </div>
                    <!--<a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-danger">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 12, 2024</div>
                            <span>Nombre: juan</span>
                            <hr>
                            <span class="font-weight-bold">Falta un dia(1) para pagar!</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 7, 2024</div>
                            <span>Nombre: CESAR</span>
                            <hr>
                            <span class="font-weight-bold">Falta un mes para pagar, esta cantidad: 30</span>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-donate text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">December 2, 2024</div>
                            <span>Nombre: MIGUEL</span>
                            <hr>
                            <span class="font-weight-bold">pagó completamente...</span>
                        </div>
                    </a>-->
                    <a class="dropdown-item text-center small text-gray-500" href="#">Cerrar alerta</a>
                </div>
            </li>


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" " id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span id="sesion_name" class="mr-2 d-none d-lg-inline text-gray-600 small">${usuario.nombre+' '+usuario.apellido}</span>
                    <img id="sesion_avatar" class="img-profile rounded-circle"
                        src="${usuario.avatar}" alt="Imagen usuario" >
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="perfil.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <!--<a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                    </a>-->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cerrar sesión
                    </a>
                </div>
            </li>
        </ul>
    `;
    $('#menu_superior').html(template);
  }
  function llenar_menu_lateral(usuario) {
    let template = `
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="control">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        ADMINISTRACIÓN
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Usuario</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Listar usuario:</h6>
                <a class="collapse-item" href="perfil"><i class="fas fa-fw fa-user-cog"></i> Perfil</a>
                <a class="collapse-item" href="usuario"><i class="fas fa-fw fa-user-circle"></i> Gestion usuario</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li id="Gestion_cliente" class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseCli" aria-expanded="true"
            aria-controls="collapseCli">
            <i class="fas fa-fw fa-folder"></i>
            <span>Cliente</span>
        </a>
        <div id="collapseCli" class="collapse" aria-labelledby="headingCli"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Listar cliente:</h6>
                <a class="collapse-item" href="clientes"><i class="fas fa-fw fa-user-friends"></i> Gestion cliente</a>
            </div>
        </div>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
      Cuentas
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsepago" aria-expanded="true"
            aria-controls="collapsepago">
            <i class="fas fa-fw fa-folder"></i>
            <span>Cuentas</span>
        </a>
        <div id="collapsepago" class="collapse" aria-labelledby="headingpago"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pagos:</h6>
                <a class="collapse-item" href="medios_pago"><i class="fas fa-fw fa-credit-card"></i> Gestion Tipo pago</a>
                <a class="collapse-item" href="cuentas"><i class="fas fa-fw fa-coins"></i> Gestion Cuenta</a>
            </div>
        </div>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
    Almacén
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsealmacen" aria-expanded="true"
            aria-controls="collapsealmacen">
            <i class="fas fa-fw fa-folder"></i>
            <span>Almacén</span>
        </a>
        <div id="collapsealmacen" class="collapse" aria-labelledby="headingalmacen"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Almacén:</h6>
                <a class="collapse-item" href="categoria"><i class="fas fa-fw fa-credit-card"></i> Gestion Categoria</a>
                <a class="collapse-item" href="marca"><i class="fas fa-fw fa-credit-card"></i> Gestion Marca</a>
                <a class="collapse-item" href="productos"><i class="fas fa-fw fa-coins"></i> Gestion Producto</a>
            </div>
        </div>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        REPORTES
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseReporte" aria-expanded="true"
            aria-controls="collapseReporte">
            <i class="fas fa-fw fa-folder"></i>
            <span>Reportes</span>
        </a>
        <div id="collapseReporte" class="collapse" aria-labelledby="headingReporte"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Listar Reporte:</h6>
                <a class="collapse-item" href="Reportes">Reportes</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    <!--<li class="nav-item">
        <a class="nav-link" href="backup.php">
        <i class="fas fa-fw fa-wrench"></i>
            <span>Backup</span></a>
    </li>-->
    <div class="sidebar-heading">
        Backup
    </div>
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsebackup" aria-expanded="true"
            aria-controls="collapsebackup">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Backup</span>
        </a>
        <div id="collapsebackup" class="collapse" aria-labelledby="headingbackup"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Backup:</h6>
                <a class="collapse-item" href="backup.php"><i class="fas fa-user-shield"></i> Respaldar Backup</a>
            </div>
        </div>
    </li>

    <div class="card shadow rounded m-2">
      <div class="card-body">
        <div class="row no-gutters">
            <div class="col-md-6 mr-2">
                <p class="small">Necesitas ayuda con <strong>DIGITALTEI</strong><i class="fas fa-question-circle fa-2x"></i></p>
                <a href="https://web.whatsapp.com/" target="_blank" title="Contactar" class="btn btn-outline-dark btn-circle"><i class="fas fa-retweet"></i></a>
            </div>
          </div>
      </div>
    </div>
    
    `;
    $('#menu_lateral').html(template);
  }
  async function verificar_sesion(){
    let funcion = "verificar_sesion";
    let data = await fetch('../controllers/UsuarioController.php',{
      method: "POST",
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'funcion='+funcion

    })
    if(data.ok){
      let response = await data.text();
      try {
        let respuesta = JSON.parse(response);
        if(respuesta.length != 0){
          llenar_menu_superior(respuesta);
          llenar_menu_lateral(respuesta);
          obtener_usuario();
          $('#cart-carrito').hide();
          $('#notificar').show();
          CloseLoader();
        }else{
          location.href = "../index";

        }
      } catch (error) {
        console.error(error);
        console.log(response);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo conflicto en el sistema, póngase en contacto con el administrador'
        })
      }

    }else{
      Swal.fire({
        icon: 'error',
        title: data.statusText,
        text: 'Hubo conflicto de codigo:'+data.status
      })
    }

  }

  async function obtener_usuario(){
    let funcion = "obtener_usuario";
    let data = await fetch('../controllers/UsuarioController.php',{
      method: "POST",
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'funcion='+funcion

    })
    if(data.ok){
      let response = await data.text();
      try {
        let usuario = JSON.parse(response);
        console.log(usuario);
        let template = `
        <img data-nombre="${usuario.nombre}" 
            data-apellido="${usuario.apellido}" 
            data-avatar="${usuario.avatar}" class="editar_avatar img-account-profile rounded-circle mb-2" role="button"
          src="../util/img/user/${usuario.avatar}" width="100px" height="100px" alt="Imagen de usuario" data-toggle="modal"
          data-target="#cambiar_avatar">
        <div class="small font-italic text-muted mb-2"><samp>${usuario.nombre}</samp></div>
        <div class="small font-italic text-muted mb-2"><samp>${usuario.apellido}</samp></div>
        <div class="small font-italic text-muted mb-2"><strong>${usuario.numero}</strong></div>
        <div class="large font-bold text-muted mb-2">`;
        if(usuario.id_tipo == '1'){
          template+=`
          <h1 class="badge badge-danger">${usuario.cargo}</h1>
          `;
        }
  
        if(usuario.id_tipo == '2'){
          template+=`
          <h1 class="badge badge-warning">${usuario.cargo}</h1>
          `;
        }
  
        if(usuario.id_tipo == '3'){
          template+=`
          <h1 class="badge badge-info">${usuario.cargo}</h1>
          `;
        }
        template+=`</div>
        <button data-nombre="${usuario.nombre}" 
                data-apellido="${usuario.apellido}" 
                data-avatar="${usuario.avatar}" 
            class="editar_password btn btn-dark btn-block" type="button" data-toggle="modal"
            data-target="#cambiar_contra">Cambiar contraseña</button>
        `;
        $('#card_1').html(template);
        let template_1 = `
          <div class="card border-top-danger mb-4 mb-xl-0 shadow-lg">
            <div class="card-header">Sobre mi
                <div class="ml-5" style="display: inline-block;">
                    <button id="${usuario.id}"
                            direccion="${usuario.direccion}" 
                            telefono="${usuario.telefono}" 
                            correo="${usuario.correo}" 
                        class="editar_perfil btn btn-outline-danger btn-circle ml-2" data-toggle="modal" data-target="#editar_perfil">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </div>
            </div>
            <div class="card-body text-center">
              <div class="small font-italic text-muted mb-4"><i class="fas fa-map-marker-alt mr-1"></i>Dirección:
              <samp>${usuario.direccion}</samp>
              </div>
              <div class="small font-italic text-muted mb-4"><i class="fas fa-phone mr-1"></i>Telefono: <samp
                      >${usuario.telefono}</samp></div>
              <div class="small font-italic text-muted mb-4"><i class="fas fa-at mr-1"></i>Correo: <samp
                      >${usuario.correo}</samp></div>
            </div>
          </div>
        `;
        $('#card_2').html(template_1);
      } catch (error) {
        console.error(error);
        console.log(response);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo conflicto en el sistema, póngase en contacto con el administrador'
        })
      }

    }else{
      Swal.fire({
        icon: 'error',
        title: data.statusText,
        text: 'Hubo conflicto de codigo:'+data.status
      })
    }

  }

  $(document).on('click','.editar_perfil',(e)=>{
    let elemento = $(this)[0].activeElement;
    let direccion = $(elemento).attr('direccion');
    let telefono = $(elemento).attr('telefono');
    let correo = $(elemento).attr('correo');
    $("#direccion").val(direccion);
    $("#telefono").val(telefono);
    $("#correo").val(correo);
  });



  async function editar_perfil(datos){
    let data = await fetch('../controllers/UsuarioController.php',{
      method: "POST",
      //en este caso ya no necesita headers por tema de fordata
      //headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: datos

    })
    if(data.ok){
      let response = await data.text();
      try {
        let respuesta = JSON.parse(response);
        if(respuesta.mensaje == 'success'){
          toastr.success('Sus datos fueron actualizados','Exito!')
          obtener_usuario();
          $('#editar_perfil').modal('hide');
        }else if(respuesta.mensaje == 'error_sesion'){
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Sesión finalizada',
            showConfirmButton: false,
            timer: 1000,
          }).then(function(){
            location.href= '../index';
          })
        }
      } catch (error) {
        console.error(error);
        console.log(response);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo conflicto en el sistema, póngase en contacto con el administrador'
        })
      }

    }else{
      Swal.fire({
        icon: 'error',
        title: data.statusText,
        text: 'Hubo conflicto de codigo:'+data.status
      })
    }

  }
  $.validator.setDefaults({
    submitHandler: function () {
      let datos = new FormData($('#form_perfil')[0]);
      let funcion = "editar_perfil";
      datos.append('funcion',funcion);
      editar_perfil(datos);
    }
  });
  $('#form_perfil').validate({
    rules: {
      direccion: {
        required: true,
      },
      telefono: {
        required: true,
        number: true,
        minlength: 9,
        maxlength: 9
      },
      correo: {
        required: true,
        email: true,
      }
    },
    messages: {
      direccion: {
        required: "*Porfavor, Ingrese su direccion",
      },
      telefono: {
        required: "*Porfavor, Ingrese su telefono",
        number: "*El dato debe ser numéricos",
        minlength: "*Se permite minimo 9 caracteres",
        maxlength: "*Se permite maximo 9 caracteres"
      },
      correo: {
        required: "*Porfavor, Ingrese su correo",
        email: "Por favor, Ingrese correo electrónico válido"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
      $(element).removeClass('is-valid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
      $(element).addClass('is-valid');
    }
  });


  $(document).on('click','.editar_avatar',function(){
    let elemento = $(this);
    console.log(elemento);
    let nombre = $(elemento).data('nombre');
    let apellido = $(elemento).data('apellido');
    let avatar = $(elemento).data('avatar');
    $("#nombre_avatar").text(nombre);
    $("#apellido_avatar").text(apellido);
    $("#avatar").attr('src','../util/img/user/'+avatar);
  });

  async function editar_avatar(datos){
    let data = await fetch('../controllers/UsuarioController.php',{
      method: "POST",
      //en este caso ya no necesita headers por tema de fordata
      //headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: datos

    })
    if(data.ok){
      let response = await data.text();
      try {
        let respuesta = JSON.parse(response);
        if(respuesta.mensaje == 'success'){
          toastr.success('Su avatar fue actualizado','Exito!')
          obtener_usuario();
          $('#sesion_avatar').attr('src','../util/img/user/'+respuesta.img);
          $('#cambiar_avatar').modal('hide');
          $('#form_avatar').trigger('reset');
        }else if(respuesta.mensaje == 'error_sesion'){
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Sesión finalizada',
            showConfirmButton: false,
            timer: 1000,
          }).then(function(){
            location.href= '../index';
          })
        }
      } catch (error) {
        console.error(error);
        console.log(response);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo conflicto en el sistema, póngase en contacto con el administrador'
        })
      }

    }else{
      Swal.fire({
        icon: 'error',
        title: data.statusText,
        text: 'Hubo conflicto de codigo:'+data.status
      })
    }

  }
  $.validator.setDefaults({
    submitHandler: function () {
      let datos = new FormData($('#form_avatar')[0]);
      let funcion = "editar_avatar";
      datos.append('funcion',funcion);
      editar_avatar(datos);
    }
  });
  $('#form_avatar').validate({
    rules: {
      avatar_mod: {
        required: true,
        extension: 'png|jpg|jpeg|webp'
      }
    },
    messages: {
      avatar_mod: {
        required: "*Dato requerido",
        extension: "*Porfavor, Ingrese formato png, jpg, jpeg,webp"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
      $(element).removeClass('is-valid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
      $(element).addClass('is-valid');
    }
  });

  $(document).on('click','.editar_password',function(){
    let elemento = $(this);
    //console.log(elemento);
    let nombre = $(elemento).data('nombre');
    let apellido = $(elemento).data('apellido');
    let avatar = $(elemento).data('avatar');
    $("#nombre_pass").text(nombre);
    $("#apellido_pass").text(apellido);
    $("#avatar_pass").attr('src','../util/img/user/'+avatar);
  });

  async function editar_password(datos){
    let data = await fetch('../controllers/UsuarioController.php',{
      method: "POST",
      //en este caso ya no necesita headers por tema de fordata
      //headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: datos

    })
    if(data.ok){
      let response = await data.text();
      try {
        let respuesta = JSON.parse(response);
        console.log(respuesta);
        if(respuesta.mensaje == 'success'){
          toastr.success('Su contraseña fue actualizada','Exito!')
          $('#cambiar_contra').modal('hide');
          $('#form_pass').trigger('reset');
        }else if(respuesta.mensaje == 'error_pass'){
          toastr.error('Su contraseña actual no coincide con nuestros registros, intente de nuevo','Error!')
        }
        else if(respuesta.mensaje == 'error_sesion'){
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Sesión finalizada',
            showConfirmButton: false,
            timer: 1000,
          }).then(function(){
            location.href= '../index';
          })
        }
      } catch (error) {
        console.error(error);
        console.log(response);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Hubo conflicto en el sistema, póngase en contacto con el administrador'
        })
      }

    }else{
      Swal.fire({
        icon: 'error',
        title: data.statusText,
        text: 'Hubo conflicto de codigo:'+data.status
      })
    }

  }

  $.validator.setDefaults({
    submitHandler: function () {
      let datos = new FormData($('#form_pass')[0]);
      let funcion = "editar_password";
      datos.append('funcion',funcion);
      editar_password(datos);
    }
  });
  $('#form_pass').validate({
    rules: {
      oldpass: {
        required: true,
      },
      newpass: {
        required: true,
      }
    },
    messages: {
      oldpass: {
        required: "*Dato requerido"
      },
      newpass: {
        required: "*Dato requerido"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
      $(element).removeClass('is-valid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
      $(element).addClass('is-valid');
    }
  });

  function Loader(mensaje) {
    if(mensaje=='' || mensaje==null){
      mensaje = "cargando datos...";
      Swal.fire({
        position: 'center',
        html: '<i class="fas fa-2x fa-sync-alt fa-spin"></i>',
        title: mensaje,
        showConfirmButton: false
      })
    }
  }

  function CloseLoader(mensaje,tipo) {
    if(mensaje=='' || mensaje==null){
      Swal.close();
    }else{
      Swal.fire({
        position: 'center',
        icon: tipo,
        title: mensaje,
        showConfirmButton: false
      })
    }
  }
  /*var funcion = '';
  var id_user = $('#id_user').val();
  var edit = false;
  //console.log(id_user);
  buscar_usuario(id_user);
  function buscar_usuario(dato) {
    funcion = 'buscar_usuario';
    $.post('../controllers/UsuarioController.php',{dato, funcion}, (response)=>{
      console.log(response);
      let nombre = '';
      let apellidos = '';
      let numero = '';
      let direccion = '';
      let telefono = '';
      let correo = '';
      const usuario = JSON.parse(response);
      nombre+= `${usuario.nombre}`;
      apellidos+= `${usuario.apellidos}`;
      numero+= `${usuario.numero}`;
      telefono+= `${usuario.telefono}`;
      direccion+= `${usuario.direccion}`;
      correo+= `${usuario.correo}`;
      $('#perfil_nombre').html(nombre);
      $('#perfil_apellidos').html(apellidos);
      $('#perfil_dni').html(numero);
      $('#perfil_telefono').html(telefono);
      $('#perfil_direccion').html(direccion);
      $('#perfil_correo').html(correo);
      $('#perfil_avatar').attr('src',usuario.avatar);
      $('#sesion_name').html(nombre);
      $('#sesion_avatar').attr('src',usuario.avatar);
    });
  }

  $(document).on('click', '.edit', (e)=>{
    funcion= "capturar_datos";
    edit = true;
    $.post('../controllers/UsuarioController.php',{funcion, id_user}, (response)=>{
      const usuario = JSON.parse(response);
      $('#telefono').val(usuario.telefono);
      $('#direccion').val(usuario.direccion);
      $('#correo').val(usuario.correo);
    })
  })

  $('#form_perfil').submit(e=>{
    if(edit == true){
      let direccion= $('#direccion').val();
      let telefono= $('#telefono').val();
      let correo= $('#correo').val();
      funcion = "editar_user";
      $.post('../controllers/UsuarioController.php',{id_user,funcion,telefono,direccion,correo}, (response)=>{
        if (response == 'editado'){
          $('#editado').hide('slow');
          $('#editado').show(1000);
          $('#editado').hide(2000);
          $('#form_perfil').trigger('reset');
        }
        edit = false;
        buscar_usuario(id_user);
        
      })
    }else{
      $('#noeditado').hide('slow');
      $('#noeditado').show(1000);
      $('#noeditado').hide(2000);
      $('#form_perfil').trigger('reset');
    }

    e.preventDefault();
  });

  $('#form-avatar').submit(e=>{
    let formData= new FormData($('#form-avatar')[0]);
    $.ajax({
      url:'../controllers/UsuarioController.php',
      type:'POST',
      data:formData,
      cache:false,
      processData:false,
      contentType:false

    }).done(function(response){
      const json = JSON.parse(response);
      console.log(json);
      if(json.alert == 'edit'){
        $('#avatar1').attr('src',json.ruta);
        $('#edit').hide('slow');
        $('#edit').show(1000);
        $('#edit').hide(2000);
        $('#form-avatar').trigger('reset');
        buscar_usuario(id_user);
      }else{
        $('#noedit').hide('slow');
        $('#noedit').show(1000);
        $('#noedit').hide(2000);
        $('#form-avatar').trigger('reset');
      }
    });
    e.preventDefault();
  })

  $('#form-pass').submit(e=>{
    let oldpass=$('#oldpass').val();
    let newpass=$('#newpass').val();
    funcion = "cambiar_contra";
    $.post('../controllers/UsuarioController.php',{id_user,funcion, oldpass, newpass}, (response)=>{
      console.log(response);
      if (response == 'update'){
        $('#update').hide('slow');
        $('#update').show(1000);
        $('#update').hide(2000);
        $('#form-pass').trigger('reset');
      }else{
        $('#noupdate').hide('slow');
        $('#noupdate').show(1000);
        $('#noupdate').hide(2000);
        $('#form-pass').trigger('reset');
      }
      
    })
    e.preventDefault();
  })*/

});