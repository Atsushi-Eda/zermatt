<?php
require_once('lib/library.php');
calendar_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title><?= h($y) ?>年<?= h($m) ?>月カレンダー | 早稲田大学公認スキーサークル ZERMTT SKI CLUB (ツェルマットスキークラブ)</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="ZERMATT SKI CLUB(ツェルマットスキークラブ)のカレンダーを掲載しております。">
  <link rel="index" href="index.php">
  <?= readCss("css/reset.css") ?>
  <?= readCss("css/font.css") ?>
  <?= readCss("css/menu.css") ?>
  <?= readCss("css/calendar.css") ?>
  <?= readJs("js/jquery-1.11.3.min.js") ?>
  <?= readJs("js/menu.js") ?>
</head>
<body>
  <header>
    <h1><a href="./">ZERMATT SKI CLUB</a></h1>
    <h2><?= h($y) ?>年<?= h($m) ?>月カレンダー</h2>
  </header>
<?php
include('inc/menu.php');
?>
  <div id="calendar_wrap">
  <table id="calendar">
    <caption>
      <ul>
        <li style="width:25%;"><a href="calendar.php?date=<?php echo date('Y-m', strtotime($y .'-' . $m . ' -1 month')); ?>">&lt; 前の月</a></li>
        <li style="width:50%;"><?php echo $y ?>年<?php echo $m ?>月</li>
        <li style="width:25%;"><a href="calendar.php?date=<?php echo date('Y-m', strtotime($y .'-' . $m . ' +1 month')); ?>">次の月 &gt;</a></li>
      </ul>
    </caption>
    <tr>
      <th>日</th>
      <th>月</th>
      <th>火</th>
      <th>水</th>
      <th>木</th>
      <th>金</th>
      <th>土</th>
    </tr>
    <tr>
<?php
$wd1 = date("w", mktime(0, 0, 0, $m, 1, $y));
for($i = 1; $i <= $wd1; $i++){
?>
      <td></td>
<?php
}
$d = 1;
while(checkdate($m, $d, $y)){
?>
      <td>
        <p class="<?= (!empty($national_holidays[date("Y-m-d", mktime(0, 0, 0, $m, $d, $y))])) ? "holiday" : "normalday" ?>">
          <?= h($d) ?>
        </p>
        <div class="day_content_large">
<?php
  if(isset($events[$d])){
?>
          <p class="event"><?= h($events[$d]) ?></p>
<?php
  }
  if(is_array($other_events[$d])){
    foreach($other_events[$d] as $other_event){
?>
          <p class="other_event"><?= h($other_event) ?></p>
<?php
    }
  }
  if(isset($birthdays[$d])){
?>
          <p class="birthday"><?= h($birthdays[$d]) ?>誕生日</p>
<?php
  }
?>
        </div>
        <div class="day_content_small">
<?php
  if(isset($events[$d]) || isset($other_events[$d]) || isset($birthdays[$d])){
?>
          <input id="modal-trigger<?= h($d) ?>" type="checkbox">
<?php
  }
?>
          <label for="modal-trigger<?= h($d) ?>">
<?php
  if(isset($events[$d])){
?>
            <img src="img/calendar/event.png">
<?php
  }
?>
<?php
  if(isset($other_events[$d])){
?>
            <img src="img/calendar/other_event.png">
<?php
  }
?>
<?php
  if(isset($birthdays[$d])){
?>
            <img src="img/calendar/birthday.png">
<?php
  }
?>
          </label>
          <div class="modal-overlay">
            <div class="modal-wrap">
              <label for="modal-trigger<?= h($d) ?>">✖</label>
              <div class="modal-content">
                <p class="modal-title"><?= h($m) ?>月<?= h($d) ?>日</p>
<?php
  if(isset($events[$d])){
?>
                <p class="event"><?= h($events[$d]) ?></p>
<?php
  }
  if(is_array($other_events[$d])){
    foreach($other_events[$d] as $other_event){
?>
                <p class="other_event"><?= h($other_event) ?></p>
<?php
    }
  }
  if(isset($birthdays[$d])){
?>
                <p class="birthday"><?= h($birthdays[$d]) ?>ハッピーバースデイ</p>
<?php
  }
?>
              </div>
            </div>
          </div>
        </div>
      </td>
<?php
  if(date("w", mktime(0, 0, 0, $m, $d, $y)) == 6){
?>
    </tr>
<?php
    if(checkdate($m, $d + 1, $y)){
?>
    <tr>
<?php
    }
  }
  $d++;
}
$wdx = date("w", mktime(0, 0, 0, $m + 1, 0, $y));
for ($i = 1; $i < 7 - $wdx; $i++){
?>
      <td></td>
<?php
}
?>
    </tr>
  </table>
  </div>
<script>
$(function(){
  $('#calendar').on('touchstart', onTouchStart);
  $('#calendar').on('touchmove', onTouchMove);
  $('#calendar').on('touchend', onTouchEnd);
  var direction, position;
  function onTouchStart(event){
    position = getPosition(event);
    direction = '';
  }
  function onTouchMove(event){
    $("#calendar").css("margin-left", (getPosition(event) - position) + "px");
    if(position - getPosition(event) > 70){
      direction = 'left';
    }else if(position - getPosition(event) < -70){
      direction = 'right';
    }else{
      direction = '';
    }
  }
  function onTouchEnd(event) {
    $("#calendar").css("margin-left", "5px");
    if(direction == 'right'){
      location.href = "http://<?= ROOT_DIR ?>/calendar.php?date="+"<?= h(date('Y-m', strtotime($y .'-' . $m . ' -1 month'))) ?>";
    } else if (direction == 'left'){
      location.href = "http://<?= ROOT_DIR ?>/calendar.php?date="+"<?= h(date('Y-m', strtotime($y .'-' . $m . ' +1 month'))) ?>";
    }
  }
  function getPosition(event){
    return event.originalEvent.touches[0].pageX;
  }
});
</script>
</body>
</html>