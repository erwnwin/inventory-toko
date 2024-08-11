<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Aplikasi Kasir: apps-kasir</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Isi Form Dibawah Ini!</h3>
                        </div>
                        <div class="card-body">
                            <form id="form-tambah" method="POST">
                                <!-- Data Kasir -->
                                <h5>Data Kasir</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label>Invoice Transaksi</label>
                                            <input type="text" name="invoice" id="invoice" value="<?= $invoice ?>" readonly class="form-control text-danger font-weight-bold">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label>Nama Kasir</label>
                                            <input type="hidden" name="id_user" id="id_user" value="<?= $this->session->userdata('id_user') ?>" readonly class="form-control">
                                            <input type="text" name="nama_kasir" id="nama_kasir" value="<?= $this->session->userdata('nama_user') ?>" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label>Tanggal Transaksi</label>
                                            <input type="text" name="date" id="date" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <label>Jam</label>
                                            <input type="text" name="jam_penjualan" id="jam_penjualan" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!-- Data Barang -->
                                <h5>Data Barang</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Produk</label>
                                            <select name="nama_barang" id="nama_barang" class="form-control select2">
                                                <option value="">Pilih Produk</option>
                                                <?php foreach ($produk as $p): ?>
                                                    <option value="<?= $p->nama_barang ?>"><?= $p->nama_barang ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-2">
                                        <div class="form-group">
                                            <label>Barcode Produk</label>
                                            <input type="text" name="barcode" id="barcode" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-2">
                                        <div class="form-group">
                                            <label>Harga Produk</label>
                                            <input type="text" name="price" id="price" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-2">
                                        <div class="form-group">
                                            <label>Jumlah / Qty</label>
                                            <input type="number" name="jumlah" id="jumlah" readonly class="form-control" min="1">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-2">
                                        <div class="form-group">
                                            <label>Sub Total</label>
                                            <input type="number" name="sub_total" id="sub_total" readonly class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-1">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button type="button" class="btn btn-primary btn-block" id="tambah" disabled>
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="satuan" id="satuan">
                                </div>
                                <!-- Detail Transaksi -->
                                <div class="keranjang">
                                    <h5>Detail Transaksi</h5>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table" id="keranjang">
                                            <thead>
                                                <tr>
                                                    <th width="35%">Nama Produk</th>
                                                    <th width="15%">Harga</th>
                                                    <th width="15%">Jumlah</th>
                                                    <th width="10%">Sub Total</th>
                                                    <th width="25%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data akan diisi dengan JavaScript -->
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" align="right"><strong>Total :</strong></td>
                                                    <td id="total"></td>
                                                    <td>
                                                        <input type="hidden" name="total_hidden" id="total_hidden">
                                                        <input type="hidden" name="max_hidden" id="max_hidden">
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="fa fa-save"></i>&nbsp;&nbsp;Proses Pembayaran
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right"><strong>Diskon :</strong></td>
                                                    <td colspan="2">
                                                        <input type="number" name="diskon" value="0" class="form-control" min="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right"><strong>Grand Total :</strong></td>
                                                    <td colspan="2">
                                                        <input type="number" name="grand_total" id="grand_total_display" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right"><strong>Cash :</strong></td>
                                                    <td colspan="2">
                                                        <input type="number" name="cash" class="form-control" min="0">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" align="right"><strong>Change :</strong></td>
                                                    <td colspan="2">
                                                        <input type="number" name="kembalian" id="kembalian" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <input type="hidden" name="details" id="details_hidden">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div>
        <br>
    </div>
</div>