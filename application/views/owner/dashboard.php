         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Dashboard</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">
                     <?php if (
                            $this->session->userdata('hak_akses') == '2'
                        ) { ?>
                         <div class="callout callout-success bg-success">
                             <h5>Welcome! <?= $this->session->userdata('nama_user') ?></h5>
                             <hr>
                             <p>Anda login sebagai OWNER TOKO</p>
                         </div>



                         <div class="row">
                             <div class="col-md-12">
                                 <div class="card">
                                     <div class="card-header">
                                         <div class="d-flex justify-content-between align-items-center">
                                             <h3 class="card-title">Monthly Sales Statistics</h3>
                                             <form method="GET" action="<?php echo base_url('dashboard'); ?>">
                                                 <div class="input-group input-group-sm">
                                                     <select name="month" class="form-control">
                                                         <?php foreach ($months as $m): ?>
                                                             <option value="<?php echo $m['month']; ?>" <?php echo ($m['month'] == date('m')) ? 'selected' : ''; ?>><?php echo $m['name']; ?></option>
                                                         <?php endforeach; ?>
                                                     </select>
                                                     <select name="year" class="form-control">
                                                         <?php foreach ($years as $y): ?>
                                                             <option value="<?php echo $y['year']; ?>" <?php echo ($y['year'] == date('Y')) ? 'selected' : ''; ?>><?php echo $y['year']; ?></option>
                                                         <?php endforeach; ?>
                                                     </select>
                                                     <!-- <input type="text" class="form-control" placeholder="Search Mail"> -->
                                                     <div class="input-group-append">
                                                         <button class="btn btn-default" type="submit">
                                                             <i class="fas fa-search"></i> Filter
                                                         </button>
                                                     </div>
                                                 </div>

                                             </form>

                                         </div>
                                     </div>
                                     <div class="card-body">
                                         <canvas id="salesChart"></canvas>
                                     </div>
                                 </div>
                             </div>
                         </div>

                     <?php } ?>

                     <?php if (
                            $this->session->userdata('hak_akses') == '3'
                        ) { ?>
                         <div class="callout callout-info bg-info">
                             <h5>Welcome!</h5>
                             <hr>
                             <p>Anda login sebagai PETUGAS TOKO</p>
                         </div>


                         <div class="row">
                             <div class="col-md-12">
                                 <div class="card">
                                     <div class="card-header">
                                         <div class="d-flex justify-content-between align-items-center">
                                             <h3 class="card-title">Monthly Sales Statistics</h3>
                                             <form method="GET" action="<?php echo base_url('dashboard'); ?>">
                                                 <div class="input-group input-group-sm">
                                                     <select name="month" class="form-control">
                                                         <?php foreach ($months1 as $m): ?>
                                                             <option value="<?php echo $m['month']; ?>" <?php echo ($m['month'] == date('m')) ? 'selected' : ''; ?>><?php echo $m['name']; ?></option>
                                                         <?php endforeach; ?>
                                                     </select>
                                                     <select name="year" class="form-control">
                                                         <?php foreach ($years1 as $y): ?>
                                                             <option value="<?php echo $y['year']; ?>" <?php echo ($y['year'] == date('Y')) ? 'selected' : ''; ?>><?php echo $y['year']; ?></option>
                                                         <?php endforeach; ?>
                                                     </select>
                                                     <!-- <input type="text" class="form-control" placeholder="Search Mail"> -->
                                                     <div class="input-group-append">
                                                         <button class="btn btn-default" type="submit">
                                                             <i class="fas fa-search"></i> Filter
                                                         </button>
                                                     </div>
                                                 </div>

                                             </form>

                                         </div>
                                     </div>
                                     <div class="card-body">
                                         <canvas id="stockChart"></canvas>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     <?php } ?>


                     <?php if (
                            $this->session->userdata('hak_akses') == '4'
                        ) { ?>
                         <div class="callout callout-primary bg-primary">
                             <h5>Welcome!</h5>
                             <hr>
                             <p>Anda login sebagai ADMIN Sistem</p>
                         </div>
                     <?php } ?>




                     <!-- <div class="row">
                         <div class="col-lg-3 col-6">
                             <div class="small-box bg-info">
                                 <div class="inner">
                                     <h3>150</h3>

                                     <p>New Orders</p>
                                 </div>
                                 <div class="icon">
                                     <i class="ion ion-bag"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                             </div>
                         </div>
                         <div class="col-lg-3 col-6">
                             <div class="small-box bg-success">
                                 <div class="inner">
                                     <h3>53<sup style="font-size: 20px">%</sup></h3>

                                     <p>Bounce Rate</p>
                                 </div>
                                 <div class="icon">
                                     <i class="ion ion-stats-bars"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                             </div>
                         </div>
                         <div class="col-lg-3 col-6">
                             <div class="small-box bg-warning">
                                 <div class="inner">
                                     <h3>44</h3>

                                     <p>User Registrations</p>
                                 </div>
                                 <div class="icon">
                                     <i class="ion ion-person-add"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                             </div>
                         </div>
                         <div class="col-lg-3 col-6">
                             <div class="small-box bg-danger">
                                 <div class="inner">
                                     <h3>65</h3>

                                     <p>Unique Visitors</p>
                                 </div>
                                 <div class="icon">
                                     <i class="ion ion-pie-graph"></i>
                                 </div>
                                 <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                             </div>
                         </div>
                     </div> -->
                 </div>
             </section>
             <div>
                 <br>
             </div>
         </div>