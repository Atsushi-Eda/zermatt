<?php
require_once('../lib/library.php');
detail_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title><?= h($candidate) ?> | 3女ランキング詳細表示</title>
  <?= readCss("../../css/reset.css") ?>
  <?= readCss("../css/for_members.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../">TOP</a> > <a href="./">3女ランキングTOP</a> > <a href="view.php">3女ランキング結果</a> > <?= h($candidate) ?>詳細表示
    </div>
    <?= flash_message() ?>
    <h2>3女ランキング詳細表示</h2>
    <div class="box">
      <h3>理由</h3>
      <textarea style="width:100%; height:300px;">
<?= h($candidate) ?>

魅力
<?php
foreach($reasons as $reason){
echo $reason['good']."\n";
}
?>

改善点
<?php
foreach($reasons as $reason){
echo $reason['bad']."\n";
}
?></textarea>
    </div>
  </div>
</div>
</body>
</html>