<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;

class Spout_lib_inout
{
    public function __construct()
    {
        require_once APPPATH . '../vendor/autoload.php';  // Path relatif menuju autoload.php
    }

    public function export_excel($data, $type = 'default')
    {
        // Determine the report title based on type
        $reportTitle = $type === 'in' ? 'Stok Barang Masuk' : ($type === 'out' ? 'Stok Barang Keluar' : 'Stock Report');

        // Create a new spreadsheet writer
        $writer = WriterEntityFactory::createXLSXWriter();

        // Create a temporary file to store the excel data
        $fileName = 'Stock_Report_' . date('YmdHis') . '.xlsx';
        $filePath = APPPATH . 'downloads/' . $fileName; // Use CodeIgniter's application path for storage

        // Check if the directory exists, if not, create it
        if (!is_dir(APPPATH . 'downloads/')) {
            mkdir(APPPATH . 'downloads/', 0777, true);
        }

        // Open file for writing
        $writer->openToFile($filePath);

        // Create and add title row
        $titleRow = WriterEntityFactory::createRowFromArray([$reportTitle]);
        $writer->addRow($titleRow);

        // Create and add header row
        $headerRow = WriterEntityFactory::createRowFromArray(['Nama Produk', 'Nama Supplier', 'Quantity', 'Tanggal', 'Type']);
        $writer->addRow($headerRow);

        // Add data rows
        if (empty($data)) {
            // If no data, add a row indicating no data
            $writer->addRow(WriterEntityFactory::createRowFromArray(['Tidak ada data untuk ditampilkan.']));
        } else {
            foreach ($data as $row) {
                $writer->addRow(WriterEntityFactory::createRowFromArray($row));
            }
        }

        // Close the file
        $writer->close();

        return $filePath;
    }
}
