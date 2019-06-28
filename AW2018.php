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
      <h3>AW2018</h3>
      <a href="https://www.facebook.com/media/set/?set=a.193564828181422.1073741844.100025837174919&type=1&l=f13e40549f">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/1.jpg"></div>
          </div>
          <p>B戦急斜面総滑</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193569028181002.1073741845.100025837174919&type=1&l=c701183a4d">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/2.jpg"></div>
          </div>
          <p>B戦中斜面大回り</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193575171513721.1073741847.100025837174919&type=1&l=82ca1ac4a9">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/3.jpg"></div>
          </div>
          <p>男子急斜面</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193584564846115.1073741849.100025837174919&type=1&l=86f79c8453">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/4.jpg"></div>
          </div>
          <p>男子緩斜面</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193582591512979.1073741848.100025837174919&type=1&l=3bf7eb0c9d">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/5.jpg"></div>
          </div>
          <p>女子緩斜面</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193588574845714.1073741850.100025837174919&type=1&l=a076216d14">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/6.jpg"></div>
          </div>
          <p>女子新人戦</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193590561512182.1073741851.100025837174919&type=1&l=43d90be322">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/7.jpg"></div>
          </div>
          <p>女子急斜面大回り</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193592458178659.1073741852.100025837174919&type=1&l=d154132c1a">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/8.jpg"></div>
          </div>
          <p>女子中斜面小回り</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193594551511783.1073741853.100025837174919&type=1&l=4bb4e5a6d9">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/9.jpg"></div>
          </div>
          <p>女子中斜面中回り</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193599864844585.1073741855.100025837174919&type=1&l=57600f2958">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/10.jpg"></div>
          </div>
          <p>男子急斜面大回り</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193598118178093.1073741854.100025837174919&type=1&l=f5236453b5">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/11.jpg"></div>
          </div>
          <p>男子新人戦</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193602961510942.1073741856.100025837174919&type=1&l=6609cd27b8">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/12.jpg"></div>
          </div>
          <p>男子中斜面小回り</p>
        </div>
      </a>
      <a href="https://www.facebook.com/media/set/?set=a.193604891510749.1073741857.100025837174919&type=1&l=b8b7937dfa">
        <div class="gallery_box">
          <div class="slide">
            <div><img src="img/gallery/100/13.jpg"></div>
          </div>
          <p>男子中斜面中回り</p>
        </div>
      </a>
    </div>
  </div>
</body>
</html>