<?php
require_once('lib/library.php');
solicitation_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title><?= h(date('Y')) ?>年度新歓情報 | 早稲田大学公認スキーサークル ZERMTT SKI CLUB (ツェルマットスキークラブ)</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="ZERMATT SKI CLUB(ツェルマットスキークラブ)の<?= h(date('Y')) ?>年度新歓情報を掲載しております。早稲田大学のサークルをお探しの方、大学でスキー、スポーツをしたい方は是非お越しください。">
  <link rel="index" href="index.php">
  <?= readCss("css/reset.css") ?>
  <?= readCss("css/font.css") ?>
  <?= readCss("css/menu.css") ?>
  <?= readCss("css/solicitation.css") ?>
  <?= readJs("js/jquery-1.11.3.min.js") ?>
  <?= readJs("js/menu.js") ?>
</head>
<body>
  <header>
    <h1><a href="./">ZERMATT SKI CLUB</a></h1>
    <h2><?= h(date('Y')) ?>年度新歓情報</h2>
  </header>
<?php
include('inc/menu.php');
?>
  <div class="content">
    <h3>新歓チラシ</h3>
    <ul>
      <li><a href="pdf/solicitation.pdf">コンパ情報(PDF)</a></li>
    </ul>
  </div>
  <div class="content">
    <h3>コンパ情報</h3>
      <div id="schedules">
<?php
foreach($schedules as $schedule_id => $schedule){
?>
        <div class="schedule">
          <p class="schedule_title">
          <?= h(date('n/j', strtotime($schedule['date']))) ?>(<?= h($weekjp[date('w', strtotime($schedule['date']))]) ?>)[<?= h($schedule['AMPM']) ?>] <?= h($schedule['place']) ?><?= $schedule['place_category'] ? '('.h($schedule['place_category']).')' : '' ?>
          </p>
<?php
  if($schedule['price']){
?>
          <p>参加費: <?= h($schedule['price']) ?>円</p>
<?php
  }
  if($schedule['my_time'] != "00:00"){
?>
          <p>開始時間: <?= h($schedule['my_time']) ?></p>
<?php
  }
  if($schedule['my_meeting_time'] != "00:00"){
?>
          <p>集合時間: <?= h($schedule['my_meeting_time']) ?></p>
<?php
  }
  if($schedule['meeting_place']){
?>
          <p>集合場所: <?= h(str_replace(',', ' または ', $schedule['meeting_place'])) ?></p>
<?php
  }
?>
          <p>
            空き情報:
<?php
  if(date('Y-m-d') > $schedule['date']){
    echo '終了';
  }elseif($cnt_male[$schedule_id] < $schedule['male'] && $cnt_female[$schedule_id] < $schedule['female']){
    echo '空きあり';
  }elseif($cnt_male[$schedule_id] >= $schedule['male'] && $cnt_female[$schedule_id] >= $schedule['female']){
    echo '空きなし';
  }else{
    echo '連絡を取ってご確認ください';
  }
?>
          </p>
        </div>
<?php
}
?>
      </div>
    </div>
  </div>
  <div class="content">
    <h3>お問い合わせ</h3>
    <dl>
      <dt>メール</dt>
      <dd>zermatt47th@gmail.com</dd>
      <dt>twitter</dt>
      <dd>@zermattskiclub</dd>
    </dl>
  </div>
</body>
</html>