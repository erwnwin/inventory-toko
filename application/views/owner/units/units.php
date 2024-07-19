         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Data Units</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">
                     <div class="card card-default">
                         <div class="card-header">
                             <h3 class="card-title">Daftar Units</h3>

                             <div class="card-tools">
                                 <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalCreateUnits"><i class="fa fa-plus-circle"></i> Create</button>
                             </div>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table">
                                     <thead>
                                         <tr>
                                             <th style="width: 10px">#</th>
                                             <th>Nama Units</th>
                                             <th style="width: 130px">Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php if (!empty($unit)) : ?>

                                             <?php
                                                $no = 1;
                                                foreach ($unit as $item) { ?>
                                                 <tr>
                                                     <td><?= $no++; ?></td>
                                                     <td><?= $item->nama_unit ?></td>
                                                     <td>
                                                         <a href="<?= base_url('units/edit/' . encrypt_id($item->id_unit)) ?>" class="btn btn-sm btn-outline-warning"> Edit </a>
                                                         <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-item-id="<?= $item->id_unit ?>" data-toggle="modal" data-target="#confirmDeleteModal"> Delete</button>
                                                     </td>
                                                 </tr>
                                             <?php } ?>

                                         <?php else : ?>
                                             <tr>
                                                 <td colspan="3" class="text-center"> Tidak ada data ...</td>
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

         <div class="modal fade" id="modalCreateUnits">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h4 class="modal-title">Form Create Unit</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <form class="form-horizontal" id="formUnits">
                             <div class="card-body">
                                 <div class="form-group row">
                                     <label for="inputEmail3" class="col-sm-2 col-form-label">Units</label>
                                     <div class="col-sm-10">
                                         <input type="text" name="nama_unit" class="form-control" id="nama_unit" placeholder="Units" autocomplete="off" required>
                                     </div>
                                 </div>
                             </div>
                     </div>
                     <div class="modal-footer justify-content-between">
                         <button type="submit" class="btn btn-primary btn-sm" id="btnSaveUnits">Simpan</button>
                         <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                     </div>
                     </form>
                 </div>
                 <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
         </div>