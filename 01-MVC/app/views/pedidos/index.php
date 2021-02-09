<h1 class='title'>Listado de pedidos</h1>

<table class="table is-fullwidth">
  <thead>
    <tr>
      <th><abbr title="ID">ID</abbr></th>
      <th><abbr title="Usuario">Usuario</abbr></th>
      <th><abbr title="Fecha">Fecha</abbr></th>
      <th><abbr title="Total">Total</abbr></th>
      <th><abbr title="Acciones">Acciones</abbr></th>
    </tr>
  </thead>
  <tbody>
    <?php for($i = 0; $i < count($pedidos); $i++): ?>
      <tr>
        <td><?= $pedidos[$i]->getId(); ?></td>
        <td><?= $pedidos[$i]->getUsuario()->getNombreCompleto(); ?></td>
        <td><?= $pedidos[$i]->getFecha(); ?></td>
        <td><?= $pedidos[$i]->getCoste(); ?></td>
        <td>
          <a href='<?= BASE_URL ?>Pedidos/edit&id=<?= $pedidos[$i]->getId() ?>'>Editar</a>
          <br />
          <a href='<?= BASE_URL ?>Pedidos/destroy&id=<?= $pedidos[$i]->getId() ?>'>Eliminar</a>
        </td>
      </tr>
    <?php endfor; ?>
  </tbody>
</table>

<a class="button" href='<?= BASE_URL ?>Pedidos/new'>Crear uno nuevo pedido</a>