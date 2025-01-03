<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo $_ENV['host.folder']; ?>" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === $_ENV['host.folder'] ? 'active' : ''; ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Inicio
              </p>
            </a>
          </li> 
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item <?php echo (in_array($_SERVER['REQUEST_URI'], [$_ENV['host.folder'].'demo-proveedores'])) ? 'menu-open' : '';?>">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Panel de control
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo $_ENV['host.folder']; ?>demo-proveedores" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === $_ENV['host.folder'].'demo-proveedores' ? 'active' : ''; ?>">
                  <i class="fas fa-laptop-code nav-icon"></i>
                  <p>Demo Proveedores</p>
                </a>
              </li>              
            </ul>
          </li>
        </ul>
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item <?php echo in_array($_SERVER['REQUEST_URI'], [$_ENV['host.folder'].'pob-pontevedra'],$_ENV['host.folder'].'pob-pontevedra-form') ? 'menu-open' : '';?>">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-laptop-code"></i>
                    <p>
                        Ejercicios CSV
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?php echo $_ENV['host.folder']; ?>pob-pontevedra" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === $_ENV['host.folder'].'pob-pontevedra' ? 'active' : ''; ?>">
                            <i class="fas fa-laptop-code nav-icon"></i>
                            <p>Ejercicios 01</p>
                        </a>
                    </li>
                </ul>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo $_ENV['host.folder']; ?>pob-pontevedra-form" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === $_ENV['host.folder'].'pob-pontevedra-form' ? 'active' : ''; ?>">
                          <i class="fas fa-laptop-code nav-icon"></i>
                          <p>Ejercicios 01 Form</p>
                      </a>
                  </li>
              </ul>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?php echo $_ENV['host.folder']; ?>usuarios/new" class="nav-link <?php echo $_SERVER['REQUEST_URI'] === $_ENV['host.folder'].'usuarios/new' ? 'active' : ''; ?>">
                          <i class="fas fa-laptop-code nav-icon"></i>
                          <p>Añadir formularios a nuestro MVC</p>
                      </a>
                  </li>
              </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->