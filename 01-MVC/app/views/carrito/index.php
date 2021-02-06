<h1 class='title'>Carrito de compra</h1>

<?php if ($carrito): ?>
  <table class="table is-fullwidth">
    <thead>
      <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio unitario</th>
        <th>Cantidad</th>
        <th>Precio total</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($carrito as $productoId => $cantidad): ?>
        <tr>
          <td>
            <figure class="image is-128x128 is-clipped">
              <img src="<?= $productos[$productoId]->getImagenUrl() ?>"/>
            </figure>
          </td>
          <td>
            <a href="<?= BASE_URL . 'Productos/show&id=' . $productos[$productoId]->getId() ?>">
              <?= $productos[$productoId]->getNombre() ?>
            </a>
          </td>
          <td>$ <?= number_format($productos[$productoId]->getPrecio(), 0, ',', '.') ?></td>
          <td><?= $cantidad ?></td>
          <td>$ <?= number_format($productos[$productoId]->getPrecio() * $cantidad, 0, ',', '.') ?></td>
          <td>
            <a class="button is-danger" href="#">
              Eliminar del carrito
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="columns has-text-centered">
    <div class="column is-half-desktop is-full-mobile">
      <p class="is-size-2">
        Total: $<?= number_format($totalCarrito, 0, ',', '.') ?>
      </p>
    </div>
    <div class="column is-half-desktop is-full-mobile">
      <a class="button is-success">
        Realizar el pedido
      </a>
    </div>
  </div>
  <a class='button is-danger mt-4' href="<?= BASE_URL . 'Carrito/clear' ?>">
    Limpiar carrito
  </a>
<?php else: ?>
    <h1 class="is-size-3 has-text-danger">El carrito de compras está vacio</h1>
<?php endif; ?>
