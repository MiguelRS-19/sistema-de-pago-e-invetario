
$(document).ready(function() {
    Loader();
    //setTimeout(verificar_sesion,2000);
    verificar_sesion();
    toastr.options={
        "preventDuplicates":true,
    }

    function llenar_menu_superior(usuario) {
        let template = `
            <ul class="navbar-nav ml-auto">

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
                        <span id="notif_contador" class="badge badge-danger badge-counter">3+</span>
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
                        <img id="sesion_avatar" class="img-profile rounded-circle animate__animated animate__zoomIn"
                            src="../util/img/user/${usuario.avatar}" alt="Imagen usuario" >
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
                <span>Panel control</span></a>
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
                    <a class="collapse-item" href="medios_pago"><i class="fas fa-fw fa-credit-card mr-2"></i>Gestion Tipo pago</a>
                    <a class="collapse-item" href="cuentas"><i class="fas fa-fw fa-coins mr-2"></i>Gestion Cuenta</a>
                    <a class="collapse-item" href="citas"><i class="fas fa-calendar-alt mr-2"></i>Gestion Citas</a>
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
                    <a class="collapse-item" href="categoria"><i class="fas fa-th-list mr-2"></i>Gestion Categoria</a>
                    <a class="collapse-item" href="marca"><i class="fas fa-lg fa-tags mr-2"></i>Gestion Marca</a>
                    <a class="collapse-item" href="productos"><i class="fas fa-lg fa-cube mr-2"></i>Gestion Producto</a>
                </div>
            </div>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">
        Compras
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsecompra" aria-expanded="true"
                aria-controls="collapsecompra">
                <i class="fas fa-fw fa-folder"></i>
                <span>Compras</span>
            </a>
            <div id="collapsecompra" class="collapse" aria-labelledby="headingcompra"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Compra:</h6>
                    <a class="collapse-item" href="proveedor"><i class="fas fa-truck mr-2"></i>Gestion Proveedor</a>
                    <a class="collapse-item" href="compras"><i class="fas fa-people-carry mr-2"></i>Gestion Compras</a>
                </div>
            </div>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">
        Ventas
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseventa" aria-expanded="true"
                aria-controls="collapseventa">
                <i class="fas fa-fw fa-folder"></i>
                <span>Ventas</span>
            </a>
            <div id="collapseventa" class="collapse" aria-labelledby="headingventa"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Venta:</h6>
                    <a class="collapse-item" href="listVenta"><i class="fas fa-clipboard-list mr-2"></i></i>Listar ventas</a>
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
                let usuario = JSON.parse(response);
                if(usuario.length != 0 && usuario.idtipo !=3){
                llenar_menu_superior(usuario);
                llenar_menu_lateral(usuario);
                $('#cart-carrito').hide();
                $('#notificar').hide();
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

    async function reporte_anual(datos){
        let funcion = "reporte_anual";
        let data = await fetch('../controllers/ingresoAnualController.php',{
            method: "POST",
            body: datos
        })
        if(data.ok){
            let response = await data.text();
            try {
                console.log(response);
                if(response == ""){
                    Cerrar_Loader('exito_reporte');
                    $('#fecha_y').val('');
                    window.open('../pdf/pdf-'+funcion+'.pdf','_blank')
                }else{
                    Cerrar_Loader('error_reporte');
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
            Mostrar_Loader('GenerarReportePDF');
            let datos = new FormData($('#form_anual')[0]);
            let funcion = "reporte_anual";
            datos.append('funcion',funcion);
            reporte_anual(datos);
        }
    });
    $('#form_anual').validate({
        rules: {
            fecha_y: {
                required: true,
            }
        },
        messages: {
            fecha_y: {
                required: "*Dato requerido",
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

    //reporte
    function Mostrar_Loader(Mensaje){
        var texto = null;
        var mostrar = false;
        switch (Mensaje) {
        case 'GenerarReportePDF':
            texto = 'Se esta generando el reporte en formato PDF, porfavor espere...';
            mostrar = true;
            break;
        }
        if(mostrar){
        Swal.fire({
            title: "Generando reporte",
            text: texto,
            showConfirmButton: false,
        });
        }
    }

    function Cerrar_Loader(Mensaje){
        var tipo = null;
        var texto = null;
        var mostrar = false;
        switch (Mensaje) {
        case 'exito_reporte':
            tipo = 'success';
            texto = 'El reporte fue generado correctamente.';
            mostrar = true;
            break;
            case 'error_reporte':
            tipo = 'error';
            texto = 'El reporte no pudo generarse, comuniquese con el personal de sistemas.';
            mostrar = true;
            break;
        
        default:
            swal.close();
            break;
        }
        if(mostrar){
        Swal.fire({
            position: 'center',
            icon: tipo,
            text: texto,
            showConfirmButton: false,
        });
        }
    }

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

});
