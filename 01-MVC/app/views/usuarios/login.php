<h1 class="title">Identificarse</h1>

<form action='<?= BASE_URL ?>Usuarios/login' method='post'>
  <div class="field">
    <label class="label">Correo electrónico</label>
    <div class="control">
      <input name="email" class="input" type="email" placeholder="Introduzca su dirección de correo electrónico" required>
    </div>
  </div>

  <div class="field">
    <label class="label">Contraseña</label>
    <div class="control">
      <input name="password" class="input" type="password" placeholder="Por favor asígnese una contraseña" required>
    </div>
  </div>

  <div class="field is-grouped">
    <div class="control">
      <button type='submit' class="button is-link">Identificarse</button>
    </div>
  </div>
</form>