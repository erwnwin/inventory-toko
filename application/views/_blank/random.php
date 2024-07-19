<form action="" id="formFilter">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="month">Month:</label>
            <select id="month" class="form-control">
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <!-- Add options for all months -->
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="year">Year:</label>
            <input type="number" id="year" class="form-control" min="2000" max="2099" value="<?php echo date('Y'); ?>">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Filter</button>
</form>

<button type="button" class="btn btn-sm btn-info" id="btnFilter"><i class="fa fa-filter"></i> Show Filter</button>


<?php
$no = 1;
foreach ($stock as $item) { ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $item->barcode ?></td>
        <td><?= $item->nama_item ?></td>
        <td><?= $item->detail ?></td>
        <td><?= $item->qty ?></td>
        <td><?= tanggal_indonesia_lengkap($item->date) ?></td>
        <td>

            <button type="button" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#confirmDeleteModal"> Detail</button>
            <form action="<?= base_url('barang-masuk/delete') ?>" method="post" class="d-inline">
                <input type="hidden" name="id_stock" value="<?= $item->id_stock; ?>">
                <input type="hidden" name="id_item" value="<?= $item->id_item; ?>">
                <button class="btn btn-outline-danger btn-sm tombol-hapus" type="submit">
                    Delete
                </button>
            </form>
        </td>
    </tr>
<?php } ?>