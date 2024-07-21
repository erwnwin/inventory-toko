         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>History Transaksi</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">
                     <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>">
                     </div>
                     <div class="card card-default">
                         <div class="card-header">
                             <div class="card-title">

                                 <form>
                                     <div class="input-group input-group-sm">
                                         <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai">
                                         <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai">
                                         <!-- <input type="text" class="form-control" placeholder="Search Mail"> -->
                                         <div class="input-group-append">
                                             <button class="btn btn-default" type="submit">
                                                 <i class="fas fa-search"></i> Filter
                                             </button>
                                         </div>
                                     </div>
                                     <span class="text-small" id="amount_error" style="color: red; font-size: 13px;"></span>
                                     <span class="text-small" id="error" style="color: red; font-size: 13px;"></span>
                                 </form>
                             </div>


                             <!-- <div class="card-tools">
                                 <button type="button" id="refreshButton" class="btn btn-sm btn-info"><i class="fas fa-sync fa-spin"></i> Show All Data</button>
                                 <a href="<?= base_url('barang-masuk/create') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
                             </div> -->
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <div id="loading" style="display: none; text-align: center;">
                                 <img src="<?= base_url('public/gif/load-1.gif') ?>" width="120px" style="position: relative;" alt="" title="Loading.....">
                             </div>
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th>#</th>
                                         <th>Barcode</th>
                                         <th>Nama Produk</th>
                                         <th>Detail</th>
                                         <th>Qty</th>
                                         <th>Tanggal</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>



                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>


                 <div>
                     <br>
                 </div>

             </section>
         </div>