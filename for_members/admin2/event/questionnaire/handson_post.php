<?php
require_once('../../../../lib/lib_db.php');
header('Content-Type: application/json; charset=utf-8');
$success_count = 0;
foreach($_POST as $member_id => $member){
  foreach($member as $event_id => $event){
    $sql = "SELECT * FROM event_participations WHERE member_id = {$member_id} AND event_id = {$event_id}";
    $record = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    if(isset($record['id'])){
      $sql = "UPDATE event_participations SET participation = :participation, after = :after, meeting_place = :meeting_place, note = :note, update_time = null WHERE event_id = :event_id AND member_id = :member_id";
      $participation = isset($event['participation']) ? $event['participation'] : $record['participation'];
      $after = isset($event['after']) ? $event['after'] : $record['after'];
      $meeting_place = isset($event['meeting_place']) ? $event['meeting_place'] : $record['meeting_place'];
      $note = isset($event['note']) ? $event['note'] : $record['note'];
    }else{
      $sql = "INSERT INTO event_participations (event_id, member_id, participation, after, meeting_place, note) VALUES (:event_id, :member_id, :participation, :after, :meeting_place, :note)";
      $participation = isset($event['participation']) ? $event['participation'] : 0;
      $after = isset($event['after']) ? $event['after'] : 0;
      $meeting_place = isset($event['meeting_place']) ? $event['meeting_place'] : NULL;
      $note = isset($event['note']) ? $event['note'] : '';
    }
    $sth = $pdo->prepare($sql);
    $debug[] = $event;
    if($sth->execute(array(':event_id'=>$event_id, ':member_id'=>$member_id, ':participation'=>$participation, ':after'=>$after, ':meeting_place'=>$meeting_place, ':note'=>$note))){
      $success_count++;
    }
  }
}
echo json_encode($debug);