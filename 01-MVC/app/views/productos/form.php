<form
  action='<?= BASE_URL ?>Productos/<?= $accion ?>'
  enctype='multipart/form-data'
  method='post'
>
  <div class="field">
    <label class="label">Nombre</label>
    <div class="control">
      <input
        name="nombre"
        class="input"
        type="text"
        placeholder="Introduzca el nombre del nuevo producto"
        <?= $producto && $producto->getNombre() ? 'value=' . $producto->getNombre() : null; ?>
        required />
    </div>
  </div>
  <div class="field">
    <label class="label">Descripción</label>
    <div class="control">
      <input
        name="descripcion"
        class="input"
        type="text"
        placeholder="Introduzca la descripción del nuevo producto"
        <?= $producto && $producto->getDescripcion() ? 'value=' . $producto->getDescripcion() : null; ?>
        required />
    </div>
  </div>
  <div class="field">
    <label class="label">Precio</label>
    <div class="control">
      <input
        name="precio"
        class="input"
        type="text"
        placeholder="Introduzca el precio del nuevo producto"
        <?= $producto && $producto->getPrecio() ? 'value=' . $producto->getPrecio() : null; ?>
        required />
    </div>
  </div>
  <div class="field">
    <label class="label">Stock</label>
    <div class="control">
      <input
        name="stock"
        class="input"
        type="text"
        placeholder="Introduzca el stock disponible"
        <?= $producto && $producto->getStock() ? 'value=' . $producto->getStock() : null; ?>
        required />
    </div>
  </div>
  <div class="field">
    <label class="label">Categoria</label>
    <div class="control">
      <select
        name="categoria_id"
        class="input">
          <?php
            foreach(Categoria::listado() as $categoria) {
              echo '<option value="' . $categoria->getId() . '"';
              echo $producto && $producto->getCategoriaId() == $categoria->getId() ? ' selected' : '';
              echo '>';
              echo $categoria->getNombre();
              echo '</option>';
            }
          ?>
      </select>
    </div>
  </div>
  <?php if ($producto && $producto->getImagen()): ?>
    <img src='<?= $producto->getImagenUrl() ?>' />
  <?php endif; ?>
  <div class="field">
    <label class="label">Imagen</label>
    <div class="control">
      <input
        name="imagen"
        class="input"
        type="file"
        placeholder="Suba una imagen del producto"
        accept="image/*"
        capture="camera" />
    </div>
  </div>

  <div class="field is-grouped">
    <div class="control">
      <button type='submit' class="button is-link">Enviar información</button>
    </div>
    <div class="control">
      <a class="button is-link is-light" href='<?= BASE_URL ?>/Productos/index'>Cancelar</a>
    </div>
  </div>
</form>