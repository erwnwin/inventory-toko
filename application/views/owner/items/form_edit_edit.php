         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Create Item Products</h1>
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
                                     <h3 class="card-title">Form Edit Item Products</h3>

                                     <div class="card-tools">
                                         <a href="<?= base_url('items') ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>

                                     </div>
                                 </div>
                                 <div class="card-body p-0">
                                     <form class="form-horizontal" id="editItemProducts" enctype="multipart/form-data">
                                         <div class="card-body">
                                             <div class="form-group row">
                                                 <label for="inputEmail3" class="col-sm-4 col-form-label">Barcode / Kode Product</label>
                                                 <div class="col-sm-8">
                                                     <input type="hidden" name="id_item" class="form-control" id="id_item" value="<?php echo $produk->id_item; ?>" readonly autocomplete="off" required>
                                                     <input type="text" name="barcode" class="form-control" id="barcode" value="<?php echo $produk->barcode; ?>" readonly autocomplete="off" required>
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <label for="inputPassword3" class="col-sm-4 col-form-label">Nama Item Produk</label>
                                                 <div class="col-sm-8">
                                                     <input type="text" name="nama_produk" class="form-control" id="nama_produk" value="<?php echo $produk->nama_produk; ?>" autocomplete="off" placeholder="Nama Produk">
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <label for="inputPassword3" class="col-sm-4 col-form-label">Stok Tersedia</label>
                                                 <div class="col-sm-8">
                                                     <input type="text" name="stock" class="form-control" id="stock" value="<?php echo $produk->stock; ?>" autocomplete="off" placeholder="Nama Produk" readonly>
                                                 </div>
                                             </div>


                                             <div class="form-group row">
                                                 <label for="id_kategori" class="col-sm-4 col-form-label">Kategori</label>
                                                 <div class="col-sm-8">
                                                     <select id="id_kategori" class="form-control" name="id_kategori">
                                                         <option value="">Pilih Kategori</option>
                                                         <?php foreach ($kategori as $item) { ?>
                                                             <option value="<?= $item->id_kategori ?>" <?= ($item->id_kategori == $produk->id_kategori) ? 'selected' : '' ?>>
                                                                 <?= $item->nama_kategori ?>
                                                             </option>
                                                         <?php } ?>
                                                     </select>
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <label for="id_unit" class="col-sm-4 col-form-label">Unit</label>
                                                 <div class="col-sm-8">
                                                     <select id="id_unit" class="form-control" name="id_unit">
                                                         <option value="">Pilih Unit</option>
                                                         <?php foreach ($unit as $item) { ?>
                                                             <option value="<?= $item->id_unit ?>" <?= ($item->id_unit == $produk->id_unit) ? 'selected' : '' ?>>
                                                                 <?= $item->nama_unit ?>
                                                             </option>
                                                         <?php } ?>
                                                     </select>
                                                 </div>
                                             </div>


                                             <div class="form-group row">
                                                 <label for="inputEmail3" class="col-sm-4 col-form-label">Harga</label>
                                                 <div class="col-sm-8">
                                                     <input type="number" name="price" class="form-control" id="price" value="<?php echo $produk->price; ?>" placeholder="Enter number" autocomplete="off">
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <label for="inputEmail3" class="col-sm-4 col-form-label">Gambar</label>
                                                 <div class="col-sm-8">
                                                     <input type="file" class="form-control" name="gambar" id="gambar" accept=".jpg, .jpeg, .png">
                                                     <div id="imagePreviewContainer" style="display: none;">
                                                         <img src="#" id="imagePreview" class="preview-image">
                                                         <br>
                                                         <span id="removeImage" class="remove-image btn-sm btn-danger">Remove Image</span>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <!-- /.card-body -->
                                         <div class="card-footer">
                                             <!-- <button type="submit" class="btn btn-info">Sign in</button> -->
                                             <button type="submit" class="btn btn-success btn-sm float-right" id="btnUpdateItem">
                                                 Update
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

         </div>