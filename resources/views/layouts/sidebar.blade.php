<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link">
      <img src="{{asset('/assets/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sighaya</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->email}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('reports')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Incidents
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('users')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Utilisateurs
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('states')}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Wilayas
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('cities')}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Moughataas
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('regions')}}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Communes
                
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('manager-regions')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Managers
                
              </p>
            </a>
          </li>

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>