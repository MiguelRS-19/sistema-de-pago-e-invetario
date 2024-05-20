<?php
session_start();
include_once 'layout/header.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">INGRESO ANUAL</h1>

        <div class="card shadow card-header-actions mb-4">
          <div class="card-header">
              LISTAR REPORTE DE INGRESO ANUAL
          </div>
          <div  class="card-body px-0 m-4">
          <form class="row needs-validation" novalidate>
             <div class="form-group col-lg-4 col-md-4">
                <label for="validationCustom01" class="form-label">del Año:</label>
                <select class="form-control" name="fecha_y" id="fecha_y">
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
                  <option value="2029">2029</option>
                  <option value="2030">2030</option>
                  <option value="2031">2031</option>
                  <option value="2032">2032</option>
                </select>
                <div class="valid-feedback">
                Looks good!
                </div>
            </div>
            <div class="form-group col-lg-12 mt-4">
            <button id="reporte_anual" class="btn btn-outline-danger">ANUAL<i class="fas fa-file-pdf ml-2"></i></b>
            </div>
            </form>
          </div>
        </div>
    </div>
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<?php include_once 'layout/footer.php';?>

<script src="../util/js/ingresoAnual.js"></script>
