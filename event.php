<?php
require_once('lib/library.php');
$grade = isset($_GET['ver']) ? $_GET['ver'] : MANAGER_GRADE;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>企画紹介</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="こちらは、ZERMATT SKI CLUB(ツェルマットスキークラブ)の企画紹介ページです。">
  <link rel="index" href="index.php">
  <?= readCss("css/reset.css") ?>
  <?= readCss("css/font.css") ?>
  <?= readCss("css/slick.css") ?>
  <?= readCss("css/menu.css") ?>
  <?= readCss("css/event.css") ?>
  <?= readJs("js/jquery-1.11.3.min.js") ?>
  <?= readJs("js/slick.js") ?>
  <?= readJs("js/menu.js") ?>
  <?= readJs("js/event.js") ?>
</head>
<body>
  <header>
    <h1><a href="./">ZERMATT SKI CLUB</a></h1>
    <h2>企画紹介</h2>
  </header>
<?php
include('inc/menu.php');
?>
  <div class="note">
<?php
$sql = "SELECT DISTINCT grade FROM events WHERE view = 1 ORDER BY grade ASC";
foreach($pdo->query($sql) as $grades){
  if($grades['grade'] == $grade){
    continue;
  }
?>
    <p><a href="event.php?ver=<?= h($grades['grade']) ?>">&gt;&gt;<?= h($grades['grade']) ?>代の企画紹介はこちら</a></p>
<?php
}
?>
  </div>
  <div id="events">
<?php
$sql = "SELECT * FROM events WHERE grade = {$grade} AND view = true ORDER BY date ASC";
foreach($pdo->query($sql) as $event){
?>
    <div class="event">
      <h3>
      <?= h(date("n/j", strtotime($event['date']))) ?>(<?= h($weekjp[date("w", strtotime($event['date']))]) ?>)
<?php
  if($event['duration'] > 1){
?>
          ~
        <?= h(date('n/j', strtotime("{$event['date']} +{$event['duration']} day -1 day"))) ?>(<?= h($weekjp[date("w", strtotime("{$event['date']} +{$event['duration']} day -1 day"))]) ?>)
<?php
  }
?>
        <?= h($event['name']) ?>
      </h3>
<?php
  if(file_exists(dirname(__FILE__) . "/img/event/" . $event['id'] . "/")){
?>
      <div class="slide">
<?php
    foreach(scandir(dirname(__FILE__) . "/img/event/" . $event['id'] . "/") as $file){
      if($file=="." || $file==".."){
        continue;
      }
?>
        <div><img src="img/event/<?= h($event['id']) ?>/<?= h($file) ?>"></div>
<?php
    }
?>
      </div>
<?php
  }
?>
      <p class="intro">
        <?= h($event['intro']) ?>
      </p>
<?php
  if(!empty($event['video'])){
?>
      <p><a href="<?= h($event['video']) ?>" target="_brank">>>紹介ビデオはこちら</a></p>
<?php
  }
?>
    </div>
<?php
}
?>
  </div>
</body>
</html>
