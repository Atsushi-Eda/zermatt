<?php
require_once('../../lib/library.php');
index_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title><?= h($y) ?>年<?= h($m) ?>月カレンダー</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/for_members.css") ?>
  <?= readCss("css/index.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > カレンダー
    </div>
    <?= flash_message() ?>
    <h2><?= h($y) ?>年<?= h($m) ?>月カレンダー</h2>
    <p style="padding:10px;">
      <input type="number" id="year" value="<?= h($y) ?>">年
      <input type="number" id="month" value="<?= h($m) ?>">月
      <a href="javascript:void(0)" id="move_date">へ移動</a>
    </p>
    <div id="calendar_wrap">
    <ul id="calendar" class="box">
<?php
$d = 1;
while(checkdate($m, $d, $y)){
?>
      <li id="day_<?= h($d) ?>">
        <div class="date"><?= h($d) ?>(<?= h($weekjp[date('w', strtotime($y.'-'.$m.'-'.$d))]) ?>)</div>
        <div class="day_content">
<?php
  if(isset($events[$d])){
?>
          <p>
            <span class="title"><?= h($events[$d]) ?></span>
            <span class="time">(終日)</span>
          </p>
<?php
  }
  if(is_array($other_events[$d])){
    foreach($other_events[$d] as $other_event){
?>
          <p>
            <a class="edit" href="edit.php?id=<?= h($other_event['id']) ?>">
              <span class="title"><?= h($other_event['name']) ?></span>
              <span class="time">(<?= (isset($other_event['start_time'])||isset($other_event['end_time'])) ? $other_event['start_time'].'~'.$other_event['end_time'] : '終日' ?>)</span>
            </a>
          </p>
<?php
    }
  }
?>
        </div>
      </li>
<?php
  $d++;
}
?>
    </ul>
    </div>
    <a href="add.php" id="add_btn"><span>+</span></a>
  </div>
</div>
<?= readJs("../../../js/jquery-1.11.3.min.js") ?>
<script>
$(function(){
  $("#move_date").click(function(){
    location.href = "http://<?= ROOT_DIR ?>/for_members/admin/calendar/?date="+$("#year").val()+"-"+('0'+$("#month").val()).slice(-2);
  });
  $('#calendar').on('touchstart', onTouchStart);
  $('#calendar').on('touchmove', onTouchMove);
  $('#calendar').on('touchend', onTouchEnd);
  var direction, positionX, positionY;
  function onTouchStart(event){
    positionX= getPositionX(event);
    positionY= getPositionY(event);
    direction = '';
  }
  function onTouchMove(event){
    $("#calendar").css("margin-left", (getPositionX(event) - positionX) + "px");
    if(Math.abs(positionY - getPositionY(event)) > 70){
      direction = '';
    }else if(positionX - getPositionX(event) > 70){
      direction = 'left';
    }else if(positionX - getPositionX(event) < -70){
      direction = 'right';
    }else{
      direction = '';
    }
  }
  function onTouchEnd(event) {
    $("#calendar").css("margin-left", "0px");
    if(direction == 'right'){
      location.href = "http://<?= ROOT_DIR ?>/for_members/admin/calendar/?date="+"<?= h(date('Y-m', strtotime($y .'-' . $m . ' -1 month'))) ?>";
    } else if (direction == 'left'){
      location.href = "http://<?= ROOT_DIR ?>/for_members/admin/calendar/?date="+"<?= h(date('Y-m', strtotime($y .'-' . $m . ' +1 month'))) ?>";
    }
  }
  function getPositionX(event){
    return event.originalEvent.touches[0].pageX;
  }
  function getPositionY(event){
    return event.originalEvent.touches[0].pageY;
  }
});
<?php
if(!isset($_GET['date'])){
?>
$(window).load(function(){
  $('#day_<?= h(date("j")) ?>').css("background","rgba(0,255,0,.1)");
  $("html,body").animate({scrollTop:$('#day_<?= h(date("j")) ?>').offset().top}, 0.1);
});
<?php
}
?>
</script>
</body>
</html>