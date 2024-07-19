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
                     <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>">
                     </div>

                     <div class="card card-default">
                         <div class="card-header">
                             <div class="card-title">
                                 <form id="filterForm">
                                     <div class="input-group input-group-sm">
                                         <select id="bulan" name="bulan" class="form-control" required>
                                             <option value="">Pilih Bulan</option>
                                             <option value="1">Januari</option>
                                             <option value="2">Februari</option>
                                             <option value="3">Maret</option>
                                             <option value="4">April</option>
                                             <option value="5">Mei</option>
                                             <option value="6">Juni</option>
                                             <option value="7">Juli</option>
                                             <option value="8">Agustus</option>
                                             <option value="9">September</option>
                                             <option value="10">Oktober</option>
                                             <option value="11">November</option>
                                             <option value="12">Desember</option>
                                         </select>
                                         <input type="text" id="tahun" name="tahun" class="form-control" min="2000" max="2099" maxlength="4" value="<?php echo date('Y'); ?>">
                                         <!-- <input type="text" class="form-control" placeholder="Search Mail"> -->
                                         <div class="input-group-append">
                                             <button class="btn btn-secondary" type="submit">
                                                 <i class="fas fa-search"></i> Filter
                                             </button>
                                         </div>
                                     </div>
                                     <span class="text-small" id="amount_error" style="color: red; font-size: 13px;"></span>
                                     <span class="text-small" id="error" style="color: red; font-size: 13px;"></span>
                                 </form>
                             </div>


                             <div class="card-tools">
                                 <!-- <button type="button" id="refreshButton" class="btn btn-sm btn-info"><i class="fas fa-sync fa-spin"></i> Show All Data</button> -->
                                 <a href="<?= base_url('barang-masuk/create') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
                             </div>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <!-- <div class="table-responsive">
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

                                                     <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#confirmDeleteModal"> Detail</button>
                                                     <form action="<?= base_url('barang-masuk/delete') ?>" method="post" class="d-inline">
                                                         <input type="hidden" name="id_stock" value="<?= $item->id_stock; ?>">
                                                         <input type="hidden" name="id_item" value="<?= $item->id_item; ?>">
                                                         <button class="btn btn-outline-danger btn-sm tombol-hapus" type="submit">
                                                             Delete
                                                         </button>
                                                     </form>
                                                 </td>
                                             </tr>
                                         <?php } ?>
                                     </tbody>
                                 </table>
                             </div> -->

                             <div id="filteredData">
                                 <?php if (!empty($stock)) : ?>
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
                                                             <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modalUpdateIn"> Detail</button>
                                                             <form action="<?= base_url('barang-masuk/delete') ?>" method="post" class="d-inline">
                                                                 <input type="hidden" name="id_stock" value="<?= $item->id_stock; ?>">
                                                                 <input type="hidden" name="id_item" value="<?= $item->id_item; ?>">
                                                                 <button class="btn btn-outline-danger btn-sm tombol-hapus" type="submit">Delete</button>
                                                             </form>
                                                         </td>
                                                     </tr>
                                                 <?php } ?>
                                             </tbody>
                                         </table>
                                     </div>

                                 <?php else : ?>
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
                                                 <tr>
                                                     <td colspan="7" class="text-center">Tidak ada data disini</td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                     </div>
                                 <?php endif; ?>
                             </div>
                         </div>
                     </div>
                 </div>


                 <div>
                     <br>
                 </div>

             </section>
         </div>