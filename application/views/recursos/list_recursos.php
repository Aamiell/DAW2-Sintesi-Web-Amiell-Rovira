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
            <td><?php  echo $recursos_item['tipus_recurs']; ?></td>
                <td><?php  echo $recursos_item['titol']; ?></td>
                <td><?php echo $recursos_item['descripcio']; ?></td>
                <td>
                    <!-- <div class="btn-group dropleft"> -->
                        <button type="button" class="btn btn-outline-info"><i class="far fa-eye"></i>&nbsp;Veure</button>
                        <!-- <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php //echo base_url('news/view/' . $recursos_item['slug']); ?>"><i class="far fa-eye"></i>&nbsp;Veure</a>
                            <a class="dropdown-item" href="<?php //echo base_url('news/delete/' . $news_item['slug']); ?>"><i class="far fa-trash-alt"></i>&nbsp;Eliminar</a>
                            <a class="dropdown-item" href="<?php //echo base_url('news/modificar/' . $news_item['slug']);; ?>"><i class="far fa-edit"></i>&nbsp;Modificar</a>
                            <a class="dropdown-item" href="<?php //echo base_url('news/pdf/' . $news_item['slug']);; ?>"><i class="fas fa-file-pdf"></i>&nbsp;Descargar PDF</a>
                        </div> -->
                    <!-- </div> -->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>