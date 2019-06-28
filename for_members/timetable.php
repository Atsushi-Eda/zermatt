<?php
require_once('lib/library.php');
timetable_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>時間割</title>
  <?= readCss("../css/reset.css") ?>
  <?= readCss("css/for_members.css") ?>
  <?= readCss("css/form.css") ?>
  <?= readCss("css/timetables.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="./">TOP</a> > 時間割
    </div>
    <?= flash_message() ?>
    <h2>時間割</h2>
    <form action="timetable.php" method="POST">
      <input type="hidden" name="time[]" value="0">
      <div class="form_content">
        <table>
          <tr>
<?php
foreach($weekjp as $key => $day){
  if($key == 0) $day = "";
?>
            <th><?= h($day) ?></th>
<?php
}
?>
          </tr>
<?php
for($time=1; $time<=6; $time++){
?>
          <tr>
            <td><?= h($time) ?></td>
<?php
  for($day=1; $day<=6; $day++){
?>
            <td><label><input type="checkbox" name="time[]" value="<?= h((($day-1)*6+$time)) ?>" <?= $timetables[(($day-1)*6+$time)] ? 'checked' : '' ?>><span></span></label></td>
<?php
  }
?>
          </tr>
<?php
}
?>
        </table>
      </div>
      <div class="form_content">
        <input type="submit" value="登録" class="submit_button">
      </div>
    </form>
  </div>
</div>
</body>
</html>