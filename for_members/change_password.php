<?php
require_once('lib/library.php');
change_password_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>パスワード変更</title>
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
      <a href="./">TOP</a> > パスワードの変更
    </div>
    <?= flash_message() ?>
    <h2>パスワードの変更</h2>
    <form id="form" method="post" action="change_password.php" autocomplete="off">
      <div class="form_content required">
        <p>新規パスワード</p>
        <input type="text" name="new_password" class="validate[custom[onlyLetterNumber]]" placeholder="abc123">
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
