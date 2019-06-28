<?php
try{
  $pdo = new PDO('mysql:host=localhost;dbname=zermatt;charset=utf8', 'zermatt', 'password');
}catch (PDOException $e){
  print('Error:'.$e->getMessage());
  die();
}
