<?php if (!empty($sales)): ?>
    <?php foreach ($sales as $index => $sale): ?>
        <tr>
            <td><?php echo $index + 1; ?></td>
            <td><?php echo htmlspecialchars($sale->invoice); ?></td>
            <td><?php echo htmlspecialchars($sale->total_price); ?></td>
            <td><?php echo htmlspecialchars($sale->discount); ?></td>
            <td><?php echo htmlspecialchars($sale->final_price); ?></td>
            <td><?php echo htmlspecialchars($sale->cash); ?></td>
            <td><?php echo htmlspecialchars($sale->uang_kembalian); ?></td>
            <td><?php echo htmlspecialchars($sale->created); ?></td>
            <!-- <td><?php echo htmlspecialchars($sale->date); ?></td> -->
            <td>
                <!-- Action Buttons -->
                <a href="<?= base_url('history-transaksi/print/' . encrypt_id($sale->id_sale)) ?>" class="btn btn-outline-primary btn-sm" target="_blank">
                    Print
                </a>
                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#detailModal" data-id="<?= $sale->invoice ?>">
                    Detail
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="9" style="text-align: center;">No sales found for the selected date range.</td>
    </tr>
<?php endif; ?>