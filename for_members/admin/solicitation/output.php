<?php
require_once('../../lib/library.php');
view_init();
require_once('../../../Classes/PHPExcel.php');
require_once('../../../Classes/PHPExcel/IOFactory.php');
$excel = new PHPExcel();
$excel->setActiveSheetIndex(0);
$sheet = $excel->getActiveSheet();
$sheet->setTitle("予約リスト");
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', '名前');
$sheet->setCellValue('C1', '性別');
$sheet->setCellValue('D1', '日付');
$sheet->setCellValue('E1', 'AMPM');
$sheet->setCellValue('F1', '店');
$sheet->setCellValue('G1', '集合場所');
$sheet->setCellValue('H1', '学校');
$sheet->setCellValue('I1', 'メモ');
$sheet->setCellValue('J1', '登録者');
$sheet->setCellValue('K1', '予約日時');
foreach($guests as $key => $guest){
$sheet->setCellValue('A'.($key+2), $guest['id']);
$sheet->setCellValue('B'.($key+2), $guest['name']);
$sheet->setCellValue('C'.($key+2), $gender[$guest['gender']]);
$sheet->setCellValue('D'.($key+2), $guest['date']);
$sheet->setCellValue('E'.($key+2), $guest['AMPM']);
$sheet->setCellValue('F'.($key+2), $guest['place']);
$sheet->setCellValue('G'.($key+2), $guest['meeting_place']);
$sheet->setCellValue('H'.($key+2), $guest['school']);
$sheet->setCellValue('I'.($key+2), $guest['note']);
$sheet->setCellValue('J'.($key+2), $guest['m_name']);
$sheet->setCellValue('K'.($key+2), $guest['update_time']);
}
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='solicitation.xlsx'");
header("Cache-Control: max-age=0");
$writer = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
$writer->save("php://output");
exit;