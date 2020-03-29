<?php
require_once('../../lib/library.php');
edit_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>トレ出欠登録</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/for_members.css") ?>
  <?= readCss("../../css/form.css") ?>
  <?= readCss("css/edit.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > <a href="./">トレ管理</a> > トレ出欠登録
    </div>
    <?= flash_message() ?>
    <h2><?= h(date("Y/n/j", strtotime($filter_date))) ?>(<?= h($weekjp[date('w', strtotime($filter_date))]) ?>)トレ出欠登録</h2>
    <div class=form_content>
      <input type="date" name="filter_date" class="filter_date" value="<?= $filter_date ?>">へ移動
    </div>
<?php
foreach($grades as $grade){
?>
    <div id="<?= h(ordSuffix($grade)) ?>" class="grade_box">
      <h3><?= h(ordSuffix($grade)) ?></h3>
<?php
  foreach($members[$grade] as $member){
?>
      <label class="member"><input type="checkbox" value="<?= h($member['id']) ?>" <?= $participations[$member['id']] ? 'checked' : '' ?>><span><?= h($member['name']) ?></span></label>
<?php
  }
?>
    </div>
<?php
}
?>
  <footer>
    <ul>
<?php
foreach($grades as $grade){
?>
      <li><a href="#<?= h(ordSuffix($grade)) ?>"><?= h(ordSuffix($grade)) ?></a></li>
<?php
}
?>
    </ul>
  </footer>
  </div>
</div>
<?= readJs("../../../js/jquery-1.11.3.min.js") ?>
<?= readJs("../../js/filter_date.js") ?>
<script>
$(function(){
  var date = '<?= h($filter_date) ?>';
  $(".member input").change(function(){
    var id = $(this).val();
    var state = $(this).prop("checked");
    $.ajax({
      type: "POST",
      url: "check.php",
      data: {
        "id": id,
        "date": date,
        "state": state
      },
    });
  });
});
</script>
</body>
</html>
