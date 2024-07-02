$(document).ready(function(){
    Loader();
    //setTimeout(verificar_sesion,2000);
    verificar_sesion();
    //Para no duplicar el toastr
    toastr.options={
        "preventDuplicates":true,
    }

    //combox para listar tipo documento
    $('#docum').select2({
        placeholder: 'Selecione tipo documento...',
        language: {
            noResult: function () {
                return "No hay resultados"
            },
            searching: function () {
                return "Buscando..."
            }
        }
    }
    );

    $('#docum_mod').select2({
        placeholder: 'Selecione tipo documento...',
        language: {
            noResult: function () {
                return "No hay resultados"
            },
            searching: function () {
                return "Buscando..."
            }
        }
    }
    );

    //Funcion de forma asincrona de obtener tipo documento.
    async function obtener_docum(){
        let funcion = "obtener_docum";
        let data = await fetch('../controllers/UsuarioController.php',{
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'funcion='+funcion

        })
        if(data.ok){
        let response = await data.text();
        try {
            let docum = JSON.parse(response);
            let template = '';
            docum.forEach(doc => {
                if(doc.id == 1){
                    template+=`
                    <option value="${doc.nombre}">${doc.nombre}</option>
                    `;
                }
            });
            $('#docum').html(template);
            $('#docum').val('').trigger('change');
            $('#docum_mod').html(template);
            $('#docum_mod').val('').trigger('change');
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
    //Funcion de llenar menu superior.
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
    //Funcion de llenar menu lateral.
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
    //Funcion de verificar sesion activa de usuario.
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
            obtener_docum();
            obtener_usuarios();
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
    //Funcion de obtener datos del usuario.
    async function obtener_usuarios(){
        let funcion = "obtener_usuarios";
        let data = await fetch('../controllers/UsuarioController.php',{
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'funcion='+funcion
    
        })
        if(data.ok){
            let response = await data.text();
            try {
                let usuarios = JSON.parse(response);
                $('#usuarios').DataTable({
                data: usuarios,
                "aaSorting": [],
                lengthMenu: [2,10, 25, 50, 75, 100],
                "searching": true,
                "scrollX":true,
                "autoWidth":false,
                columns: [{
                    "render": function(data,type,datos,meta){
                        let template = '';
                        template+= `
                            <div class="card bg-light d-flex flex-fill">
                                <div class="h5 card-header text-muted border-bottom-0">`
                                    if(datos.id_tipo == 1){
                                        template+=`<span class="badge badge-danger">${datos.cargo}</span>`;
                                    }
                                    if(datos.id_tipo == 2){
                                        if(datos.estado =='A'){
                                            template+=`<span class="badge badge-success">${datos.cargo}</span>`;
                                        }else{
                                            template+=`<span class="badge badge-success">${datos.cargo}</span> - 
                                            <span class="badge badge-secondary">Inactivo</span>`;
                                        }
                                    }
                                    if(datos.id_tipo == 3){
                                        if(datos.estado =='A'){
                                            template+=`<span class="badge badge-info">${datos.cargo}</span>`;
                                        }else{
                                            template+=`<span class="badge badge-info">${datos.cargo}</span> - 
                                            <span class="badge badge-secondary">Inactivo</span>`;
                                        }
                                    }
                                template+=`</div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-7">
                                        <h4 class=""><b>${datos.nombre} ${datos.apellido}</b></h4>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="mediun"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Documento: ${datos.documento}</li>
                                        <li class="mediun"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> DNI: ${datos.numero}</li>
                                        <li class="mediun"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Telefono: ${datos.telefono}</li>
                                        <li class="mediun"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Dirección: ${datos.direccion}</li>
                                        <li class="mediun"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Correo: ${datos.correo}</li>
                                        </ul>
                                        </div>
                                        
                                        <div class="col-md-5 text-center">
                                        <img src="../util/img/user/${datos.avatar}" alt="tinta" width="80" height="90" class="rounded-circle img-fluid">
                                        </div>
                                    </div>
                                </div>
        
                                <div class="card-footer">
                                    <div class="text-right">`
                                        if(datos.idtipo == 1 && datos.id_tipo !=1 && datos.estado =='A'){
                                            if(datos.id_tipo ==2){
                                                    template+=`
                                                <button id="${datos.id}"
                                                nombre="${datos.nombre}"
                                                apellido="${datos.apellido}"
                                                avatar="${datos.avatar}"
                                                funcion="eliminar_usuario"
                                                class="confirmar btn btn-circle btn-sm btn-outline-danger ml-2 mr-2 mb-2" title="Eliminar usuario" data-toggle="modal" data-target="#confirmar"><i class="fas fa-trash"></i></button>
                                                <button id="${datos.id}"
                                                nombre="${datos.nombre}"
                                                apellido="${datos.apellido}"
                                                avatar="${datos.avatar}"
                                                funcion="descender_usuario" class="confirmar btn btn-circle btn-sm btn-outline-secondary ml-2 mr-2 mb-2" title="Descender usuario" data-toggle="modal" data-target="#confirmar"><i class="fas fa-sort-amount-down"></i></button>
                                                `
                                            }else if(datos.id_tipo == 3){
                                                template+=`
                                                <button id="${datos.id}"
                                                nombre="${datos.nombre}"
                                                apellido="${datos.apellido}"
                                                avatar="${datos.avatar}"
                                                funcion="eliminar_usuario" class="confirmar btn btn-circle btn-sm btn-outline-danger ml-2 mr-2 mb-2" title="Eliminar usuario" data-toggle="modal" data-target="#confirmar"><i class="fas fa-trash"></i></button>
                                                <button id="${datos.id}"
                                                nombre="${datos.nombre}"
                                                apellido="${datos.apellido}"
                                                avatar="${datos.avatar}"
                                                funcion="ascender_usuario" class="confirmar btn btn-circle btn-sm btn-outline-primary ml-2 mr-2 mb-2" title="Ascender usuario" data-toggle="modal" data-target="#confirmar"><i class="fas fa-sort-amount-up"></i></button>
                                                `
                                            }
                                        }else if(datos.idtipo == 2 && datos.id_tipo !=1 && datos.id_tipo!=2 && datos.estado =='A'){
                                            if(datos.id_tipo == 3){
                                                template+=`
                                                <button id="${datos.id}"
                                                nombre="${datos.nombre}"
                                                apellido="${datos.apellido}"
                                                avatar="${datos.avatar}"
                                                funcion="eliminar_usuario" class="confirmar btn btn-circle btn-sm btn-outline-danger ml-2 mr-2 mb-2" title="Eliminar usuario" data-toggle="modal" data-target="#confirmar"><i class="fas fa-trash"></i></button>
                                                <button id="${datos.id}"
                                                nombre="${datos.nombre}"
                                                apellido="${datos.apellido}"
                                                avatar="${datos.avatar}"
                                                funcion="ascender_usuario" class="confirmar btn btn-circle btn-sm btn-outline-primary ml-2 mr-2 mb-2" title="Ascender usuario" data-toggle="modal" data-target="#confirmar"><i class="fas fa-sort-amount-up"></i></button>
                                                `
                                            }
                                        }else if(datos.estado == 'I'){
                                            template+=`
                                                <button id="${datos.id}"
                                                nombre="${datos.nombre}"
                                                apellido="${datos.apellido}"
                                                avatar="${datos.avatar}"
                                                funcion="activar_usuario" class="confirmar btn btn-circle btn-sm btn-outline-dark ml-2 mr-2 mb-2" title="Activar usuario" data-toggle="modal" data-target="#confirmar"><i class="fas fa-plus"></i></button>
                                                
                                                `
                                        }

                                        if(datos.idtipo == 1 && datos.id_tipo == 1 && datos.id_tipo !=2 && datos.estado =='A'){
                                            template+=`<button id="${datos.id}"
                                            tipo="${datos.documento}"
                                            dni="${datos.numero}" 
                                            nombre="${datos.nombre}" 
                                            apellido="${datos.apellido}" 
                                            login="${datos.login}" 
                                            class="editar_usuario btn btn-circle btn-sm btn-outline-success ml-2 mb-2 mr-2" title="Editar usuario" data-toggle="modal" data-target="#editar_usuario"><i class="fas fa-pen-alt"></i></button>
                                            `
                                        }else if(datos.idtipo == 2 && datos.id_tipo ==3 && datos.id_tipo !=2 && datos.estado =='A'){
                                            template+=`<button id="${datos.id}"
                                            tipo="${datos.documento}"
                                            dni="${datos.numero}" 
                                            nombre="${datos.nombre}" 
                                            apellido="${datos.apellido}" 
                                            login="${datos.login}" 
                                            class="editar_usuario btn btn-circle btn-sm btn-outline-success ml-2 mb-2 mr-2" title="Editar usuario" data-toggle="modal" data-target="#editar_usuario"><i class="fas fa-pen-alt"></i></button>
                                            `
                                        }else if(datos.idtipo == 2 && datos.id_tipo ==2 && datos.estado =='A'){
                                            template+=`<button id="${datos.id}"
                                            tipo="${datos.documento}"
                                            dni="${datos.numero}" 
                                            nombre="${datos.nombre}" 
                                            apellido="${datos.apellido}" 
                                            login="${datos.login}" 
                                            class="editar_usuario btn btn-circle btn-sm btn-outline-success ml-2 mb-2 mr-2" title="Editar usuario" data-toggle="modal" data-target="#editar_usuario"><i class="fas fa-pen-alt"></i></button>
                                            `
                                        }else if(datos.idtipo == 1 && datos.id_tipo ==3 && datos.estado =='A'){
                                            template+=`<button id="${datos.id}"
                                            tipo="${datos.documento}"
                                            dni="${datos.numero}" 
                                            nombre="${datos.nombre}" 
                                            apellido="${datos.apellido}" 
                                            login="${datos.login}" 
                                            class="editar_usuario btn btn-circle btn-sm btn-outline-success ml-2 mb-2 mr-2" title="Editar usuario" data-toggle="modal" data-target="#editar_usuario"><i class="fas fa-pen-alt"></i></button>
                                            `
                                        }else if(datos.idtipo == 1 && datos.id_tipo ==2 && datos.estado =='A'){
                                            template+=`<button id="${datos.id}"
                                            tipo="${datos.documento}"
                                            dni="${datos.numero}" 
                                            nombre="${datos.nombre}" 
                                            apellido="${datos.apellido}" 
                                            login="${datos.login}" 
                                            class="editar_usuario btn btn-circle btn-sm btn-outline-success ml-2 mb-2 mr-2" title="Editar usuario" data-toggle="modal" data-target="#editar_usuario"><i class="fas fa-pen-alt"></i></button>
                                            `
                                        }

                                    template+=`</div>
                                </div>
                            </div>
                        
                        `;
                        return template
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
    //Funcion de registrar usuario.
    async function registro_usuarios(datos){
        let data = await fetch('../controllers/UsuarioController.php',{
            method: "POST",
            body: datos
        })
        if(data.ok){
            let response = await data.text();
            try {
                let respuesta = JSON.parse(response);
                if(respuesta.mensaje == 'success'){
                    toastr.success('Se registro el usuario','Exito!')
                    obtener_usuarios();
                    $('#crear_usuario').modal('hide');
                    $("#form-registrar").trigger('reset');
                    $('#docum').val('').trigger('change');
                }else if(respuesta.mensaje == 'error_usuario'){
                    Swal.fire({
                        icon: 'error',
                        title: 'El usuario ya existe',
                        text: 'El usuario ya existe, pongase en contacto con el administrador del sistema'
                    });
                    $("#form-registrar").trigger('reset');
                    $('#docum').val('').trigger('change');
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
            let datos = new FormData($('#form-registrar')[0]);
            let funcion = "registro_usuarios";
            datos.append('funcion',funcion);
            registro_usuarios(datos);
        }
    });
    jQuery.validator.addMethod("letras",function(value) {
        let campo = value.replace(/ /g,"");
        let estado = /^[A-Za-z]+$/.test(campo);
        return estado;
    },"*Este campo solo permite letras")
    $('#form-registrar').validate({
        rules: {
            docum: {
                required: true,
            },
            num: {
                required: true,
                number: true,
                minlength: 8,
                maxlength: 8
            },
            nombre: {
                required: true,
                letras:true
            },
            apellido: {
                required: true,
                letras:true
            },
            login: {
                required: true,
                letras:true
            },
            clave: {
                required: true,
                number: true,
            },
            direccion: {
                required: false,
            },
            telefono: {
                required: false,
                number: true,
                minlength: 9,
                maxlength: 9
            },
            correo: {
                required: false,
                email: true,
            }
        },
        messages: {
            docum: {
                required: "*Dato requerido",
            },
            num: {
                required: "*Porfavor, Ingrese su numero",
                number: "*El dato debe ser numéricos",
                minlength: "*Se permite minimo 8 caracteres",
                maxlength: "*Se permite maximo 8 caracteres"
            },
            nombre: {
                required: "*Porfavor, Ingrese su nombre",
            },
            apellido: {
                required: "*Porfavor, Ingrese su apellido",
            },
            login: {
                required: "*Porfavor, Ingrese su tipo login",
            },
            clave: {
                required: "*Porfavor, Ingrese su contraseña",
                number: "*La contraseña debe ser numéricos",
            },
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
    //Escuchar evento click para confirmar.
    $(document).on('click','.confirmar',(e)=>{
        let elemento = $(this)[0].activeElement;
        let id = $(elemento).attr('id');
        let nombre = $(elemento).attr('nombre');
        let apellido = $(elemento).attr('apellido');
        let avatar = $(elemento).attr('avatar');
        let funcion = $(elemento).attr('funcion');
        $('#nombre_confirmar').text(nombre);
        $('#apellido_confirmar').text(apellido);
        $('#avatar_confirmar').attr('src','../util/img/user/'+avatar);
        $('#id_usuario').val(id);
        $('#funcion').val(funcion);
    });
    //Funcion de confimar usuario.
    async function confirmar(datos){
        let data = await fetch('../controllers/UsuarioController.php',{
            method: "POST",
            body: datos
        })
        if(data.ok){
            let response = await data.text();
            try {
                let respuesta = JSON.parse(response);
                if(respuesta.mensaje == 'success'){
                    if(respuesta.funcion == 'eliminar usuario'){
                        toastr.success('Se elimino al usuario','Exito!')
                        obtener_usuarios();
                        $('#confirmar').modal('hide');
                        $("#form_confirmar").trigger('reset');
                    }
                    else if(respuesta.funcion == 'activar usuario'){
                        toastr.success('Se activo al usuario','Exito!')
                        obtener_usuarios();
                        $('#confirmar').modal('hide');
                        $("#form_confirmar").trigger('reset');
                    }else if(respuesta.funcion == 'ascender usuario'){
                        toastr.success('Se ascendió al usuario','Exito!')
                        obtener_usuarios();
                        $('#confirmar').modal('hide');
                        $("#form_confirmar").trigger('reset');
                    }else if(respuesta.funcion == 'descender usuario'){
                        toastr.success('Se descendió al usuario','Exito!')
                        obtener_usuarios();
                        $('#confirmar').modal('hide');
                        $("#form_confirmar").trigger('reset');
                    }

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
                }else if(respuesta.mensaje == 'error_pass'){
                    toastr.error('No se pudo '+respuesta.funcion+' Porque su contraseña actual no coincide con nuestros registros, intente de nuevo','Error!')
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
            let datos = new FormData($('#form_confirmar')[0]);
            confirmar(datos);
        }
    });
    $('#form_confirmar').validate({
        rules: {
            pass: {
                required: true,
            }
            
        },
        messages: {
            pass: {
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
    //Escuchar evento click para editar usuario.
    $(document).on('click','.editar_usuario',(e)=>{
        let elemento = $(this)[0].activeElement;
        let id = $(elemento).attr('id');
        let tipo = $(elemento).attr('tipo');
        let dni = $(elemento).attr('dni');
        let nombre = $(elemento).attr('nombre');
        let apellido = $(elemento).attr('apellido');
        let login = $(elemento).attr('login');
        $('#idusuario_mod').val(id);
        $('#docum_mod').val(tipo).trigger('change');
        $('#num_mod').val(dni);
        $('#nombre_mod').val(nombre);
        $('#apellido_mod').val(apellido);
        $('#login_mod').val(login);
    });
    //Funcion de editar usuario.
    async function editar_usuarios(datos){
        let data = await fetch('../controllers/UsuarioController.php',{
            method: "POST",
            body: datos
        })
        if(data.ok){
            let response = await data.text();
            try {
                let respuesta = JSON.parse(response);
                if(respuesta.mensaje == 'success'){
                    toastr.success('Se Edito el usuario','Exito!')
                    obtener_usuarios();
                    $('#editar_usuario').modal('hide');
                    $("#form-editar").trigger('reset');
                    $('#docum_mod').val('').trigger('change');
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
            let funcion = "editar_usuarios";
            datos.append('funcion',funcion);
            editar_usuarios(datos);
        }
    });
    jQuery.validator.addMethod("letras",function(value) {
        let campo = value.replace(/ /g,"");
        let estado = /^[A-Za-z]+$/.test(campo);
        return estado;
    },"*Este campo solo permite letras")
    $('#form-editar').validate({
        rules: {
            docum_mod: {
                required: true,
            },
            num_mod: {
                required: true,
                number: true,
                minlength: 8,
                maxlength: 8
            },
            nombre_mod: {
                required: true,
                letras:true
            },
            apellido_mod: {
                required: true,
                letras:true
            },
            login_mod: {
                required: true,
                letras:true
            }
        },
        messages: {
            docum_mod: {
                required: "*Dato requerido",
            },
            num_mod: {
                required: "*Porfavor, Ingrese su numero",
                number: "*El dato debe ser numéricos",
                minlength: "*Se permite minimo 8 caracteres",
                maxlength: "*Se permite maximo 8 caracteres"
            },
            nombre_mod: {
                required: "*Porfavor, Ingrese su nombre",
            },
            apellido_mod: {
                required: "*Porfavor, Ingrese su apellido",
            },
            login_mod: {
                required: "*Porfavor, Ingrese su tipo login",
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
    //La cargar de datos.
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
    //Cerrar la carga de datos.
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