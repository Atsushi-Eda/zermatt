<?php
$need_pass = true;
require_once('lib/library.php');
$grade = isset($_GET['ver']) ? $_GET['ver'] : MANAGER_GRADE-1;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title><?= h($grade) ?>代AW大会ギャラリー | 早稲田大学公認スキーサークル ZERMTT SKI CLUB (ツェルマットスキークラブ)</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="こちらは、ZERMATT SKI CLUB(ツェルマットスキークラブ)のギャラリーです。">
  <link rel="index" href="index.php">
  <?= readCss("css/reset.css") ?>
  <?= readCss("css/font.css") ?>
  <?= readCss("css/slick.css") ?>
  <?= readCss("css/menu.css") ?>
  <?= readCss("css/gallery.css") ?>
  <?= readJs("js/jquery-1.11.3.min.js") ?>
  <?= readJs("js/slick.js") ?>
  <?= readJs("js/menu.js") ?>
  <?= readJs("js/gallery.js") ?>
</head>
<body>
  <header>
    <h1><a href="./">ZERMATT SKI CLUB</a></h1>
    <h2><?= h($grade) ?>代AW大会ギャラリー</h2>
  </header>
<?php
include('inc/menu.php');
?>
  <div id="gallery">
    <div id="album">
<?php
$sql = "SELECT * FROM aw_albums WHERE view = 1 AND grade = $grade ORDER BY id ASC";
foreach($pdo->query($sql) as $album){
?>
      <a href="<?= $album['url'] ?>">
        <div class="gallery_box">
          <div class="slide">
<?php
  foreach(scandir("img/aw_gallery/" . $album['id'] . "/") as $file){
    if($file=="." || $file==".."){
      continue;
    }
?>
            <div><?= readImg("img/aw_gallery/" . $album['id'] . "/" . $file) ?></div>
<?php
  }
?>
          </div>
          <p><?= $album['name'] ?></p>
        </div>
      </a>
<?php
}
?>
    </div>
  </div>
</body>
</html>
