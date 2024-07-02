$(document).ready(function(){
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
    <!-- Nav Item - Panel -->
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
        if(respuesta.length != 0 && respuesta.idtipo !=2 && respuesta.idtipo !=3 ){
          llenar_menu_superior(respuesta);
          llenar_menu_lateral(respuesta);
          mostrar_consultas();
          medios_mas_utilizada();
          Cliente_mes_anual();
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

  async function mostrar_consultas(){
    let funcion = "mostrar_consultas";
    let data = await fetch('../controllers/CuentaController.php',{
      method: "POST",
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'funcion='+funcion

    })
    if(data.ok){
      let response = await data.text();
      try {
        let json = JSON.parse(response);
        $("#ingreso_diaria").html(json.ingreso_diaria);
        $("#ingreso_mensual").html(json.ingreso_mensual);
        $("#ingreso_anual").html(json.ingreso_anual);
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

  async function medios_mas_utilizada(){
    let funcion = 'medios_mas_utilizada';
    let array = ['','','','','','','','','','','',''];
    const response = await fetch('../controllers/CuentaController.php',{
      method:"POST",
      headers:{'Content-type':'application/x-www-form-urlencoded'},
      body: 'funcion='+funcion,
    }).then(function(response){
      return response.json();
    }).then(function(meses){
      meses.forEach(mes => {
        if(mes.mes == 1){
          array[0]=mes;
        }
        if(mes.mes == 2){
          array[1]=mes;
        }
        if(mes.mes == 3){
          array[2]=mes;
        }
        if(mes.mes == 4){
          array[3]=mes;
        }
        if(mes.mes == 5){
          array[4]=mes;
        }
        if(mes.mes == 6){
          array[5]=mes;
        }
        if(mes.mes == 7){
          array[6]=mes;
        }
        if(mes.mes == 8){
          array[7]=mes;
        }
        if(mes.mes == 9){
          array[8]=mes;
        }
        if(mes.mes == 10){
          array[9]=mes;
        }
        if(mes.mes == 11){
          array[10]=mes;
        }
        if(mes.mes == 12){
          array[11]=mes;
        }
      });
    })

    let canvasG1 = $('#Grafico1').get(0).getContext('2d');
    let datos = {
      labels:[
        array[0].pago,
        array[1].pago,
        array[2].pago,
        array[3].pago,
        array[4].pago,
      ],
      datasets:[{
        data:[
          array[0].cantidad,
          array[1].cantidad,
          array[2].cantidad,
          array[3].cantidad,
          array[4].cantidad,
          array[5].cantidad,
          array[6].cantidad,
          array[7].cantidad,
          array[8].cantidad,
          array[9].cantidad,
          array[10].cantidad,
          array[11].cantidad
        ],
        backgroundColor:[
          '#FF0000',
          '#0CFF00',
          '#001BFF',
          '#FF00F0',
          '#F7FF00',
          '#00FFE8',
          '#A200FF',
          '#FF8F00',
          '#9BFF00',
          '#000000',
          '#009EFF',
          '#10B504',
        ],
        hoverOffset: 4
      }
      ]
    }

    let opciones = {
      maintainAspectRatio:false,
      responsive:true,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      cutoutPercentage: 80,
    }

    let G1 = new Chart(canvasG1,{
      type: 'doughnut',
      data: datos,
      options: opciones
    })
  }

  async function Cliente_mes_anual(){
    let funcion = 'Cliente_mes_anual';
    let lista = ['','','','','','','','','','','',''];
    const response = await fetch('../controllers/CuentaController.php',{
      method:"POST",
      headers:{'Content-type':'application/x-www-form-urlencoded'},
      body: 'funcion='+funcion,
    }).then(function(response){
      return response.json();
    }).then(function(meses){
      meses.forEach(mes => {
        if(mes.mes == 1){
          lista[0]=mes;
        }
        if(mes.mes == 2){
          lista[1]=mes;
        }
        if(mes.mes == 3){
          lista[2]=mes;
        }
        if(mes.mes == 4){
          lista[3]=mes;
        }
        if(mes.mes == 5){
          lista[4]=mes;
        }
        if(mes.mes == 6){
          lista[5]=mes;
        }
        if(mes.mes == 7){
          lista[6]=mes;
        }
        if(mes.mes == 8){
          lista[7]=mes;
        }
        if(mes.mes == 9){
          lista[8]=mes;
        }
        if(mes.mes == 10){
          lista[9]=mes;
        }
        if(mes.mes == 11){
          lista[10]=mes;
        }
        if(mes.mes == 12){
          lista[11]=mes;
        }
      });
    })
    funcion = 'Cliente_mes';
    let lista1 = ['','','','','','','','','','','',''];
    const response1 = await fetch('../controllers/CuentaController.php',{
      method:"POST",
      headers:{'Content-type':'application/x-www-form-urlencoded'},
      body: 'funcion='+funcion,
    }).then(function(response1){
      return response1.json();
    }).then(function(meses){
      meses.forEach(mes => {
        if(mes.mes == 1){
          lista1[0]=mes;
        }
        if(mes.mes == 2){
          lista1[1]=mes;
        }
        if(mes.mes == 3){
          lista1[2]=mes;
        }
        if(mes.mes == 4){
          lista1[3]=mes;
        }
        if(mes.mes == 5){
          lista1[4]=mes;
        }
        if(mes.mes == 6){
          lista1[5]=mes;
        }
        if(mes.mes == 7){
          lista1[6]=mes;
        }
        if(mes.mes == 8){
          lista1[7]=mes;
        }
        if(mes.mes == 9){
          lista1[8]=mes;
        }
        if(mes.mes == 10){
          lista1[9]=mes;
        }
        if(mes.mes == 11){
          lista1[10]=mes;
        }
        if(mes.mes == 12){
          lista1[11]=mes;
        }
      });
    })
    
    let canvasG2 = $('#Grafico2').get(0).getContext('2d');
    let datos = {
      labels:[
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Setiembre',
        'Octubre',
        'Noviembre',
        'Diciembre',
      ],
      datasets:[
        {
          label: 'Año actual',
          backgroundColor: 'rgba(60,141,188,0.9)',
          borderColor: 'rgba(60,141,188,0.8)',
          pointRadius: false,
          pointColor:'#3b8bba',
          pointStrokeColor: 'rgba(60,141,188,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: [lista1[0].cantidad,lista1[1].cantidad,lista1[2].cantidad,lista1[3].cantidad,
          lista1[4].cantidad,lista1[5].cantidad,lista1[6].cantidad,lista1[7].cantidad,lista1[8].cantidad,
          lista1[9].cantidad,lista1[10].cantidad,lista1[11].cantidad]
        },
        {
          label: 'Año anterior',
          backgroundColor: 'rgba(210,214,222,1)',
          borderColor: 'rgba(210,214,222,1)',
          pointRadius: false,
          pointColor:'#3b8bba',
          pointStrokeColor: 'rgba(210,214,222,1)',
          pointHighlightFill: '#c1c7d1',
          pointHighlightStroke: 'rgba(210,214,222,1)',
          data: [lista[0].cantidad,lista[1].cantidad,lista[2].cantidad,lista[3].cantidad,
          lista[4].cantidad,lista[5].cantidad,lista[6].cantidad,lista[7].cantidad,lista[8].cantidad,
          lista[9].cantidad,lista[10].cantidad,lista[11].cantidad]
        }
      ]
    }

    let opciones = {
      maintainAspectRatio:false,
      responsive:true,
      datasetsFill:false,
    }

    let G2 = new Chart(canvasG2,{
      type: 'bar',
      data: datos,
      options: opciones
    })

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