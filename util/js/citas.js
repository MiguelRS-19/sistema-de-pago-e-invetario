$(document).ready(function(){
    moment.locale('es'); 
    Loader();
    //setTimeout(verificar_sesion,2000);
    verificar_sesion();
    toastr.options={
        "preventDuplicates":true,
    }

    $('#clientes').select2({
        placeholder: 'Selecione cliente...',
        language: {
            noResult: function () {
                return "No hay resultados"
            },
            searching: function () {
                return "Buscando..."
            }
        }
    });

    async function obtener_cliente(){
        let funcion = "obtener_cliente";
        let data = await fetch('../controllers/ClienteController.php',{
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'funcion='+funcion

        })
        if(data.ok){
        let response = await data.text();
        try {
            let clientes = JSON.parse(response);
            let template = '';
            clientes.forEach(cliente => {
            if(cliente.estado == 'A'){
                template+=`
                <option value="${cliente.id}">${cliente.nombre}</option>
                `;
            }
            });
            $('#clientes').html(template);
            $('#clientes').val('').trigger('change');
            $('#clientes').on('change', function() {
                const Id = $(this).val();
                encontrar(Id);
            });
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

    async function encontrar(Id) {
        let funcion = "encontrar";
        try {
            let data = await fetch('../controllers/CitaController.php', {
                method: "POST",
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'funcion=' + funcion + '&id=' + Id
            });
    
            if (data.ok) {
                let response = await data.text();
                try {
                    let cuentas = JSON.parse(response);
                    if(cuentas != 0){
                        if(cuentas[0].saldo > 0 ){
                            toastr.success('Cuenta encontrada','Exito!')
                            $('#deuda').val(cuentas[0].deuda);
                            $('#saldo').val(cuentas[0].saldo);
                            let motivo = `Descripcion: ${cuentas[0].descri}, Fecha consumo: ${cuentas[0].consumo}, fecha pago:${cuentas[0].fecha_pago}, \nfecha plazo: ${cuentas[0].fecha_plazo}, Deuda: ${cuentas[0].deuda}, saldo:${cuentas[0].saldo}`
                            $('#motivo').text(motivo);
                        }else{
                            toastr.info('No hay saldo','info!')
                        }
                    }else{
                        toastr.warning('Al encontrar el saldo esta vacio','Warning!')
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
            } else {
                Swal.fire({
                    icon: 'error',
                    title: data.statusText,
                    text: 'Hubo un error al obtener el precio del producto.'
                });
            }
        } catch (error) {
            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al obtener el precio del producto. Por favor, inténtelo de nuevo.'
            });
        }
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
                    <a class="collapse-item" href="backup"><i class="fas fa-user-shield"></i> Respaldar Backup</a>
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
                obtener_cliente();
                obtener_citas();
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

    async function obtener_citas(){
        let funcion = "obtener_citas";
        let data = await fetch('../controllers/CitaController.php',{
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'funcion='+funcion

        })
        if(data.ok){
        let response = await data.text();
        try {
            let citas = JSON.parse(response);
            $('#citas').DataTable({
            data: citas,
            "aaSorting": [],
            lengthMenu: [1,10, 25, 50, 75, 100],
            "searching": true,
            "scrollX":true,
            "autoWidth":false,
            columns: [{
                "render": function(data,type,datos,meta){
                    let fecha_moments = moment(datos.inicio,'YYYY/MM/DD HH:mm:ss');
                    let fecha_moments1 = moment(datos.final,'YYYY/MM/DD HH:mm:ss');
                    let hora_moment;
                    hora_moment = fecha_moments.format('LLLL');
                    let hora_moment1;
                    hora_moment1 = fecha_moments1.format('LLLL');
                    return `
                    <div class="">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12">
                                    <h4 class=""><b>...</b></h4>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="mediun"><span class="fa-li"><i class="fas fa-users"></i></span> Cliente: ${datos.cliente}</li>
                                    <li class="mediun"><span class="fa-li"><i class="fas fa-calendar-day"></i></span> Fecha Inicio: ${hora_moment}</li>
                                    <li class="mediun"><span class="fa-li"><i class="fas fa-calendar-alt"></i></span> Fecha Final: ${hora_moment1}</li>
                                    <li class="mediun"><span class="fa-li"><i class="fas fa-balance-scale-right"></i></span> Saldo: ${datos.saldo}</li>
                                    <li class="mediun"><span class="fa-li"><i class="fas fa-chalkboard-teacher"></i></span> Responsable: ${datos.usuario}</li>
                                    </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    
                    `;
                }
            }],
            "language":espanol,
            "destroy":true
            })
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

    async function registro_citas(datos){
        let data = await fetch('../controllers/CitaController.php',{
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
                    toastr.success('Se registro la cita','Exito!')
                    obtener_citas();
                    $("#form-asignar").trigger('reset');
                    $('#deuda').val('').trigger('change');
                    $("#asignar_cita").modal('hide');
                }else if(respuesta.mensaje == 'error_decrypt'){
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'No volnere los datos',
                        showConfirmButton: false,
                        timer: 1000,
                    }).then(function(){
                        location.reload();
                    })
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
            let datos = new FormData($('#form-asignar')[0]);
            let funcion = "registro_citas";
            //$(".btnGuardarCita").prop("disabled", true);
            datos.append('funcion',funcion);
            registro_citas(datos);
        }
    });
    $('#form-asignar').validate({
        rules: {
            clientes: {
                required: true,
            },
            color: {
                required: true,
            },
            inicio: {
                required: true
            },
            final: {
                required: true,
            },
            deuda: {
                required: true,
            },
            saldo: {
                required: true,
            },
            motivo: {
                required: true,
            }
            
        },
        messages: {
            clientes: {
                required: "*Dato requerido",
            },
            color: {
                required: "*Dato requerido",
            },
            inicio: {
                required: "*Dato requerido",
            },
            final: {
                required: "*Dato requerido",
            },
            deuda: {
                required: "*Dato requerido",
            },
            saldo: {
                required: "*Dato requerido",
            },
            motivo: {
                required: "*Dato requerido",
            },
            
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

    var calendarEl = $('#calendar')[0];
    $.post('../controllers/CitaController.php', { funcion: 'obtener_citas' }, (response) => {
        let citas = JSON.parse(response);
        var eventos = citas.map(cita => {
            return {
                id: cita.id,
                title: cita.cliente,
                start: cita.inicio,
                color: cita.color,
                end: cita.final,
                motivo: cita.motivo,
                saldo: cita.saldo,
                inicio: cita.inicio,
                fin: cita.final,
            };
        });
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: "es",
            initialView: 'dayGridMonth',
            headerToolbar: {
            left: 'prev,next today',
            center:'title',
            right:'dayGridMonth, timeGridWeek, timeGridDay, listWeek',
            },
            navLinks: true,
            businessHours: false,
            editable: true,
            selectable: true,
            themeSystem: 'bootstrap',
            eventHint: "Evento",
            events: eventos,
            dateClick: function(info){
                fechaInicio = moment(info.dateStr).format('YYYY-MM-DDTHH:mm');
                fechaFin = moment(fechaInicio).add(30, 'minutes').format('YYYY-MM-DDTHH:mm');
                if (info.dateStr.length == 10) { fechaInicio = moment(info.dateStr).format('YYYY-MM-DDT09:00'); fechaFin = moment(info.dateStr).format('YYYY-MM-DDT09:30'); }
                //$('#modalAgregarEvento #nombre_paciente').find('[autofocus]').focus();
                $('#inicio').val(fechaInicio)
                $('#final').val(fechaFin)
                $('#asignar_cita').modal('show');
            },
            eventClick: function (info) {
                $('#id').val(info.event.id);
                $('#cliente_mod').val(info.event.title);
                $('#color_mod').val(info.event.backgroundColor);
                $('#motivo_mod').val(info.event._def.extendedProps.motivo);
                $('#editar_cita').modal('show');
                $('.borrar').attr('idcita', info.event.id);
                $('.borrar').attr('cli', info.event.title);
                $('#inicio_mod').val(info.event._def.extendedProps.inicio);
                $('#final_mod').val(info.event._def.extendedProps.fin);
                $('#saldo_mod').val(info.event._def.extendedProps.saldo);

            },
            eventDrop: function (info, delta, revertFunc) {
                let a = moment(event.event.startStr).format('YYYY-MM-DD');
                let b = moment(event.event._def.extendedProps.inicio).format('HH:mm:ss');
                let c = moment(event.event._def.extendedProps.fin).format('HH:mm:ss');
                let ini = a + " " + b;
                let fin = a + " " + c;

                evento = [];
                evento[0] = event.event.id;
                evento[1] = moment(ini).format('YYYY-MM-DD HH:mm:ss');
                evento[2] = moment(fin).format('YYYY-MM-DD HH:mm:ss');

                $.ajax({
                    url: "./vistas/paginas/eventos.php",
                    method: "POST",
                    data: { editar: evento },
                    success: function (rep) {
                    Swal.fire({
                        title: lang['evento_modificado'],
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                    }

                })

            },
            eventResize: function (event, dayDelta, minuteDelta, revertFunc) {

            },

        });
        calendar.render();
        //calendar.refetchEvents();
    })


    async function editar_citas(datos){
        let data = await fetch('../controllers/CitaController.php',{
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
                    toastr.success('Se edito la cita','Exito!')
                    $("#form-editar").trigger('reset');
                    $("#editar_cita").modal('hide');
                }else if(respuesta.mensaje == 'error_decrypt'){
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'No volnere los datos',
                        showConfirmButton: false,
                        timer: 1000,
                    }).then(function(){
                        location.reload();
                    })
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
            let datos = new FormData($('#form-editar')[0]);
            let funcion = "editar_citas";
            datos.append('funcion',funcion);
            editar_citas(datos);
            
        }
    });
    $('#form-editar').validate({
        rules: {
            color_mod: {
                required: true,
            },
            inicio_mod: {
                required: true
            },
            final_mod: {
                required: true,
            },
            saldo_mod: {
                required: true,
            },
            motivo_mod: {
                required: true,
            }
            
        },
        messages: {
            color_mod: {
                required: "*Dato requerido",
            },
            inicio_mod: {
                required: "*Dato requerido",
            },
            final_mod: {
                required: "*Dato requerido",
            },
            saldo_mod: {
                required: "*Dato requerido",
            },
            motivo_mod: {
                required: "*Dato requerido",
            },
            
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

    async function eliminar(id){
        let funcion = 'eliminar';
        let respuesta = '';
        let data = await fetch('../controllers/CitaController.php',{
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'funcion='+funcion+'&&id='+id
    
        })
        if(data.ok){
            let response = await data.text();
            try {
                respuesta = JSON.parse(response);
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
        return respuesta;
    }
    $(document).on('click','.borrar',(e)=>{
        let elemento = $(this)[0].activeElement;
        let id = $(elemento).attr('idcita');
        let nombre = $(elemento).attr('cli');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success ml-2",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            icon: 'warning',
            title: 'Deseas eliminar citas '+nombre+'?',
            showCancelButton: true,
            confirmButtonText: "Si, Borrar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                eliminar(id).then(respuesta=>{
                    if(respuesta.mensaje == 'success'){
                        swalWithBootstrapButtons.fire({
                            title: "Eliminado!",
                            text: "La cita fue eliminado "+nombre+".",
                            icon: "success"
                        });
                        obtener_citas();
                    }else if(respuesta.mensaje == 'error_decrypt'){
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'No volnere los datos',
                            showConfirmButton: false,
                            timer: 1000,
                        }).then(function(){
                            location.reload();
                        })
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
                })
            } else if (
              /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ){
                swalWithBootstrapButtons.fire({
                    title: "Cancelado!",
                    text: "Cancelo la eliminación de citas",
                    icon: "error"
                });
            }
        });
    })

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


let espanol = {
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %ds fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir",
        "renameState": "Cambiar nombre",
        "updateState": "Actualizar",
        "createState": "Crear Estado",
        "removeAllStates": "Remover Estados",
        "removeState": "Remover",
        "savedStates": "Estados Guardados",
        "stateRestore": "Estado %d"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmente"
    },
    "decimal": ",",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
            "date": {
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "notBetween": "No entre",
                "not": "Diferente de",
                "after": "Después",
                "notEmpty": "No Vacío"
            },
            "number": {
                "between": "Entre",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "notBetween": "No entre",
                "notEmpty": "No vacío",
                "not": "Diferente de",
                "empty": "Vacío"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "startsWith": "Empieza con",
                "not": "Diferente de",
                "notContains": "No Contiene",
                "notStartsWith": "No empieza con",
                "notEndsWith": "No termina con",
                "notEmpty": "No Vacío"
            },
            "array": {
                "not": "Diferente de",
                "equals": "Igual",
                "empty": "Vacío",
                "contains": "Contiene",
                "notEmpty": "No Vacío",
                "without": "Sin"
            }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d",
        "showMessage": "Mostrar Todo",
        "collapseMessage": "Colapsar Todo"
    },
    "select": {
        "cells": {
            "1": "1 celda seleccionada",
            "_": "%d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        },
        "rows": {
            "1": "1 fila seleccionada",
            "_": "%d filas seleccionadas"
        }
    },
    "thousands": ".",
    "datetime": {
        "previous": "Anterior",
        "hours": "Horas",
        "minutes": "Minutos",
        "seconds": "Segundos",
        "unknown": "-",
        "amPm": [
            "AM",
            "PM"
        ],
        "months": {
            "0": "Enero",
            "1": "Febrero",
            "10": "Noviembre",
            "11": "Diciembre",
            "2": "Marzo",
            "3": "Abril",
            "4": "Mayo",
            "5": "Junio",
            "6": "Julio",
            "7": "Agosto",
            "8": "Septiembre",
            "9": "Octubre"
        },
        "weekdays": {
            "0": "Dom",
            "1": "Lun",
            "2": "Mar",
            "4": "Jue",
            "5": "Vie",
            "3": "Mié",
            "6": "Sáb"
        },
        "next": "Próximo"
    },
    "editor": {
        "close": "Cerrar",
        "create": {
            "button": "Nuevo",
            "title": "Crear Nuevo Registro",
            "submit": "Crear"
        },
        "edit": {
            "button": "Editar",
            "title": "Editar Registro",
            "submit": "Actualizar"
        },
        "remove": {
            "button": "Eliminar",
            "title": "Eliminar Registro",
            "submit": "Eliminar",
            "confirm": {
                "_": "¿Está seguro de que desea eliminar %d filas?",
                "1": "¿Está seguro de que desea eliminar 1 fila?"
            }
        },
        "error": {
            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
        },
        "multi": {
            "title": "Múltiples Valores",
            "restore": "Deshacer Cambios",
            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, haga clic o pulse aquí, de lo contrario conservarán sus valores individuales."
        }
    },
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "stateRestore": {
        "creationModal": {
            "button": "Crear",
            "name": "Nombre:",
            "order": "Clasificación",
            "paging": "Paginación",
            "select": "Seleccionar",
            "columns": {
                "search": "Búsqueda de Columna",
                "visible": "Visibilidad de Columna"
            },
            "title": "Crear Nuevo Estado",
            "toggleLabel": "Incluir:",
            "scroller": "Posición de desplazamiento",
            "search": "Búsqueda",
            "searchBuilder": "Búsqueda avanzada"
        },
        "removeJoiner": "y",
        "removeSubmit": "Eliminar",
        "renameButton": "Cambiar Nombre",
        "duplicateError": "Ya existe un Estado con este nombre.",
        "emptyStates": "No hay Estados guardados",
        "removeTitle": "Remover Estado",
        "renameTitle": "Cambiar Nombre Estado",
        "emptyError": "El nombre no puede estar vacío.",
        "removeConfirm": "¿Seguro que quiere eliminar %s?",
        "removeError": "Error al eliminar el Estado",
        "renameLabel": "Nuevo nombre para %s:"
    },
    "infoThousands": "."
} 


/*document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    $.post('../controllers/CitaController.php', { funcion: 'obtener_citas' }, (response) => {
        let citas = JSON.parse(response);
        var eventos = citas.map(cita => {
            return {
                id: cita.id,
                title: cita.cliente,
                start: cita.inicio,
                color: cita.color,
                end: cita.final,
                motivo: cita.motivo,
                saldo: cita.saldo,
                inicio: cita.inicio,
                fin: cita.final,
            };
        });
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: "es",
            initialView: 'dayGridMonth',
            headerToolbar: {
            left: 'prev,next today',
            center:'title',
            right:'dayGridMonth, timeGridWeek, timeGridDay, listWeek',
            },
            navLinks: true,
            businessHours: false,
            editable: true,
            selectable: true,
                themeSystem: 'bootstrap',
            buttonText: {
            today: "Hoy",
            month: "Mes",
            week: "Semana",
            day: "D\xEDa",
            list: "Agenda"
            },
            //noEventsText: "No hay eventos para mostrar",
            eventHint: "Evento",
            events: eventos,
            dateClick: function(info){
            console.log(info);
            fechaInicio = moment(info.dateStr).format('YYYY-MM-DDTHH:mm');
            fechaFin = moment(fechaInicio).add(30, 'minutes').format('YYYY-MM-DDTHH:mm');
            if (info.dateStr.length == 10) { fechaInicio = moment(info.dateStr).format('YYYY-MM-DDT09:00'); fechaFin = moment(info.dateStr).format('YYYY-MM-DDT09:30'); }
            //$('#modalAgregarEvento #nombre_paciente').find('[autofocus]').focus();
            $('#inicio').val(fechaInicio)
            $('#final').val(fechaFin)
            $('#asignar_cita').modal('show');
            },
            eventClick: function (info) {
                console.log(info);
                $('#id').val(info.event.id);
                $('#cliente_mod').val(info.title).trigger('change');
                $('#color_mod').val(info.event.backgroundColor);
                $('#motivo_mod').val(info.event._def.extendedProps.motivo);
                $('#editar_cita').modal('show');
                //$('#btnBorrarCita').attr('idCita', info.event.id);
                $('#inicio_mod').val(info.event._def.extendedProps.inicio);
                $('#final_mod').val(info.event._def.extendedProps.fin);
                $('#saldo_mod').val(info.event._def.extendedProps.saldo);
                $(".btnEditarCita").prop("disabled", false);

            },
            eventDrop: function (event, delta, revertFunc) {
                let a = moment(event.event.startStr).format('YYYY-MM-DD');
                let b = moment(event.event._def.extendedProps.inicio).format('HH:mm:ss');
                let c = moment(event.event._def.extendedProps.fin).format('HH:mm:ss');
                let ini = a + " " + b;
                let fin = a + " " + c;

                evento = [];
                evento[0] = event.event.id;
                evento[1] = moment(ini).format('YYYY-MM-DD HH:mm:ss');
                evento[2] = moment(fin).format('YYYY-MM-DD HH:mm:ss');

                $.ajax({
                    url: "./vistas/paginas/eventos.php",
                    method: "POST",
                    data: { editar: evento },
                    success: function (rep) {
                    Swal.fire({
                        title: lang['evento_modificado'],
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });

                    }

                })

            },
            eventResize: function (event, dayDelta, minuteDelta, revertFunc) {

            },

        });
        calendar.render();
        calendar.refetchEvents();
    })
    $(".btnGuardarCita").on("click", function () {

            $(".btnGuardarCita").prop("disabled", true);
            let id_paciente = $("#id_paciente").val();
            let nombre_paciente = $("#nombre_paciente").val();
            let color = $("#color").val();
            let precio = $("#precio").val();
            let inicioEvento = $("#inicioEvento").val();
            let finEvento = $("#finEvento").val();
            let observaciones = $("#observaciones").val();

            let datos = new FormData();
            datos.append("crearCita", "ok");
            datos.append("id_paciente", id_paciente);
            datos.append("nombre_paciente", nombre_paciente);
            datos.append("color", color);
            datos.append("precio", precio);
            datos.append("inicioEvento", inicioEvento);
            datos.append("finEvento", finEvento);
            datos.append("observaciones", observaciones);

            $.ajax({

                url: "ajax/calendario.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (respuesta) {

                    calendar.refetchEvents();
                    calendar.render();

                    if (respuesta === "ok") {

                        Swal.fire({
                            icon: "success",
                            title: lang['evento_guardado'],
                            showConfirmButton: true,
                            timer: 2000,
                            confirmButtonText: lang['Cerrar']

                        })

                        $("#formularioCrearEvento")[0].reset();
                        $('#modalAgregarEvento').modal('hide');
                        $(".btnGuardarCita").prop("disabled", false);

                    } else {

                        Swal.fire({
                            icon: "error",
                            title: lang['Error'],
                            html: respuesta,
                            showConfirmButton: true,
                            confirmButtonText: lang['Cerrar']

                        })

                    }

                }

            })

    })


    $(".btnEditarCita").on("click", function () {

            $(".btnEditarCita").prop("disabled", true);
            let idEvento = $("#idEvento").val();
            let id_paciente = $("#id_paciente").val();
            let color = $("#editarColor").val();
            let precio = $("#editarPrecio").val();
            let inicioEvento = $("#editarInicioEvento").val();
            let finEvento = $("#editarFinEvento").val();
            let observaciones = $("#editarObservaciones").val();

            let datos = new FormData();
            datos.append("editarCita", idEvento);
            datos.append("editarColor", color);
            datos.append("editarPrecio", precio);
            datos.append("editarInicioEvento", inicioEvento);
            datos.append("editarFinEvento", finEvento);
            datos.append("editarObservaciones", observaciones);

            $.ajax({

                url: "ajax/calendario.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (respuesta) {

                    calendar.refetchEvents();
                    calendar.render();

                    if (respuesta === "ok") {

                        Swal.fire({
                            icon: "success",
                            title: lang['evento_editado'],
                            showConfirmButton: true,
                            timer: 2000,
                            confirmButtonText: lang['Cerrar']

                        })

                        $("#formularioEditarEvento")[0].reset();
                        $('#modalEditarEvento').modal('hide');
                        $(".btnEditarCita").prop("disabled", false);

                    } else {

                        Swal.fire({
                            icon: "error",
                            title: lang['Error'],
                            html: respuesta,
                            showConfirmButton: true,
                            confirmButtonText: lang['Cerrar']

                        })

                    }

                }

            })


        });


    $('#btnBorrarCita').on('click', function (event) {

            let idCita = $(this).attr('idCita');

            Swal.fire({
                title: lang['borrar_evento_?'],
                text: lang['si_no_puede_cancelar'],
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: lang['Cancelar'],
                confirmButtonText: lang['si_borrar']
            }).then(function (result) {

                if (result.value) {

                    let datos = new FormData();
                    datos.append("idCitaBorrar", idCita);

                    $.ajax({

                        url: "ajax/calendario.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (respuesta) {

                            calendar.refetchEvents();
                            calendar.render();

                            if (respuesta === "ok") {

                                Swal.fire({
                                    icon: "success",
                                    title: lang['evento_eliminado'],
                                    showConfirmButton: true,
                                    confirmButtonText: lang['Cerrar']

                                });

                                $("#formularioEditarEvento")[0].reset();
                                $('#modalEditarEvento').modal('hide');

                            } else {

                                Swal.fire({
                                    icon: "error",
                                    title: lang['Error'],
                                    html: respuesta,
                                    showConfirmButton: true,
                                    confirmButtonText: lang['Cerrar']

                                })

                            }

                        }

                    })

                }

            })

    });
    


    $("#inicioEvento").on("change", function () {

            $("#finEvento").val((moment($("#inicioEvento").val()).add(30, 'minutes')).format('YYYY-MM-DD HH:mm:ss'));

        })

        $("#editarInicioEvento").on("change", function () {

            $("#editarFinEvento").val((moment($("#editarInicioEvento").val()).add(30, 'minutes')).format('YYYY-MM-DD HH:mm:ss'));

        })

});*/
