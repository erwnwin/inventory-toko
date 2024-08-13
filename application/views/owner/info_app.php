<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Info Apps</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1">
                </div>
                <!-- ./col -->

                <div class="col-lg-10 col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Informasi Singkat Toko</h3>
                        </div>
                        <div class="card-body p-0">
                            <form class="form-horizontal" id="myFormInfo">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Toko</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="id_user" class="form-control" id="id_user" value="<?= $this->session->userdata('id_user'); ?>" placeholder="Nama Toko" autocomplete="off" required>
                                            <input type="text" name="nama_toko" class="form-control" id="nama_toko" value="<?= isset($info['nama_toko']) ? $info['nama_toko'] : '' ?>" placeholder="Nama Toko" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">No Telp/Wa Toko</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="no_telp" class="form-control" id="no_telp" value="<?= isset($info['no_telp']) ? $info['no_telp'] : '' ?>" placeholder="No Telp/WA Toko" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Deskripsi Singkat Toko</label>
                                        <div class="col-sm-10">
                                            <textarea name="deskripsi_depan" id="deskripsi_depan" class="form-control" cols="10" rows="10" placeholder="Deskripsi Toko"><?= isset($info['deskripsi_depan']) ? $info['deskripsi_depan'] : '' ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Tentang Toko</label>
                                        <div class="col-sm-10">
                                            <textarea name="tentang_toko" id="tentang_toko" class="form-control" cols="10" rows="10" placeholder="Tentang Toko"><?= isset($info['tentang_toko']) ? $info['tentang_toko'] : '' ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Jam Buka / Operasional Toko</label>
                                        <div class="col-sm-10">
                                            <textarea name="jam_buka" id="jam_buka" class="form-control" cols="10" rows="10" placeholder="Jam Buka / Operasional Toko"><?= isset($info['jam_buka']) ? $info['jam_buka'] : '' ?></textarea>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" class="btn btn-success btn-sm float-right" id="saveBtnInfo">
                                        Simpan
                                    </button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ./col -->

                <div class="col-lg-1">
                </div>
                <!-- ./col -->
            </div>
        </div>
    </section>

    <div>
        <br>
    </div>
</div>