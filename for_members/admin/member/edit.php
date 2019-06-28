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
  <title>メンバー情報登録</title>
  <?= readCss("../../../css/reset.css") ?>
  <?= readCss("../../css/validationEngine.jquery.css") ?>
  <?= readCss("../../../css/cropper.min.css") ?>
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
      <a href="../../">TOP</a> > <a href="../">管理ページTOP</a> > <a href="./">メンバー管理</a> > メンバー情報登録
    </div>
    <?= flash_message() ?>
    <h2>メンバー情報登録</h2>
    <form id="form" method="POST" action="edit.php" autocomplete="off" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= h($member['id']) ?>">
      <div class="form_content required">
        <p>名前</p>
        <input type="text" name="name" value="<?= h($member['name']) ?>">
      </div>
      <div class="form_content required">
        <p>パスワード</p>
        <input type="text" name="password" value="<?= $member['password'] ? h($member['password']) : 1234 ?>">
      </div>
      <div class="form_content required">
        <p>よみがな</p>
        <input type="text" name="phonetic" value="<?= h($member['phonetic']) ?>">
      </div>
      <div class="form_content">
        <p>ニックネーム</p>
        <input type="text" name="nickname" value="<?= h($member['nickname']) ?>">
      </div>
      <div class="form_content required">
        <p>代</p>
        <input type="number" name="grade" value="<?= h($member['grade']) ?>">
      </div>
      <div class="form_content required">
        <p>性別</p>
        <div class="radios">
          <label><input type="radio" name="gender" value="male" <?= $member['gender']=='male' ? 'checked' : '' ?>><span>男性</span></label>
          <label><input type="radio" name="gender" value="female" <?= $member['gender']=='female' ? 'checked' : '' ?>><span>女性</span></label>
        </div>
      </div>
      <div class="form_content">
        <p>役職</p>
        <input type="text" name="position" value="<?= h($member['position']) ?>">
      </div>
      <div class="form_content">
        <p>誕生日</p>
        <input type="number" name="birthmonth" value="<?= h($member['birthmonth']) ?>">月<input type="number" name="birthday" value="<?= h($member['birthday']) ?>">日
      </div>
      <div class="form_content required">
        <p>紹介ページに表示</p>
        <div class="radios">
          <label><input type="radio" name="intro_view" value="1" <?= $member['intro_view'] ? 'checked' : '' ?>><span>表示</span></label>
          <label><input type="radio" name="intro_view" value="0" <?= !$member['intro_view'] ? 'checked' : '' ?>><span>非表示</span></label>
        </div>
      </div>
      <div class="form_content">
        <p>紹介文</p>
        <textarea name="intro"><?= h($member['intro']) ?></textarea>
      </div>
      <div class="form_content">
        <p>画像</p>
        <div id="member_img">
          <?= file_exists("../../../img/member/".$member['id'].".jpg")!==false ? readImg("../../../img/member/".$member['id'].".jpg") : "画像なし" ?>
        </div>
        <div id="cropper"></div>
        <input type="hidden" id="cropper_x" name="cropper_x">
        <input type="hidden" id="cropper_y" name="cropper_y">
        <input type="hidden" id="cropper_width" name="cropper_width">
        <input type="hidden" id="cropper_height" name="cropper_height">
        <div class="buttons">
          <label class="button"><input type="file" name="image" style="display:none;" accept="image/*">ファイルを選択</label>
          <div id="trim" class="button">トリミング</div>
          <div id="retrim" class="button">トリミングし直す</div>
        </div>
      </div>
      <div class="form_content">
        <p>ビデオID</p>
        <input type="text" name="video_id" id="video_id" value="<?= h($member['video_id']) ?>">
        <div class="buttons">
          <div class="button" onclick="uniqueID();">自動作成</div>
        </div>
      </div>
      <div class="form_content">
        <p>ビデオURL</p>
        <input type="text" name="video" value="<?= h($member['video']) ?>">
      </div>
      <div class="form_content">
        <p>ブログ</p>
        <input type="text" name="blog" value="<?= h($member['blog']) ?>">
      </div>
      <div class="form_content">
        <p>表示順</p>
        <input type="number" name="order" value="<?= h($member['order']) ?>">
      </div>
      <div class="form_content">
        <input type="submit" value="登録" class="submit_button">
      </div>
    </form>
  </div>
  <?= readJs("../../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../../js/jquery.validationEngine.js") ?>
  <?= readJs("../../js/jquery.validationEngine-ja.js") ?>
  <?= readJs("../../../js/cropper.min.js") ?>
  <?= readJs("../../js/validation.js") ?>
  <?= readJs("js/edit.js") ?>
</body>
</html>