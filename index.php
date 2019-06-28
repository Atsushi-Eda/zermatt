<?php
require_once('lib/library.php');
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
    <img src="img/background/1.png">
    <img src="img/background/2.png">
    <img src="img/background/3.png">
    <img src="img/background/4.png">
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
foreach(scandir(dirname(__FILE__) . "/img/mv/", SCANDIR_SORT_DESCENDING) as $file){
  if($file=="." || $file==".."){
    continue;
  }
  if(strpos($file,'t') !== false){
    $trim_type = "trim_top";
  }else if(strpos($file,'b') !== false){
    $trim_type = "trim_bottom";
  }else{
    $trim_type = "trim_both";
  }
?>
      <div><?= readImg("img/mv/".$file, $trim_type) ?></div>
<?php
}
?>
    </div>
    <div class="arrows-wrap"><div class="arrows"><span></span><span></span><span></span></div></div>
  </div>
  <div id="home">
    <h2 class="inview">ホーム</h2>
    <div id="blog" class="inview">
      <h3>ブログ</h3>
      <script type="text/javascript" src="https://feed.mikle.com/js/fw-loader.js" data-fw-param="74402/"></script>
    </div>
    <div id="twitter" class="inview">
      <h3>ツイッター</h3>
      <a class="twitter-timeline" href="https://twitter.com/zermattskiclub" data-widget-id="736535935202918402">@zermattskiclubさんのツイート</a>
      <script>
      !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
      </script>
    </div>
    <div id="youtube" class="inview">
      <h3>新歓ビデオ</h3>
      <iframe src="https://drive.google.com/file/d/1PL9jWUjxnWfagIsvHVsTN9ehhwb_gBuS/preview"></iframe>
    </div>
  </div>
  <div id="about">
    <h2 class="inview">サークル紹介</h2>
    <div class="inview">
      <img src="img/about/1.png">
    </div>
    <p class="inview">
      ZERMATT SKI CLUBは、早稲田大学公認のスキーサークルで、オール早稲田スキー連盟にも加盟しています！サークル員のほとんどはスキー初心者から始めます。2015年度、全国学生岩岳スキー大会、オール早稲田大会では女子チームが優勝！2016年度、オール早稲田大会、女子チーム優勝！と成績を残しています。オフは全力で楽しみ、仲間との絆をつくり、シーズンは優勝を目指し全力に。全てに全力になれる仲間と、岩岳大会、オール早稲田大会、男女総合優勝を目指し、最高の大学生活を送ろう！！
    </p>
  </div>
  <div id="member">
    <h2 class="inview">メンバー紹介</h2>
    <a href="member.php?grade=b3" class="inview">
      <div class="grade_box">
        <img src="img/grade/<?= h(MANAGER_GRADE) ?>.jpg">
        <p><?= h(ordSuffix(MANAGER_GRADE)) ?>(3年生幹部)</p>
      </div>
    </a>
<?php
if($show_b1){
?>
    <a href="member.php?grade=b1" class="inview">
      <div class="grade_box">
        <img src="img/grade/<?= h(MANAGER_GRADE + 2) ?>.jpg">
        <p><?= h(ordSuffix(MANAGER_GRADE + 2)) ?>(1年生)</p>
      </div>
    </a>
<?php
}
?>
    <a href="member.php?grade=b2" class="inview">
      <div class="grade_box">
        <img src="img/grade/<?= h(MANAGER_GRADE + 1) ?>.jpg">
        <p><?= h(ordSuffix(MANAGER_GRADE + 1)) ?>(2年生)</p>
      </div>
    </a>
    <a href="member.php?grade=b4" class="inview">
      <div class="grade_box">
        <img src="img/grade/<?= h(MANAGER_GRADE - 1) ?>.jpg">
        <p><?= h(ordSuffix(MANAGER_GRADE - 1)) ?>(4年生)</p>
      </div>
    </a>
    <a href="member.php?grade=m" class="inview">
      <div class="grade_box">
        <img src="img/grade/44.jpg">
        <p><?= h(ordSuffix($oldest)) ?>~<?= h(ordSuffix(MANAGER_GRADE - 2)) ?>(上級生)</p>
      </div>
    </a>
  </div>
  <div id="link">
    <h2 class="inview">リンク</h2>
    <div class="inview">
      <h3>オール早稲田</h3>
      <ul>
        <li><a target="_blank" href="http://basicskiclub38th.wixsite.com/basicskiclub">BASIC/ベーシック</a></li>
        <li><a target="_blank" href="http://belleskiclub.wixsite.com/belleskiclub">Belle/ベル</a></li>
        <li><a target="_blank" href="http://lespoirskiclub.web.fc2.com/">L'espoir/レスポワール</a></li>
        <li><a target="_blank" href="https://montblancski-2015.jimdo.com/">MONTBLANC/モンブラン</a></li>
        <li><a target="_blank" href="http://neigeski.web.fc2.com/index.html">Neige/ネージュ</a></li>
        <li><a target="_blank" href="http://nichee38th.wixsite.com/nicheeskiclub">Nichee/ニッシェ</a></li>
        <li><a target="_blank" href="http://www.sugar-ski.com/2010/">Sugar/スガ</a></li>
        <li><a target="_blank" href="http://wss-ski.com/">W.S.S/早稲田スキー同好会</a></li>
      </ul>
    </div>
    <div class="inview">
      <h3>スキー場・大会</h3>
      <ul>
        <li><a target="_blank" href="http://www.shigakogen.gr.jp/">志賀高原観光協会</a></li>
        <li><a target="_blank" href="http://www.oze-iwakura.co.jp/ski/">ホワイトワールド尾瀬岩鞍</a></li>
        <li><a target="_blank" href="http://ssci.iwatake.jp/">全国学生岩岳大会</a></li>
      </ul>
    </div>
  </div>
</body>
</html>
