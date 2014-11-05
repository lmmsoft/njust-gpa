<?php

$url = "";

function set_url($id) {
    switch ($id) {
        case 101:$url = "http://localhost/";
            break;
        case 102:$url = "";
            break;
        default:$url = "";
            break;
    }
}

//id从101开始
if ($_GET['id']) {
    $id = $_GET['id'];
    //下载加一
    require_once '../DB.php';
    require_once '../config.php';
    $db = new DB($hostname_, $username_, $password_, $database_name);
    $num = $db->plus(1, $id);

////重构开始
//    //来源信息
//    require_once '../user_agent.php';
//
//    $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
////显示访问用户的浏览器信息
//    $browser = determinebrowser($HTTP_USER_AGENT);
////显示访问用户的操作系统平台
//    //下个函数始终得不到返回啊
////    $os = determineplatform($HTTP_USER_AGENT);
//    $os="忽略";
//    $ip = getIp();
//    $datetime = date("Y-m-d H:i:s");
//
//    $from = "";
//    if ($_GET['fm']) {
//        $from = $_GET['fm'];
//    }
//
//    $db = new DB($hostname_, $username_, $password_, $database_name);
//    $db->insert_user_agent($browser, $os, $datetime, $ip, $HTTP_USER_AGENT, $id, $from);
////重构结束

    //重定向
    if ($id > 100) {
        set_url($id);
        header("Location: $url");
    }
}
?>
