<?php
include "navbar-private.php"; ?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Login</h1>
                    </div>-->

    <!-- Content Row -->
    <div class="row">
        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-actulogin-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Actualitzar contrasenya</h1>
                                </div>
                                <form class="user" action="<?php echo base_url('login/changepass_update') ?>" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                                    <div class="form-group">
                                        <input type="pass" class="form-control form-control-user" name="actupass" id="exampleInputActuPass" placeholder="Contrasenya ">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" name="newpass" id="exampleInputNewPass" placeholder="Contrasenya nova">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user" name="newpass2" id="exampleInputNewPass2" placeholder="Confirmar contrasenya">
                                        </div>
                                    </div>
                                    <hr>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Actulitzar">
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white ">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Access&Resource 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script type="text/javascript" src='<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>'></script>
<script type="text/javascript" src='<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>'></script>
<script type="text/javascript" src='<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>'></script>
<script type="text/javascript" src='<?php echo base_url('assets/js/sb-admin-2.min.js'); ?>'></script>
<script type="text/javascript" src='<?php echo base_url('assets/vendor/chart.js/Chart.min.js'); ?>'></script>
<script type="text/javascript" src='<?php echo base_url('assets/js/demo/chart-area-demo.js'); ?>'></script>
<script type="text/javascript" src='<?php echo base_url('assets/js/demo/chart-pie-demo.js'); ?>'></script>