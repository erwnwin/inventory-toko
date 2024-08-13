<!DOCTYPE html>
<html>

<head>
    <title>Stock Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid black;
            /* Menambahkan garis tebal di bawah header */
            padding-bottom: 10px;
            /* Menambahkan jarak antara teks dan garis bawah */
        }

        .title b {
            font-size: 18px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="title">
        <b>OPTIK FADHEL</b>
        <br>
        Kota Makassar
        <br>
        Jln Perintis Kemerdekaan KM. 10
    </div>

    <h3>
        <?php
        if ($type == 'in') {
            echo 'Stok Barang Masuk';
        } elseif ($type == 'out') {
            echo 'Stok Barang Keluar';
        } else {
            echo 'Stock Report';
        }
        ?>
    </h3>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Nama Supplier</th>
                <th>Quantity</th>
                <th>Tanggal</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($stocks)): ?>
                <?php foreach ($stocks as $stock): ?>
                    <tr>
                        <td><?= htmlspecialchars($stock['nama_produk']) ?></td>
                        <td><?= htmlspecialchars($stock['nama_supplier']) ?></td>
                        <td><?= htmlspecialchars($stock['qty']) ?></td>
                        <td><?= htmlspecialchars($stock['date']) ?></td>
                        <td><?= htmlspecialchars($stock['type']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>