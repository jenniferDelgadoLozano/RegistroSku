<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\IOFactory;

$data = $_POST["data"];


$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator("Jennifer Lozano")->setTitle("Codigos Seleccionados");

$spreadsheet->setActiveSheetIndex(0);

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

$spreadsheet->getActiveSheet()->setCellValue('A1', 'Referencia');
$spreadsheet->getActiveSheet()->setCellValue('B1', 'Marca');
$spreadsheet->getActiveSheet()->setCellValue('C1', 'Color');
$spreadsheet->getActiveSheet()->setCellValue('D1', 'Talla');
$spreadsheet->getActiveSheet()->setCellValue('E1', 'Sku');

$spreadsheet->getActiveSheet()->fromArray($data,null,'A2');

$spreadsheet->getDefaultStyle()->getNumberFormat()->setFormatCode('#');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

ob_start();
$writer->save("php://output");
$xlsData = ob_get_contents();
ob_end_clean();

$response =  array(
  'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData)
);


die(json_encode($response));
?>
