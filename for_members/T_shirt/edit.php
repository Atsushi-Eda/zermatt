<?php
require_once('../lib/library.php');
edit_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title><?= T_shirts_type ?>Tシャツ変更</title>
  <?= readCss("../../css/reset.css") ?>
  <?= readCss("../css/validationEngine.jquery.css") ?>
  <?= readCss("../css/for_members.css") ?>
  <?= readCss("../css/form.css") ?>
  <?= readCss("css/form.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../">TOP</a> > <a href="./"><?= T_shirts_type ?>TシャツアンケートTOP</a> > 変更
    </div>
    <?= flash_message() ?>
    <h2><?= T_shirts_type ?>Tシャツ変更</h2>
    <form id="form" method="post" action="edit.php" autocomplete="off">
      <input type="hidden" name="id" value="<?= h($data['id']) ?>">
      <div id="buy" class="form_content required">
        <p>購入</p>
        <div class="radios">
          <label><input type="radio" name="buy" value="1" <?= ($data['buy']==1) ? 'checked' : '' ?>><span>買う</span></label>
          <label><input type="radio" name="buy" value="0" <?= ($data['buy']==0) ? 'checked' : '' ?>><span>買わない</span></label>
        </div>
      </div>
      <div id="size" class="form_content <?= ($data['buy']==1) ? 'required' : '' ?>">
        <p>サイズ</p>
        <div class="radios">
<?php
foreach($sizes as $key => $value){
?>
          <label><input type="radio" name="size" value="<?= h($key) ?>" <?= ($data['size']==$key) ? 'checked' : '' ?>><span><?= h($value) ?></span></label>
<?php
}
?>
          <table>
            <tr>
              <th>サイズ</th>
              <th>着丈(cm)</th>
              <th>身巾(cm)</th>
            </tr>
            <tr>
              <td>S</td>
              <td>65</td>
              <td>47</td>
            </tr>
            <tr>
              <td>M</td>
              <td>68</td>
              <td>50</td>
            </tr>
            <tr>
              <td>L</td>
              <td>71</td>
              <td>53</td>
            </tr>
            <tr>
              <td>XL</td>
              <td>74</td>
              <td>56</td>
            </tr>
            <tr>
              <td>XXL</td>
              <td>77</td>
              <td>56</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="form_content">
        <input type="submit" value="変更" class="submit_button">
      </div>
    </form>
  </div>
  <?= readJs("../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../js/jquery.validationEngine.js") ?>
  <?= readJs("../js/jquery.validationEngine-ja.js") ?>
  <?= readJs("../js/validation.js") ?>
  <?= readJs("js/form.js") ?>
</div>
</body>
</html>