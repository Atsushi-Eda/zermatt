      <div id="participation" class="form_content required">
        <p>出欠</p>
        <div class="radios">
<?php
foreach($participation_array as $key => $value){
?>
          <label><input type="radio" name="participation" value="<?= h($key) ?>"><span><?= h($value) ?></span></label>
<?php
}
?>
        </div>
      </div>
<?php
if($member['grade'] != (MANAGER_GRADE + 2)){
?>
      <div id="private_car_flag" class="form_content">
        <p>自家車を出せますか?</p>
        <div class="radios">
          <label><input type="radio" name="private_car_flag" value="1"><span>はい</span></label>
          <label><input type="radio" name="private_car_flag" value="0"><span>いいえ</span></label>
        </div>
      </div>
      <div id="private_car" class="form_content">
        <p>何人乗りですか?</p>
        <input type="number" name="private_car">人乗り
      </div>
      <div id="car_rental" class="form_content">
        <p>レンタカーを出せますか?</p>
        <div class="radios">
          <label><input type="radio" name="car_rental" value="1"><span>はい</span></label>
          <label><input type="radio" name="car_rental" value="0"><span>いいえ</span></label>
        </div>
      </div>
<?php
}
?>
      <div id="racket" class="form_content">
        <p>テニスラケットを何本お持ちですか?</p>
        <input type="number" name="racket">本
      </div>
      <div id="ball" class="form_content">
        <p>テニスボールを何個お持ちですか?</p>
        <input type="number" name="ball">個
      </div>
      <div id="date" class="form_content">
        <p>参加可能な日程を教えてください</p>
        <div class="checkboxs">
<?php
foreach($dates as $date){
?>
          <label><input type="checkbox" name="date[]" value="<?= h($date) ?>"><span><?= h($date) ?>日</span></label>
<?php
}
?>
        </div>
      </div>
      <div id="note" class="form_content free">
        <p id="note_free">質問などあればこちらにお願いします。</p>
        <p id="note_absent">不参加の理由を簡単に教えてください。</p>
        <p id="note_undecided">未定の理由を簡単に教えてください。</p>
        <textarea name="note"></textarea>
      </div>
