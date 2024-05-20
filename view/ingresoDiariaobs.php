<?php
session_start();
include_once 'layout/header.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">INGRESO DIARIA</h1>

        <div class="card shadow card-header-actions mb-4">
          <div class="card-header">
              LISTAR REPORTE DE INGRESO DIARIA
          </div>
          <div  class="card-body px-0 m-4">
          <form class="row needs-validation" novalidate>
            <div class="form-group col-lg-4 col-md-4">
                <label for="fecha_diaria" class="form-label">Fecha del día:</label>
                <input type="date" class="form-control" id="fecha_diaria" name="fecha_diaria" value="" required>
                <div class="valid-feedback">
                Looks good!
                </div>
            </div>
            <div class="form-group col-lg-12 mt-4">
            <button id="reporte_diaria" class="btn btn-outline-danger" type="button">DIARIA<i class="fas fa-file-pdf ml-2"></i></button>
            </div>
            </form>
          </div>
        </div>
    </div>
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<?php include_once 'layout/footer.php';?>
<script src="../util/js/ingresoDiaria.js"></script>
