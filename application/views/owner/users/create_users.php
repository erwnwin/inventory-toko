         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Create Pengguna</h1>
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
                                     <h3 class="card-title">Form Create Users</h3>

                                     <daiv class="card-tools">
                                         <a href="<?= base_url('users') ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>

                                     </daiv>
                                 </div>
                                 <div class="card-body p-0">
                                     <form class="form-horizontal" id="myForm">
                                         <div class="card-body">
                                             <div class="form-group row">
                                                 <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                                 <div class="col-sm-10">
                                                     <input type="email" name="email" class="form-control" id="email" placeholder="Email" autocomplete="off" required>
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <label for="inputPassword3" class="col-sm-2 col-form-label">Nama User</label>
                                                 <div class="col-sm-10">
                                                     <input type="text" name="nama_user" class="form-control" id="nama_user" autocomplete="off" placeholder="Nama User" required>
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                                                 <div class="col-sm-10">
                                                     <input type="text" name="password" class="form-control" id="password" placeholder="*****" autocomplete="off" required>
                                                 </div>
                                             </div>

                                             <div class="form-group row">
                                                 <label for="inputPassword3" class="col-sm-2 col-form-label">Role User</label>
                                                 <div class="col-sm-10">
                                                     <select id="role" class="form-control" name="role">
                                                         <option value="">Pilih Role</option>
                                                         <option value="admin">Admin</option>
                                                         <option value="owner">Owner Toko</option>
                                                         <option value="petugas">Petugas Toko</option>
                                                         <option value="kasir">Kasir</option>
                                                     </select>
                                                 </div>
                                             </div>
                                         </div>
                                         <!-- /.card-body -->
                                         <div class="card-footer">
                                             <!-- <button type="submit" class="btn btn-info">Sign in</button> -->
                                             <button type="button" class="btn btn-success btn-sm float-right" id="saveBtn">
                                                 Simpan
                                             </button>
                                         </div>
                                         <!-- /.card-footer -->
                                     </form>
                                     <!-- <div class="overlay hide">
                                         <i class="fas fa-spinner"></i>
                                     </div> -->
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