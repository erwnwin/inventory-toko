         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Create Products Keluar</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">

                     <div class="row">
                         <div class="col-lg-2">

                         </div>
                         <!-- ./col -->

                         <div class="col-lg-8 col-12">
                             <!-- Default box -->
                             <div class="card">
                                 <div class="card-header">
                                     <h3 class="card-title">Form Create Products Keluar</h3>

                                     <div class="card-tools">
                                         <a href="<?= base_url('barang-masuk') ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>

                                     </div>
                                 </div>
                                 <div class="card-body p-0">
                                     <!-- <form class="form-horizontal" id="createBarangKeluar" action="<?= base_url('barang-masuk/store') ?>" method="post"> -->
                                     <form class="form-horizontal" id="createBarangKeluar">
                                         <div class="card-body">
                                             <div class="form-group row">
                                                 <label for="inputPassword3" class="col-sm-4 col-form-label">Tanggal</label>
                                                 <div class="col-sm-8">
                                                     <input type="date" name="date" class="form-control" id="date" autocomplete="off" value="<?= date('Y-m-d') ?>">
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <label for="inputEmail3" class="col-sm-4 col-form-label">Barcode / Kode Product</label>
                                                 <div class="col-sm-8">
                                                     <div class="input-group">
                                                         <input type="hidden" class="form-control" name="id_item" id="id_item">
                                                         <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Klik icon search" aria-describedby="basic" autofocus>
                                                         <div class="input-group-append">
                                                             <span>
                                                                 <button type="button" class="input-group-text btn btn-info btn-flat form-control" data-toggle="modal" data-target="#modal-item"><i class="fa fa-search" id="basic"></i></button>
                                                             </span>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <label for="inputPassword3" class="col-sm-4 col-form-label">Detail Product</label>
                                                 <div class="col-sm-8">
                                                     <input type="text" name="nama_produk" class="form-control" id="nama_produk" autofocus readonly>
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <label for="inputPassword3" class="col-sm-4 col-form-label"></label>
                                                 <div class="col-sm-8">
                                                     <div class="row">
                                                         <div class="col-sm-7">
                                                             <span class="text-danger text-small font-weight-bold">Unit Product</span>
                                                             <input type="text" name="nama_unit" id="nama_unit" class="form-control" value="-" readonly autofocus>

                                                         </div>
                                                         <div class="col-sm-5">
                                                             <span class="text-danger text-small font-weight-bold">Stok Product</span>
                                                             <input type="text" name="stock" id="stock" class="form-control" value="-" readonly autofocus>

                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <label for="inputPassword3" class="col-sm-4 col-form-label">Info</label>
                                                 <div class="col-sm-8">
                                                     <input type="text" name="detail" class="form-control" id="detail" placeholder="Rusak / Hilang / dll" autofocus>
                                                 </div>
                                             </div>


                                             <div class="form-group row">
                                                 <label for="inputPassword3" class="col-sm-4 col-form-label">Qty / Jumlah Masuk</label>
                                                 <div class="col-sm-8">
                                                     <input type="number" name="qty" id="qty" class="form-control" placeholder="Qty / jumlah masuk" autofocus>
                                                 </div>
                                             </div>

                                         </div>
                                         <!-- /.card-body -->
                                         <div class="card-footer">
                                             <!-- <button type="submit" class="btn btn-info">Sign in</button> -->
                                             <button type="submit" class="btn btn-success btn-sm float-right" id="btnSaveBarangKeluar">
                                                 Simpan
                                             </button>
                                         </div>

                                     </form>

                                 </div>
                             </div>
                         </div>
                         <!-- ./col -->

                         <div class="col-lg-2">

                         </div>
                         <!-- ./col -->
                     </div>
                 </div>
             </section>

             <div>
                 <br>
             </div>
         </div>


         <div class="modal fade" id="modal-item">
             <div class="modal-dialog modal-lg">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h4 class="modal-title">Pilih Item Product</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body table-responsive">
                         <div class="container-fluid">
                             <table class="table table-sm table-bordered table-striped" id="example2">
                                 <thead>
                                     <tr class="text-center">
                                         <th>Barcode</th>
                                         <th>Nama Product</th>
                                         <th>Unit</th>
                                         <th>Harga</th>
                                         <th>Stock</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php foreach ($product as $i) { ?>
                                         <tr>
                                             <td class="text-center"><?= $i->barcode; ?></td>
                                             <td><?= $i->nama_produk; ?></td>
                                             <td style="text-align: center;"><?= $i->name_unit; ?></td>
                                             <td style="text-align: center;"><?= indo_currency($i->price); ?></td>
                                             <td style="text-align: center;"><?= $i->stock; ?></td>
                                             <td align="center">
                                                 <button class="btn btn-xs btn-info" id="select" data-id="<?= $i->id_item; ?>" data-barcode="<?= $i->barcode; ?>" data-name="<?= $i->nama_produk; ?>" data-unit="<?= $i->name_unit; ?>" data-stock="<?= $i->stock; ?>">
                                                     <i class="fa fa-check"></i> Pilih Item
                                                 </button>
                                             </td>
                                         </tr>
                                     <?php } ?>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <!-- <button type="button" class="btn btn-primary btn-sm" id="btnSaveBarangKeluarSelect">Simpan</button> -->
                         <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                     </div>
                 </div>
             </div>
         </div>