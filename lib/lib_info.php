<?php
define('MANAGER_GRADE', $pdo->query('SELECT grade FROM manager_grade ORDER BY id DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC)['grade']);
