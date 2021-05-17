<!-- End of Topbar -->
<script src="https://cdn.tiny.cloud/1/e2tgnbfthwd0opuvogjvl20bqeeaw4m2a3nf2pefrq6kefh6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
                                        tinymce.init({
                                            selector: '#explicacio',
                                            plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
                                            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
                                            toolbar_mode: 'floating',
                                            tinycomments_mode: 'embedded',
                                            tinycomments_author: 'Author name',
                                        });
                                        var sel = document.getElementById("recurs");
                                        //alert('el tipus es: ' + sel.value);
                                        if (sel.value == 'infografia') {
                                            //alert('1')
                                            document.getElementById('titol').hidden = false;
                                            document.getElementById('descripcio').hidden = false;
                                            document.getElementById('explicacio').hidden = false;
                                            document.getElementById('arxiu').hidden = false;
                                            document.getElementById('boto').hidden = false;
                                            document.getElementById('tags').hidden = false;
                                        } else if (sel.value == 'video') {
                                            //alert('2');
                                            document.getElementById('titol').hidden = false;
                                            document.getElementById('descripcio').hidden = false;
                                            document.getElementById('explicacio').hidden = false;
                                            document.getElementById('arxiu').hidden = false;
                                            document.getElementById('boto').hidden = false;
                                            document.getElementById('tags').hidden = false;
                                        } else if (sel.value == 'linkvideo') {
                                            //alert('3');
                                            document.getElementById('titol').hidden = false;
                                            document.getElementById('descripcio').hidden = false;
                                            document.getElementById('explicacio').hidden = false;
                                            document.getElementById('link').hidden = false;
                                            document.getElementById('boto').hidden = false;
                                            document.getElementById('tags').hidden = false;
                                        } else if (sel.value == 'pissarra') {
                                            //alert('4');
                                            document.getElementById('titol').hidden = false;
                                            document.getElementById('descripcio').hidden = false;
                                            document.getElementById('explicacio').hidden = false;
                                            document.getElementById('pissarra').hidden = false;
                                            document.getElementById('boto').hidden = false;
                                            document.getElementById('tags').hidden = false;
                                        }
                                    }
                                </script>

                                <form class="user" action="<?php echo base_url('recurs/formrecurs') ?>" enctype="multipart/form-data" method="POST">
                                    <div class="form-floating">
                                        <label for="recurs">Tipus de videorecurs: </label>
                                        <select class="form-select" name="recurs" id="recurs" aria-label="Floating label select example" onchange="canviSelect()">
                                            <option selected>Desplega per veure les opcions</option>
                                            <option value="infografia">Infografia</option>
                                            <option value="video">Video</option>
                                            <option value="linkvideo">Link video</option>
                                            <option value="pissarra">Pissarra digital</option>
                                        </select>
                                    </div>

                                    <input hidden type="file" name="arxiu" id="arxiu" size="20" />
                                    <br>
                                    <div class="form-group">
                                        <input hidden type="text" class="form-control" name="link" id="link" placeholder="Link...">
                                    </div>
                                    <div class="form-group">
                                        <input hidden type="text" class="form-control" name="titol" id="titol" placeholder="Titol...">
                                    </div>
                                    <div class="form-group">
                                        <textarea hidden type="textarea" class="form-control" name="descripcio" id="descripcio" placeholder="Descripcio..."></textarea>
                                    </div>
                                    <textarea hidden="true" type="textarea" id="explicacio" name="explicacio" placeholder="Explicacio..."></textarea>
                                    <br>
                                    <input hidden id="boto" name="boto" type="submit" class="btn btn-primary btn-user btn-block" value="Afegir Recurs">
                                </form>
                                <hr>
                                <?php
                                if (isset($error)) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $error ?>
                                    </div>
                                <?php } ?>
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