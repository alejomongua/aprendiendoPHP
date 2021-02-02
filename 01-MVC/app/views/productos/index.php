<h1 class='title'>Listado de productos</h1>

<table class="table is-fullwidth">
  <thead>
    <tr>
      <th><abbr title="ID">ID</abbr></th>
      <th><abbr title="Nombre">Nombre</abbr></th>
      <th><abbr title="Precio">Precio</abbr></th>
      <th><abbr title="Stock">Stock</abbr></th>
      <th><abbr title="Acciones">Acciones</abbr></th>
    </tr>
  </thead>
  <tbody>
    <?php for($i = 0; $i < count($productos); $i++): ?>
      <tr>
        <td><?= $productos[$i]->getId(); ?></td>
        <td><?= $productos[$i]->getNombre(); ?></td>
        <td><?= $productos[$i]->getPrecio(); ?></td>
        <td><?= $productos[$i]->getStock(); ?></td>
        <td>
          <a href='<?= BASE_URL ?>Productos/edit?id=<?= $productos[$i]->getId() ?>'>Editar</a>
          <br />
          <a href='<?= BASE_URL ?>Productos/destroy?id=<?= $productos[$i]->getId() ?>'>Eliminar</a>
        </td>
      </tr>
    <?php endfor; ?>
  </tbody>
</table>

<a class="button" href='<?= BASE_URL ?>Productos/new'>Crear uno nuevo producto</a>