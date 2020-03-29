<?php
require_once('../../lib/lib_init.php');
function index_init(){
  global $pdo, $guests, $schedules, $schedule_key;
  $sql = 'SELECT * FROM solicitation_schedules WHERE deleted = 0 ORDER BY date ASC, AMPM ASC';
  $schedules = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  foreach($schedules as $key => $schedule){
    if(isset($_GET['schedule_id']) && $schedule['id'] == $_GET['schedule_id']){
      $schedule_key = $key;
    }
  }
  if(!isset($_GET['schedule_id']) || $_GET['schedule_id'] == 0){
    $sql_schedule = 1;
  }else{
    $sql_schedule = "g.schedule_id = ".$_GET['schedule_id'];
  }
  if(!isset($_GET['meeting_place']) || $_GET['meeting_place'] == "0"){
    $sql_meeting_place = 1;
  }else{
    $sql_meeting_place = "g.meeting_place = '".$_GET['meeting_place']."'";
  }
  $sql = "SELECT g.id, g.name, g.gender, s.date, s.AMPM, s.place, g.meeting_place, g.school, g.note, m.name AS m_name, g.attendance, g.update_time FROM solicitation_guests AS g LEFT JOIN solicitation_schedules AS s ON g.schedule_id = s.id LEFT JOIN members AS m ON g.member_id = m.id WHERE s.deleted = 0 AND g.deleted = 0 AND {$sql_schedule} AND {$sql_meeting_place} ORDER BY s.date ASC, s.AMPM ASC, g.meeting_place ASC, g.gender ASC";
  $guests = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
