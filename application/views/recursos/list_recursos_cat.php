<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Tipus recurs</th>
            <th scope="col">Titol</th>
            <th scope="col">Descripcio</th>
            <th scope="col">Opcions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($recursos as $recursos_item) : ?>
            <tr>
                <td><?php echo $recursos_item['tipus_recurs']; ?></td>
                <td><?php echo $recursos_item['titol']; ?></td>
                <td><?php echo $recursos_item['descripcio']; ?></td>
                <td>
                    <?php if ($recursos_item['tipus_recurs'] == 'infografia') { ?>
                        <a class="btn btn-outline-info" href="<?php echo base_url('recursos/mostrar_infografia/' . $recursos_item['id']); ?>"><i class="far fa-eye"></i>&nbsp;Veure</a>
                    <?php } elseif ($recursos_item['tipus_recurs'] == 'video') { ?>
                        <a class="btn btn-outline-info" href="<?php echo base_url('recursos/mostrar_video/' . $recursos_item['id']); ?>"><i class="far fa-eye"></i>&nbsp;Veure</a>
                    <?php } elseif ($recursos_item['tipus_recurs'] == 'link_video') { ?>
                        <a class="btn btn-outline-info" href="<?php echo base_url('recursos/mostrar_link_video/' . $recursos_item['id']); ?>"><i class="far fa-eye"></i>&nbsp;Veure</a>
                    <?php } elseif ($recursos_item['tipus_recurs'] == 'pissarra') { ?>
                        <a class="btn btn-outline-info" href="<?php echo base_url('recursos/mostrar_pissarra/' . $recursos_item['id']); ?>"><i class="far fa-eye"></i>&nbsp;Veure</a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>