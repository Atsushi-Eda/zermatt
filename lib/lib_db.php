<?php
try{
  $pdo = new PDO('mysql:host=localhost;dbname=zermatt;charset=utf8', 'root');
}catch (PDOException $e){
  print('Error:'.$e->getMessage());
  die();
}
