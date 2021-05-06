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
                        <div class="col-lg-5 d-none d-lg-block bg-recurs-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Crear recurs</h1>
                                </div>

                                <script>
                                    function canviSelect() {
                                        var sel = document.getElementById("recurs");
                                        //alert('el tipus es: ' + sel.value);
                                        if (sel.value == 1) {
                                            //alert('1')
                                            document.getElementById('titol').hidden = false;
                                            document.getElementById('descripcio').hidden = false;
                                            document.getElementById('explicacio').hidden = false;
                                            document.getElementById('tags').hidden = false;
                                            document.getElementById('arxiu').hidden = false;
                                        } else if (sel.value == 2) {
                                            //alert('2');
                                            document.getElementById('titol').hidden = false;
                                            document.getElementById('descripcio').hidden = false;
                                            document.getElementById('explicacio').hidden = false;
                                            document.getElementById('tags').hidden = false;
                                            document.getElementById('arxiu').hidden = false;
                                        } else if (sel.value == 3) {
                                            //alert('3');
                                            document.getElementById('titol').hidden = false;
                                            document.getElementById('descripcio').hidden = false;
                                            document.getElementById('explicacio').hidden = false;
                                            document.getElementById('tags').hidden = false;
                                            document.getElementById('arxiu').hidden = false;
                                        } else if (sel.value == 4) {
                                            //alert('4');
                                            document.getElementById('titol').hidden = false;
                                            document.getElementById('descripcio').hidden = false;
                                            document.getElementById('explicacio').hidden = false;
                                            document.getElementById('tags').hidden = false;
                                            document.getElementById('arxiu').hidden = false;
                                        }
                                    }
                                </script>
                                <form class="user" action="<?php echo base_url('recursos/formrecurs') ?>" method="POST">
                                    <div class="form-floating">
                                        <label for="recurs">Tipus de videorecurs: </label>
                                        <select class="form-select" id="recurs" aria-label="Floating label select example" onchange="canviSelect()">
                                            <option selected>Desplega per veure les opcions</option>
                                            <option value="1">Infografia</option>
                                            <option value="2">Video</option>
                                            <option value="3">Link video</option>
                                            <option value="4">Pissara digital</option>
                                        </select>
                                    </div>
                                    <input hidden type='file' id="arxiu">
                                    <br><br>
                                    <div class="form-group">
                                        <input hidden type="text" class="form-control form-control-user" name="titol" id="titol" placeholder="Titol...">
                                    </div>
                                    <div class="form-group">
                                        <input hidden type="textarea" class="form-control form-control-user" name="descripcio" id="descripcio" placeholder="Descripcio...">
                                    </div>
                                    <div class="form-group">
                                        <input hidden type="textarea" class="form-control form-control-user" name="explicacio" id="explicacio" placeholder="Explicacio...">
                                    </div>
                                    <div class="form-group">
                                        <input hidden type="email" class="form-control form-control-user" name="tags" id="tags" placeholder="AdministraciÓ TAGS...">
                                    </div>
                                    <!--<div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="pass" id="exampleInputPass" placeholder="Password...">
                                    </div>-->
                                    <!--<div class="form-group">
                                        <div class="custom-control form-check small">
                                            <input type="checkbox" class="form-check-input" name="casella" id="casella">
                                            <label class="form-check-label" for="customCheck">Aceptes els termens de privacitat </label>
                                            <a href="<?php //echo base_url('assets/docs/PoliticaDePrivacidadAccess&Resource.pdf') 
                                                        ?>" >ACCESS&RESOURCE</a>
                                        </div>
                                    </div>-->
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Afegir Recurs">
                                </form>
                                <hr>
                                <?php if (validation_errors() != null) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo validation_errors(); ?>
                                    </div>
                                <?php } ?>
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
<footer class="sticky-footer bg-white">
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