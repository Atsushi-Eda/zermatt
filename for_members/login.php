<?php
require_once('lib/library.php');
login_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>ログイン | ZERMATT SKI CLUB</title>
  <?= readCss("../css/reset.css") ?>
  <?= readCss("../jquery-ui-1.12.1.custom/jquery-ui.min.css") ?>
  <?= readCss("css/for_members.css") ?>
  <?= readCss("css/form.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('inc/header.php');
?>
  <div id="maincontents">
    <h2>ログイン</h2>
    <?= flash_message() ?>
    <form id="form" method="post" action="login.php" autocomplete="off">
      <div class="form_content">
        <p>名前</p>
        <input type="text" name="name" id="name" placeholder="ツェルマット太郎">
      </div>
      <div class="form_content">
        <p>パスワード</p>
        <input type="text" name="password" placeholder="abc123">
      </div>
      <div class="form_content">
        <label><input type="checkbox" name="auto_login" value="true" checked>自動ログインを有効にする。</label>
      </div>
      <div class="form_content">
        <input type="submit" value="ログイン" class="submit_button">
      </div>
    </form>
  </div>
  <?= readJs("../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../jquery-ui-1.12.1.custom/jquery-ui.min.js") ?>
  <script>
  memberList = [
<?php
$sql = "SELECT name, phonetic FROM members WHERE view = true ORDER BY phonetic ASC";
foreach($pdo->query($sql) as $member){
?>
    ['<?= $member['name'] ?>', '<?= $member['phonetic'] ?>'],
<?php
}
?>
  ];
  </script>
  <?= readJs("js/rome.js") ?>
  <?= readJs("js/autocomplete.js") ?>
</div>
</body>
</html>