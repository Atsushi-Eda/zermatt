  <header>
    <h1><a href="http://<?= h(ROOT_DIR) ?>/for_members/">ZERMATT SKI CLUB<br>メンバー用ページ</a></h1>
<?php
if(isset($_SESSION['user']['id'])){
?>
    <div>
      <p><?= h($_SESSION['user']['name']); ?>さん</p>
      <p><a href="http://<?= h(ROOT_DIR) ?>/for_members/logout.php?from=<?= h($_SERVER['SCRIPT_NAME']) ?>">ログアウト</a></p>
    </div>
<?php
}
?>
  </header>
