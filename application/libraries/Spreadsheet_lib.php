<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Spreadsheet_lib
{

    public function export_to_excel($data, $filename = 'report.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'Header 1');
        $sheet->setCellValue('B1', 'Header 2');
        $sheet->setCellValue('C1', 'Header 3');

        // Add data
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->column1);
            $sheet->setCellValue('B' . $row, $item->column2);
            $sheet->setCellValue('C' . $row, $item->column3);
            $row++;
        }

        // Save to file
        $writer = new Xlsx($spreadsheet);
        $temp_file = tempnam(sys_get_temp_dir(), 'excel');
        $writer->save($temp_file);

        // Force download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        readfile($temp_file);

        // Clean up
        unlink($temp_file);
    }
}
