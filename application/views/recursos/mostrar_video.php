<div class="card mx-auto" style="width: 50%; text-align: center;">
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
</div>