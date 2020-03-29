<?php
require_once('../../../lib/library.php');
index_init();
$schedule_id = isset($_GET['schedule_id']) ? $_GET['schedule_id'] : "";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>新歓コンパ参加者確認</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("css/index.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">新歓管理</a> > コンパ参加者確認
    </div>
    <?= flash_message() ?>
    <h2>新歓コンパ参加者確認</h2>
    <div id="search">
      <form action="./" method="GET">
        <div class="form_content">
          <select id="schedule_id" name="schedule_id">
            <option value="0">(コンパ)全て</option>
<?php
foreach($schedules as $schedule){

?>
            <option value="<?= $schedule['id'] ?>" <?= ($schedule_id == $schedule['id']) ? "selected" : "" ?>><?= h(date('n/j', strtotime($schedule['date']))) ?>[<?= h($schedule['AMPM']) ?>] <?= h($schedule['place']) ?></option>
<?php
}
?>
          </select>
        </div>
        <div class="form_content">
          <select id="meeting_place" name="meeting_place">
            <option value="0">(場所)全て</option>
<?php
if(isset($_GET['schedule_id'])){
  foreach(array_merge(explode(',',$schedules[$schedule_key]['meeting_place']),array('その他')) as $key => $meeting_place){
?>
            <option value="<?= h($meeting_place) ?>" <?= ($_GET['meeting_place'] == $meeting_place) ? "selected" : "" ?>><?= h($meeting_place) ?></option>
<?php
  }
}
?>
          </select>
        </div>
        <div class="form_content">
          <input type="submit" class="submit_button" value="検索">
        </div>
      </form>
    </div>
<?php
if(isset($guests)){
?>
    <div id="result">
      <p style="padding-bottom:10px;"><a href="excel.php?schedule_id=<?= isset($_GET['schedule_id']) ? h($_GET['schedule_id']) : 0 ?>&meeting_place=<?= isset($_GET['meeting_place']) ? h($_GET['meeting_place']) : 0 ?>">&gt;&gt;エクセル出力</a></p>
      <p id="count"><span></span>/<?= h(count($guests)) ?></p>
      <div id="table_wrap">
        <table>
          <thead>
            <tr>
              <th style="width: 5%;">出欠</th>
              <th style="width: 5%;">ID</th>
              <th style="width: 10%;">名前</th>
              <th style="width: 5%;">性別</th>
              <th style="width: 10%;">日付</th>
              <th style="width: 5%;">AMPM</th>
              <th style="width: 10%;">店</th>
              <th style="width: 10%;">集合場所</th>
              <th style="width: 10%;">学校</th>
              <th style="width: 10%;">メモ</th>
              <th style="width: 10%;">登録者</th>
              <th style="width: 10%;">予約日時</th>
            </tr>
          </thead>
          <tbody>
<?php
  foreach($guests as $guest){
?>
            <tr class="<?= $guest["attendance"] ? "checked" : "" ?>"">
              <td class="attendance_cell"><label><input class="attendance" type="checkbox" value="<?= h($guest['id']) ?>" <?= $guest["attendance"] ? "checked" : "" ?>></label></td>
              <td><?= h($guest['id']) ?></td>
              <td><?= h($guest['name']) ?></td>
              <td><?= h($gender[$guest['gender']]) ?></td>
              <td><?= h($guest['date']) ?></td>
              <td><?= h($guest['AMPM']) ?></td>
              <td><?= h($guest['place']) ?></td>
              <td><?= h($guest['meeting_place']) ?></td>
              <td><?= h($guest['school']) ?></td>
              <td><?= h($guest['note']) ?></td>
              <td><?= h($guest['m_name']) ?></td>
              <td><?= h($guest['update_time']) ?></td>
            </tr>
<?php
  }
?>
          </tbody>
        </table>
      </div>
    </div>
<?php
}
?>
  </div>
</div>
<?= readJs("../../../../js/jquery-1.11.3.min.js") ?>
<script>
$(function(){
  var meeting_places = [];
  meeting_places[0] = [];
<?php
foreach($schedules as $schedule){
?>
  meeting_places['<?= h($schedule['id']) ?>'] = [];
<?php
  foreach(array_merge(explode(',',$schedule['meeting_place']),array('その他')) as $key => $meeting_place){
?>
  meeting_places['<?= h($schedule['id']) ?>'][<?= h($key) ?>] = "<?= h($meeting_place) ?>";
<?php
  }
}
?>
  $("#schedule_id").change(function(){
    var schedule_id = $("#schedule_id").val();
    var html = '<option value="0">(場所)全て</option>';
    meeting_places[schedule_id].forEach(function(val, key){
      html += '<option value="' + val + '">' + val + '</option>'
    });
    $("#meeting_place").html(html);
  });
  $(".attendance").change(function(){
    $(this).parent().parent().parent().toggleClass("checked");
    var id = $(this).val();
    var state = $(this).prop("checked");
    $.ajax({
      type: "POST",
      url: "check.php",
      data: {
        "id": id,
        "state": state
      },
    });
    $("#count span").html($(".attendance:checked").length);
  });
  $("#count span").html($(".attendance:checked").length);
});
</script>
</body>
</html>
