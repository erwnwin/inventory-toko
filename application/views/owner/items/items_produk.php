         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Items Produk</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">

                     <div class="card card-default">
                         <div class="card-header">
                             <h3 class="card-title">Daftar Item Products</h3>

                             <div class="card-tools">
                                 <a href="<?= base_url('items/create') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
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
                                             <th>Nama Barang/Produk</th>
                                             <th>Kategori</th>
                                             <th>Unit</th>
                                             <th>Harga</th>
                                             <th>Stok</th>
                                             <th>Gambar</th>
                                             <th style="width: 130px">Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            $no = 1;
                                            // $generator = new BarcodeGeneratorHTML();
                                            foreach ($product as $item) { ?>
                                             <tr>
                                                 <td><?= $no++; ?></td>
                                                 <td><?= $item->nama_produk ?></td>
                                                 <td><?= $item->name_category ?></td>
                                                 <td><?= $item->name_unit ?></td>
                                                 <td><?= indo_currency($item->price) ?></td>
                                                 <td><?= $item->stock ?></td>
                                                 <td>
                                                     <img src="<?php echo base_url('public/upload/' . $item->gambar); ?>" alt="" width="50px" height="50px">
                                                 </td>
                                                 <td>
                                                     <a href="<?= base_url('items/edit/' . encrypt_id($item->id_item)) ?>" class="btn btn-sm btn-outline-warning"> Edit </a>
                                                     <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-item-id="<?= $item->id_item ?>" data-toggle="modal" data-target="#confirmDeleteModal"> Delete</button>
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