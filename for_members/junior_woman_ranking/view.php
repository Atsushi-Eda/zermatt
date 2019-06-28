<?php
require_once('../lib/library.php');
view_init();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#003aff">
  <title>3女ランキング結果</title>
  <?= readCss("../../css/reset.css") ?>
  <?= readCss("../css/for_members.css") ?>
  <?= readCss("../css/tablesort.css") ?>
  <?= readCss("css/view.css") ?>
</head>
<body>
<div id="mycontents">
<?php
include('../inc/header.php');
?>
  <div id="maincontents">
    <div id="pankuzu">
      <a href="../">TOP</a> > <a href="./">3女ランキングTOP</a> > 3女ランキング結果
    </div>
    <?= flash_message() ?>
    <h2>3女ランキング結果(<?= (isset($_GET['grade'])) ? implode(",", $_GET['grade']).'代' : '全体' ?>)</h2>
    <p>投票数:<?= h($vote['cnt'] / $count) ?></p>
    <div class="box">
      <h3>ランキング表示</h3>
<?php
$i = 0;
$j = 0;
$before_point = -1;
foreach($points as $member_id => $point){
  $i++;
  if($point != $before_point){
    $j = $i;
  }
  $before_point = $point;
?>
      <div class="box">
        <div style="padding:5px 0;">
          第<?= h($j) ?>位 (<?= h($point) ?>点)
        </div>
        <div style="padding:5px 0;">
          <a href="detail.php?candidate=<?= h($member_id) ?>" target="_blank"><?= h($candidates[$member_id]) ?></a>
        </div>
        <div style="padding:5px 0;">
          偏差値: <?= h(round($deviation[$member_id],2)) ?>
        </div>
      </div>
<?php
}
?>
    </div>
    <div class="box">
      <h3>グラフ表示</h3>
      <canvas id="myChart"></canvas>
    </div>
    <div class="box">
      <h3>テーブル表示</h3>
      <div id="tablewrap">
        <table id="sorttable">
          <thead>
            <tr>
              <th>氏名</th>
<?php
for($i=1; $i<=$count; $i++){
?>
              <th><?= h($i) ?>位</th>
<?php
}
?>
              <th>点</th>
            </tr>
          </thead>
          <tbody>
<?php
foreach($candidates as $member_id => $candidate){
?>
            <tr>
              <td><?= h($candidate) ?></td>
<?php
for($i=1; $i<=$count; $i++){
?>
              <td><?= h($ranks[$member_id][$i]['cnt']) ?></td>
<?php
}
?>
              <td><?= h($points[$member_id]) ?></td>
            </tr>
<?php
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?= readJs("../../js/jquery-1.11.3.min.js") ?>
<?= readJs("../js/jquery.tablesorter.min.js") ?>
<?= readJs("../js/tablesort.js") ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
<script>
<?php
$colors = array(
  "#E60012",
  "#F39800",
  "#FFF100",
  "#8FC31F",
  "#009944",
  "#009E96",
  "#00A0E9",
  "#0068B7",
  "#1D2088",
  "#920783",
  "#E4007F",
  "#E5004F",
);
?>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'polarArea',
  data: {
    labels: [
<?php
foreach($candidates as $candidate){
?>
      "<?= h($candidate) ?>",
<?php
}
?>
    ],
    datasets: [{
      backgroundColor: [
<?php
for($i=0; $i<$count; $i++){
?>
        "<?= h($colors[$i]) ?>",
<?php
}
?>
      ],
      data: [
<?php
foreach($candidates as $member_id => $candidate){
?>
        <?= h($points[$member_id]) ?>,
<?php
}
?>
      ]
    }]
  }
});
</script>
</body>
</html>