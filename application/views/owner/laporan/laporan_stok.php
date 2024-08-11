         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <section class="content-header">
                 <div class="container-fluid">
                     <div class="row mb-2">
                         <div class="col-sm-6">
                             <h1>Laporan Stok Per Item</h1>
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
                                     <form method="GET" action="<?= base_url('stok-produk') ?>" class="form-horizontal" id="pilihProdukForm">
                                         <div class="card-body">

                                             <div class="form-group row">
                                                 <label for="produkSelect" class="col-sm-4 col-form-label">Pilih Item Produk</label>
                                                 <div class="col-sm-8">
                                                     <select id="produkSelect" class="form-control select2">
                                                         <option value="">Pilih Produk</option>
                                                         <?php foreach ($product as $p) { ?>
                                                             <option value="<?= $p->id_item ?>"><?= $p->nama_produk ?></option>
                                                         <?php } ?>
                                                     </select>
                                                 </div>
                                             </div>
                                             <div class="table-responsive">
                                                 <table id="produkTable" class="table">
                                                     <!-- Data akan dimuat di sini -->
                                                 </table>
                                             </div>

                                         </div>

                                         <!-- /.card-body -->
                                         <div class="card-footer">
                                             <!-- <button type="submit" class="btn btn-success btn-sm float-right" id="btnFilterRiwayatPenjualan">
                                                 Filter Data
                                             </button> -->
                                             <!-- <a target="_blank" href="<?= base_url('riwayat-penjualan/export-pdf?tanggal_mulai=' . urlencode($this->input->get('tanggal_mulai')) . '&tanggal_selesai=' . urlencode($this->input->get('tanggal_selesai'))) ?>" class="btn btn-primary btn-sm">Export to PDF</a>
                                             <a target="_blank" href="<?= base_url('riwayat-penjualan/export-excel?tanggal_mulai=' . urlencode($this->input->get('tanggal_mulai')) . '&tanggal_selesai=' . urlencode($this->input->get('tanggal_selesai'))) ?>" class="btn btn-info btn-sm">Export to Excel</a> -->
                                             <button type="button" class="btn btn-primary btn-sm float-right" id="btnExportPDF22">
                                                 Export to PDF
                                             </button>
                                             <button type="button" class="btn btn-info btn-sm" id="btnExportExcel22">
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