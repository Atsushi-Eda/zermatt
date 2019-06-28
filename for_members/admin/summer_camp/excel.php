<?php
require_once('../../../lib/library.php');
excel_init();
require_once('../../../../Classes/PHPExcel.php');
require_once('../../../../Classes/PHPExcel/IOFactory.php');
$excel = new PHPExcel();
$excel->setActiveSheetIndex(0);
$sheet = $excel->getActiveSheet();
$sheet->setTitle("参加者リスト");
foreach($grade_names as $grade_key => $grade_name){
  $column_name = PHPExcel_Cell::stringFromColumnIndex($grade_key*3);
  $column_note = PHPExcel_Cell::stringFromColumnIndex($grade_key*3+1);
  $sheet->setCellValue($column_name."1", $grade_name);
  foreach($participations[$grade_key]['male'] as $participation_key => $participation){
    $sheet->setCellValue($column_name.($participation_key+2), $participation['name']);
    $sheet->getStyle($column_name.($participation_key+2))->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
    $sheet->setCellValue($column_note.($participation_key+2), $participation['note']);
  }
  $start_female = count($participations[$grade_key]['male']) + 3;
  foreach($participations[$grade_key]['female'] as $participation_key => $participation){
    $sheet->setCellValue($column_name.($participation_key+$start_female), $participation['name']);
    $sheet->getStyle($column_name.($participation_key+$start_female))->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
    $sheet->setCellValue($column_note.($participation_key+$start_female), $participation['note']);
  }
}
$filename = rawurlencode($event['short_name']."参加者リスト");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename*=UTF-8''$filename.xlsx");
header("Cache-Control: max-age=0");
$writer = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
$writer->save("php://output");
exit;