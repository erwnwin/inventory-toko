         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Barang Masuk</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">

                     <div class="card card-default">
                         <div class="card-header">
                             <h3 class="card-title">Daftar Products Masuk</h3>

                             <div class="card-tools">
                                 <a href="<?= base_url('barang-masuk/create') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
                                 <!-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCreateKategori"><i class="fa fa-plus-circle"></i> Create</button> -->
                             </div>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table">
                                     <thead>
                                         <tr>
                                             <th style="width: 10px">#</th>
                                             <th>Barcode</th>
                                             <th>Nama Produk</th>
                                             <th>Detail</th>
                                             <th>Qty</th>
                                             <th>Tanggal</th>
                                             <th style="width: 130px">Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            $no = 1;
                                            foreach ($stock as $item) { ?>
                                             <tr>
                                                 <td><?= $no++; ?></td>
                                                 <td><?= $item->barcode ?></td>
                                                 <td><?= $item->nama_item ?></td>
                                                 <td><?= $item->detail ?></td>
                                                 <td><?= $item->qty ?></td>
                                                 <td><?= tanggal_indonesia_lengkap($item->date) ?></td>
                                                 <td>
                                                     <!-- <a href="<?= base_url('items/edit/' . encrypt_id($item->id_item)) ?>" class="btn btn-sm btn-outline-warning"> Edit </a> -->
                                                     <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#confirmDeleteModal"> Detail</button>
                                                     <form action="<?= base_url('barang-masuk/delete') ?>" method="post" class="d-inline">
                                                         <input type="hidden" name="id_stock" value="<?= $item->id_stock; ?>">
                                                         <input type="hidden" name="id_item" value="<?= $item->id_item; ?>">
                                                         <button class="btn btn-outline-danger btn-sm tombol-hapus" type="submit">
                                                             Delete
                                                         </button>
                                                     </form>
                                                     <!-- <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-item-id="<?= $item->id_item ?>" data-toggle="modal" data-target="#confirmDeleteModal"> Delete</button> -->
                                                 </td>
                                             </tr>
                                         <?php } ?>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>

                 </div>
             </section>
         </div>