<?php
require_once('../lib/library.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>インラインメニュー</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= readCss("../css/reset.css") ?>
  <?= readCss("css/index.css") ?>
  <style>
<?php
$sql = "SELECT * FROM inline_steps ORDER BY step ASC";
foreach($pdo->query($sql) as $step){
?>
    #step<?= h($step['step']) ?>{
      background: <?= h($step['color']) ?>
    }
<?php
}
?>
  </style>
</head>
<body>
  <h1>インラインメニュー</h1>
  <div id="step_table"><a href="file/step.jpg" target="_blank"><?= readImg("file/step.jpg") ?></a></div>
<?php
include('inc/menu.php');
?>
  <div id="inline">
<?php
$sql = "SELECT * FROM inline_steps ORDER BY step ASC";
foreach($pdo->query($sql) as $step){
?>
    <div id="step<?= h($step['step']) ?>" class="inline_step">
      <h2>ステップ<?= h($step['step']) ?></h2>
      <p class="purpose"><?= h($step['purpose']) ?></p>
      <div class="inline_menus">
<?php
  $sql = "SELECT * FROM inline_menus WHERE step = {$step['step']} ORDER BY menu ASC";
  foreach($pdo->query($sql) as $menu){
?>
        <div class="inline_menu">
          <h3><?= h($menu['menu']) ?>. <?= h($menu['title']) ?></h3>
          <dl>
            <dt>・やり方</dt>
            <dd><?= h($menu['manner']) ?></dd>
            <dt>・ポイント</dt>
            <dd><?= str_replace(',', '<br>', $menu['point']) ?></dd>
          </dl>
          <iframe src="https://www.youtube.com/embed/<?= h($menu['video']) ?>?rel=0" frameborder="0" allowfullscreen></iframe>
        </div>
<?php
  }
?>
      </div>
    </div>
<?php
}
?>
  </div>
</body>
</html>