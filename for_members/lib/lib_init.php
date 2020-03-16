<?php
function login_init(){
  global $pdo;
  if(isset($_SESSION['user']['id'])){
    $_SESSION['flash_message'] = 'ログインしなおす場合には、ログアウトを行ってください。';
    header('Location: http://' . ROOT_DIR . '/for_members/');
    exit;
  }
  if(isset($_POST['name'])){
    $sql = "SELECT id, name, grade FROM members WHERE name = :name AND password = :password";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':name'=>$_POST['name'], ':password'=>$_POST['password']));
    $_SESSION['user'] = $sth->fetch(PDO::FETCH_ASSOC);
    if(isset($_SESSION['user']['id'])){
      if($_POST['auto_login']){
        $token = sha1(uniqid(mt_rand(), true));
        $sth->execute(insertTable('auto_login', [
          'member_id' => $_SESSION['user']['id'],
          'token' => $token,
        ]));
        setcookie("token", $token, time()+60*60*24*365);
      }
      $_SESSION['flash_message'] = 'ログインに成功しました。';
      $from = isset($_SESSION['from']) ? $_SESSION['from'] : '/for_members/';
      unset($_SESSION['from']);
      header('Location: http://' . ROOT_DIR . $from);
      exit;
    }else{
      $_SESSION['flash_message'] = 'ユーザー名あるいはパスワードが正しくありません。';
    }
  }
}
function change_password_init(){
  global $pdo;
  if(isset($_POST['new_password'])){
    if(updateTable('members', [
      'password' => $_POST['new_password'],
    ], [
      'id' => $_SESSION['user']['id'],
    ])){
      $_SESSION['flash_message'] = 'パスワードを更新しました。';
    }else{
      $_SESSION['flash_message'] = 'パスワードの更新に失敗しました。';
    }
    header('Location: http://' . ROOT_DIR . '/for_members/');
    exit;
  }
}
function timetable_init(){
  global $pdo;
  if(!isset($_POST['time'])){
    global $timetables;
    $sql = "SELECT id FROM timetables WHERE member_id = :member_id AND time = :time";
    for($time=0; $time<=36; $time++){
      $sth = $pdo->prepare($sql);
      $sth->execute(array(':member_id'=>$_SESSION['user']['id'], ':time'=>$time));
      $tmp = $sth->fetch(PDO::FETCH_ASSOC);
      $timetables[$time] = isset($tmp['id']);
    }
  }else{
    $sql = "DELETE FROM timetables WHERE member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':member_id'=>$_SESSION['user']['id']));
    foreach($_POST['time'] as $time){
      insertTable('timetables', [
        'member_id' => $_SESSION['user']['id'],
        'time' => $time,
      ]);
    }
    $_SESSION['flash_message'] = '時間割を登録しました。';
    header('Location: http://' . ROOT_DIR . '/for_members/');
    exit;
  }
}
