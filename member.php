<?php
$need_pass = true;
require_once('lib/library.php');
member_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>メンバー紹介 | 早稲田大学公認スキーサークル ZERMTT SKI CLUB (ツェルマットスキークラブ)</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="こちらは、ZERMATT SKI CLUB(ツェルマットスキークラブ)のメンバー紹介ページです。">
  <link rel="index" href="index.php">
  <?= readCss("css/reset.css") ?>
  <?= readCss("css/font.css") ?>
  <?= readCss("css/menu.css") ?>
  <?= readCss("css/member.css") ?>
  <?= readJs("js/jquery-1.11.3.min.js") ?>
  <?= readJs("js/menu.js") ?>
  <style>
<?php
foreach($grades as $grade){
$sql = "SELECT color FROM grades WHERE grade = $grade";
$color = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
?>
    .on_<?= h($grade) ?>{
      background: <?= h($color['color']) ?>;
    }
    .on_<?= h($grade) ?> h2:after{
      content: ' <?= h(ordSuffix($grade)) ?>';
      color: #fff;
    }
<?php
  if(!$sp){
?>
    /* #grade_<?= h($grade) ?>{
      background-image: url("img/grade/<?= h($grade) ?>.jpg?date=<?= filemtime("img/grade/".$grade.".jpg") ?>");
      background-attachment: fixed;
      background-size:cover;
      background-position: center;
      background-repeat: no-repeat;
    } */
<?php
  }
}
?>
  </style>
</head>
<body>
  <header>
    <h1><a href="./">ZERMATT SKI CLUB</a></h1>
    <h2>MEMBER</h2>
  </header>
<?php
include('inc/menu.php');
?>
<?php
foreach($grades as $grade){
?>
  <div id="grade_<?= h($grade) ?>" class="grade_box">
    <h3 class="tit_grade"><?= h(ordSuffix($grade)) ?></h3>
<?php
  $order = ($grade <= $manager) ? '`order`' : '`phonetic`';
  $sql = "SELECT * FROM {$member_table} WHERE intro_view = 1 AND grade = $grade ORDER BY {$order} ASC";
  foreach($pdo->query($sql) as $member){
?>
    <div class="member_box">
<?php
    if($member['position'] !== ''){
?>
      <p><?= h($grade.'代'.$member['position']) ?></p>
<?php
    }
?>
      <h4><?= h($member['name']) ?></h4>
      <p><?= h($member['nickname']) ?></p>
<?php
    if($member['birthmonth'] && $member['birthday']){
?>
      <p><?= h($member['birthmonth']) ?>月<?= h($member['birthday']) ?>日生まれ</p>
<?php
    }
?>
<?php
    if(file_exists("img/".$member_image."/".$member['id'].".jpg")!==false){
?>
      <div class="member_img"><?= readImg("img/".$member_image."/".$member['id'].".jpg") ?></div>
<?php
    }else{
?>
      <div class="member_img"><img src="img/member/coming_soon.jpg" /></div>
<?php
    }
    if($member['intro']!=''){
?>
      <p><?= h($member['intro']) ?></p>
<?php
    }
    if($member['blog']!=''){
?>
      <p><a href="http://ameblo.jp/zermatt<?= h(ordSuffix($grade)) ?>/entry-<?= h($member['blog']) ?>.html" target="_blank">>>紹介ブログへ</a></p>
<?php
      if($member['video']!=''){
?>
      <p><a href="<?= h($member['video']) ?>" target="_blank">>>紹介ビデオへ</a></p>
<?php
      }
    }
?>
    </div>
<?php
  }
?>
  </div>
<?php
}
?>
<script>
$(function(){
<?php
foreach($grades as $grade){
?>
  if($(this).scrollTop() < ($("#grade_<?= h($grade) ?>").offset().top - window.innerHeight/2) || $(this).scrollTop() > ($("#grade_<?= h($grade) ?>").offset().top + $("#grade_<?= h($grade) ?>").outerHeight() - window.innerHeight/2)){
    $("header").removeClass('on_<?= h($grade) ?>');
  }else{
    $("header").addClass('on_<?= h($grade) ?>');
  }
  $(window).scroll(function(){
    if($(this).scrollTop() < ($("#grade_<?= h($grade) ?>").offset().top - window.innerHeight/2) || $(this).scrollTop() > ($("#grade_<?= h($grade) ?>").offset().top + $("#grade_<?= h($grade) ?>").outerHeight() - window.innerHeight/2)){
      $("header").removeClass('on_<?= h($grade) ?>');
    }else{
      $("header").addClass('on_<?= h($grade) ?>');
    }
  });
<?php
}
?>
});
</script>
</body>
</html>