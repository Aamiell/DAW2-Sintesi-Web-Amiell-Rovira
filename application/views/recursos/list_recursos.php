<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Tipus recurs</th>
            <th scope="col">Titol</th>
            <th scope="col">Descripcio</th>
            <th scope="col">Propietari</th>
            <th scope="col">Opcions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($recursos as $recursos_item) : ?>
            <tr>
                <td><?php echo $recursos_item['tipus_recurs']; ?></td>
                <td><?php echo $recursos_item['titol']; ?></td>
                <td><?php echo $recursos_item['descripcio']; ?></td>
                <td><?php echo $recursos_item['propietari']; ?></td>
                <td>
                    <?php if ($recursos_item['tipus_recurs'] == 'infografia') { ?>
                        <a class="btn btn-outline-info" href="<?php echo base_url('recursos/modificar_infografia/' . $recursos_item['id']); ?>"><i class="fas fa-pencil-alt"></i>&nbsp;Modificar</a>
                    <?php } elseif ($recursos_item['tipus_recurs'] == 'video') { ?>
                        <a class="btn btn-outline-info" href="<?php echo base_url('recursos/modificar_video/' . $recursos_item['id']); ?>"><i class="fas fa-pencil-alt"></i>&nbsp;Modificar</a>
                    <?php } elseif ($recursos_item['tipus_recurs'] == 'link_video') { ?>
                        <a class="btn btn-outline-info" href="<?php echo base_url('recursos/modificar_link_video/' . $recursos_item['id']); ?>"><i class="fas fa-pencil-alt"></i>&nbsp;Modificar</a>
                    <?php } elseif ($recursos_item['tipus_recurs'] == 'pissarra') { ?>
                        <a class="btn btn-outline-info" href="<?php echo base_url('recursos/modificar_pissarra/' . $recursos_item['id']); ?>"><i class="fas fa-pencil-alt"></i>&nbsp;Modificar</a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>