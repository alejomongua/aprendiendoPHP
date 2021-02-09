<h1 class="title">Cambiar el estado del pedido</h1>

<form
  action="<?= BASE_URL . 'Pedidos/update&id=' . $_GET['id'] ?>"
  method='post'
>
  <div class="field">
    <label class="label">Estado</label>
    <div class="control">
      <select name="estado" class="input">
          <?php
            foreach(Pedido::ESTADOS as $estado) {
              echo '<option value="' . $estado . '"';
              echo $pedido && $pedido->getEstado() == $estado ? ' selected' : '';
              echo '>';
              echo $estado;
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
      <a class="button is-link is-light" href='<?= BASE_URL ?>/Pedidos/index'>Cancelar</a>
    </div>
  </div>
</form>