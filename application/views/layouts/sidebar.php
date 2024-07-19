 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="" class="brand-link">
         <!-- <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>public/img/icon.png"> -->
         <img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light font-weight-bold text-center" style="font-size: 1.2rem; font-weight: bold">OPTIK FADHEL</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                 <li class="nav-header ">Pengguna</li>
                 <li class="nav-item">
                     <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : ''
                                                                            ?>">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?= base_url('profil') ?>" class="nav-link <?= $this->uri->segment(1) == 'profil' ? 'active' : ''
                                                                            ?>">
                         <i class="nav-icon fas fa-user-circle"></i>
                         <p>
                             Profil
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('info-apps') ?>" class="nav-link <?= $this->uri->segment(1) == 'info-apps' ? 'active' : ''
                                                                            ?>">
                         <i class="nav-icon fas fa-info-circle"></i>
                         <p>
                             Info Apps
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('logout') ?>" class="nav-link">
                         <i class="nav-icon fas fa-power-off"></i>
                         <p>
                             Logout
                         </p>
                     </a>
                 </li>
                 

                 <li class="nav-header">Owner</li>
                 <li class="nav-item <?= $this->uri->segment(1) == 'barang-masuk' || $this->uri->segment(1) == 'barang-keluar' ? 'menu-open' : '' ?>">
                     <a href="#" class="nav-link <?= $this->uri->segment(1) == 'barang-masuk' || $this->uri->segment(1) == 'barang-keluar' ? 'active' : '' ?>">
                         <i class="nav-icon fas fa-shopping-cart"></i>
                         <p>
                             Transaksi
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="<?= base_url('barang-masuk') ?>" class="nav-link <?= $this->uri->segment(1) == 'barang-masuk' ? 'active' : '' ?>">
                                 <i class="fas fa-arrow-right nav-icon"></i>
                                 <p>Barang Masuk</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="<?= base_url('barang-keluar') ?>" class="nav-link <?= $this->uri->segment(1) == 'barang-keluar' ? 'active' : '' ?>">
                                 <i class="fas fa-arrow-left nav-icon"></i>
                                 <p>Barang Keluar</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 <li class="nav-item <?= $this->uri->segment(1) == 'kategori' || $this->uri->segment(1) == 'units' || $this->uri->segment(1) == 'items' ? 'menu-open' : '' ?>">
                     <a href="#" class="nav-link <?= $this->uri->segment(1) == 'kategori' ||  $this->uri->segment(1) == 'units' || $this->uri->segment(1) == 'items' ? 'active' : '' ?>">
                         <i class="nav-icon fas fa-table"></i>
                         <p>
                             Produk
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="<?= base_url('kategori') ?>" class="nav-link <?= $this->uri->segment(1) == 'kategori' ? 'active' : '' ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Kategori</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="<?= base_url('units') ?>" class="nav-link <?= $this->uri->segment(1) == 'units' ? 'active' : '' ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Units</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="<?= base_url('items') ?>" class="nav-link <?= $this->uri->segment(1) == 'items' ? 'active' : '' ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Items Products</p>
                             </a>
                         </li>
                     </ul>
                 </li>


                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-chart-pie"></i>
                         <p>
                             Report
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="../layout/top-nav.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Riwayat Penjualan</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="../layout/top-nav-sidebar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Stok Produk</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="../layout/top-nav-sidebar.html" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Filter Laporan</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="<?= base_url('supplier') ?>" class="nav-link <?= $this->uri->segment(1) == 'supplier' ? 'active' : ''
                                                                            ?>">
                         <i class="nav-icon fas fa-users"></i>
                         <p>
                             Supplier

                         </p>
                     </a>
                 </li>

                 <li class="nav-header">Setting</li>
                 <li class="nav-item">
                     <a href="<?= base_url('users') ?>" class="nav-link <?= $this->uri->segment(1) == 'users' ? 'active' : ''
                                                                        ?>">
                         <i class="nav-icon fas fa-users"></i>
                         <p>
                             Users
                             <span class="right badge badge-danger">2</span>
                         </p>
                     </a>
                 </li>


                 <!-- STAF TOKO -->


             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>