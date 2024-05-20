<?php
session_start();
include_once 'layout/header.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Generar Copia de seguridad</h1>
        <div class="row">
            <div class="col-xl-6 mb-5">
            <div class="card card-raised h-100">
                <div class="card-body p-4">
                        <div class="d-flex justify-content-between">
                            <div class="me-4">
                                <h2 class="card-title mb-0">Copia de seguridad</h2>
                                <p class="card-text">Generar siempre la copia de seguridad.</p>
                            </div>
                            <img class="d-none d-sm-inline-block rounded-image" src="../util/img/backup.png" alt="imagen backup" width="240" height="175">
                        </div>
                </div>
                <div class="card-footer bg-transparent position-relative ripple-gray px-4 mdc-ripple-upgraded">
                <button id="boton_backup" class="d-sm-inline-block btn btn-sm btn-outline-dark shadow-sm ml-2" type="button" ><i class="fas fa-download fa-sm text-white-50"></i> Descargar Backup</button>
                </div>
            </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<?php include_once 'layout/footer.php';?>

<script src="../util/js/backup.js"></script>