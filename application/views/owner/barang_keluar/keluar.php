         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Barang Keluar</h1>
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

                                 <form method="GET" action="<?= base_url('barang-keluar') ?>">
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


                             <?php if ($this->session->userdata('hak_akses') == '3'): ?>
                                 <div class="card-tools">
                                     <!-- <button type="button" id="refreshButton" class="btn btn-sm btn-info"><i class="fas fa-sync fa-spin"></i> Show All Data</button> -->
                                     <a href="<?= base_url('barang-keluar/create') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
                                 </div>
                             <?php endif; ?>
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
                                         <th>Keterangan</th>
                                         <th>Qty</th>
                                         <th>Tanggal</th>
                                         <?php if ($this->session->userdata('hak_akses') == '3'): ?>
                                             <th>Action</th>
                                         <?php endif; ?>
                                     </tr>
                                 </thead>
                                 <tbody id="filteredDataOut">
                                     <?php if (!empty($stock)) { ?>
                                         <?php foreach ($stock as $index => $item) : ?>
                                             <tr>
                                                 <td><?= ($index + 1) ?></td>
                                                 <td><?= $item->barcode ?></td>
                                                 <td><?= $item->nama_item ?></td>
                                                 <td><?= $item->detail ?></td>
                                                 <td><?= $item->qty ?></td>
                                                 <td><?= tanggal_indonesia_lengkap($item->date) ?></td>
                                                 <?php if ($this->session->userdata('hak_akses') == '3'): ?>
                                                     <td>
                                                         <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modalUpdateOut"> Update</button>
                                                         <form action="<?= base_url('barang-keluar/delete') ?>" method="post" class="d-inline">
                                                             <input type="hidden" name="id_stock" value="<?= $item->id_stock ?>">
                                                             <input type="hidden" name="id_item" value="<?= $item->id_item ?>">
                                                             <button class="btn btn-outline-danger btn-sm tombol-hapus" type="submit">Delete</button>
                                                         </form>
                                                     </td>
                                                 <?php endif; ?>
                                             </tr>
                                         <?php endforeach; ?>
                                     <?php } else { ?>
                                         <tr>
                                             <td colspan="7" class="text-center">Tidak ada data yang tersedia....</td>
                                         </tr>
                                     <?php } ?>
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