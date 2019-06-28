<?php
require_once('../lib/lib_init.php');
$participation = array(
  1 => "参加",
  2 => "不参加",
  3 => "後発",
);
function output_init(){
  global $pdo, $members, $cnt;
  $sql = 'SELECT m.name, p.participation, p.experience, p.wear, p.goggles, p.knit, p.gloves, p.note FROM solicitation_camp_participations AS p RIGHT JOIN members AS m ON p.member_id = m.id WHERE m.view = true ORDER BY m.grade ASC';
  $members = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $cnt['all'] = count($members);
  $cnt['done'] = 0;
  $cnt['participation'] = 0;
  $cnt['late'] = 0;
  foreach($members as $member){
    if(isset($member['participation'])){
      $cnt['done']++;
      if($member['participation'] == 1){
        $cnt['participation']++;
      }
      if($member['participation'] == 3){
        $cnt['late']++;
      }
    }
  }
}