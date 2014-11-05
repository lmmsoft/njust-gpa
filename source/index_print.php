<!DOCTYPE html>
<html>
    <head>
        <title>南理工课表打印</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body bgColor="#FFFCF1">
        <h2>南理工课表打印</h2>
        <h3>请输入你的学号和密码：</h3>
        <FORM ACTION="print.php" METHOD="POST"><!-- login  login-->
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
        <h3>开学在即</h3>
        <p>你是否曾遇到这样的问题：</p>
        <ul>
            <li>无法访问教务处网站，看不了课表</li>
            <li>想打印课表，却经历了繁琐过程：<ol>
                    <li>打开网页</li>
                    <li>把课表复制到word里</li>
                    <li>拷到优盘</li>
                    <li>在文印室打开优盘，中了很多病毒T_T</li>
                    <li>打印课表</li>
                </ol>
            </li>
            <li>打印出的课表格式很不好看</li>
        </ul>
        <h3>使用南理工课表打印助手，可以轻松解决上述问题</h3>
        <ol>
            <li>空手走入文印室</li>
            <li>打开本网址（如若记不清，用文印室的电脑搜索"南理工GPA"）</li>
            <li>输入学号、密码</li>
            <li>选择【横向】打印，获得更好的排版效果</li>
            <li>付0.1元，潇洒走人</li>
        </ol>
        <p>若不能正常打印，欢迎发邮件lmmsoft#126.com交流 :)</p>
        <hr />
        <h3><a href=index.php>回GPA查询</a></h3>
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