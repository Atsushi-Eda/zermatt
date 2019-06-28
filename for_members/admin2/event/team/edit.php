<?php
require_once('../../../lib/library.php');
edit_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>班分け編集</title>
  <?= readCss("../../../../css/reset.css") ?>
  <?= readCss("../../../css/for_members.css") ?>
  <?= readCss("../../../css/form.css") ?>
  <?= readCss("css/edit.css") ?>
  <?= readCss("../../../../jquery-ui-1.12.1.custom/jquery-ui.min.css") ?>
  <?= readJs("../../../../js/jquery-1.11.3.min.js") ?>
  <?= readJs("../../../../jquery-ui-1.12.1.custom/jquery-ui.min.js") ?>
  <?= readJs("../../../../js/jquery.ui.touch-punch.min.js") ?>
  <?= readJs("../../../../js/jquery.event.dblTap.js") ?>
  <?= readJs("js/edit_add.js") ?>
  <?= readJs("js/edit_assign.js") ?>
  <?= readJs("js/edit_count.js") ?>
  <?= readJs("js/edit_ng.js") ?>
  <?= readJs("js/edit_return.js") ?>
  <?= readJs("js/edit_sort.js") ?>
  <?= readJs("js/edit.js") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../../../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../../../">TOP</a> > <a href="../../">管理ページTOP</a> > <a href="../">企画管理</a> > <a href="./">班分け</a> > 編集
    </div>
    <?= flash_message() ?>
    <h2>班分け編集(<?= h($event['name']) ?>)</h2>
    <div class="table_wrap">
      <table>
        <tr>
          <th rowspan="2">班</th>
          <th colspan="3">全て</th>
          <th colspan="3">2年生</th>
          <th colspan="3">上級生</th>
          <th colspan="3">3年生</th>
          <th colspan="3">1年生</th>
        </tr>
        <tr>
<?php
for($grade=0; $grade<5; $grade++){
?>
          <th>全</th>
          <th>男</th>
          <th>女</th>
<?php
}
?>
        </tr>
        <tr class="count_table_team_total">
          <td>計</td>
<?php
for($grade=0; $grade<5; $grade++){
  for($gender=0; $gender<3; $gender++){
?>
          <td><?= h($count[$grade][$gender]['cnt']) ?></td>
<?php
  }
}
?>
        </tr>
<?php
for($team=0; $team<=$teams; $team++){
?>
        <tr class="count_table_team<?= h($team) ?>">
          <td><?= ($team) ? h($team) : '未' ?></td>
<?php
  for($grade=0; $grade<5; $grade++){
    for($gender=0; $gender<3; $gender++){
?>
          <td class="count_table_grade<?= h($grade) ?> count_table_gender<?= h($gender) ?>"></td>
<?php
    }
  }
?>
        </tr>
<?php
}
?>
      </table>
    </div>
    <form action="edit.php" method="POST">
      <input type="hidden" name="event_id" value="<?= $_GET['event_id'] ?>">
      <div class="buttons">
        <div id="add" class="button">班を追加</div>
        <div id="assign" class="button">残りを配置</div>
        <div id="return" class="button">全て未配属にする</div>
        <input type="submit" value="登録" class="button">
      </div>
      <div id="teams">
        <div id="team0" data-team="" class="team box">
          <div class="team_header">
            <h3>未配属</h3>
            <div class="counts"><span class="count"></span>(<span class="count_male"></span>,<span class="count_female"></span>)</div>
          </div>
          <div class="team_content">
            <ul class="team_members jquery-ui-sortable">
<?php
foreach($participants[0] as $participant){
?>
              <li class="team_member <?= h($participant['gender']) ?> <?= h(grade_type($participant['grade'])) ?>" data-member="<?= h($participant['id']) ?>" data-gender="<?= h($participant['gender']) ?>" data-grade="<?= h(grade_type($participant['grade'])) ?>">
                <p><?= h($participant['name']) ?></p>
                <input type="hidden" name="member[<?= h($participant['id']) ?>]">
                <input type="hidden" name="leader[<?= h($participant['id']) ?>]">
                <div class="past">
<?php
  if(empty($past_events[$participant['id']])) echo '過去に参加した企画はありません。';
  foreach($past_events[$participant['id']] as $past_event_key => $past_event){
?>
                  <div class="past_event past_event<?= h($past_event_key) ?>">
                    <h4><?= h($past_event['short_name']) ?>(<?= h($past_event['team']) ?>班)</h4>
                    <ul class="past_members">
<?php
    foreach($past_members[$participant['id']][$past_event['id']] as $past_member){
?>
                      <li class="past_member" data-member="<?= h($past_member['id']) ?>">
                        <p><?= h($past_member['name']) ?></p>
                      </li>
<?php
    }
?>
                    </ul>
                  </div>
<?php
  }
?>
                </div>
              </li>
<?php
}
?>
            </ul>
          </div>
        </div>
<?php
for($team=1; $team<=$teams; $team++){
?>
        <div id="team<?= h($team) ?>" data-team="<?= h($team) ?>" class="team assigned box">
          <div class="team_header">
            <h3><?= h($team) ?>班</h3>
            <div class="counts"><span class="count"></span>(<span class="count_male"></span>,<span class="count_female"></span>)</div>
          </div>
          <div class="team_content">
            <ul class="team_members jquery-ui-sortable">
<?php
  foreach($participants[$team] as $participant){
?>
              <li class="team_member <?= h($participant['gender']) ?> <?= h(grade_type($participant['grade'])) ?> <?= $participant['leader'] ? 'team_leader' : '' ?>" data-member="<?= h($participant['id']) ?>" data-gender="<?= h($participant['gender']) ?>" data-grade="<?= h(grade_type($participant['grade'])) ?>">
                <p><?= h($participant['name']) ?></p>
                <input type="hidden" name="member[<?= h($participant['id']) ?>]" value="<?= h($team) ?>">
                <input type="hidden" name="leader[<?= h($participant['id']) ?>]" value="<?= h($participant['leader']) ?>">
                <div class="past">
<?php
    if(empty($past_events[$participant['id']])) echo '過去に参加した企画はありません。';
    foreach($past_events[$participant['id']] as $past_event_key => $past_event){
?>
                  <div class="past_event past_event<?= h($past_event_key) ?>">
                    <h4><?= h($past_event['short_name']) ?>(<?= h($past_event['team']) ?>班)</h4>
                    <ul class="past_members">
<?php
      foreach($past_members[$participant['id']][$past_event['id']] as $past_member){
?>
                      <li class="past_member" data-member="<?= h($past_member['id']) ?>">
                        <p><?= h($past_member['name']) ?></p>
                      </li>
<?php
      }
?>
                    </ul>
                  </div>
<?php
    }
?>
                </div>
              </li>
<?php
  }
?>
            </ul>
          </div>
        </div>
<?php
}
?>
      </div>
    </form>
<?php
if($sp){
?>
    <div id="sortable_controler">
      <div class="checkboxs">
        <label><input type="checkbox" id="is_sortable" checked><span>D&D</span></label>
      </div>
    </div>
<?php
}
?>
  </div>
</div>
<script>
teams = <?= h($teams) ?> + 1;
</script>
</body>
</html>