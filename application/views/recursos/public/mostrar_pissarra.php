<div class="card mx-auto" style="width: 50%; text-align: center;">
    <div class="card-body">
        <table class="table text-center">
            <thead>
                <tr>
                    <th style="color: white;" class="bg-info" scope="col" colspan="4"><?php echo $recursos['titol']; ?></th>
                </tr>
            </thead>
        </table>
        <img src="data:image/png;base64,<?php echo $recursos['pissarra']; ?>" alt="">
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
                        <td><a class="btn btn-outline-info" href="<?php echo base_url('recurs/public/arxius/' . $id_recurs  . '/adjunts/' . $adjunts_item['id']); ?>"><i class="fas fa-download"></i>&nbsp;Descargar</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- </ul> -->
        <b class="card-subtitle mb-2 text-muted">Tags</b><br>
        <div class="card-body">
            <p class="card">Card</p>
            <p class="card">Another</p>
        </div>
    </div>
</div>