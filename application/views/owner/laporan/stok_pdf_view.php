<!DOCTYPE html>
<html>

<head>
    <title>Stok Produk</title>
    <style>
        /* Styling CSS untuk PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        thead {
            background-color: #e0e0e0;
        }

        tfoot {
            font-weight: bold;
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

    <h3>Stok Produk</h3>
    <table>
        <thead>
            <tr>
                <th>Attribute</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($product as $item): ?>
                <tr>
                    <td>Nama Produk</td>
                    <td><?= $item['nama_produk'] ?></td>
                </tr>
                <tr>
                    <td>Stock</td>
                    <td><?= $item['stock'] ?></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td><?= $item['name_category'] ?></td>
                </tr>
                <tr>
                    <td>Unit</td>
                    <td><?= $item['name_unit'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>