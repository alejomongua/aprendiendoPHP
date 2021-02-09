<h1 class="title">Tu pedido ha sido recibido</h1>

<hr />

<p>
Hemos recibido tu pedido, tan pronto recibamos la confirmación del pago procederemos al despacho.
</p>

<p>
Si tienes una duda, no olvides contactarte con nosotros
</p>

<hr />

<h2 class="subtitle has-text-weight-bold">Datos del pedido</h2>
<hr />

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