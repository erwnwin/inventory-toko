         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Riwayat Penjualan</h1>
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
                                     <h3 class="card-title">Form Filter</h3>

                                     <!-- <div class="card-tools">
                                         <a href="<?= base_url('barang-masuk') ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Back</a>

                                     </div> -->
                                 </div>
                                 <div class="card-body p-0">
                                     <!-- <form class="form-horizontal" id="createBarangMasuk" action="<?= base_url('barang-masuk/store') ?>" method="post"> -->
                                     <form method="GET" action="<?= base_url('riwayat-penjualan') ?>" class="form-horizontal" id="filterForm">
                                         <div class="card-body">
                                             <div class="form-group row">
                                                 <label for="tanggal_mulai" class="col-sm-4 col-form-label">Tanggal Mulai</label>
                                                 <div class="col-sm-8">
                                                     <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai" autocomplete="off" value="<?= $this->input->get('tanggal_mulai') ?: date('Y-m-d') ?>">
                                                 </div>
                                             </div>
                                             <div class="form-group row">
                                                 <label for="tanggal_selesai" class="col-sm-4 col-form-label">Tanggal Akhir</label>
                                                 <div class="col-sm-8">
                                                     <input type="date" name="tanggal_selesai" class="form-control" id="tanggal_selesai" autocomplete="off" value="<?= $this->input->get('tanggal_selesai') ?: date('Y-m-d') ?>">
                                                 </div>
                                             </div>
                                         </div>

                                         <!-- /.card-body -->
                                         <div class="card-footer">
                                             <!-- <button type="submit" class="btn btn-success btn-sm float-right" id="btnFilterRiwayatPenjualan">
                                                 Filter Data
                                             </button> -->
                                             <!-- <a target="_blank" href="<?= base_url('riwayat-penjualan/export-pdf?tanggal_mulai=' . urlencode($this->input->get('tanggal_mulai')) . '&tanggal_selesai=' . urlencode($this->input->get('tanggal_selesai'))) ?>" class="btn btn-primary btn-sm">Export to PDF</a>
                                             <a target="_blank" href="<?= base_url('riwayat-penjualan/export-excel?tanggal_mulai=' . urlencode($this->input->get('tanggal_mulai')) . '&tanggal_selesai=' . urlencode($this->input->get('tanggal_selesai'))) ?>" class="btn btn-info btn-sm">Export to Excel</a> -->
                                             <button type="button" class="btn btn-primary btn-sm float-right" id="btnExportPDF">
                                                 Export to PDF
                                             </button>
                                             <button type="button" class="btn btn-info btn-sm" id="btnExportExcel">
                                                 Export to Excel
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