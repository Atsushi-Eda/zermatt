        <div class="form_content required validation_trigger">
          <p>出欠</p>
          <div class="radios expression <?= $participation['participation'] ? 'smile' : 'cry' ?>">
            <label><input type="radio" name="participation" value="1" <?= $participation['participation'] ? 'checked' : '' ?>><span>参加</span></label>
            <label><input type="radio" name="participation" value="0" <?= !$participation['participation'] ? 'checked' : '' ?>><span>不参加</span></label>
          </div>
        </div>
<?php
if($event['after']){
?>
        <div class="form_content validation_change <?= $participation['participation'] ? 'required' : '' ?>">
          <p>アフター出欠</p>
          <div class="radios expression <?= $participation['after'] ? 'smile' : 'cry' ?>">
            <label><input type="radio" name="after" value="1" <?= $participation['after'] ? 'checked' : '' ?>><span>参加</span></label>
            <label><input type="radio" name="after" value="0" <?= !$participation['after'] ? 'checked' : '' ?>><span>不参加</span></label>
          </div>
        </div>
<?php
}
if($event['meeting_place']!==""){
?>
        <div class="form_content validation_change <?= $participation['participation'] ? 'required' : '' ?>">
          <p>集合場所</p>
          <div class="radios">
<?php
  foreach(explode(',',$event['meeting_place']) as $meeting_place){
?>
            <label><input type="radio" name="meeting_place" value="<?= h($meeting_place) ?>" <?= $meeting_place==$participation['meeting_place'] ? 'checked' : '' ?>><span><?= h($meeting_place) ?></span></label>
<?php
  }
?>
          </div>
        </div>
<?php
}
?>
        <div class="form_content">
          <p><?= $event['other_question']!=="" ? h($event['other_question']) : '備考' ?></p>
          <textarea name="note"><?= $participation['note'] ?></textarea>
        </div>
