<h1 class="title"><?= $producto->getNombre() ?></h1>

<div class="box">
  <div class="columns">
    <div class="column is-half-desktop is-full-mobile">
      <?php if ($producto->getImagen()): ?>
        <figure class="image is-1by1 is-clipped">
          <img src="<?= $producto->getImagenUrl() ?>" class="is-clipped" alt="Image">
        </figure>
      <?php endif; ?>
    </div>
    <div class="column is-half-desktop is-full-mobile">
      <div>
        <div class="media-content">
          <div class="content">
            <p>
              <br>
              <?= $producto->getDescripcion() ?>
            </p>
          </div>
        </div>
      </div>
      <p class="is-size-3">
        $<?= number_format($producto->getPrecio(), 0, ',', '.') ?>
      </p>
      <p>
        <a
          class="button is-primary"
          href="<?= BASE_URL . 'Carrito/add&producto=' . $producto->getId() ?>"
          <?= $producto->getStock() ? '' : 'disabled' ?>
        >
          Añadir al carrito
        </a>
      </p>
      <p class="is-italic"><?= $producto->getStock() ?> disponibles</p>
    </div>
  </div>
</div>
