<?php
require_once('../../../lib/library.php');
index_init();
require_once('../../../../Classes/PHPExcel.php');
require_once('../../../../Classes/PHPExcel/IOFactory.php');
$excel = new PHPExcel();
$excel->setActiveSheetIndex(0);
$sheet = $excel->getActiveSheet();
$sheet->setTitle("班分け");
foreach($team_members as $team => $team_members2){
  $column = PHPExcel_Cell::stringFromColumnIndex($team - 1);
  $sheet->setCellValue($column."1", $team."班");
  $row = 2;
  foreach($team_members2 as $team_members3){
    foreach($team_members3 as $team_member){
      $sheet->setCellValue($column.$row, $team_member['name']);
      if($team_member['leader']){
        $sheet->getStyle($column.$row)->getFill()->setFillType( PHPExcel_Style_Fill::FILL_SOLID )->getStartColor()->setARGB('FFFFFF00');
      }
      if($team_member['gender'] == 'male'){
        $sheet->getStyle($column.$row)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
      }else{
        $sheet->getStyle($column.$row)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
      }
      $row++;
    }
  }
}
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$event['short_name']."班分け.xlsx'");
header("Cache-Control: max-age=0");
$writer = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
$writer->save("php://output");
exit;