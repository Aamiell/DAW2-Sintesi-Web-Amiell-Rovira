<div class="card" style="width: 100%; text-align: center;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
        <h5 style="font-weight: 900;" class="card-title"><?php echo $recursos['titol']; ?></h5>
        <b class="card-subtitle mb-2 text-muted">Descripció</b>
        <p class="card-text"><?php echo $recursos['descripcio']; ?></p>
        <b class="card-subtitle mb-2 text-muted">Explicació</b>
        <p class="card-text"><?php echo $recursos['explicacio']; ?></p>
        <b class="card-subtitle mb-2 text-muted">Arxius Adjunts</b>
        <ul class="list-group list-group-flush">
            <?php foreach ($adjunts as $adjunts_item) : ?>
                <li class="list-group-item"><?php echo $adjunts_item['nom_original']; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>