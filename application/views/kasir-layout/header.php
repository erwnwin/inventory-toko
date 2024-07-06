 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
         </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">

         <!-- Notifications Dropdown Menu -->
         <li class="nav-item dropdown">
             <a class="nav-link font-weight-bold text-black" style="color: black;" data-toggle="dropdown" href="#">
                 <i class="far fa-user-circle"></i> <i class="fas fa-dash"></i> Coba
             </a>

             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header text-bold text-solid">Direct Menu</span>

                 <div class="dropdown-divider"></div>
                 <a href="<?= base_url('logout') ?>" class="dropdown-item">
                     <i class="fas fa-power-off mr-2"></i> Logout

                 </a>


             </div>
         </li>

     </ul>
 </nav>
 <!-- /.navbar -->