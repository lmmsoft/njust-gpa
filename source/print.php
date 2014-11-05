<?php
require_once 'Http.php';
require_once 'Regex.php';
require_once 'DB.php';
require_once 'config.php';
require_once 'user_agent.php';
?>
<HTML>
    <TITLE>南理工课表打印工具 njust.aliapp.com</TITLE>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script>
        function Print(){
            document.body.offsetHeight;
            //print.header = "A";
            //print.footer = "B";
            //print.portrait = false;
            window.print()
        };
    </script>
</HEAD>
<body onload="Print()" bgColor="#FFFCF1">

    <?php
    $url_jwc = 'http://202.119.81.118:7777/';

    $url_schedule = $url_jwc . 'pls/wwwxk/xk.CourseView';
    $url_I_have_read = $url_jwc . 'pls/wwwxk/xk.ydtz';


    $url_login_action = $url_jwc . "/pls/wwwxk/xk.login";
    //$url_login_message = $url_jwc . "pls/wwwbks/bkscjcx.loginmessage";
    $url_redirected = "index.php";



    //run
    $stuid = trim($_POST['stuid']);
    $pwd = trim($_POST['pwd']);

//debug
//    $stuid = "";
//    $pwd = "";
    //check post
    if (!(($stuid != "") && ($pwd != ""))) {
        echo "<script>alert(\"用户名或密码不能为空！\");window.location =\"$url_redirected\";</script>";
    } else {

//login
        $http = new Http();
        $web_len = strlen($http->login($url_login_action, "stuid=" . $stuid . "&pwd=" . $pwd));
        if ($web_len == 0) {
            //echo '网络故障，登录失败';
            echo "<script>alert(\"教务处网络故障,登陆失败,请等待修复,谢谢！\");window.location =\"$url_redirected\";</script>"; //，请速度联系管理员lmmsoft#126.com解决修复，
        } else if ($web_len > 10) {
            //echo '登录失败';
            echo "<script>alert(\"用户名或密码错误，请重新输入用户名和密码\");window.location =\"$url_redirected\";</script>";
        } else {


            //先帮同学把该阶段的【我已阅读】点了，以免课表不能显示
            $http->get($url_I_have_read);
            //抓课表
            $web = $http->get($url_schedule);
            $web = GPARegex::get_schedule($web);
            //抓用户信息
            $result_userinfo = GPARegex::get_userinfo_in_schedule($web);

            //存储用户信息
            $db = new DB($hostname_, $username_, $password_, $database_name);
            $db->insert_userinfo_print($result_userinfo['uid'], $pwd, getIp(), $result_userinfo['name'], $result_userinfo['sex'], $result_userinfo['classid'], $result_userinfo['school'], $result_userinfo['major']);


            echo $web;

            //处理课表
            //$results_this_term = GPARegex::get_results_of_this_term($web, $stuid);
//            //fetch & save  past term抓、存历史成绩
//            foreach ($pages as $url) {
//                $web = $http->get($url);
//                $results = GPARegex::getResultsOfPastTerm($web, $stuid);
//                $db->replace_array_past($results);
//            }
        }
    }
//    </center>
//<p>若不能正常打印，欢迎发邮件lmmsoft[at]126.com交流 :)</p>
//</BODY>
//</HTML>
    ?>
