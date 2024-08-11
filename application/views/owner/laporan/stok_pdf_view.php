<!DOCTYPE html>
<html>

<head>
    <title>Stok Produk</title>
    <style>
        /* Styling CSS untuk PDF */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        .container {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Stok Produk</h1>
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
    </div>
</body>

</html>