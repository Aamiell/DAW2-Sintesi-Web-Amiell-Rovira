<!-- <div class="card mx-auto" style="width: 50%; text-align: center;"> -->
<div class="input-group mb-3">
    <!-- <input type="text" class="form-control" id="linkvideo" placeholder="Link del video de Youtube" aria-label="Recipient's username" aria-describedby="button-addon2" value="<?php echo $recursos['link']; ?>"> &nbsp; -->
    <!-- <button class="btn btn-outline-primary" type="button" id="veure" onclick="veureVideo()"><i class="fab fa-youtube"></i>&nbsp;Veure Video</button> -->
</div>
<!-- <div id="player"></div> -->
<!-- <br>
<div class="botons">
    <button type="button" class="btn btn-outline-success" id="btstart" onclick="play()"><i class="fas fa-play-circle"></i>&nbsp;PLAY</button>
    <button type="button" class="btn btn-outline-danger" id="bstop" onclick="stop()"><i class="fas fa-stop-circle"></i>&nbsp;STOP</button>
    <input type="range" id="volumen" onclick="volumen()">
</div> -->
<!-- <button type="button" class="btn btn-outline-dark baltrevideo" id="altrevideo" onclick="veurealtrevideo()"><i class="fab fa-youtube"></i>&nbsp;VEURE UN ALTRE VIDEO</button> -->


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

<!-- <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <h5 style="font-weight: 900;" class="card-title"><?php echo $recursos['titol']; ?></h5>
        <b class="card-subtitle mb-2 text-muted">Descripció</b>
        <p class="card-text"><?php echo $recursos['descripcio']; ?></p>
        <b class="card-subtitle mb-2 text-muted">Explicació</b>
        <p class="card-text"><?php echo $recursos['explicacio']; ?></p>
        <b class="card-subtitle mb-2 text-muted">Arxius Adjunts</b>
        <ul class="list-group list-group-flush">
            <?php foreach ($adjunts as $adjunts_item) : ?>
                <li class="list-group-item"><?php echo $adjunts_item['nom_original']; ?></li><a style="width: 100%;" class="btn btn-outline-info" href="<?php echo base_url('recurs/arxius/' . $id_recurs); ?>"><i class="fas fa-download"></i>&nbsp;Descargar</a>
            <?php endforeach; ?>
        </ul>
    </div>
</div> -->

<div class="card mx-auto" style="width: 50%; text-align: center;">
    <div class="card-body">
        <table class="table text-center">
            <thead>
                <tr>
                    <th style="color: white;" class="bg-info" scope="col" colspan="4"><?php echo $recursos['titol']; ?></th>
                </tr>
            </thead>
        </table>
        <div id="player"></div>
        <br><br>
        <div class="botons">
            <button type="button" class="btn btn-outline-success" id="btstart" onclick="play()"><i class="fas fa-play-circle"></i>&nbsp;PLAY</button>
            <button type="button" class="btn btn-outline-danger" id="bstop" onclick="stop()"><i class="fas fa-stop-circle"></i>&nbsp;STOP</button>
            <input type="range" id="volumen" onclick="volumen()">
        </div>
        <br>
        <table class="table text-center">
            <thead>
                <tr>
                    <th style="color: black;" class="bg-light" scope="col" colspan="4">Descripció</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $recursos['descripcio']; ?></td>
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
                    <td><?php echo $recursos['explicacio']; ?></td>
                </tr>
            </tbody>
        </table>
        <!-- <h5 style="font-weight: 900;" class="card-title"><?php echo $recursos['titol']; ?></h5> -->
        <!-- <b class="card-subtitle mb-2 text-muted">Descripció</b>
        <p class="card-text"><?php echo $recursos['descripcio']; ?></p> -->
        <!-- <b class="card-subtitle mb-2 text-muted">Explicació</b>
        <p class="card-text"><?php echo $recursos['explicacio']; ?></p> -->
        <!-- <b class="card-subtitle mb-2 text-muted">Arxius Adjunts</b> -->
        <!-- <ul class="list-group list-group-flush" style="width: 50%;"> -->
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
                        <td><a class="btn btn-outline-info" href="<?php echo base_url('recurs/arxius/' . $id_recurs  . '/adjunts/' . $adjunts_item['id']); ?>"><i class="fas fa-download"></i>&nbsp;Descargar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- </ul> -->
        <table class="table text-center">
            <thead>
                <tr>
                    <th style="color: black;" class="bg-light" scope="col" colspan="4">Tags</th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php foreach ($adjunts as $adjunts_item) : ?> -->
                    <tr>
                        <!-- <td><?php echo $adjunts_item['nom_original']; ?></td> -->
                        <td colspan="4" >DJKNVJDFNVJND</td>
                    </tr>
                <!-- <?php endforeach; ?> -->
            </tbody>
        </table>
    </div>
</div>