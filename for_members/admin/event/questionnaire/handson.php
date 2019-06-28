<?php
require_once('../../../lib/library.php');
handson_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>企画アンケート結果エクセル風表示</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../../css/handsontable.full.min.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("css/handson.css") ?>
  <?= readJs("../../../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../../../../js/handsontable.full.min.js") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">企画管理</a> > <a href="./">アンケート結果</a> > エクセル風表示
    </div>
    <?= flash_message() ?>
    <h2>企画アンケート結果詳細表示</h2>
    <div id="handson"></div>
    <div id="submit" class="button">保存</div>
    <div id="loading"><?= readImg("../../../img/loading.gif") ?></div>
  </div>
</div>
<script>
$(function(){
  var logs = {};
  var data = <?= json_encode($contents) ?>;
  var rowHeaders = <?= json_encode($rowHeaders) ?>;
  var columns = <?= json_encode($columns) ?>;
  new Handsontable(document.getElementById('handson'), {
    data: data,
    rowHeaders: rowHeaders,
    rowHeaderWidth: 100,
    columns: columns,
    afterChange: function(changes, source) {
      if(source === 'loadData') return;
      Array.prototype.forEach.call(changes, function(change){
        if(!logs[data[change[0]].member_id]) logs[data[change[0]].member_id] = {};
        if(!logs[data[change[0]].member_id][change[1].split('.')[0]]) logs[data[change[0]].member_id][change[1].split('.')[0]] = {};
        logs[data[change[0]].member_id][change[1].split('.')[0]][change[1].split('.')[1]] = change[3];
      })
    }
  });
  $("#submit").click(function(){
    $("#loading").show();
    $.post(
      'handson_post.php',
      logs,
      function(data){
        logs = {};
        $("#loading").hide();
        alert("保存しました。");
      }
    );
  });
});
</script>
</body>
</html>