<h1 class="title">Registrar un nuevo producto</h1>

<form action='<?= BASE_URL ?>Productos/create' method='post'>
  <div class="field">
    <label class="label">Nombre</label>
    <div class="control">
      <input
        name="nombre"
        class="input"
        type="text"
        placeholder="Introduzca el nombre del nuevo producto"
        required />
    </div>
  </div>
  <div class="field">
    <label class="label">Descripción</label>
    <div class="control">
      <input
        name="descripción"
        class="input"
        type="text"
        placeholder="Introduzca la descripción del nuevo producto"
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
              echo '<option value="' . $categoria->getId() . '">';
              echo $categoria->getNombre();
              echo '</option>';
            }
          ?>
      </select>
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