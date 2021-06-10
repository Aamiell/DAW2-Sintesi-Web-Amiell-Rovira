<script src="https://cdn.tiny.cloud/1/e2tgnbfthwd0opuvogjvl20bqeeaw4m2a3nf2pefrq6kefh6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<div class="card mx-auto" style="width: 50%; text-align: center;">
    <div class="card-body">
        <form enctype="multipart/form-data" method="POST" action="<?php echo base_url('recursos/modificar_video');  ?>">
            <input hidden name="id" value="<?php echo $recursos['id']; ?>">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="color: white;" class="bg-info" scope="col" colspan="4"><input type="text" class="form-control" name="titol" value="<?php echo $recursos['titol']; ?>" /></th>
                    </tr>
                </thead>
            </table>
            <?php if ($arxiu == null) { ?>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th style="color: black;" class="bg-light" scope="col" colspan="4">Arxiu Principal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img style="width: 20%;" src="<?php echo base_url('assets/img/no-imatge.png'); ?>" class="card-img-top"></td>
                        </tr>
                    </tbody>
                </table>
            <?php } else { ?>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th style="color: black;" class="bg-light" scope="col" colspan="4">Arxiu Principal</th>
                        </tr>
                        <tr>
                            <th scope="col">Nom fitxer</th>
                            <th scope="col">Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> <video style="width: 20%;" src="<?php echo base_url('recurs/' . $id_recurs); ?>" controls class="card-img-top" alt="<?php echo $arxiu['nom_original']; ?>"></video></td>
                            <td><a class="btn btn-outline-danger" href="<?php echo base_url('recurs/video/borrar/' . $id_recurs) ?>"><i class="fas fa-times"></i>&nbsp;Borrar</a></td>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="color: black;" class="bg-light" scope="col" colspan="4">Arxiu principal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="file" name="arxiu" id="arxiu" size="20" /></td>
                    </tr>
                </tbody>
            </table>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="color: black;" class="bg-light" scope="col" colspan="4">Descripció</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: justify;"><input type="text" class="form-control" name="descripcio" value="<?php echo $recursos['descripcio']; ?>" /></td>
                    </tr>
                </tbody>
            </table>

            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="color: black;" class="bg-light" scope="col" colspan="4">Explicació</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
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
                        <td style="text-align: justify;"><textarea type="text" class="form-control" id="explicacio" name="explicacio" value=""><?php echo $recursos['explicacio']; ?></textarea></td>
                    </tr>
                </tbody>
            </table>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="color: black;" class="bg-light" scope="col" colspan="4">Arxius Adjunts</th>
                    </tr>
                    <tr>
                        <th scope="col">Nom fitxer</th>
                        <th scope="col">Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($adjunts as $adjunts_item) : ?>
                        <tr>
                            <td><?php echo $adjunts_item['nom_original']; ?></td>
                            <td><a class="btn btn-outline-danger" href="<?php echo base_url('recurs/video/borrar/arxius/' . $id_recurs  . '/adjunts/' . $adjunts_item['id']); ?>"><i class="fas fa-times"></i>&nbsp;Borrar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="color: black;" class="bg-light" scope="col" colspan="4">Arxius Adjunts</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="file" name="adjunts1" id="adjunts1" size="20" /></td>
                    </tr>
                    <tr>
                        <td><input type="file" name="adjunts2" id="adjunts2" size="20" /></td>
                    </tr>
                    <tr>
                        <td><input type="file" name="adjunts3" id="adjunts3" size="20" /></td>
                    </tr>
                </tbody>
            </table>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="color: black;" class="bg-light" scope="col" colspan="4">Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> <?php
                                echo "<select name='cat' id='cat'>";
                                echo "<hr>";
                                $controller->mostrar_categories($cat);
                                echo "</select>";
                                ?></td>
                    </tr>
                </tbody>
            </table>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="color: black;" class="bg-light" scope="col" colspan="4">Tipus d'access</th>
                    </tr>
                </thead>
                <tbody>
                    <script>
                        function access() {
                            var sel = document.getElementById("tipus_access");
                            if (sel.value == 'codi_invitacio') {
                                document.getElementById('codi').hidden = false;
                            } else {
                                document.getElementById('codi').hidden = true;
                            }
                        }
                    </script>
                    <tr>
                        <td> <select name="tipus_access" id="tipus_access" onchange="access()">
                                <option value="grups_usuaris">Grup usuaris</option>
                                <option value="perfil_usuaris">Perfil usuaris</option>
                                <option value="codi_invitacio">Codi invitació</option>
                                <option value="public">Públic</option>
                            </select></td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <input hidden type="password" class="form-control" name="codi" id="codi" placeholder="Codi...">
            </div>
            <!-- <b class="card-subtitle mb-2 text-muted">Tags</b><br>
        <div class="card-body">
            <p class="card">Card</p>
            <p class="card">Another</p>
        </div> -->
            <button type="submit" class="btn btn-warning" name="submit"><i class="far fa-edit"></i>&nbsp;MODIFICAR</button>
    </div>
    </form>
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