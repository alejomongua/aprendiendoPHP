<h1 class="title"><?= $categoria->getNombre(); ?></h1>

<?php foreach($categoria->productos() as $producto): ?>
  <div class="box">
    <article class="media">
      <div class="media-left">
        <?php if ($producto->getImagen()): ?>
          <figure class="image is-128x128 is-clipped">
            <img src="<?= $producto->getImagenUrl() ?>" alt="Image">
          </figure>
        <?php endif; ?>
      </div>
      <div class="media-content">
        <div class="content">
          <p>
            <strong><?= $producto->getNombre() ?></strong> <span>$ <?= $producto->getPrecio() ?></span> <small class='is-italic'><?= $producto->getStock() ?> disponibles</small>
            <br>
            <?= $producto->getDescripcion() ?>
          </p>
        </div>
        </nav>
      </div>
    </article>
  </div>
<?php endforeach; ?>