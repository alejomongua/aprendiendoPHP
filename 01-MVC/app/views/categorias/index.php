<h1 class='title'>Listado de categorías</h1>

<table class="table is-fullwidth">
  <thead>
    <tr>
      <th><abbr title="ID">ID</abbr></th>
      <th><abbr title="Nombre">Nombre</abbr></th>
      <th><abbr title="Acciones">Acciones</abbr></th>
    </tr>
  </thead>
  <!--tfoot>
    <tr>
      <th><abbr title="ID">ID</abbr></th>
      <th><abbr title="Nombre">Nombre</abbr></th>
      <th><abbr title="Acciones">Acciones</abbr></th>
    </tr>
  </tfoot-->
  <tbody>
    <?php for($i = 0; $i < count($categorias); $i++): ?>
      <tr>
        <td><?= $categorias[$i]->getId(); ?></td>
        <td><?= $categorias[$i]->getNombre(); ?></td>
        <td>
          <a href='<?= BASE_URL ?>Categorias/edit&id=<?= $categorias[$i]->getId() ?>'>Editar</a>
          <br />
          <a href='<?= BASE_URL ?>Categorias/destroy&id=<?= $categorias[$i]->getId() ?>'>Eliminar</a>
        </td>
      </tr>
    <?php endfor; ?>
  </tbody>
</table>

<a class="button" href='<?= BASE_URL ?>Categorias/new'>Crear una nueva categoría</a>