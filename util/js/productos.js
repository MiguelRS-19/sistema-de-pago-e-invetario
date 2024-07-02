$(document).ready(function(){
    Loader();
    //setTimeout(verificar_sesion,2000);
    bsCustomFileInput.init();
    verificar_sesion();
    toastr.options={
        "preventDuplicates":true,
    }

    $('#categoria').select2({
        placeholder: 'Selecione categoria...',
        language: {
            noResult: function () {
                return "No hay resultados"
            },
            searching: function () {
                return "Buscando..."
            }
        }
    });
    $('#categoria_mod').select2({
        placeholder: 'Selecione categoria...',
        language: {
            noResult: function () {
                return "No hay resultados"
            },
            searching: function () {
                return "Buscando..."
            }
        }
    });

    $('#marca').select2({
        placeholder: 'Selecione marca...',
        language: {
            noResult: function () {
                return "No hay resultados"
            },
            searching: function () {
                return "Buscando..."
            }
        }
    });

    $('#marca_mod').select2({
        placeholder: 'Selecione marca...',
        language: {
            noResult: function () {
                return "No hay resultados"
            },
            searching: function () {
                return "Buscando..."
            }
        }
    });

    async function obtener_categoria(){
        let funcion = "obtener_categoria";
        let data = await fetch('../controllers/ProductoController.php',{
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'funcion='+funcion

        })
        if(data.ok){
        let response = await data.text();
        try {
            let categorias = JSON.parse(response);
            let template = '';
            categorias.forEach(categoria => {
                if(categoria.estado == 'A'){
                    template+=`
                    <option value="${categoria.id}">${categoria.nombre}</option>
                    `;
                }
            });
            $('#categoria').html(template);
            $('#categoria').val('').trigger('change');
            $('#categoria_mod').html(template);
            $('#categoria_mod').val('').trigger('change');
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

    async function obtener_marca(){
        let funcion = "obtener_marca";
        let data = await fetch('../controllers/ProductoController.php',{
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'funcion='+funcion

        })
        if(data.ok){
        let response = await data.text();
        try {
            let marcas = JSON.parse(response);
            let template = '';
            marcas.forEach(marca => {
                if(marca.estado == 'A'){
                    template+=`
                    <option value="${marca.id}">${marca.nombre}</option>
                    `;
                }
            });
            $('#marca').html(template);
            $('#marca').val('').trigger('change');
            $('#marca_mod').html(template);
            $('#marca_mod').val('').trigger('change');
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


    function llenar_menu_superior(usuario) {
        let template = `
            <ul class="navbar-nav ml-auto">
                
                <li id="cart-carrito" class="nav-item dropdown no-arrow mx-1" role="button">
                    <a class="nav-link dropdown-toggle">
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
            let respuesta = JSON.parse(response);
            if(respuesta.length != 0){
                llenar_menu_superior(respuesta);
                llenar_menu_lateral(respuesta);
                $('#cart-carrito').hide();
                $('#notificar').hide();
                traer_productos();
                obtener_categoria();
                obtener_marca();
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

    async function traer_productos(){
        let funcion = "traer_productos";
        let data = await fetch('../controllers/ProductoController.php',{
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'funcion='+funcion

        })
        if(data.ok){
        let response = await data.text();
        try {
            let productos = JSON.parse(response);
            $('#productos').DataTable({
            data: productos,
            "aaSorting": [],
            lengthMenu: [1,10, 25, 50, 75, 100],
            "searching": true,
            "scrollX":true,
            "autoWidth":false,
            columns: [{
                "render": function(data,type,datos,meta){
                    let estado_span = '';
                    if(datos.estado == 'A'){
                        estado_span = `<span class="badge badge-success"><b>Activo</b></span>`;
                    }else{
                        estado_span = `<span class="badge badge-danger"><b>Inactivo</b></span>`;
                    }
                    let stock = '';
                    let intStock = Number(datos.stock);
                    let StockMinimo = Number(datos.stock_minimo)
                    if(intStock < StockMinimo){
                        stock = "Sin stock";
                    }else{
                        stock = datos.stock;
                    }
                    let estado = '';
                    if(intStock > StockMinimo){
                        estado = `<span class="badge badge-success"><b>Disponible</b></span>`;
                    }else{
                        estado = `<span class="badge badge-danger"><b>Agotado</b></span>`;
                    }
                    let template= `
                        <div class="card bg-light d-flex flex-fill">
                            <div class="h5 card-header text-muted border-bottom-0">
                                <i class="fas fa-lg fa-cubes mr-1"></i>${stock}
                            </div>
                            <div class="lead ml-4">${estado} | ${estado_span}</div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-4">
                                    <h4 class=""><b>${datos.producto}</b></h4>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="mediun"><span class="fa-li"><i class="fas fa-lg fa-barcode"></i></span> Código: ${datos.codigo}</li>
                                    <li class="mediun"><span class="fa-li"><i class="fas fa-lg fa-coins"></i></span> Precio venta: ${datos.precio_venta}</li>
                                    <li class="mediun"><span class="fa-li"><i class="fas fa-stream"></i></span> Descripción: ${datos.descripcion}</li>
                                    <li class="mediun"><span class="fa-li"><i class="fas fa-tasks"></i></span> Presentación: ${datos.presentacion}</li>
                                    </ul>
                                    </div>
                                    <div class="col-md-4">
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="mediun"><span class="fa-li"><i class="fas fa-lg fa-tags"></i></span> Marca: ${datos.marca}</li>
                                    <li class="mediun"><span class="fa-li"><i class="fas fa-layer-group"></i></span> Categoria: ${datos.categoria}</li>
                                    </ul>
                                    </div>
                                    <div class="col-md-4 text-center">
                                    <img src="../util/img/productos/${datos.imagen}" alt="producto" width="80" height="90" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                            <div class="text-right">`
                            if(datos.estado == 'A'){
                                template+=`
                                </button>
                                <button id="${datos.id}"
                                nombre="${datos.producto}"
                                descripcion="${datos.descripcion}"
                                presentacion="${datos.presentacion}"
                                precio_compra="${datos.precio_compra}"
                                precio_venta="${datos.precio_venta}"
                                stock="${datos.stock}"
                                stock_minimo="${datos.stock_minimo}"
                                idmarca="${datos.idmarca}"
                                idcat="${datos.idcat}"
                                avatar="${datos.imagen}"
                                class="editar_producto btn btn-circle btn-sm btn-outline-success ml-2" title="Editar producto" data-toggle="modal" data-target="#editar_producto"><i class="fas fa-pen-alt"></i></button>
                                <button id="${datos.id}"
                                nombre="${datos.producto}"
                                avatar="${datos.imagen}"
                                class="editar_imagen btn btn-circle btn-sm btn-outline-info ml-2" title="Cambiar imagen" data-toggle="modal" data-target="#editar_imagen"><i class="fas fa-image"></i></button>
                                </button>
                                <button id="${datos.id}"
                                codigo="${datos.codigo}"
                                nombre="${datos.producto}"
                                avatar="${datos.imagen}"
                                class="eliminar btn btn-circle btn-sm btn-outline-danger ml-2" title="Eliminar producto"><i class="fas fa-trash"></i></button>
                                
                                `;
                            }else{
                                template+=`
                                <button id="${datos.id}" 
                                codigo="${datos.codigo}"
                                nombre="${datos.producto}"
                                avatar="${datos.imagen}"
                                class="activar btn btn-sm btn-outline-dark btn-circle ml-2">
                                <i class="fas fa-plus"></i>
                                
                                `;
                            }
                            template+= `</div>
                            </div>
                        </div>
                    
                    `;
                    return template;
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

    $('#generar_id').click((e)=>{
        let funcion = 'generar';
        $.post('../controllers/ProductoController',{funcion},(response)=>{
            const json = JSON.parse(response);
            $('#codigo').val(json.codigo);
        })
    })

    async function registro_productos(datos){
        let data = await fetch('../controllers/ProductoController.php',{
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
                toastr.success('Se registro el producto','Exito!')
                traer_productos();
                $('#crear_producto').modal('hide');
                $("#form-registrar").trigger('reset');
                $('#marca').val('').trigger('change');
                $('#categoria').val('').trigger('change');
            }else if(respuesta.mensaje == 'error_producto'){
                Swal.fire({
                    icon: 'error',
                    title: 'El producto ya existe',
                    text: 'El producto ya existe, pongase en contacto con el administrador del sistema'
                });
                $("#form-registrar").trigger('reset');
                $('#marca').val('').trigger('change');
                $('#categoria').val('').trigger('change');
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
            let datos = new FormData($('#form-registrar')[0]);
            let funcion = "registro_productos";
            datos.append('funcion',funcion);
            registro_productos(datos);
        }
    });
    jQuery.validator.addMethod("letras",function(value) {
        let campo = value.replace(/ /g,"");
        let estado = /^[A-Za-z]+$/.test(campo);
        return estado;
    },"*Este campo solo permite letras")
    $('#form-registrar').validate({
        rules: {
            codigo: {
                required: true,
            },
            nombre: {
                required: true,
                letras:true
            },
            descripcion: {
                required: true,
            },
            presentacion: {
                required: true,
            },
            precio_compra: {
                required: true,
                number: true,
            },
            precio_venta: {
                required: true,
                number: true,
            },
            stock: {
                required: true,
                number: true,
                min: true
            },
            stock_minimo: {
                required: true,
                number: true,
                range: [6, 12]
            },
            categoria: {
                required: true,
            },
            marca: {
                required: true,
            }
        },
        messages: {
            codigo: {
                required: "*Dato requerido",
            },
            nombre: {
                required: "*Porfavor, Ingrese el nombre",
            },
            descripcion: {
                required: "*Porfavor, Ingrese descripcion",
            },
            presentacion: {
                required: "*Porfavor, Ingrese presentacion",
            },
            precio_compra: {
                required: "*Porfavor, Ingrese precio de compra",
                number: "*El dato debe ser numéricos",
            },
            precio_venta: {
                required: "*Porfavor, Ingrese precio de venta",
                number: "*El dato debe ser numéricos",
            },
            stock: {
                required: "*Porfavor, Ingrese stock",
                number: "*El dato debe ser numéricos",
                min: "Por favor ingrese un valor mayor o igual a 1."
            },
            stock_minimo: {
                required: "*Porfavor, Ingrese stock minimo",
                number: "*El dato debe ser numéricos",
                range: "Por favor introduzca un valor entre 6 y 12."
            },
            categoria: {
                required: "*Porfavor, Ingrese categoria",
            },
            marca: {
                required: "*Porfavor, Ingrese marca",
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


    $(document).on('click','.editar_producto',(e)=>{
        let elemento = $(this)[0].activeElement;
        let id = $(elemento).attr('id');
        let nombre = $(elemento).attr('nombre');
        let descripcion = $(elemento).attr('descripcion');
        let presentacion = $(elemento).attr('presentacion');
        let precio_compra = $(elemento).attr('precio_compra');
        let precio_venta = $(elemento).attr('precio_venta');
        let stock = $(elemento).attr('stock');
        let stock_minimo = $(elemento).attr('stock_minimo');
        let idmarca = $(elemento).attr('idmarca');
        let idcat = $(elemento).attr('idcat');
        console.log(idmarca, idcat);
        //let avatar = $(elemento).attr('avatar');
        $('#id').val(id);
        $('#nombre_mod').val(nombre);
        $('#descripcion_mod').val(descripcion);
        $('#presentacion_mod').val(presentacion);
        $('#precio_compra_mod').val(precio_compra);
        $('#precio_venta_mod').val(precio_venta);
        $('#stock_mod').val(stock);
        $('#stock_minimo_mod').val(stock_minimo);
        $('#marca_mod').val(idmarca).trigger('change');
        $('#categoria_mod').val(idcat).trigger('change');
    });

    async function editar_productos(datos){
        let data = await fetch('../controllers/ProductoController.php',{
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
                toastr.success('Se Edito el producto','Exito!')
                traer_productos();
                $('#editar_producto').modal('hide');
                $('#marca_mod').val('').trigger('change');
                $('#categoria_mod').val('').trigger('change');
                $("#form-editar").trigger('reset');
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
        let funcion = "editar_productos";
        datos.append('funcion',funcion);
        editar_productos(datos);
    }
    });
    jQuery.validator.addMethod("letras",function(value) {
        let campo = value.replace(/ /g,"");
        let estado = /^[A-Za-z]+$/.test(campo);
        return estado;
    },"*Este campo solo permite letras")
    $('#form-editar').validate({
        rules: {
            nombre_mod: {
                required: true,
                letras:true
            },
            descripcion_mod: {
                required: true,
            },
            presentacion_mod: {
                required: true,
            },
            precio_compra_mod: {
                required: true,
                number: true,
            },
            precio_venta_mod: {
                required: true,
                number: true,
            },
            stock_mod: {
                required: true,
                number: true,
                min: true
            },
            stock_minimo_mod: {
                required: true,
                number: true,
                range: [6, 12]
            },
            categoria_mod: {
                required: true,
            },
            marca_mod: {
                required: true,
            }
        },
        messages: {
            nombre_mod: {
                required: "*Porfavor, Ingrese el nombre",
            },
            descripcion_mod: {
                required: "*Porfavor, Ingrese descripcion",
            },
            presentacion_mod: {
                required: "*Porfavor, Ingrese presentacion",
            },
            precio_compra_mod: {
                required: "*Porfavor, Ingrese precio de compra",
                number: "*El dato debe ser numéricos",
            },
            precio_venta_mod: {
                required: "*Porfavor, Ingrese precio de venta",
                number: "*El dato debe ser numéricos",
            },
            stock_mod: {
                required: "*Porfavor, Ingrese stock",
                number: "*El dato debe ser numéricos",
                min: "Por favor ingrese un valor mayor o igual a 1."
            },
            stock_minimo_mod: {
                required: "*Porfavor, Ingrese stock minimo",
                number: "*El dato debe ser numéricos",
                range: "Por favor introduzca un valor entre 6 y 12."
            },
            categoria_mod: {
                required: "*Porfavor, Ingrese categoria",
            },
            marca_mod: {
                required: "*Porfavor, Ingrese marca",
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

    $(document).on('click','.editar_imagen',(e)=>{
        let elemento = $(this)[0].activeElement;
        let id = $(elemento).attr('id');
        let nombre = $(elemento).attr('nombre');
        let avatar = $(elemento).attr('avatar');
        $('#avatar_id').val(id);
        $("#nombre_avatar").text(nombre);
        $("#avatar").attr('src','../util/img/productos/'+avatar);
        $("#avatar1").val(avatar);
    });
    
    async function editar_imagen(datos){
        let data = await fetch('../controllers/ProductoController.php',{
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
                traer_productos();
                $('#editar_imagen').modal('hide');
                $('#form_avatar').trigger('reset');
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
        let datos = new FormData($('#form_avatar')[0]);
        let funcion = "editar_imagen";
        datos.append('funcion',funcion);
        editar_imagen(datos);
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


    async function eliminar(id){
        let funcion = 'eliminar';
        let respuesta = '';
        let data = await fetch('../controllers/ProductoController.php',{
        method: "POST",
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'funcion='+funcion+'&&id='+id
    
        })
        if(data.ok){
            let response = await data.text();
            try {
                respuesta = JSON.parse(response);
                console.log(respuesta);
                
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
    $(document).on('click','.eliminar',(e)=>{
        let elemento = $(this)[0].activeElement;
        let id = $(elemento).attr('id');
        let nombre = $(elemento).attr('nombre');
        let avatar = $(elemento).attr('avatar');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success ml-2",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: 'Deseas eliminar producto '+nombre+'?',
            imageUrl: '../util/img/productos/'+avatar,
            imageWidth: 200,
            imageHeight: 200,
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
                            text: "El producto fue eliminado "+nombre+".",
                            icon: "success"
                        });
                        traer_productos();
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
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado!",
                    text: "Cancelo la eliminación de producto",
                    icon: "error"
                });
            }
        });
    })

    async function activar(id){
        let funcion = 'activar';
        let respuesta = '';
        let data = await fetch('../controllers/ProductoController.php',{
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
    $(document).on('click','.activar',(e)=>{
        let elemento = $(this)[0].activeElement;
        let id = $(elemento).attr('id');
        let nombre = $(elemento).attr('nombre');
        let avatar = $(elemento).attr('avatar');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success ml-2",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: 'Desea volver activar a '+nombre+'?',
            imageUrl: '../util/img/productos/'+avatar,
            imageWidth: 200,
            imageHeight: 200,
            showCancelButton: true,
            confirmButtonText: "Si, Activar!",
            cancelButtonText: "No, cancelar!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                activar(id).then(respuesta=>{
                    if(respuesta.mensaje == 'success'){
                        swalWithBootstrapButtons.fire({
                            title: "Activado!",
                            text: "El producto fue activado "+nombre+".",
                            icon: "success"
                        });
                        traer_productos();
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
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelado!",
                    text: "Cancelo la activación de producto.",
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