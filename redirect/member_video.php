<?php
$need_pass = true;
require_once('../lib/library.php');
$sql = "SELECT video FROM members WHERE video_id = '".$_GET['id']."'";
$member = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
header('Location: ' . $member['video']);
exit;