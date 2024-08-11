<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;

class Spout_lib_produk
{
    public function __construct()
    {
        require_once APPPATH . '../vendor/autoload.php'; // Path relatif menuju autoload.php
    }

    public function export_excel($data)
    {
        // Create a new spreadsheet writer
        $writer = WriterEntityFactory::createXLSXWriter();

        // Create a temporary file to store the excel data
        $fileName = 'Data_stok_produk_' . date('YmdHis') . '.xlsx';
        $filePath = FCPATH . 'downloads/' . $fileName; // Use FCPATH for the project root

        // Check if the directory exists, if not, create it
        if (!is_dir(FCPATH . 'downloads/')) {
            mkdir(FCPATH . 'downloads/', 0777, true);
        }

        // Open file for writing
        $writer->openToFile($filePath);

        // Create and add title row
        $titleRow = WriterEntityFactory::createRowFromArray(['Stok Produk']);
        $writer->addRow($titleRow);

        // Create and add header row
        $headerRow = WriterEntityFactory::createRowFromArray(['Attribute', 'Value']);
        $writer->addRow($headerRow);

        // Add data rows
        foreach ($data as $item) {
            // Create rows for each attribute-value pair
            $rows = [
                WriterEntityFactory::createRowFromArray(['Nama Produk', $item['nama_produk']]),
                WriterEntityFactory::createRowFromArray(['Stock', $item['stock']]),
                WriterEntityFactory::createRowFromArray(['Kategori', $item['name_category']]),
                WriterEntityFactory::createRowFromArray(['Unit', $item['name_unit']])
            ];

            // Add rows to the writer
            foreach ($rows as $row) {
                $writer->addRow($row);
            }
        }

        // Close the file
        $writer->close();

        return $filePath;
    }
}
