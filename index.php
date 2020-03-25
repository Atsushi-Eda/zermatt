<?php
require_once('lib/library.php');
index_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>早稲田大学公認スキーサークル ZERMTT SKI CLUB (ツェルマットスキークラブ)</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="こちらは、ZERMATT SKI CLUB(ツェルマットスキークラブ)の公式ホームページです。ZERMATT SKI CLUBは、早稲田大学公認のスキーサークルで、オール早稲田スキー連盟にも加盟しています。スキー、スポーツに興味のある方は是非お越しください。">
  <?= readCss("css/reset.css") ?>
  <?= readCss("css/font.css") ?>
  <?= readCss("css/slick.css") ?>
  <?= readCss("css/menu.css") ?>
  <?= readCss("css/inview.css") ?>
  <?= readCss("css/index.css") ?>
  <?= readJs("js/jquery-1.11.3.min.js") ?>
  <?= readJs("js/jquery.inview.min.js") ?>
  <?= readJs("js/inview.js") ?>
  <?= readJs("js/imagesloaded.pkgd.min.js") ?>
  <?= readJs("js/slick.js") ?>
  <?= readJs("js/menu.js") ?>
  <?= readJs("js/index.js") ?>
</head>
<body>
  <div id="background">
<?php
foreach(scandir("img/background/", SCANDIR_SORT_DESCENDING) as $file){
  if($file=="." || $file==".."){
    continue;
  }
?>
    <?= readImg("img/background/".$file) ?>
<?php
}
?>
  </div>
<?php
include('inc/menu.php');
?>
  <div id="mainvisual">
    <header>
      <h1>Zermatt Ski Club</h1>
      <p>Recognized by Waseda University</p>
    </header>
    <div id="mv_slide">
<?php
foreach($mainvisuals as $mainvisual){
?>
      <div><?= readImg("img/mv/".$mainvisual) ?></div>
<?php
}
?>
    </div>
    <div class="arrows-wrap"><div class="arrows"><span></span><span></span><span></span></div></div>
  </div>
  <section id="sns" class="index_section">
    <h2 class="inview">SNS</h2>
<?php
foreach($snss as $sns){
?>
    <div class="inview card">
      <h3><?= $sns['name'] ?></h3>
      <?= $sns['widget'] ?>
    </div>
<?php
}
?>
  </section>
  <section id="about" class="index_section">
    <h2 class="inview">サークル紹介</h2>
    <div class="inview">
<?php
foreach(scandir("img/about/", SCANDIR_SORT_DESCENDING) as $file){
  if($file=="." || $file==".."){
    continue;
  }
?>
      <?= readImg("img/about/".$file) ?>
<?php
}
?>
    </div>
    <p class="inview"><?= h($circle_introduction) ?></p>
    <div id="video" class="inview card">
      <p>新歓ビデオ</p>
      <iframe src="<?= h($solicitation_video) ?>"></iframe>
    </div>
  </section>
  <section id="member" class="index_section">
    <h2 class="inview">メンバー紹介</h2>
<?php
foreach($menu_grades as $menu_grade){
?>
    <a href="member.php?grade=<?= h($menu_grade['tag']) ?>" class="inview card">
      <div class="grade_box">
        <img src="img/grade/<?= h($menu_grade['image']) ?>">
        <p><?= h($menu_grade['label']) ?></p>
      </div>
    </a>
<?php
}
?>
  </section>
  <section id="link" class="index_section">
    <h2 class="inview">リンク</h2>
<?php
foreach($link_categories as $link_category){
?>
    <div class="inview card">
      <h3><?= h($link_category) ?></h3>
      <ul>
<?php
  foreach($links[$link_category] as $link){
?>
        <li><a target="_blank" href="<?= h($link['url']) ?>"><?= h($link['name']) ?></a></li>
<?php
  }
?>
      </ul>
    </div>
<?php
}
?>
  </section>
</body>
</html>
