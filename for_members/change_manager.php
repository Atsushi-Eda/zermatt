<?php
require_once('lib/library.php');
change_manager_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>幹部代変更</title>
  <?= readCss("../css/reset.css") ?>
  <?= readCss("css/validationEngine.jquery.css") ?>
  <?= readCss("css/for_members.css") ?>
  <?= readCss("css/form.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="./">TOP</a> > 幹部代変更
    </div>
    <h2>幹部代変更</h2>
    <form id="form" method="post" action="change_manager.php" autocomplete="off">
      <div class="form_content required">
        <p>幹部代</p>
        <input type="number" name="manager_grade" value="<?= h($manager_grade) ?>">代
      </div>
      <div class="form_content">
        <input type="submit" value="変更" class="submit_button">
      </div>
    </form>
  </div>
  <?= readJs("../js/jquery-1.11.3.min.js") ?>
  <?= readJs("js/jquery.validationEngine.js") ?>
  <?= readJs("js/jquery.validationEngine-ja.js") ?>
  <?= readJs("js/validation.js") ?>
</div>
</body>
</html>
