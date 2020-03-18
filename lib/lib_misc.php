<?php
function h($value){
  return htmlspecialchars($value);
}
function ordSuffix($n){
  $str = "$n";
  $t = $n > 9 ? substr($str,-2,1) : 0;
  $u = substr($str,-1);
  if ($t==1) return $str . 'th';
  else switch ($u) {
    case 1: return $str . 'st';
    case 2: return $str . 'nd';
    case 3: return $str . 'rd';
    default: return $str . 'th';
  }
}
function readCss($path){
  return '<link rel="stylesheet" type="text/css" href="' . $path . '?date=' . filemtime($path) . '">' . "\n";
}
function readJs($path){
  return '<script src="' . $path . '?date=' . filemtime($path) . '"></script>' . "\n";
}
function readImg($path, $class=''){
  return '<img src="' . $path . '?date=' . filemtime($path) . '" class="' . $class . '">' . "\n";
}
function flash_message(){
  if(isset($_SESSION['flash_message'])){
    $flash_message = h($_SESSION['flash_message']);
    unset($_SESSION['flash_message']);
    return '<p id="flash_message">' . $flash_message . "</p>\n";
  }
}
function insertTable($table, $datas){
  global $pdo;
  $sql =
    "INSERT INTO `" . $table . "` (" .
    join(', ', array_map(function($key){
      return "`" . $key . "`";
    }, array_keys($datas))) . ') VALUES (' .
    join(', ', array_map(function($key){
      return ":" . $key;
    }, array_keys($datas))) . ')';
  $placeholders = array_reduce(array_keys($datas), function($placeholders, $key) use ($datas){
    $placeholders[':' . $key] = $datas[$key];
    return $placeholders;
  }, []);
  return $pdo->prepare($sql)->execute($placeholders);
}
function updateTable($table, $datas, $conditions){
  global $pdo;
  $sql =
    "UPDATE `" . $table . "` SET " .
    join(', ', array_map(function($key){
      return "`" . $key . "` = :" . $key;
    }, array_keys($datas))) . ' WHERE ' .
    join(' AND ', array_map(function($key){
      return "`" . $key . "` = :" . $key;
    }, array_keys($conditions)));
  $fields = array_merge($datas, $conditions);
  $placeholders = array_reduce(array_keys($fields), function($placeholders, $key) use ($fields){
    $placeholders[':' . $key] = $fields[$key];
    return $placeholders;
  }, []);
  return $pdo->prepare($sql)->execute($placeholders);
}
function deleteTable($table, $conditions){
  global $pdo;
  $sql =
    "DELETE FROM `" . $table . "` WHERE " .
    join(' AND ', array_map(function($key){
      return "`" . $key . "` = :" . $key;
    }, array_keys($conditions)));
  $placeholders = array_reduce(array_keys($conditions), function($placeholders, $key) use ($conditions){
    $placeholders[':' . $key] = $conditions[$key];
    return $placeholders;
  }, []);
  return $pdo->prepare($sql)->execute($placeholders);
}
