<h1 class="title">Registrarse</h1>

<form action='<?= BASE_URL ?>Usuarios/create' method='post'>
  <div class="field">
    <label class="label">Nombre</label>
    <div class="control">
      <input name="nombre" class="input" type="text" placeholder="Introduzca su nombre de pila" required>
    </div>
  </div>

  <div class="field">
    <label class="label">Apellido</label>
    <div class="control">
      <input name="apellidos" class="input" type="text" placeholder="Introduzca su apellido" required>
    </div>
  </div>

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
      <button type='submit' class="button is-link">Enviar información</button>
    </div>
    <div class="control">
      <a class="button is-link is-light" href='<?= BASE_URL ?>'>Cancelar</a>
    </div>
  </div>
</form>