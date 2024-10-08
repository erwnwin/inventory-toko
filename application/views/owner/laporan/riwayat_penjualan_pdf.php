<!DOCTYPE html>
<html>

<head>
    <title>Riwayat Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

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
        }

        .title b {
            font-size: 18px;
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

    <h3>Riwayat Penjualan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sales)) : ?>
                <?php foreach ($sales as $key => $sale) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= $sale->invoice ?></td>
                        <td><?= $sale->total_price ?></td>
                        <td><?= $sale->final_price ?></td>
                        <td><?= $sale->cash ?></td>
                        <td><?= $sale->date ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data yang tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>