<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link navbar-light">
        <img src="<?= base_url('assets/img/logo.jpg') ?>" alt="Reacsa Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">REACSA CMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><?= $this->session->nombre ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <?/*<div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>*/?>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-legacy nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <? $url = base_url($this->router->fetch_class().'/'.$this->router->fetch_method()); ?>
                    <a href="<?= base_url('dashboard/index') ?>" class="nav-link <?= ($url == base_url('dashboard/index')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                    <!-- <a href="<?= base_url('imagenes/cargar') ?>" class="nav-link <?= ($url == base_url('imagenes/cargar')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Cargar imagenes
                        </p>
                    </a> -->
                    <a href="<?= base_url('clientes/index') ?>" class="nav-link <?= ($url == base_url('clientes/index')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Clientes
                        </p>
                    </a>
                    <a href="<?= base_url('productos/index') ?>" class="nav-link <?= ($url == base_url('productos/index')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Productos
                        </p>
                    </a>
                    <a href="<?= base_url('sucursales/index') ?>" class="nav-link <?= ($url == base_url('sucursales/index')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Sucursales
                        </p>
                    </a>
                    <a href="<?= base_url('usuarios/index') ?>" class="nav-link <?= ($url == base_url('usuarios/index')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Usuarios
                        </p>
                    </a>
                    <a href="<?= base_url('notificaciones/index') ?>" class="nav-link <?= ($url == base_url('notificaciones/index')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            Notificaciones
                        </p>
                    </a>
                    <a href="<?= base_url('banners/index') ?>" class="nav-link <?= ($url == base_url('banners/index')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Banners
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
    </section>