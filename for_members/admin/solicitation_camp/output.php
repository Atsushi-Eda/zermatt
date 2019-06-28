<?php
require_once('../../lib/library.php');
output_init();
require_once('../../../Classes/PHPExcel.php');
require_once('../../../Classes/PHPExcel/IOFactory.php');
$excel = new PHPExcel();
$excel->setActiveSheetIndex(0);
$sheet = $excel->getActiveSheet();
$sheet->setTitle("出欠リスト");
$sheet->setCellValue('A1', 'メンバー数');
$sheet->setCellValue('A2', $cnt['all']);
$sheet->setCellValue('A4', '回答数');
$sheet->setCellValue('A5', $cnt['done']);
$sheet->setCellValue('A7', '参加(後発除く)');
$sheet->setCellValue('A8', $cnt['participation']);
$sheet->setCellValue('A10', '後発');
$sheet->setCellValue('A11', $cnt['late']);
$sheet->setCellValue('C1', '名前');
$sheet->setCellValue('D1', '出欠');
$sheet->setCellValue('E1', 'スキー経験');
$sheet->setCellValue('F1', 'ウェア');
$sheet->setCellValue('G1', 'ゴーグル');
$sheet->setCellValue('H1', 'ニット帽');
$sheet->setCellValue('I1', 'グローブ');
$sheet->setCellValue('J1', 'メモ');
foreach($members as $key => $member){
  $sheet->setCellValue('C'.($key+2), $member['name']);
  if(!empty($member['participation'])){
    $sheet->setCellValue('D'.($key+2), $participation[$member['participation']]);
  }else{
    $sheet->setCellValue('D'.($key+2), '未回答');
    $sheet->getStyle('D'.($key+2))->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
  }
  $sheet->setCellValue('E'.($key+2), $member['experience']);
  $sheet->setCellValue('F'.($key+2), $member['wear']);
  $sheet->setCellValue('G'.($key+2), $member['goggles']);
  $sheet->setCellValue('H'.($key+2), $member['knit']);
  $sheet->setCellValue('I'.($key+2), $member['gloves']);
  $sheet->setCellValue('J'.($key+2), $member['note']);
}
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='solicitation_camp.xlsx'");
header("Cache-Control: max-age=0");
$writer = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
$writer->save("php://output");
exit;