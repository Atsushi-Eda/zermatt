<?php
require_once('../lib/library.php');
form_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>3女ランキング回答</title>
  <?= readCss("../../css/reset.css") ?>
  <?= readCss("../css/validationEngine.jquery.css") ?>
  <?= readCss("../css/for_members.css") ?>
  <?= readCss("../css/form.css") ?>
  <?= readJs("../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../js/jquery.validationEngine.js") ?>
  <?= readJs("../js/jquery.validationEngine-ja.js") ?>
  <?= readJs("../js/validation.js") ?>
  <?= readJs("js/form.js") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../">TOP</a> > <a href="./">3女ランキングTOP</a> > 3女ランキング回答
    </div>
    <?= flash_message() ?>
    <h2>3女ランキング回答</h2>
    <form id="form" method="post" action="form.php" autocomplete="off" onsubmit="return duplicationCheck();">
<?php
foreach($candidates as $candidate_key => $candidate){
?>
      <fieldset>
        <legend><?= h($candidate) ?></legend>
        <div class="form_content required">
          <p>順位</p>
          <input type="number" name="<?= h($candidate_key) ?>[rank]" value="<?= h($ranks[$candidate_key]['rank']) ?>" min="1" max="<?= h($count) ?>" class="noDuplication">位
        </div>
        <div class="form_content">
          <p>魅力</p>
          <textarea name="<?= h($candidate_key) ?>[good]"><?= h($ranks[$candidate_key]['good']) ?></textarea>
        </div>
        <div class="form_content">
          <p>改善点</p>
          <textarea name="<?= h($candidate_key) ?>[bad]"><?= h($ranks[$candidate_key]['bad']) ?></textarea>
        </div>
      </fieldset>
<?php
}
?>
      <div class="form_content">
        <input type="submit" value="回答" class="submit_button">
      </div>
    </form>
  </div>
</div>
</body>
</html>