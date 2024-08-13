         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Data Suppliers</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">
                     <div class="card card-default">
                         <div class="card-header">
                             <h3 class="card-title">Daftar Suppliers</h3>

                             <div class="card-tools">
                                 <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCreateSupplier"><i class="fa fa-plus-circle"></i> Create</button>
                             </div>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table">
                                     <thead>
                                         <tr>
                                             <th style="width: 10px">#</th>
                                             <th>Nama Supplier</th>
                                             <th>No HP/WA Supplier</th>
                                             <th>Alamat Supplier</th>
                                             <th style="width: 130px">Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php if (!empty($supplier)) : ?>

                                             <?php
                                                $no = 1;
                                                foreach ($supplier as $item) { ?>
                                                 <tr>
                                                     <td><?= $no++; ?></td>
                                                     <td><?= $item->nama_supplier ?></td>
                                                     <td><?= $item->no_hp_wa ?></td>
                                                     <td><i class="fas fa-map-marker-alt"></i> <?= $item->alamat_supplier ?></td>
                                                     <td>
                                                         <button type="button" data-toggle="modal" data-target="#modalEditSupplier<?= $item->id_supplier ?>" class="btn btn-sm btn-outline-warning"> Edit </button>
                                                         <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-item-id="<?= $item->id_supplier ?>" data-toggle="modal" data-target="#confirmDeleteModal"> Delete</button>
                                                     </td>
                                                 </tr>
                                             <?php } ?>

                                         <?php else : ?>
                                             <tr>
                                                 <td colspan="5" class="text-center"> Tidak ada data ...</td>
                                             </tr>
                                         <?php endif; ?>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
             </section>

             <div>
                 <br>
             </div>

         </div>

         <div class="modal fade" id="modalCreateSupplier">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h4 class="modal-title">Form Create Supplier</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form class="form-horizontal" id="formSupplier">
                             <div class="card-body">
                                 <div class="form-group row">
                                     <label for="inputEmail3" class="col-sm-5 col-form-label">Nama Supplier</label>
                                     <div class="col-sm-7">
                                         <input type="text" name="nama_supplier" class="form-control" id="nama_supplier" placeholder="Nama Suppliers" autocomplete="off" required>
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="inputEmail3" class="col-sm-5 col-form-label">Alamat Supplier</label>
                                     <div class="col-sm-7">
                                         <input type="text" name="alamat_supplier" class="form-control" id="alamat_supplier" placeholder="Alamat Suppliers" autocomplete="off" required>
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="inputEmail3" class="col-sm-5 col-form-label">No HP/WA Supplier</label>
                                     <div class="col-sm-7">
                                         <input type="text" name="no_hp_wa" maxlength="12" class="form-control" id="no_hp_wa" pattern="[0-9]*" title="Hanya angka yang diperbolehkan" placeholder="No HP/WA Suppliers" autocomplete="off" required>
                                         <span class="text-small" id="error" style="color: red;"></span>
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <label for="inputEmail3" class="col-sm-5 col-form-label">Deskripsi Supplier</label>
                                     <div class="col-sm-7">
                                         <textarea class="form-control" name="desk_supplier" id="desk_supplier" placeholder="Deskripsi supplier"></textarea>
                                         <!-- <input type="text" name="nama_unit" class="form-control" id="nama_unit" placeholder="Units" autocomplete="off" required> -->
                                         <span class="text-small" style="color: red;">*Opsional</span>
                                     </div>
                                 </div>
                             </div>
                     </div>
                     <div class="modal-footer justify-content-between">
                         <button type="submit" class="btn btn-primary btn-sm" id="btnSaveSupplier">Simpan</button>
                         <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                     </div>
                     </form>
                 </div>
                 <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
         </div>

         <!-- Edit Supplier Modal -->
         <?php foreach ($supplier as $item) { ?>
             <div class="modal fade" id="modalEditSupplier<?= $item->id_supplier ?>" tabindex="-1" role="dialog" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="editSupplierModalLabel">Form Edit Supplier</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-body">
                             <form class="form-horizontal" id="formEditSupplier">
                                 <div class="card-body">
                                     <input type="hidden" id="id_supplier" name="id_supplier" value="<?= $item->id_supplier ?>"> <!-- Hidden field for supplier ID -->
                                     <div class="form-group row">
                                         <label for="edit_nama_supplier" class="col-sm-5 col-form-label">Nama Supplier</label>
                                         <div class="col-sm-7">
                                             <input type="text" name="nama_supplier" class="form-control" id="edit_nama_supplier" value="<?= $item->nama_supplier ?>" placeholder="Nama Supplier" autocomplete="off" required>
                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <label for="edit_alamat_supplier" class="col-sm-5 col-form-label">Alamat Supplier</label>
                                         <div class="col-sm-7">
                                             <input type="text" name="alamat_supplier" class="form-control" id="edit_alamat_supplier" value="<?= $item->alamat_supplier ?>" placeholder="Alamat Supplier" autocomplete="off" required>
                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <label for="edit_no_hp_wa" class="col-sm-5 col-form-label">No HP/WA Supplier</label>
                                         <div class="col-sm-7">
                                             <input type="text" name="no_hp_wa" maxlength="12" class="form-control" id="edit_no_hp_wa" value="<?= $item->no_hp_wa ?>" pattern="[0-9]*" title="Hanya angka yang diperbolehkan" placeholder="No HP/WA Supplier" autocomplete="off" required>
                                             <span class="text-small" id="edit_error" style="color: red;"></span>
                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <label for="edit_desk_supplier" class="col-sm-5 col-form-label">Deskripsi Supplier</label>
                                         <div class="col-sm-7">
                                             <textarea class="form-control" name="desk_supplier" id="edit_desk_supplier" placeholder="Deskripsi Supplier"><?= $item->desk_supplier ?></textarea>
                                             <span class="text-small" style="color: red;">*Opsional</span>
                                         </div>
                                     </div>
                                 </div>
                         </div>
                         <div class="modal-footer justify-content-between">
                             <button type="submit" class="btn btn-primary btn-sm" id="btnUpdateSupplier">Update</button>
                             <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                         </div>
                         </form>
                     </div>
                     <!-- /.modal-content -->
                 </div>
                 <!-- /.modal-dialog -->
             </div>
             <!-- /.modal -->
         <?php } ?>