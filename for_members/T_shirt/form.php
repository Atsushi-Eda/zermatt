<?php
require_once('../lib/library.php');
form_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title><?= T_shirts_type ?>Tシャツアンケート回答</title>
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
      <a href="../">TOP</a> > <a href="./"><?= T_shirts_type ?>TシャツアンケートTOP</a> > アンケート回答
    </div>
    <?= flash_message() ?>
    <h2><?= T_shirts_type ?>Tシャツアンケート回答</h2>
    <form id="form" method="post" action="form.php" autocomplete="off">
    <div id="buy" class="form_content required">
        <p>購入</p>
        <div class="radios">
          <label><input type="radio" name="buy" value="1"><span>買う</span></label>
          <label><input type="radio" name="buy" value="0"><span>買わない</span></label>
        </div>
      </div>
      <div id="size" class="form_content">
        <p>サイズ</p>
        <div class="radios">
<?php
foreach($sizes as $key => $value){
?>
          <label><input type="radio" name="size" value="<?= h($key) ?>"><span><?= h($value) ?></span></label>
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
        <input type="submit" value="回答" class="submit_button">
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