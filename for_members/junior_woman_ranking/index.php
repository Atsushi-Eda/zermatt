<?php
require_once('../lib/library.php');
index_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>3女ランキングTOP</title>
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
      <a href="../">TOP</a> > 3女ランキングTOP
    </div>
    <?= flash_message() ?>
    <h2>3女ランキングTOP</h2>
    <p><a href="form.php">>>回答する</a></p>
<?php
foreach($ranks as $rank){
?>
    <div class="box">
      <div style="padding:5px 0;">
        <span>順位:</span>
        <span><?= h($rank['rank']) ?>位</span>
      </div>
      <div style="padding:5px 0;">
        <span>氏名:</span>
        <span><?= h($candidates[$rank['candidate']]) ?></span>
      </div>
      <div style="padding:5px 0;">
        <span>魅力:</span>
        <p><?= h($rank['good']) ?></p>
      </div>
      <div style="padding:5px 0;">
        <span>改善点:</span>
        <p><?= h($rank['bad']) ?></p>
      </div>
    </div>
<?php
}
?>
  </div>
</div>
</body>
</html>