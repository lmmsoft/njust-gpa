<?php

//正值表达式比对解析$_SERVER['HTTP_USER_AGENT']中的字符串 获取访问用户的浏览器的信息
function determinebrowser($Agent) {
    $browseragent = "";   //浏览器
    $browserversion = ""; //浏览器的版本
    if (ereg('MSIE ([0-9].[0-9]{1,2})', $Agent, $version)) {
        $browserversion = $version[1];
        $browseragent = "Internet Explorer";
    } else if (ereg('Opera/([0-9]{1,2}.[0-9]{1,2})', $Agent, $version)) {
        $browserversion = $version[1];
        $browseragent = "Opera";
    } else if (ereg('Firefox/([0-9.]{1,5})', $Agent, $version)) {
        $browserversion = $version[1];
        $browseragent = "Firefox";
    } else if (ereg('Chrome/([0-9.]{1,3})', $Agent, $version)) {
        $browserversion = $version[1];
        $browseragent = "Chrome";
    } else if (ereg('Safari/([0-9.]{1,3})', $Agent, $version)) {
        $browseragent = "Safari";
        $browserversion = "";
    } else {
        $browserversion = "";
        $browseragent = "Unknown";
    }
    return $browseragent . " " . $browserversion;
}

// 同理获取访问用户的浏览器的信息
function determineplatform($Agent) {
    $browserplatform == '';
    if (eregi('win', $Agent) && strpos($Agent, '95')) {
        $browserplatform = "Windows 95";
    } elseif (eregi('win 9x', $Agent) && strpos($Agent, '4.90')) {
        $browserplatform = "Windows ME";
    } elseif (eregi('win', $Agent) && ereg('98', $Agent)) {
        $browserplatform = "Windows 98";
    } elseif (eregi('win', $Agent) && eregi('nt 5.0', $Agent)) {
        $browserplatform = "Windows 2000";
    } elseif (eregi('win', $Agent) && eregi('nt 5.1', $Agent)) {
        $browserplatform = "Windows XP";
    } elseif (eregi('win', $Agent) && eregi('nt 6.0', $Agent)) {
        $browserplatform = "Windows Vista";
    } elseif (eregi('win', $Agent) && eregi('nt 6.1; WOW64', $Agent)) {
        $browserplatform = "Windows 7-64";
    } elseif (eregi('win', $Agent) && eregi('nt 6.1', $Agent)) {
        $browserplatform = "Windows 7-32";
    } elseif (eregi('win', $Agent) && ereg('32', $Agent)) {
        $browserplatform = "Windows 32";
    } elseif (eregi('win', $Agent) && eregi('nt', $Agent)) {
        $browserplatform = "Windows NT";
    } elseif (eregi('Mac OS', $Agent)) {
        $browserplatform = "Mac OS";
    } elseif (eregi('linux', $Agent)) {
        $browserplatform = "Linux";
    } elseif (eregi('unix', $Agent)) {
        $browserplatform = "Unix";
    } elseif (eregi('sun', $Agent) && eregi('os', $Agent)) {
        $browserplatform = "SunOS";
    } elseif (eregi('ibm', $Agent) && eregi('os', $Agent)) {
        $browserplatform = "IBM OS/2";
    } elseif (eregi('Mac', $Agent) && eregi('PC', $Agent)) {
        $browserplatform = "Macintosh";
    } elseif (eregi('PowerPC', $Agent)) {
        $browserplatform = "PowerPC";
    } elseif (eregi('AIX', $Agent)) {
        $browserplatform = "AIX";
    } elseif (eregi('HPUX', $Agent)) {
        $browserplatform = "HPUX";
    } elseif (eregi('NetBSD', $Agent)) {
        $browserplatform = "NetBSD";
    } elseif (eregi('BSD', $Agent)) {
        $browserplatform = "BSD";
    } elseif (ereg('OSF1', $Agent)) {
        $browserplatform = "OSF1";
    } elseif (ereg('IRIX', $Agent)) {
        $browserplatform = "IRIX";
    } elseif (eregi('FreeBSD', $Agent)) {
        $browserplatform = "FreeBSD";
    }
    if ($browserplatform == '') {
        $browserplatform = "Unknown";
    }
    return $browserplatform;
}

//$Agent = $_SERVER['HTTP_USER_AGENT'];
//var_dump($Agent);
////显示访问用户的浏览器信息
//echo 'Browser: ' . determinebrowser($Agent) . '
//';
////显示访问用户的操作系统平台
//echo 'Platform: ' . determineplatform($Agent) . '
//';

function getIp() {
    if (@$_SERVER['HTTP_CLIENT_IP'] && $_SERVER['HTTP_CLIENT_IP'] != 'unknown') {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (@$_SERVER['HTTP_X_FORWARDED_FOR'] && $_SERVER['HTTP_X_FORWARDED_FOR'] != 'unknown') {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

?>