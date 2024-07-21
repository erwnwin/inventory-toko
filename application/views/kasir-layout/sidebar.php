 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="" class="brand-link">
         <img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light font-weight-bold text-center" style="font-size: 1.2rem; font-weight: bold">OPTIK FADHEL</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                 <li class="nav-header ">Menu Transaksi</li>
                 <!-- <li class="nav-item">
                     <a href="<?= base_url('dashboard') ?>" class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? 'active' : ''
                                                                            ?>">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li> -->

                 <li class="nav-item">
                     <a href="<?= base_url('apps-kasir') ?>" class="nav-link <?= $this->uri->segment(1) == 'apps-kasir' ? 'active' : ''
                                                                                ?>">
                         <!-- <i class="nav-icon fas fa-shopping-cart"></i> -->
                         <i class="nav-icon fas fa-cash-register"></i>
                         <p>
                             Transaksi
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?= base_url('history-transaksi') ?>" class="nav-link <?= $this->uri->segment(1) == 'history-transaksi' ? 'active' : ''
                                                                                    ?>">
                         <!-- <i class="nav-icon fas fa-shopping-cart"></i> -->
                         <i class="nav-icon fas fa-file-alt"></i>
                         <p>
                             History Transaksi
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

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>