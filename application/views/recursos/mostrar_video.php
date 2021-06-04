<!-- <div class="card mx-auto" style="width: 50%; text-align: center;">
    <video src="<?php echo base_url('recurs/' . $id_recurs); ?>" controls class="card-img-top" alt="<?php echo $arxiu['nom_original']; ?>"></video>
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
        <video src="<?php echo base_url('recurs/' . $id_recurs); ?>" controls class="card-img-top" alt="<?php echo $arxiu['nom_original']; ?>"></video>
        <br><br>
        <table class="table text-center">
            <thead>
                <tr>
                    <th style="color: black;" class="bg-light" scope="col" colspan="4">Descripció</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td style="text-align: justify;"><?php echo $recursos['descripcio']; ?></td>
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
                        <td style="text-align: justify;"><?php echo $recursos['explicacio']; ?></td>
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
        <b class="card-subtitle mb-2 text-muted">Tags</b><br>
        <div class="card-body">
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>
    </div>
</div>