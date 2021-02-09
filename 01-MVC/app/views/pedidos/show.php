<h1 class="title">Datos del pedido</h1>
<hr />

<p>
Estado del pedido: <?= $pedido->getEstado() ?>
</p>

<p>
Este pedido fue realizado en <?= $pedido->getFecha() ?>
</p>

<p>
Enviar el pedido a <?= $pedido->getCiudad() . ' (' . $pedido->getDepartamento() . ')' ?> 
en la dirección <?= $pedido->getDireccion() ?>
</p>

<p>
El total del pedido es $ <?= number_format($pedido->getCoste(), 0, ',', '.') ?>
</p>
<hr />
<h3 class='is-subtitle has-text-weight-semibold'>Productos</h3>
<hr />

<ul>
  <?php foreach($pedido->getProductos() as $producto): ?>
    <li>
      <?= $pedido->getListaProductos()[$producto->getId()] ?> unidad(es) de <?= $producto->getNombre() ?>
    </li>
  <?php endforeach; ?>
</ul>