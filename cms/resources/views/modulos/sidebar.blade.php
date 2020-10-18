  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
    <img src="{{ url('/')  }}/vistas/img/icono.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Juanito Travel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{ url('/') }}/vistas/img/admin.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrador</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- BOTON PARA LA PAGINA DEL BLOG -->     
          <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Blog</p>
          </a>
          </li>

          <!-- BOTON PARA LA PAGINA DEL ADMINISTRADORES -->     
          <li class="nav-item">
            <a href="{{ url('/administradores') }}" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Administradores</p>
            </a>
          </li>

          <!-- BOTON PARA LA PAGINA DEL CATEGORIAS -->     
          <li class="nav-item">
            <a href="{{ url('/categorias') }}" class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>Categorías</p>
            </a>
          </li>

          <!-- BOTON PARA LA PAGINA DEL ARTICULOS -->     
          <li class="nav-item">
            <a href="{{ url('/articulos') }}" class="nav-link">
              <i class="nav-icon fas fa-sticky-note"></i>
              <p>Artículos</p>
            </a>
          </li>

          <!-- BOTON PARA LA PAGINA DEL OPINIONES -->     
          <li class="nav-item">
            <a href="{{ url('/opiniones') }}" class="nav-link">
              <i class="nav-icon fas fa-user-check"></i>
              <p>Opiniones</p>
            </a>
          </li>

          <!-- BOTON PARA LA PAGINA DEL BANNER -->     
          <li class="nav-item">
            <a href="{{ url('/banner') }}" class="nav-link">
              <i class="nav-icon fas fa-images"></i>
              <p>Banner</p>
            </a>
          </li>

          <!-- BOTON PARA LA PAGINA DEL ANUNCIOS -->     
          <li class="nav-item">
            <a href="{{ url('/anuncios') }}" class="nav-link">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>Anuncios</p>
            </a>
          </li>

          <!-- BOTON PARA LA PAGINA DEL SITIO WEB -->     
          <li class="nav-item">
            <a href="{{ substr(url('/'),0, -10) }}" class="nav-link" target="_blank">
              <i class="nav-icon fas fa-globe"></i>
              <p>Ver sitio</p>
            </a>
          </li>




        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>