<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Type;

class Spout_lib
{

    public function __construct()
    {
        require_once APPPATH . '../vendor/autoload.php';  // Path relatif menuju autoload.php
    }

    public function export_excel($data)
    {
        // Create a new spreadsheet writer
        $writer = WriterEntityFactory::createXLSXWriter();

        // Create a temporary file to store the excel data
        $fileName = 'Riwayat_Penjualan_' . date('YmdHis') . '.xlsx';
        // Save the file to the server's downloads directory
        $filePath = __DIR__ . '/downloads/' . $fileName;

        // Check if the directory exists, if not, create it
        if (!is_dir(__DIR__ . '/downloads/')) {
            mkdir(__DIR__ . '/downloads/', 0777, true);
        }

        // Open file for writing
        $writer->openToFile($filePath);

        // Create and add title row
        $titleRow = WriterEntityFactory::createRowFromArray(['Riwayat Penjualan']);
        $writer->addRow($titleRow);

        // Create and add header row
        $headerRow = WriterEntityFactory::createRowFromArray(['Invoice', 'Total Price', 'Final Price', 'Date']);
        $writer->addRow($headerRow);

        // Add data rows
        foreach ($data as $row) {
            $writer->addRow(WriterEntityFactory::createRowFromArray($row));
        }

        // Close the file
        $writer->close();

        return $filePath;
    }
}
