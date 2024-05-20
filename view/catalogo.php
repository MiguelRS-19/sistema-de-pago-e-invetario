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
<div class="modal fade" id="abrir_carrito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Carrito de compra</h5>
      </div>
      <div class="modal-body p-0 table_scroll">
        <table id="carrito_compras" class="table table-hover table-borderless table-secondary p-0">
            <thead class="bg-success">
              <tr>
                  <th class="text-white">Productos</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir de carrito" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
        <button type="button" class=" vaciar_carrito btn btn-outline-danger btn-circle ml-2" title="Eliminar carrito"><i class="fas fa-trash-alt"></i></button>
        <button type="button" class="btn btn-outline-success btn-circle ml-2" title="agregar compra"><i class="fas fa-check"></i></button>
      </div>
    </div>
  </div>
</div>

<title>DIGITALTEI S.A.C - Catalogo</title>
<!-- Modal -->
<div class="modal fade" id="modal_pago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title text-white">Agregar Metodo de pago
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </h3>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id="add" style="display:none">
            <span><i class="fas fa-check m-1"></i>se agrego correctamente</span>
          </div>
          <div class="alert alert-danger text-center" id="noadd" style="display:none">
            <span><i class="fas fa-times m-1"></i>El pago ya exite en otro usuario</span>
          </div>
          <form id="form_Metodo_pago">
            <div class="form-group">
              <label class="small mb-1" for="nombre">Metodo de pago</label>
              <input id="nombre" type="text" class="form-control" placeholder="Ingrese Metodo de pago" required>
            </div>
            <div class="form-group">
              <label class="small mb-1" for="vencimiento">Fecha vencimiento</label>
              <input id="vencimiento" type="date" class="form-control" placeholder="Ingrese Fecha vencimiento" required>
            </div>
          
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary float-right m-1">Guardar</button>
          <button type="button" class="btn btn-outline-secondary float-right m-1" data-dismiss="modal">Cerrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_edit_pago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Metodo de pago</h5>
                <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="alert alert-success text-center" id="edit" style="display:none">
              <span><i class="fas fa-check m-1"></i>se edito correctamente</span>
              </div>
              <div class="alert alert-danger text-center" id="noedit" style="display:none">
                <span><i class="fas fa-times m-1"></i>No se edito correctamente</span>
              </div>
              <form id="form_pago">
                <div class="form-group">
                <label class="small mb-1" for="nombre_mod">Metodo de pago</label>
                <input id="nombre_mod" type="text" class="form-control" placeholder="Ingrese Metodo de pago" required>
                </div>
                <div class="form-group">
                  <label class="small mb-1" for="vencimiento_mod">Fecha vencimiento</label>
                  <input id="vencimiento_mod" type="date" class="form-control" placeholder="Ingrese Fecha vencimiento" required>
                </div>
                <input id="idpago_mod" type="hidden" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary float-right m-1">Guardar</button>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Catalogo</h1>
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
              Busque los subministro para agregar al carrito
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