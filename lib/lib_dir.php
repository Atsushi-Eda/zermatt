<?php
if(!preg_match("/^\/test/", $_SERVER["REQUEST_URI"])){
  define("ROOT_DIR", $_SERVER["HTTP_HOST"]);
}else{
  define("ROOT_DIR", $_SERVER["HTTP_HOST"] . '/test');
}