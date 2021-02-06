<h1 class="title"><?= $categoria->getNombre(); ?></h1>

<?php foreach($categoria->productos() as $producto) {
  $producto->show();
}
