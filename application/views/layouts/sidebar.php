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



                 <?php if ($this->session->userdata('hak_akses') == '2'): ?>
                     <li class="nav-header">Owner</li>


                     <li class="nav-item">
                         <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : ''
                                                                                ?>">
                             <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                             <i class="nav-icon fas fa-th-large"></i>
                             <p>
                                 Dashboard
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?= base_url('riwayat-penjualan') ?>" class="nav-link <?= $this->uri->segment(1) == 'riwayat-penjualan' ? 'active' : ''
                                                                                        ?>">
                             <i class="nav-icon fas fa-file-pdf"></i>
                             <p>
                                 Report Penjualan
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?= base_url('stok-produk') ?>" class="nav-link <?= $this->uri->segment(1) == 'stok-produk' ? 'active' : ''
                                                                                    ?>">
                             <i class="nav-icon fas fa-file-excel"></i>
                             <p>
                                 Report Stok
                             </p>
                         </a>
                     </li>
                 <?php endif; ?>



                 <?php if ($this->session->userdata('hak_akses') == '2'): ?>
                     <li class="nav-item">
                         <a href="<?= base_url('filter-laporan') ?>" class="nav-link <?= $this->uri->segment(1) == 'filter-laporan' ? 'active' : ''
                                                                                        ?>">
                             <i class="nav-icon fas fa-clipboard-list"></i>
                             <p>
                                 Report Barang
                             </p>
                         </a>
                     </li>
                 <?php elseif ($this->session->userdata('hak_akses') == '3') : ?>
                     <li class="nav-header">Petugas Toko</li>
                     <li class="nav-item">
                         <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : ''
                                                                                ?>">
                             <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                             <i class="nav-icon fas fa-th-large"></i>
                             <p>
                                 Dashboard
                             </p>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a href="<?= base_url('items') ?>" class="nav-link <?= $this->uri->segment(1) == 'items' ? 'active' : '' ?>">
                             <i class="nav-icon fas fa-clipboard-list"></i>
                             <p>
                                 Data Barang
                             </p>
                         </a>
                     </li>
                     <li class="nav-item <?= $this->uri->segment(1) == 'barang-masuk' || $this->uri->segment(1) == 'barang-keluar' ? 'menu-open' : '' ?>">
                         <a href="#" class="nav-link <?= $this->uri->segment(1) == 'barang-masuk' || $this->uri->segment(1) == 'barang-keluar' ? 'active' : '' ?>">
                             <i class="nav-icon fas fa-dolly-flatbed"></i>
                             <p>
                                 Inventory Barang
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
                     <li class="nav-item <?= $this->uri->segment(1) == 'riwayat-penjualan' || $this->uri->segment(1) == 'stok-produk' || $this->uri->segment(1) == 'filter-laporan' ? 'menu-open' : '' ?>">
                         <a href="#" class="nav-link <?= $this->uri->segment(1) == 'riwayat-penjualan' || $this->uri->segment(1) == 'stok-produk' || $this->uri->segment(1) == 'filter-laporan' ? 'active' : '' ?>">
                             <i class="nav-icon fas fa-chart-pie"></i>
                             <p>
                                 Report
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="<?= base_url('riwayat-penjualan') ?>" class="nav-link <?= $this->uri->segment(1) == 'riwayat-penjualan' ? 'active' : '' ?>">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Riwayat Penjualan</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="<?= base_url('stok-produk') ?>" class="nav-link <?= $this->uri->segment(1) == 'stok-produk' ? 'active' : '' ?>">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Stok Produk
                                         <span class="right badge badge-danger">terbaru</span>
                                     </p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="<?= base_url('filter-laporan') ?>" class="nav-link <?= $this->uri->segment(1) == 'filter-laporan' ? 'active' : '' ?>">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Report Barang
                                         <span class="right badge badge-warning">in/out</span>

                                     </p>
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
                 <?php endif; ?>


                 <?php if ($this->session->userdata('hak_akses') == '4'): ?>
                     <li class="nav-header">Admin</li>
                     <li class="nav-item">
                         <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : ''
                                                                                ?>">
                             <!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
                             <i class="nav-icon fas fa-th-large"></i>
                             <p>
                                 Dashboard
                             </p>
                         </a>
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

                     <li class="nav-item <?= $this->uri->segment(1) == 'riwayat-penjualan' || $this->uri->segment(1) == 'stok-produk' || $this->uri->segment(1) == 'filter-laporan' ? 'menu-open' : '' ?>">
                         <a href="#" class="nav-link <?= $this->uri->segment(1) == 'riwayat-penjualan' || $this->uri->segment(1) == 'stok-produk' || $this->uri->segment(1) == 'filter-laporan' ? 'active' : '' ?>">
                             <i class="nav-icon fas fa-chart-pie"></i>
                             <p>
                                 Report
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item">
                                 <a href="<?= base_url('riwayat-penjualan') ?>" class="nav-link <?= $this->uri->segment(1) == 'riwayat-penjualan' ? 'active' : '' ?>">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Riwayat Penjualan</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="<?= base_url('stok-produk') ?>" class="nav-link <?= $this->uri->segment(1) == 'stok-produk' ? 'active' : '' ?>">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Stok Produk
                                         <span class="right badge badge-danger">terbaru</span>
                                     </p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="<?= base_url('filter-laporan') ?>" class="nav-link <?= $this->uri->segment(1) == 'filter-laporan' ? 'active' : '' ?>">
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
                                 <?php if ($user_count > 0): ?>
                                     <span class="right badge badge-danger"><?= $user_count ?></span>
                                 <?php endif; ?>
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

                 <?php endif; ?>

                 <li class="nav-item">
                     <a href="<?= base_url('logout') ?>" class="nav-link">
                         <i class="nav-icon fas fa-power-off"></i>
                         <p>
                             Logout
                         </p>
                     </a>
                 </li>



             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>