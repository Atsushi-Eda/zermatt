<?php
set_time_limit(300);
require_once('../../../lib/library.php');
view_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>企画アンケート結果詳細表示</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("css/view.css") ?>
  <?= readJs("../../../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../../../js/rome.js") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">企画管理</a> > <a href="./">アンケート結果</a> > 詳細表示
    </div>
    <?= flash_message() ?>
    <h2>企画アンケート結果詳細表示</h2>
    <div class="form_content">
      <input type="text" id="member_name" placeholder="メンバー名">
    </div>
    <div class="form_content">
      <select id="event_id">
        <option value="0">(企画)全て</option>
<?php
foreach($event_alls as $event_all){

?>
        <option value="<?= $event_all['id'] ?>" <?= (isset($_GET['event_id']) && $_GET['event_id'] == $event_all['id']) ? "selected" : "" ?>><?= h($event_all['short_name']) ?></option>
<?php
}
?>
      </select>
    </div>
    <div id="result">
<?php
if(count($events) === 1){
?>
      <p style="padding-bottom:10px;"><a href="excel.php?event_id=<?= h($events[0]['id']) ?>">>>エクセル出力</a></p>
      <p style="padding-bottom:10px;"><a href="text.php?event_id=<?= h($events[0]['id']) ?>">>>メーリス送信用参加者リスト</a></p>
<?php
}
?>
      <div id="table_wrap">
        <table>
          <thead>
            <tr>
              <th rowspan="2">名前</th>
<?php
foreach($events as $event){
  $colspan = 3;
  if($event['after']) $colspan++;
  if(!empty($event['meeting_place'])) $colspan++;
?>
              <th colspan="<?= h($colspan) ?>" class="col<?= h($colspan) ?>"><?= h($event['short_name']) ?></th>
<?php
}
?>
            </tr>
            <tr>
<?php
foreach($events as $event){
?>
              <th>出欠</th>
<?php
  if($event['after']){
?>
              <th>アフター</th>
<?php
  }
  if(!empty($event['meeting_place'])){
?>
              <th>集合場所</th>
<?php
  }
?>
              <th>備考</th>
              <th>編集</th>
<?php
}
?>
            </tr>
          </thead>
          <tbody>
<?php
foreach($members as $member){
?>
            <tr class="member" data-name="<?= h($member['name']) ?>" data-phonetic="<?= h($member['phonetic']) ?>">
              <td><?= h($member['name']) ?></td>
<?php
  foreach($events as $event){
    if($participations[$member['id']][$event['id']]['participation'] !== NULL){
?>
              <td><?= ($participations[$member['id']][$event['id']]['participation']) ? '参加' : '不参加' ?></td>
<?php
    }else{
?>
              <td style="color:red;">未回答</td>
<?php
    }
    if($event['after']){
      if($participations[$member['id']][$event['id']]['after'] !== NULL){
?>
              <td><?= ($participations[$member['id']][$event['id']]['after']) ? '参加' : '不参加' ?></td>
<?php
      }else{
?>
              <td style="color:red;">未回答</td>
<?php
      }
    }
    if(!empty($event['meeting_place'])){
?>
              <td><?= h($participations[$member['id']][$event['id']]['meeting_place']) ?></td>
<?php
    }
?>
              <td><?= h($participations[$member['id']][$event['id']]['note']) ?></td>
              <td><a href="edit.php?event_id=<?= h($event['id']) ?>&member_id=<?= h($member['id']) ?>">編集</a></td>
<?php
  }
?>
            </tr>
<?php
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
$(function(){
  $("#member_name").keyup(function(){
    var keyword = r2h($(this).val());
    $.each($(".member"), function(i, val){
      if($(val).data("name").indexOf(keyword)!=-1 || $(val).data("phonetic").indexOf(keyword)!=-1){
        $(val).show();
      }else{
        $(val).hide();
      }
    });
  });
  $("#event_id").change(function(){
    location.href = "http://<?= ROOT_DIR ?>/for_members/admin/event/questionnaire/view.php?event_id="+$(this).val();
  });
});
</script>
</body>
</html>
