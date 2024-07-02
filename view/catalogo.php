<?php
session_start();
  include_once 'layout/header.php';
?>
<style>
  .table_scroll{
    overflow: scroll;
    height: 400px;
    overflow-x: hidden;
  }
  #carrito_compras td{
    padding: 0px !important;
    margin: 0px !important;
  }
</style>
<!-- Modal -->
<div class="modal fade animate__animated animate__bounceInDown" id="abrir_carrito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Carrito de compra</h5>
      </div>
      <div class="modal-body p-0 table_scroll">
        <table class="carro table table-hover table-borderless table-secondary p-0">
            <thead class="bg-dark text-white">
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Presentación</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody id="lista">

            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir de carrito" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
        <button type="button" class=" vaciar_carrito btn btn-outline-danger btn-circle ml-2" title="Eliminar carrito"><i class="fas fa-trash-alt"></i></button>
        <button type="button" id="procesar-pedido" class="btn btn-outline-success btn-circle ml-2" title="agregar venta"><i class="fas fa-check"></i></button>
      </div>
    </div>
  </div>
</div>

<title>DIGITALTEI S.A.C - Catalogo</title>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800 animate__animated animate__bounce">Catalogo</h1>
        <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Productos</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="productos" class="table table-hover">
                  <thead class="table-dark">
                      <tr><th width="100%">Productos</th></tr>
                  </thead>
                  <tbody>
  
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              Busque los productos para agregar al carrito
            </div>
        </div>



    </div>
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->
<?php
include_once 'layout/footer.php';
?>

<script src="../util/js/catalogo.js"></script>