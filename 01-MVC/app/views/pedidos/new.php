<h1 class="title">Realizar un nuevo pedido</h1>

<h2 class="subtitle">Por favor verifique su pedido y complete la información faltante</h2>

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
          <a class="button is-danger"  href="<?= BASE_URL . 'Carrito/remove&producto=' . $productos[$productoId]->getId() ?>">
            Eliminar del carrito
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<form action='<?= BASE_URL ?>Pedidos/create' method='post'>
  <div class="field">
    <label class="label">Departamento</label>
    <div class="control">
      <input name="departamento" class="input" type="text" placeholder="Introduzca el departamento para el envío" required>
    </div>
  </div>

  <div class="field">
    <label class="label">Ciudad</label>
    <div class="control">
      <input name="ciudad" class="input" type="text" placeholder="Introduzca su ciudad para el envío" required>
    </div>
  </div>

  <div class="field">
    <label class="label">Dirección</label>
    <div class="control">
      <input name="direccion" class="input" type="text" placeholder="Introduzca su dirección para el envío" required>
    </div>
  </div>

  <p class="is-size-2">
    Total: $<?= number_format($totalCarrito, 0, ',', '.') ?>
  </p>

  <div class="field is-grouped">
    <div class="control">
      <button type='submit' class="button is-link">Enviar información</button>
    </div>
    <div class="control">
      <a class="button is-link is-light" href='<?= BASE_URL ?>'>Cancelar</a>
    </div>
  </div>
</form>