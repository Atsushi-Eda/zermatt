<?php
require_once('../../lib/library.php');
backup_check_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title><?= h($grade) ?>代版メンバー情報バックアップ確認</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("css/backup_check.css") ?>
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
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > <a href="./">メンバー管理</a> > <a href="backup.php">メンバー情報バックアップ</a> > <?= h($grade) ?>代版メンバー情報バックアップ確認
    </div>
    <?= flash_message() ?>
    <h2><?= h($grade) ?>代版メンバー情報バックアップ確認</h2>
    <div id="table_wrap">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>名前</th>
            <th>紹介文</th>
            <th>画像</th>
          </tr>
        </thead>
        <tbody>
<?php
foreach($members as $member){
?>
          <tr>
            <td><?= h($member['id']) ?></td>
            <td><?= h($member['name']) ?></td>
            <td><?= h($member['intro']) ?></td>
            <td>
              <div class="album_img"><?= file_exists($dir.$member['id'].".jpg")!==false ? readImg($dir.$member['id'].".jpg") : 'なし' ?></div>
            </td>
          </tr>
<?php
}
?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
