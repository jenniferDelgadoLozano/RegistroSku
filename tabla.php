<?php
require '../vendor/autoload.php';
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
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);

$spreadsheet->getActiveSheet()->setCellValue('A1', 'Marca');
$spreadsheet->getActiveSheet()->setCellValue('B1', 'Referencia');
$spreadsheet->getActiveSheet()->setCellValue('C1', 'Descripción');
$spreadsheet->getActiveSheet()->setCellValue('D1', 'Talla');
$spreadsheet->getActiveSheet()->setCellValue('E1', 'Sku');
$spreadsheet->getActiveSheet()->setCellValue('F1', 'Codigo Color');
$spreadsheet->getActiveSheet()->setCellValue('G1', 'Codigo Color Factory');
$spreadsheet->getActiveSheet()->setCellValue('H1', 'Codigo Color Roque');
$spreadsheet->getActiveSheet()->setCellValue('I1', 'Nombre del Color');
$spreadsheet->getActiveSheet()->setCellValue('J1', 'Estado');
$spreadsheet->getActiveSheet()->setCellValue('K1', 'Usuario');
$spreadsheet->getActiveSheet()->setCellValue('L1', 'Fecha');

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
