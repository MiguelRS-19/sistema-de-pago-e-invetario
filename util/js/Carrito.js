$(document).ready(function(){
  Loader();
  //setTimeout(verificar_sesion,2000);
  //$('#productos').DataTable({})
  verificar_sesion();
  toastr.options={
      "preventDuplicates":true,
  }
  function llenar_menu_superior(usuario) {
      let template = `
          <ul class="navbar-nav ml-auto">

              <li id="cart-carrito" class="nav-item dropdown no-arrow mx-1 animate__animated animate__heartBeat" role="button">
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
          $('#cat-carrito').hide();
          $('#notificar').hide();
          Contar_productos();
          RecuperarLS_carrito_venta();
          //procesar_venta();
          obtener_productos();
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

  //este evento es para agregar el producto al carrito
  $(document).on('click','.agregar-carrito',(e)=>{
      let elementos = $(this)[0].activeElement;
      let id = $(elementos).attr('id');
      let codigo = $(elementos).attr('codigo');
      let nombre = $(elementos).attr('nombre');
      let descripcion = $(elementos).attr('descripcion');
      let presentacion = $(elementos).attr('presentacion');
      let precio_venta = $(elementos).attr('precioventa');
      let stock = $(elementos).attr('stock');
      let marca = $(elementos).attr('marca');
      if(stock != 5){
          const producto={
              id: id,
              codigo:codigo,
              nombre:nombre,
              descripcion:descripcion,
              presentacion:presentacion,
              precioVenta:precio_venta,
              stock: stock,
              marca:marca,
              cantidad: 1
          }
          let bandera = false;
          let productos = RecuperarLS();
          productos.forEach(prod => {
              if (prod.id === producto.id){
                  bandera = true;
              }
          });
          if(bandera){
              toastr.error('El producto ya existe','Error!')
          }else{
              AgregarLS(producto);
              Contar_productos();
              toastr.success('Producto '+presentacion+' #'+codigo+' agregado','Exito!')
          }
      }else{
          toastr.warning('El producto no tiene stock', 'No fue agregado!')
      }

  })

  function abrir_carrito(){
      //let productos,id_producto;
      productos = RecuperarLS();
      if(productos.length !=0){
          funcion = "carrito_id";
          $('#lista').empty();
          productos.forEach(producto => {
              id_producto = producto.id;
              $.post('../controllers/ProductoController.php',{funcion,id_producto},(response)=>{
                  // Llamar a la función para agregar
                  agregarElementoTabla(response);
              });
          })
          $('#abrir_carrito').modal('show');
      }else{
          toastr.warning('El carrito esta vacio','No se pudo abrir!')
          $('#abrir_carrito').modal('hide');
      }
  }

  // Función para agregar un elemento a la tabla del carrito
  function agregarElementoTabla(response) {
      let json = JSON.parse(response);
      let template_carrito=`
          <tr prodId="${json.id}">
              <td>${json.producto}</td>
              <td>${json.descripcion}</td>
              <td>${json.presentacion}</td>
              <td>${json.marca}</td>
              <td>${json.precio_venta}</td>
              <td><button type="button" class="borrar_producto btn btn-outline-danger btn-circle ml-2" title="Eliminar carrito"><i class="fas fa-trash-alt"></i></button></td>
          </tr>
      `;
      $('#lista').append(template_carrito);
  }
  //este evento para abrir el modal
  $(document).on('click','#cart-carrito',(e)=>{
      abrir_carrito();
  })

  $(document).on('click','.vaciar_carrito',(e)=>{
      EliminarLS();
      toastr.success('El carrito fue vaciado','Exito!')
      Contar_productos();
      $('#abrir_carrito').modal('hide');
  })
  
  $(document).on('click','.borrar_producto',(e)=>{
      let elemento = $(this)[0].activeElement.parentElement.parentElement;
      let id = $(elemento).attr('prodId');
      let presentacion = $(elemento).attr('presentacion');
      toastr.success('El producto fue eliminado','Exito!')
      Eliminar_producto_LS(id);
      Contar_productos();
      abrir_carrito();
  })

  $(document).on('click','#procesar-pedido',(e)=>{
      procesar_pedido();
      e.preventDefault();
  });

  /*$(document).on('click','#procesar-venta',(e)=>{
      procesar_venta();
      e.preventDefault();
  });*/

  function RecuperarLS(){
      let productos;
      if(localStorage.getItem('productos') === null){
      productos = [];

      }else{
      productos = JSON.parse(localStorage.getItem('productos'));
      }
      return productos;
  }

  function AgregarLS(producto){
      let productos;
      productos = RecuperarLS();
      productos.push(producto);
      localStorage.setItem('productos',JSON.stringify(productos));
  }

  //Funcion de contador producto
  function Contar_productos() {
      let productos;
      let contador = 0;
      productos = RecuperarLS();
      productos.forEach(producto => {
      contador++;
      });
      $('#contador').html(contador);
  }


  //Funcion de procesar pedido
  function procesar_pedido() {
      let productos;
      productos = RecuperarLS();
      if(productos.length === 0){
          Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "El carrito esta vacio!",
          });
      }else{
          location.href = 'ventas';
      }
  }

  async function RecuperarLS_carrito_venta(){
      let productos,id_producto;
      productos = RecuperarLS();
      funcion = "carrito_id";
      //$('#lista').empty();
      productos.forEach(producto => {
          id_producto = producto.id;
          $.post('../controllers/ProductoController.php',{funcion,id_producto},(response)=>{
              let json = JSON.parse(response);
              let template_venta=`
                  <tr prodId="${producto.id}">
                      <td>${json.producto}</td>
                      <td>${json.stock}</td>
                      <td>${json.precio_venta}</td>
                      <td>${json.descripcion}</td>
                      <td>${json.presentacion}</td>
                      <td><input type='number' min='1' class='form-control cantidad_producto' value='${producto.cantidad}'></td>
                      <td class='subtotales'><h5>${json.precio_venta*producto.cantidad}</h5></td>
                      <td><button type="button" class="borrar_producto btn btn-outline-danger btn-circle ml-2" title="Eliminar carrito"><i class="fas fa-trash-alt"></i></button></td>
                  </tr>
              `;
              $('#lista-venta').append(template_venta);
          });
      })
      
  }
  
  //actualizar productos por precio
  $(document).on('click','#actualizar',(e)=>{
      let productos,precios;
      precios = document.querySelectorAll('.precio');
      productos = RecuperarLS();
      productos.forEach(function(producto,indice) {
          producto.precio = precios[indice].textContent;
      });
      localStorage.setItem('productos',JSON.stringify(productos));
      calcularTotal();
      e.preventDefault();
  });

  $('#cp').keyup((e)=>{
      let id,cantidad,producto,productos,montos;
      producto = $(this)[0].activeElement.parentElement.parentElement;
      id = $(producto).attr('prodId');
      //precio = $(producto).attr('precioVenta');
      cantidad = producto.querySelector('input').value;
      montos = document.querySelectorAll('.subtotales');
      productos = RecuperarLS();
      productos.forEach(function(prod,indice){
          if(prod.id === id){
              prod.cantidad = cantidad;
              montos[indice].innerHTML = `<h5>${cantidad*productos[indice].precioVenta}</h5>`;
          }
      });
      localStorage.setItem('productos',JSON.stringify(productos));
      calcularTotal();
  });

  function calcularTotal(){
      let productos,subtotal,con_igv,total_sin_descuento,pago,vuelto,descuento;
      let total = 0, igv=0.18;
      productos = RecuperarLS();
      productos.forEach(producto => {
          let subtotal_producto = Number(producto.precio * producto.cantidad);
          total = total + subtotal_producto;
      });
      pago = $('#pago').val();
      descuento = $('#descuento').val();
  
      total_sin_descuento = total.toFixed(2);
      con_igv = parseFloat(total*igv).toFixed(2);
      subtotal = parseFloat(total-igv).toFixed(2);
  
      total = total - descuento;
      vuelto = pago - total;
  
      $('#subtotal').html(subtotal);
      $('#con_igv').html(con_igv);
      $('#total_sin_descuento').html(total_sin_descuento);
  
      $('#total').html(total.toFixed(2));
      $('#vuelto').html(vuelto.toFixed(2));
  }
  
  /*//Funcion de procesar venta
  function procesar_venta() {
      let nombre,dni;
      nombre = $('#cliente').val();
      dni = $('#dni').val();
      if(RecuperarLS().length == 0){
          Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "No hay productos, Seleccione algunos!",
          }).then(function(){
          location.href = '../view/adm_catalogo.php';
          });
      }else if(nombre == ''){
          Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Necesitamos un nombre de cliente!",
          });
      }else{
          verificar_stock().then(error=>{
          if(error == 0){
              Registrar_venta(nombre,dni);
              Swal.fire({
              position: "center",
              icon: "success",
              title: "Se realizo la compra",
              showConfirmButton: false,
              timer: 1500
              }).then(function(){
              EliminarLS();
              location.href = '../view/adm_catalogo.php';
              });
          }else{
              Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Hay conflicto en el stock de algun producto!",
              });
          }
          })
      }
  }
  
  async function verificar_stock(){
      let productos;
      funcion = 'verificar_stock';
      productos = RecuperarLS();
      const response = await fetch('../controllers/ProductoController.php',{
          method: 'POST',
          headers:{'Content-type':'application/x-www-form-urlencoded'},
          body: 'funcion='+funcion+'&&productos='+JSON.stringify(productos),
      });
      let error = await response.text();
      return error;
  }
  
  function Registrar_venta(nombre,dni){
      funcion = 'registrar_venta';
      let total = $('#total').get(0).textContent;
      let productos = RecuperarLS();
      let json = JSON.stringify(productos);
      $.post('../controllers/VentaController.php',{funcion,total,nombre,dni,json},(response)=>{
          console.log(response);
      })
  }*/

  //Funcion para eliminar
  function EliminarLS(){
      localStorage.clear();
  }

  //Eliminar producto de local storage 
  function Eliminar_producto_LS(id){
      let productos;
      productos = RecuperarLS();
      productos.forEach(function(producto,indice) {
      if(producto.id === id){
          productos.splice(indice,1);
      }
      });
      localStorage.setItem('productos',JSON.stringify(productos));
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

