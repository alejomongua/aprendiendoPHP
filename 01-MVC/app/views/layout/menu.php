<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="/">
      <img src="icon.png" width="28" height="28">
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
          Categorias
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            Categoria 1
          </a>
          <a class="navbar-item">
            Categoria 2
          </a>
          <a class="navbar-item">
            Categoria 3
          </a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary" href='index.php?controller=Usuarios&action=new'>
            <strong>Registrarse</strong>
          </a>
          <a class="button is-light">
            Iniciar sesión
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>