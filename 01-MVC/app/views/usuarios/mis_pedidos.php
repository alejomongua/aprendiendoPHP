<h1 class='title'>Listado de mis pedidos</h1>

<table class="table is-fullwidth">
  <thead>
    <tr>
      <th><abbr title="ID">ID</abbr></th>
      <th><abbr title="Fecha">Fecha</abbr></th>
      <th><abbr title="Total">Total</abbr></th>
      <th><abbr title="Acciones">Estado</abbr></th>
    </tr>
  </thead>
  <tbody>
    <?php for($i = 0; $i < count($pedidos); $i++): ?>
      <tr>
        <td>
          <a href="<?= BASE_URL . 'Pedidos/show&id=' . $pedidos[$i]->getId() ?>">
            <?= $pedidos[$i]->getId(); ?>
          </a>
        </td>
        <td><?= $pedidos[$i]->getFecha() ?></td>
        <td><?= number_format($pedidos[$i]->getCoste(), 0, ',', '.') ?></td>
        <td><?= $pedidos[$i]->getEstado() ?></td>
      </tr>
    <?php endfor; ?>
  </tbody>
</table>

<a class="button" href='<?= BASE_URL ?>Pedidos/new'>Crear uno nuevo pedido</a>