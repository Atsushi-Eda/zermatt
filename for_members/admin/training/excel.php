<?php
require_once('../../lib/library.php');
view_init();
require_once('../../../Classes/PHPExcel.php');
require_once('../../../Classes/PHPExcel/IOFactory.php');
$excel = new PHPExcel();
$excel->setActiveSheetIndex(0);
$sheet = $excel->getActiveSheet();
$sheet->setTitle("トレ出欠確認");
$sheet->setCellValue("A1", "名前");
$sheet->setCellValue("B1", "合計");
foreach($dates as $date_key => $date){
  $column = PHPExcel_Cell::stringFromColumnIndex($date_key + 2);
  $sheet->setCellValue($column."1", date("n/j", strtotime($date)).'('.$weekjp[date('w', strtotime($date))].')');
}
foreach($members as $member_key => $member){
  $row = $member_key + 2;
  $sheet->setCellValue("A".$row, $member['name']);
  $sheet->setCellValue("B".$row, isset($participations[$member['id']]) ? count($participations[$member['id']]) : 0);
  foreach($dates as $date_key => $date){
    $column = PHPExcel_Cell::stringFromColumnIndex($date_key + 2);
    $sheet->setCellValue($column.$row, isset($participations[$member['id']][$date]) ? 1 : 0);
  }
}
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=トレ出欠確認.xlsx");
header("Cache-Control: max-age=0");
$writer = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
$writer->save("php://output");
exit;
