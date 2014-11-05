<?php

require_once '../DB.php';
require_once '../config.php';
$db = new DB($hostname_, $username_, $password_, $database_name);
$num = $db->plus(1, 4);
echo '<hr />你是第' . $num . "个访问本页面的同学↖(^ω^)↗";
?>