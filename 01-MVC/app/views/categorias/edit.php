<h1 class="title">Editar <?= $categoria->getNombre(); ?></h1>

<form action='<?= BASE_URL ?>Categorias/update&id=<?= $categoria->getId(); ?>' method='post'>
  <div class="field">
    <label class="label">Nombre</label>
    <div class="control">
      <input
        name="nombre"
        class="input"
        type="text"
        placeholder="Introduzca el nombre de la nueva categoría"
        value="<?= $categoria->getNombre(); ?>"
        required />
    </div>
  </div>

  <div class="field is-grouped">
    <div class="control">
      <button type='submit' class="button is-link">Enviar información</button>
    </div>
    <div class="control">
      <a class="button is-link is-light" href='<?= BASE_URL ?>/Categorias/index'>Cancelar</a>
    </div>
  </div>
</form>