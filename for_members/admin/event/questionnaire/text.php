<?php
require_once('../../../lib/library.php');
text_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>メーリス送信用参加者リスト</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">企画管理</a> > <a href="./">アンケート結果</a> > <a href="view.php">詳細表示</a> > メーリス送信用参加者リスト
    </div>
    <?= flash_message() ?>
    <h2>メーリス送信用参加者リスト(<?= h($event['short_name']) ?>)</h2>
    <div class="buttons">
      <div class="button">クリップボードにコピー</div>
    </div>
    <textarea id="textarea" style="width:100%;height:70vh;box-sizing:border-box;"><?= h($text) ?></textarea>
  </div>
</div>
<?= readJs("../../../../js/jquery-1.11.3.min.js") ?>
<?= readJs("js/text.js") ?>
</body>
</html>