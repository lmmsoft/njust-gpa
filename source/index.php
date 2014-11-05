<!DOCTYPE html>
<html>
    <head>
        <title>南理工本科生GPA查询系统</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body bgColor="#FFFCF1">
        <h2>南理工本科生GPA查询系统</h2>
        <h3>请输入你的学号和密码：</h3>
        <FORM ACTION="login.php" METHOD="POST"><!-- login  login-->
            <table border="0">
                <tr><td>学号：</TD><TD><input NAME="stuid" TYPE="text" SIZE="12" maxlength="12" /></TD></tr>
                <tr><td>密码：</TD><TD><input NAME="pwd" TYPE="password" SIZE="10" maxlength="12" /></TD></tr>
<!--                <tr><td>年级:</td><td>
                        <input type="radio" name="grade" value="09" />
                        09、10、11级
                        <input type="radio" name="grade" value="08" />
                        08级以前
                    </td></tr>-->
            </table>
            <BR /><table border="0">
                <tr><TD><input TYPE="submit" VALUE=" 确认 ">&nbsp;</td>
                    <td><input TYPE="reset" VALUE=" 重置 "></td></tr>
            </table>
        </FORM>
        <hr />
        <h3>打印课表太麻烦？试试<a href=index_print.php>课表一键打印</a></h3>
<!--        <h3>找自习室太麻烦？试试<a href=classroom.php>南理工自习教室推荐</a></h3>-->
        <h3>评教太麻烦？试试<a href=pingjiao/>南理工评教助手</a></h3>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-27089866-6', 'auto');
        ga('send', 'pageview');

    </script>
    </body>
</html>
<?php
require_once 'user_agent.php';
require_once 'DB.php';
require_once 'config.php';

$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
//显示访问用户的浏览器信息
$browser = determinebrowser($HTTP_USER_AGENT);
//显示访问用户的操作系统平台
$os = determineplatform($HTTP_USER_AGENT);
$ip = getIp();
$datetime = date("Y-m-d H:i:s");

$from = "";
if ($_GET['fm']) {
    $from = $_GET['fm'];
}
$db = new DB($hostname_, $username_, $password_, $database_name);
$db->insert_user_agent($browser, $os, $datetime, $ip, $HTTP_USER_AGENT, 0, $from);
?>