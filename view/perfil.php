<?php
session_start();
include_once 'layout/header.php';
?>


<!-- Modal cambiar contraseña-->
<div class="modal fade animate__animated animate__bounceInUp" id="cambiar_contra" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Cambiar contraseña</h5>
            </div>
            <div class="modal-body p-0">
                <div class="card">
                    <div class="bg-dark">
                        <h3 id="nombre_pass" class="text-center text-white"></h3>
                        <h5 id="apellido_pass" class="text-center text-white"></h5>
                    </div>
                    <div class="m-2 image text-center">
                        <img id="avatar_pass" class="img-account-profile rounded-circle mb-2" src="../util/img/user_default.png" width="100px" height="100px" alt="usuario avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="form_pass" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                            </div>
                                            <input id="oldpass" name="oldpass" type="password" class="form-control"
                                                placeholder="Ingrese contraseña actual">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <input id="newpass" name="newpass" type="text" class="form-control" placeholder="Ingrese contraseña nueva">
                                        </div>
                                    </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
                    <button type="submit" class="btn btn-outline-success btn-circle ml-2" title="Cambiar password"><i class="fas fa-check"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar perfil -->
<div class="modal fade animate__animated animate__bounceInDown" id="editar_perfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Editar perfil</h5>
            </div>
            <div class="modal-body">
                <form id="form_perfil" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="small mb-1" for="direccion">Dirección</label>
                        <input class="form-control" id="direccion" name="direccion" type="text"
                            placeholder="Dirección" >
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="small mb-1" for="telefono">Telefono</label>
                                <input class="form-control" id="telefono" name="telefono" type="text"
                                    placeholder="Telefono" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="font-size:12px ;">
                                <label class="small mb-1" for="correo">Correo</label>
                                <input class="form-control" id="correo" name="correo" type="text" placeholder="Correo" >
                            </div>
                        </div>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
                    <button type="submit" class="btn btn-outline-success btn-circle ml-2" title="Editar dato"><i class="fas fa-check"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal avatar-->
<div class="modal fade animate__animated animate__bounceInLeft" id="cambiar_avatar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Foto</h5>
            </div>
            <div class="modal-body p-0">
                <div class="card">
                    <div class="bg-dark">
                        <!--Se quedo aqui agregando id-->
                        <h3 id="nombre_avatar" class="text-center text-white">Alexander Pierce</h3>
                        <h5 id="apellido_avatar" class="text-center text-white">Founder &amp; CEO</h5>
                    </div>
                    <div class="m-2 image text-center">
                        <img id="avatar" class="img-account-profile rounded-circle mb-2" src="../util/img/user_default.png" width="100px" height="100px" alt="usuario avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="form_avatar" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputFile">Avatar: </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar_mod" name="avatar_mod">
                                            <label class="custom-file-label" for="avatar_mod">selecione una imagen</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-circle ml-2" title="Salir" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
                    <button type="submit" class="btn btn-outline-success btn-circle ml-2" title="Editar foto"><i class="fas fa-check"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<title>DIGITALTEI S.A.C - Perfil</title>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 animate__animated animate__bounce">Perfil</h1>

    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4 mb-xl-0 shadow-lg">
                <div class="card-header">Perfil de usuario</div>
                <div id="card_1" class="card-body text-center">
                    
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-4">
            <div id="card_2">

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<?php include_once 'layout/footer.php'; ?>
<script src="../util/js/perfil.js"></script>
<script src="../util/js/notificacion.js"></script>