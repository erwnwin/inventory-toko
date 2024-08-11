<?php if (!empty($cart) && is_array($cart)) : ?>
    <?php $no = 1;
    foreach ($cart as $item) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($item['barcode']); ?></td>
            <td><?= htmlspecialchars($item['name']); ?></td>
            <td><?= indo_currency($item['price']); ?></td>
            <td><?= htmlspecialchars($item['qty']); ?></td>
            <td><?= indo_currency($item['total']); ?></td>
            <td>
                <button class="btn btn-xs btn-danger remove" data-id="<?= htmlspecialchars($item['id']); ?>">
                    <i class="fa fa-trash"></i> Remove
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="8">No items in cart</td>
    </tr>
<?php endif; ?>