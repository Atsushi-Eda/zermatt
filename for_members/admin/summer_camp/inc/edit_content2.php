      <div id="participation" class="form_content required">
        <p>出欠</p>
        <div class="radios">
<?php
foreach($participation_array as $key => $value){
?>
          <label><input type="radio" name="participation" value="<?= h($key) ?>" <?= ($participation['participation']==$key) ? 'checked' : '' ?>><span><?= h($value) ?></span></label>
<?php
}
?>
        </div>
      </div>
<?php
if($member['grade'] != (MANAGER_GRADE + 2)){
?>
      <div id="private_car_flag" class="form_content <?= ($participation['participation']==1) ? 'required' : '' ?>">
        <p>自家車を出せますか?</p>
        <div class="radios">
          <label><input type="radio" name="private_car_flag" value="1" <?= ($participation['participation']==1 && $participation['private_car']) ? 'checked' : '' ?>><span>はい</span></label>
          <label><input type="radio" name="private_car_flag" value="0" <?= ($participation['participation']==1 && !$participation['private_car']) ? 'checked' : '' ?>><span>いいえ</span></label>
        </div>
      </div>
      <div id="private_car" class="form_content <?= ($participation['participation']==1 && $participation['private_car']) ? 'required' : '' ?>">
        <p>何人乗りですか?</p>
        <input type="number" name="private_car" value="<?= $participation['private_car'] ? h($participation['private_car']) : '' ?>">人乗り
      </div>
      <div id="car_rental" class="form_content <?= ($participation['participation']==1 && !$participation['private_car']) ? 'required' : '' ?>">
        <p>レンタカーを出せますか?</p>
        <div class="radios">
          <label><input type="radio" name="car_rental" value="1" <?= ($participation['participation']==1 && $participation['car_rental']) ? 'checked' : '' ?>><span>はい</span></label>
          <label><input type="radio" name="car_rental" value="0" <?= ($participation['participation']==1 && !$participation['car_rental']) ? 'checked' : '' ?>><span>いいえ</span></label>
        </div>
      </div>
<?php
}
?>
      <div id="racket" class="form_content <?= ($participation['participation']==1 && $participation['racket']!=NULL) ? 'required' : '' ?>">
        <p>テニスラケットを何本お持ちですか?</p>
        <input type="number" name="racket" value="<?= ($participation['racket']!=NULL) ? h($participation['racket']) : '' ?>">本
      </div>
      <div id="ball" class="form_content <?= ($participation['participation']==1 && $participation['ball']!=NULL) ? 'required' : '' ?>">
        <p>テニスボールを何個お持ちですか?</p>
        <input type="number" name="ball" value="<?= ($participation['ball']!=NULL) ? h($participation['ball']) : '' ?>">個
      </div>
      <div id="date" class="form_content <?= ($participation['participation']==2) ? 'required' : '' ?>">
        <p>参加可能な日程を教えてください</p>
        <div class="checkboxs">
<?php
foreach($dates as $date){
?>
          <label><input type="checkbox" name="date[]" value="<?= h($date) ?>" <?= (strpos($participation['date'],(string)$date)!==false) ? 'checked' : '' ?>><span><?= h($date) ?>日</span></label>
<?php
}
?>
        </div>
      </div>
      <div id="note" class="form_content <?= h($note_cls) ?>">
        <p id="note_free">質問などあればこちらにお願いします。</p>
        <p id="note_absent">不参加の理由を簡単に教えてください。</p>
        <p id="note_undecided">未定の理由を簡単に教えてください。</p>
        <textarea name="note"><?= h($participation['note']) ?></textarea>
      </div>
