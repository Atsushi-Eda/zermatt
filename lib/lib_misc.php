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