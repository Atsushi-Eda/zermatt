<?php
require_once('../../lib/library.php');
index_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>メンバー管理</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("css/index.css") ?>
  <?= readJs("../../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../../js/rome.js") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > メンバー管理
    </div>
    <?= flash_message() ?>
    <h2>メンバー管理</h2>
    <p><a href="edit.php">+新規メンバー作成</a></p>
    <div class="form_content">
      <input type="text" id="member_name" placeholder="検索(名前or代)">
    </div>
    <div id="table_wrap">
      <table>
        <thead>
          <tr>
            <th>操作</th>
            <th>ID</th>
            <th>名前</th>
            <th>パスワード</th>
            <th>よみがな</th>
            <th>ニックネーム</th>
            <th>代</th>
            <th>性別</th>
            <th>役職</th>
            <th>誕生日</th>
            <th>表示</th>
            <th>紹介文</th>
            <th>ビデオID</th>
            <th>ビデオURL</th>
            <th>ブログ</th>
            <th>表示順</th>
          </tr>
        </thead>
        <tbody>
<?php
foreach($members as $member){
?>
          <tr class="member" data-name="<?= h($member['name']) ?>" data-phonetic="<?= h($member['phonetic']) ?>"  data-grade="<?= h($member['grade']) ?>">
            <td><a href="edit.php?id=<?= h($member['id']) ?>">編集</a> <a href="javascript:void(0);" onclick="delete_confirm(<?= h($member['id']) ?>);">削除</a></td>
            <td><?= h($member['id']) ?></td>
            <td><?= h($member['name']) ?></td>
            <td><?= h($member['password']) ?></td>
            <td><?= h($member['phonetic']) ?></td>
            <td><?= h($member['nickname']) ?></td>
            <td><?= h($member['grade']) ?></td>
            <td><?= h($gender[$member['gender']]) ?></td>
            <td><?= h($member['position']) ?></td>
            <td><?= h($member['birthmonth']) ?>/<?= h($member['birthday']) ?></td>
            <td><?= h($member['intro_view']) ?></td>
            <td><?= h($member['intro']) ?></td>
            <td><?= h($member['video_id']) ?></td>
            <td><?= h($member['video']) ?></td>
            <td><?= h($member['blog']) ?></td>
            <td><?= h($member['order']) ?></td>
          </tr>
<?php
}
?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
$(function(){
  $("#member_name").keyup(function(){
    var keyword = r2h($(this).val());
    $.each($(".member"), function(i, val){
      if($(val).data("name").indexOf(keyword)!=-1 || $(val).data("phonetic").indexOf(keyword)!=-1 || $(val).data("grade") == keyword){
        $(val).show();
      }else{
        $(val).hide();
      }
    });
  });
});
function delete_confirm(id){
  if(window.confirm("削除すると管理ページから元に戻せません。\n本当に削除しますか?")){
    location.href = "delete.php?id=" + id;
  }
}
</script>
</body>
</html>