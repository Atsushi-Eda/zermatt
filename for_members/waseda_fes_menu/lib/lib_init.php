<?php
$menus = array(
  1 => "1.のってこうぜ!タンタタンタンメン焼きそば",
  2 => "2.そこの君!ちょ待てよ!キムタク焼きそば",
  3 => "3.美味しくてギョギョギョ!餃子焼きそば",
  4 => "4.ドーデっか?アロイナカ!ガパオケバブ",
  5 => "5.選ばれたのは抹茶でした。抹茶ケバブ",
);
$menu_details = array(
  1 => "汁なしタンタンメン風焼きそば",
  2 => "キムチ&たくあん入り焼きそば",
  3 => "餃子風焼きそば",
  4 => "ガパオライスの上",
  5 => "スイーツ風ケバブ",
);
$recipes = array(
  1 => "もやし,肉みそ,ネギ,すりごま",
  2 => "キムチ,たくあん,豚肉,海苔",
  3 => "キャベツ,ニラ,ひき肉",
  4 => "ひき肉,パプリカ",
  5 => "ソース,白玉,小豆,マシュマロ",
);
function index_init(){
  global $pdo, $data;
  $sql = "SELECT * FROM waseda_fes_menus WHERE member_id = {$_SESSION['user']['id']}";
  $data = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}
function form_init(){
  global $pdo;
  if(!empty($_POST)){
    $sql = "DELETE FROM waseda_fes_menus WHERE member_id = {$_SESSION['user']['id']}";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $sql = "INSERT INTO waseda_fes_menus (member_id, menu) VALUES (:member_id, :menu)";
    $sth = $pdo->prepare($sql);
    if($sth->execute(array(':member_id'=>$_SESSION['user']['id'], ':menu'=>$_POST['menu']))){
      $_SESSION['flash_message'] = '回答しました。';
    }else{
      $_SESSION['flash_message'] = '回答に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/waseda_fes_menu/');
    exit;
  }
}