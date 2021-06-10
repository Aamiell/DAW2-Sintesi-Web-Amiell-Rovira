<script>
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;

    //Desactivem tots el botons y amagem la part del video
    document.getElementById('linkvideo').disabled = true;
    document.getElementById('volumen').disabled = true;
    document.getElementById('btstart').disabled = true;
    document.getElementById('bstop').disabled = true;
    document.getElementById('altrevideo').disabled = true;
    document.getElementById('player').style.display = "none"

    function onYouTubeIframeAPIReady() {
        //Agafem el que hem introduit al input
        var linkvideo = value = "<?php echo $recursos['link']; ?>";
        //Retallem del caracter 32 al 43 es a dir la id del video
        var linkvideoid = linkvideo.substring(32, 43);
        player = new YT.Player('player', {
            playerVars: {
                'controls': 0
            },
            height: '360',
            width: '100%',
            videoId: linkvideoid,
            events: {
                'onReady': stop,
                'onStateChange': onPlayerStateChange
            }
        });

    }

    function veureVideo() {
        //Fem visible la part on esta el video
        document.getElementById('player').style.display = "block"
        //Agafem el que hem introduit al input
        var linkvideo = value = "<?php echo $recursos['link']; ?>";
        //Retallem del caracter 32 al 43 es a dir la id del video
        var videoid = linkvideo.substring(32, 43);
        //Carregem el video que li hem pasat
        player.loadVideoById(videoid);
        //Desactivem el input y el boto
        document.getElementById('linkvideo').disabled = true;
        document.getElementById('veure').disabled = true;
        document.getElementById('volumen').disabled = false;
        document.getElementById('btstart').disabled = false;
        document.getElementById('bstop').disabled = false;
        document.getElementById('altrevideo').disabled = false;
        //Una vegda carregat el video fem el stop per a que no començi
        player.stopVideo();
        player.setVolume((document.getElementById("volumen").value));
        //Afagem el valor dels segons del localstorage
        var localtemps = localStorage.getItem(videoid);
        if (localtemps != null) {
            //alert(localtemps);
            //Li diem que carregem en el segons que hi havia al localstorage
            player.loadVideoById(videoid,
                localtemps)
            player.pauseVideo();
        }
    }

    var done = false;

    function onPlayerStateChange(event) {
        //Si el video esta funcionan cambiarem el boto a pause
        if (event.data == YT.PlayerState.PLAYING && !done) {
            done = true;
            document.getElementById('btstart').innerHTML = '<i class="fas fa-pause-circle"></i>&nbsp;PAUSE';
            //Si el video no esta funcionan cambiarem el boto a play
        } else {
            done = false;
            document.getElementById('btstart').innerHTML = '<i class="fas fa-play-circle"></i>&nbsp;PLAY';
        }
    }

    function play() {
        //Si el boto te el valor PLAY farem playVideo
        if (document.getElementById('btstart').innerHTML == '<i class="fas fa-play-circle"></i>&nbsp;PLAY') {
            player.playVideo();
            //Canviem el valor del boto a PAUSE
            document.getElementById('btstart').innerHTML = '<i class="fas fa-pause-circle"></i>&nbsp;PAUSE';
            //Si el boto te el valor PAUSE farem pauseVideo
        } else if (document.getElementById('btstart').innerHTML = '<i class="fas fa-pause-circle"></i>&nbsp;PAUSE') {
            player.pauseVideo();
            //Canviem el valor del boto a PLAY
            document.getElementById('btstart').innerHTML = '<i class="fas fa-play-circle"></i>&nbsp;PLAY';
        }
    }

    function stop() {
        //Pausem el video
        player.stopVideo();
    }

    function volumen() {
        //Ajustem el volumen que vulgem
        player.setVolume((document.getElementById("volumen").value));
    }

    function veurealtrevideo() {
        //Agafem el que hem introduit al input
        var linkvideo = document.getElementById('linkvideo').value;
        //Retallem del caracter 32 al 43 es a dir la id del video
        var videoid = linkvideo.substring(32, 43);
        //Guardem el valor del temps on hem parat en la variable
        var tempsparat = player.getCurrentTime();
        //FIquem al localstorege la id del video y el temps cuan hem parat
        localStorage.setItem(videoid, tempsparat);
        //Tornem a activar el input y el boto
        player.pauseVideo();
        //Tornem a activar el input y el boto
        document.getElementById('linkvideo').disabled = false;
        document.getElementById('veure').disabled = false;
    }
</script>

<div class="card mx-auto" style="width: 50%; text-align: center;">
    <div class="card-body">
        <form enctype="multipart/form-data" method="POST" action="<?php echo base_url('recursos/modificar_link_video'); ?>">
            <input hidden name="id" value="<?php echo $recursos['id']; ?>">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="color: white;" class="bg-info" scope="col" colspan="4"><input type="text" class="form-control" name="titol" value="<?php echo $recursos['titol']; ?>" /></th>
                    </tr>
                </thead>
            </table>
            <div id="player"></div>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th style="color: black;" class="bg-light" scope="col" colspan="4">Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: justify;"><input type="text" class="form-control" name="link" value="<?php echo $recursos['link']; ?>" /></td>
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
                        <th style="color: black; " class="bg-light" scope="col" colspan="4">Explicació</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: justify;"><textarea type="text" class="form-control" name="explicacio"><?php echo $recursos['explicacio']; ?></textarea></td>
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
                        <th scope="col">Descarregar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($adjunts as $adjunts_item) : ?>
                        <tr>
                            <td><?php echo $adjunts_item['nom_original']; ?></td>
                            <td><a class="btn btn-outline-danger" href="<?php echo base_url('recurs/link/borrar/arxius/' . $id_recurs  . '/adjunts/' . $adjunts_item['id']); ?>"><i class="fas fa-times"></i>&nbsp;Borrar</a></td>
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