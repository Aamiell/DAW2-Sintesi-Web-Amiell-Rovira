<!-- End of Topbar -->
<script src="https://cdn.tiny.cloud/1/e2tgnbfthwd0opuvogjvl20bqeeaw4m2a3nf2pefrq6kefh6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!-- Begin Page Content -->
<div class="container-fluid">
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
                                <div style="margin-left: 71%;  margin-top: -7%">
                                    <button type="button" class="btn btn-outline-info" onclick="location.href='<?php echo base_url(); ?>recurs/formrecursos'"><i class="far fa-calendar-plus"></i>&nbsp;Menu Recursos</button>
                                </div>
                                <?php echo $this->session->flashdata('ok');  ?>
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-images"></i>&nbsp;Infografia</h1>
                                </div>

                                <script>
                                    tinymce.init({
                                        selector: '#explicacio',
                                        plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
                                        toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
                                        toolbar_mode: 'floating',
                                        tinycomments_mode: 'embedded',
                                        tinycomments_author: 'Author name',
                                        language: 'ca',
                                    });
                                </script>
                                <form class="user" action="<?php echo base_url('recurs/infografia') ?>" enctype="multipart/form-data" method="POST">
                                    <b>Arxiu recurs: </b>
                                    <br>
                                    <input type="file" name="arxiu" id="arxiu" size="20" />
                                    <br><br>
                                    <b>Arxius adjunts: </b>
                                    <br>
                                    <input type="file" name="adjunts1" id="adjunts1" size="20" />
                                    <input type="file" name="adjunts2" id="adjunts2" size="20" />
                                    <input type="file" name="adjunts3" id="adjunts3" size="20" />
                                    <br><br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="titol" id="titol" placeholder="Titol...">
                                    </div>
                                    <div class="form-group">
                                        <textarea type="textarea" class="form-control" name="descripcio" id="descripcio" placeholder="Descripcio..."></textarea>
                                    </div>
                                    <textarea type="textarea" id="explicacio" name="explicacio" placeholder="Explicacio..."></textarea>
                                    <br>
                                    <?php $query = $this->db->get('tags');
                                    foreach ($query->result() as $row) { ?>
                                        <input type="checkbox" id="tag" name="tag[]" value="<?php echo $row->nom; ?>"> <label for="tag" id="taglabel"> <?php echo $row->nom; ?></label><br>
                                    <?php } ?>
                                    <input id="boto" name="boto" type="submit" class="btn btn-primary btn-user btn-block" value="Afegir Recurs">
                                </form>
                                <hr>
                                <?php
                                if (isset($error) && $error != "") { ?>
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