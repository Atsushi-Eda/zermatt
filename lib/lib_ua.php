<?php
$ua = $_SERVER['HTTP_USER_AGENT'];
$sp = (strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false);