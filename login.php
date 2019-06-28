<?php
require_once('lib/library.php');
login_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>パスワード保護</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= readCss("css/reset.css") ?>
  <?= readCss("css/font.css") ?>
  <?= readCss("css/form.css") ?>
</head>
<body>
<?php
if(isset($_POST['password'])){
?>
  <p style="color:red;padding:15px;">パスワードが正しくありません。</p>
<?php
}
?>
  <form action="login.php" method="POST">
    <div class="form_content">
      <p>パスワード</p>
      <input type="text" name="password">
    </div>
    <div class="form_content">
      <label><input type="checkbox" name="auto_login" value="true" checked>自動ログインを有効にする。</label>
    </div>
    <div class="form_content">
      <input type="submit" value="送信" class="submit_button">
    </div>
  </form>
</body>
</html>