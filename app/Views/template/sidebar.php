
<?php //dd(session()->get('count')) ?>
<!-- Main Sidebar Container -->
  <aside  style="position: fixed; height: 100vh;" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
      <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Inventory</span>
    </a>
   
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
          <img src="<?php echo session()->get('foto_user');?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/profile" class="d-block"><?= session()->get('username')?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">MENU</li>
          <?php if(session()->get('id_role') == 1) : ?>
          <li class="nav-item">
            <a href="/users" class="nav-link <?php if(uri_string() == 'users') echo 'active'?>">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Users
                <span class="badge badge-info right"><?= session()->get('count')?> user</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/logs" class="nav-link <?php if(uri_string() == 'logs') echo 'active'?>">
              <i class="nav-icon fas fa-clock"></i>
              <p>
                Monitor Logs
              </p>
            </a>
          </li>
          <?php endif ?>
          
          <?php if(session()->get('id_role') == 1 || session()->get('id_role') == 2) : ?>
          <li class="nav-item">
            <a href="/attributes" class="nav-link <?php if(uri_string() == 'attributes') echo 'active'?>">
            <i class="nav-icon fas fa-list-ul"></i>
            <!-- <i class="nav-icon far fa-image"></i> -->
              <p>
                Attributes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/brands" class="nav-link">
            <i class="nav-icon fab fa-product-hunt"></i>
            <!-- <i class="nav-icon far fa-image"></i> -->
              <p>
                Brands
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/productcategory" class="nav-link">
            <i class="nav-icon fas fa-layer-group"></i>
            <!-- <i class="nav-icon far fa-image"></i> -->
              <p>
                Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/products" class="nav-link">
            <i class="nav-icon fas fa-tshirt"></i>
            <!-- <i class="nav-icon far fa-image"></i> -->
              <p>
                Products
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/reports" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
          <?php endif ?>
          <?php if(session()->get('id_role') == 3 ) : ?>
            <li class="nav-item menu-open">
              <div class="nav-link">
                <i class="nav-icon fas fa-money-bill"></i>  
                <p>
                  Transactions
                  <i class="right fas fa-angle-left"></i>
                </p>
              </div>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/transactions" class="nav-link <?php if(uri_string() == 'transactions') echo 'active'?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Transaction</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/todaytransactions" class="nav-link  <?php if(uri_string() == 'todaytransactions') echo 'active'?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Today's Transactions </p>
                </a>
              </li>
            </ul>
            </li>
            <?php endif ?>
          <li class="nav-item">
            <a href="/logout" class="nav-link">
            <i class="nav-icon fa fas fa-sign-out-alt"></i>  
            <p>
                Log Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>