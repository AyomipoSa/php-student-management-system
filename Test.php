<?php

require_once __DIR__ . "/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'First Name');
$sheet->setCellValue('B1', 'Last Name');
$sheet->setCellValue('C1', 'Email');

$sheet->setCellValue('A2', 'Rose');
$sheet->setCellValue('B2', 'John');
$sheet->setCellValue('C2', 'rose@email.com');

$writer = new Xlsx($spreadsheet);
$writer->save(__DIR__ . "/students.xlsx");

echo "Excel file created!";