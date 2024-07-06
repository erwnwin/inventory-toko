         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Data Pengguna</h1>
                         </div>
                     </div>
                 </div><!-- /.container-fluid -->
             </section>

             <!-- Main content -->
             <section class="content">
                 <div class="container-fluid">


                     <div class="card card-default">
                         <div class="card-header">
                             <h3 class="card-title">Daftar Users</h3>

                             <div class="card-tools">
                                 <a href="<?= base_url('users/create') ?>" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Create</a>

                             </div>
                         </div>
                         <!-- /.card-header -->
                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table">
                                     <thead>
                                         <tr>
                                             <th style="width: 10px">#</th>
                                             <th>Nama Users</th>
                                             <th>Email</th>
                                             <th>Password</th>
                                             <th>Role</th>
                                             <th style="width: 130px">Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php
                                            $no = 1;
                                            foreach ($users as $item) { ?>
                                             <tr>
                                                 <td><?= $no++; ?></td>
                                                 <td><?= $item->nama_user ?></td>
                                                 <td><?= $item->email ?></td>
                                                 <td>******</td>
                                                 <td>
                                                     <?php if ($item->role == 'owner') { ?>
                                                         <span class="badge bg-danger"><?= $item->role ?></span>
                                                     <?php } elseif ($item->role == 'petugas') { ?>
                                                         <span class="badge bg-primary"><?= $item->role ?></span>
                                                     <?php } elseif ($item->role == 'admin') { ?>
                                                         <span class="badge bg-success"><?= $item->role ?></span>
                                                     <?php } ?>

                                                 </td>
                                                 <td>
                                                     <a href="<?= base_url('users/edit/' . encrypt_id($item->id_user)) ?>" class="btn btn-sm btn-outline-warning"> Edit </a>
                                                     <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-item-id="<?= $item->id_user ?>" data-toggle="modal" data-target="#confirmDeleteModal"> Delete</button>
                                                 </td>
                                             </tr>
                                         <?php } ?>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                         <!-- /.card-body -->
                         <div class="card-footer">

                         </div>
                     </div>
                     <!-- /.card -->
                 </div>
             </section>
         </div>

         <div class="modal fade" id="confirmDeleteModal">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h4 class="modal-title">Delete data</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <p class="text-center">Yakin Delete Data?&hellip;</p>
                     </div>
                     <div class="modal-footer justify-content-between">
                         <button type="button" class="btn btn-danger btn-sm" id="confirmDeleteBtn">Delete</button>
                         <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
                     </div>
                 </div>
                 <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->