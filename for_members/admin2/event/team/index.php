<?php
require_once('../../../lib/library.php');
index_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>班分け</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("css/index.css") ?>
  <?= readJs("../../../../js/jquery-1.11.3.min.js") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">企画管理</a> > 班分け
    </div>
    <?= flash_message() ?>
    <h2>班分け</h2>
    <div class="form_content">
      <select id="event_id">
        <option value="0">(企画)選択なし</option>
<?php
foreach($events as $event){

?>
        <option value="<?= $event['id'] ?>" <?= (isset($_GET['event_id']) && $_GET['event_id'] == $event['id']) ? "selected" : "" ?>><?= h($event['name']) ?></option>
<?php
}
?>
      </select>
    </div>
<?php
if(isset($_GET['event_id']) && $_GET['event_id']!=0){
?>
    <p><a href="excel.php?event_id=<?= h($_GET['event_id']) ?>">>>エクセル出力</a></p>
    <div class="form_content buttons">
      <a href="edit.php?event_id=<?= h($_GET['event_id']) ?>" class="button">編集</a>
    </div>
<?php
  if($disagreement){
?>
    <p style="color:red;">※アンケートの参加者リストと班分けされているメンバーのリストが一致していません。編集を行ってください。</p>
<?php
  }
?>
    <div id="teams">
<?php
  foreach(is_array($team_members) ? $team_members : [] as $team => $team_members2){
?>
      <div class="team box">
        <h3><?= h($team) ?>班</h3>
        <ul>
<?php
    foreach($team_members2 as $team_members3){
      foreach($team_members3 as $team_member){
?>
          <li class="<?= h($team_member['gender']) ?> <?= $team_member['leader'] ? 'team_leader' : '' ?>"><?= h($team_member['name']) ?></li>
<?php
      }
    }
?>
        </ul>
      </div>
<?php
  }
?>
    </div>
<?php
}
?>
  </div>
</div>
<script>
$(function(){
  $("#event_id").change(function(){
    location.href = "http://<?= ROOT_DIR ?>/for_members/admin2/event/team/?event_id="+$(this).val();
  });
});
</script>
</body>
</html>
