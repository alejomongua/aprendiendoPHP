<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="<?= BASE_URL ?>">
      <img src="<?= BASE_URL ?>icon.png" width="28" height="28">
      <span class="ml-3">Inicio</span>
    </a>

    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Categorías
        </a>

        <div class="navbar-dropdown">
          <?php
            foreach(Categoria::listado() as $categoria) {
              echo '<a class="navbar-item" href="' . BASE_URL . 'Categorias/show&id=' . $categoria->getId() . '">';
              echo $categoria->getNombre();
              echo '</a>';
            }
          ?>
        </div>

      </div>
      <?php if (usuarioAdministrador()): ?>
        <div class="navbar-item">
          <a class="navbar-link is-arrowless" href="<?= BASE_URL ?>Main/administrar">
            Administrar
          </a>
        </div>
      <?php endif; ?>
    </div>
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <?php if (usuarioIdentificado()): ?>
            <a class="button is-danger" href='<?= BASE_URL ?>Usuarios/logout'>
              <strong>Cerrar sesión</strong>
            </a>
          <?php else: ?>
            <a class="button is-primary" href='<?= BASE_URL ?>Usuarios/new'>
              <strong>Registrarse</strong>
            </a>
            <a class="button is-light" href='<?= BASE_URL ?>Usuarios/login'>
              Iniciar sesión
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</nav>