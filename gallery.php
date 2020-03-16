<?php
$need_pass = true;
require_once('lib/library.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ギャラリー | 早稲田大学公認スキーサークル ZERMTT SKI CLUB (ツェルマットスキークラブ)</title>
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
    <h2>ギャラリー</h2>
  </header>
<?php
include('inc/menu.php');
?>
  <div id="gallery">
    <div id="album">
      <h3>アルバム</h3>
      <p class="note">
        <a target="_blank" href="http://zermatt.who.ph/45th_gallery.php">>>45代のギャラリーはこちら</a>
        <br>
        <a target="_blank" href="http://zermatt.who.ph/46th_gallery.php">>>46代のギャラリーはこちら</a>
      </p>
<?php
$grade = $_GET['ver'] ? $_GET['ver'] : MANAGER_GRADE;
$sql = "SELECT * FROM albums WHERE grade = $grade ORDER BY id ASC";
foreach($pdo->query($sql) as $album){
?>
      <a href="<?= $album['url'] ?>">
        <div class="gallery_box">
          <div class="slide">
<?php
  foreach(scandir(dirname(__FILE__) . "/img/gallery/" . $album['id'] . "/") as $file){
    if($file=="." || $file==".."){
      continue;
    }
?>
            <div><?= readImg("img/gallery/" . $album['id'] . "/" . $file) ?></div>
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
    <div id="video">
      <h3>ビデオ</h3>
<?php
$sql = "SELECT * FROM videos WHERE grade = $grade ORDER BY id ASC";
foreach($pdo->query($sql) as $video){
?>
      <div class="gallery_box">
        <iframe src="<?= $video['url'] ?>"></iframe>
        <p><?= $video['name'] ?></p>
      </div>
<?php
}
?>
    </div>
  </div>
</body>
</html>
