<?php
require_once('../../../../lib/lib_db.php');
require_once('../../../../lib/lib_misc.php');
header('Content-Type: application/json; charset=utf-8');
foreach($_POST as $member_id => $member){
  foreach($member as $event_id => $event){
    $sql = "SELECT * FROM event_participations WHERE member_id = {$member_id} AND event_id = {$event_id}";
    $record = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    if(isset($record['id'])){
      $participation = isset($event['participation']) ? $event['participation'] : $record['participation'];
      $after = isset($event['after']) ? $event['after'] : $record['after'];
      $meeting_place = isset($event['meeting_place']) ? $event['meeting_place'] : $record['meeting_place'];
      $note = isset($event['note']) ? $event['note'] : $record['note'];
      updateTable('event_participations', [
        'participation' => $participation,
        'after' => $after,
        'meeting_place' => $meeting_place,
        'note' => $note,
      ], [
        'event_id' => $event_id,
        'member_id' => $member_id,
      ]);
    }else{
      $participation = isset($event['participation']) ? $event['participation'] : 0;
      $after = isset($event['after']) ? $event['after'] : 0;
      $meeting_place = isset($event['meeting_place']) ? $event['meeting_place'] : NULL;
      $note = isset($event['note']) ? $event['note'] : '';
      insertTable('event_participations', [
        'event_id' => $event_id,
        'member_id' => $member_id,
        'participation' => $participation,
        'after' => $after,
        'meeting_place' => $meeting_place,
        'note' => $note,
      ]);
    }
  }
}
echo 1;
