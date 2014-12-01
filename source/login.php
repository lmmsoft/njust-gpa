<?php
require_once 'Http.php';
require_once 'Regex.php';
require_once 'DB.php';
require_once 'config.php';
require_once 'user_agent.php';

class Show {

    function __construct() {

    }

    private function show_results($results) {
        $this->show_head_this_term();
        foreach ($results as $row) {
            $this->show_row($row);
        }
        echo "</table>\n";
    }

    public function show_results_past($results) {
        $this->show_head_past_term();
        foreach ($results as $row) {
            $this->show_row_past($row);
        }
        echo "</table>\n";
    }

    private function show_row($row) {
        //输出result对象
        echo "<tr>\n";
        echo '<td>' . $row->uid . "</td>\n";
        echo '<td>' . $row->sid . "</td>\n";
        echo '<td>' . $row->sname . "</td>\n";
        echo '<td>' . $row->spoint . "</td>\n";
        echo '<td>' . $row->stype . "</td>\n";
        echo '<td>' . $row->score . "</td>\n";
        echo '<td>' . $row->gradepoint . "</td>\n";
        echo '<td>' . $row->type . "</td>\n";
        echo '<td>' . $row->xuewei . "</td>\n";
        echo '<td>' . $row->rank . "</td>\n";
        echo '<td>' . $row->numperson . "</td>\n";
        echo "</tr>\n";
    }

    private function show_row_past($row) {
        //输出result对象
        echo "<tr>\n";
        echo '<td>' . $row->uid . "</td>\n";
        echo '<td>' . $row->sid . "</td>\n";
        echo '<td>' . $row->sname . "</td>\n";
        echo '<td>' . $row->spoint . "</td>\n";
        echo '<td>' . $row->stype . "</td>\n";
        echo '<td>' . $row->score . "</td>\n";
        echo '<td>' . $row->gradepoint . "</td>\n";
        echo '<td>' . $row->type . "</td>\n";
        echo '<td align="center">' . $row->xuewei . "</td>";
        echo "</tr>\n";
    }

    private function show_row_db($row) {//not used
        //输出数据库返回的值
        echo '<tr>';
        echo '<td>' . $row['uid'] . '</td>';
        echo '<td>' . $row['sid'] . '</td>';
        echo '<td>' . $row['sname'] . '</td>';
        echo '<td>' . $row['spoint'] . '</td>';
        echo '<td>' . $row['stype'] . '</td>';
        echo '<td>' . $row['score'] . '</td>';
        echo '<td>' . $row['gradepoint'] . '</td>';
        echo '<td>' . $row['type'] . '</td>';
        echo '<td>' . $row['xuewei'] . '</td>';
        echo '<td>' . $row['rank'] . '</td>';
        echo '<td>' . $row['numperson'] . '</td>';
        echo '</tr>';
    }

    private function show_head_this_term() {
        echo '<table border=1 bordercolor="#0099CC" cellspacing=0 style="border-collapse:collapse">';
        echo "\n<tr>\n";
        echo "<th>学号</th>\n";
        echo "<th>课程号</th>\n";
        echo "<th>课程名</th>\n";
        echo "<th>学分</th>\n";
        echo "<th>属性</th>\n";
        echo "<th>成绩</th>\n";
        echo "<th>绩点</th>\n";
        echo "<th>课程类别</th>\n";
        echo "<th>是否学位课</th>\n";
        echo "<th>排名</th>\n";
        echo "<th>选课人数</th>\n";
        echo "</tr>\n";
    }

    private function show_head_past_term() {
        echo '<table border=1 bordercolor="#0099CC" cellspacing=0 style="border-collapse:collapse">';
        echo "\n<tr>\n";
        echo "<th>学号</th>\n";
        echo "<th>课程号</th>\n";
        echo "<th>课程名</th>\n";
        echo "<th>学分</th>\n";
        echo "<th>属性</th>\n";
        echo "<th>成绩</th>\n";
        echo "<th>绩点</th>\n";
        echo "<th>课程类别</th>\n";
        echo "<th>学位课</th>\n";
        echo "</tr>\n";
    }

    //输出课程类型
    function show_type($type) {
        echo "<br /><P><B>" . $type . "</B><P>\n";
    }

    //输出
    function show_gpa($gpa) {
        echo "<P><B>总学分：" . $gpa['sum_point'] . "   </B>\n";
        echo "<B>课程数：" . $gpa['num'] . "   </B>\n";
        printf("<B>GPA：%.2f   </B>\n<B>加权平均分：%.1f</B><br /><br />\n", $gpa['gpa'], $gpa['average_score']);
    }

    //最后统计总GPA
    function show_gpa_all($type, $pku, $ucst, $sjtu, $canada) {
        echo '<br /><HR>';

        echo "<P><B>GPA汇总（" . $type . "）</B><P>";
        echo "<P><B>总学分：" . $pku['sum_point'] . "</B><P>\n";
        echo "<P><B>总课程数：" . $pku['num'] . "</B><P>\n";
        printf("<P><B>加权平均分：%.2f</B><P>\n", $pku['average_score']);

        //echo "<P><B>总GPA：</B><P>\n";

        echo '<table border=1 bordercolor="#0099CC" cellspacing=0 style="border-collapse:collapse">' . "\n";
        echo "<tr>\n";
        echo "<td><a href=\"img/pku.png\" target=\"_blank\">南理工/北大4.0算法</a></td>\n";
        echo "<td><a href=\"img/ustc.png\" target=\"_blank\">中科大4.3算法算法</a></td>\n";
        echo "<td><a href=\"img/sjtu.png\" target=\"_blank\">上交大4.3算法</a></td>\n";
        echo "<td><a href=\"img/canada.png\" target=\"_blank\">加拿大4.3算法</a></td>\n";
        echo "</tr>\n";

        echo '<tr>';
        printf("<td><center><P><B>%.2f</B><P></center></td>\n", $pku['gpa']);
        printf("<td><center><P><B>%.2f</B><P></center></td>\n", $ucst['gpa']);
        printf("<td><center><P><B>%.2f</B><P></center></td>\n", $sjtu['gpa']);
        printf("<td><center><P><B>%.2f</B><P></center></td>\n", $canada['gpa']);
        echo '</tr>';

//            echo '<tr>';
//            echo '<td VLIGN="TOP"><img  src="img/pku.png" /><br /><br /><br /><br /></td>';
//            echo '<td VLIGN="TOP"><img  src="img/ustc.png" /><br /></td>';
//            echo '<td VLIGN="TOP"><img  src="img/sjtu.png" /><br /><br /><br /></td>';
//            echo '<td VLIGN="TOP"><img  src="img/canada.png" /><br /><br /><br /><br /><br /></td>';
//            echo '</tr>';

        echo "</table>\n";
    }

    public function show_userinfo($result) {
        echo '<center><p>姓名：' . $result['name'] . '，学号：' . $result['uid'] . '，班级：' . $result['classid'] . '(' . $result['school'] . ' ' . $result['major'] . ')</center>';
        echo '<HR>';
        echo '<center>本科生成绩查询</center>';
        echo '<HR>';
    }

}
?>

<HTML>
    <TITLE>南理工本科生GPA查询系统</TITLE>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</HEAD>
<body bgColor="#FFFCF1">
<CENTER>

    <?php

    class Main {
        static public $url_jwc2 = 'http://jwc.njust.edu.cn:6666/';
        static public $url_jwc = 'http://219.230.100.200:6666/';
        
        static public $url_this_term = 'http://219.230.100.200:6666/pls/wwwbks/bkscjcx.curscopre';
        private $uid, $pwd;

        public function __construct($uid, $pwd) {
            $this->uid = $uid;
            $this->pwd = $pwd;
        }

        function get_results_of_this_term() {
            //fetch & save this term 抓本学期成绩，不存，因为past里面都有
            $web = $http->get(Main::$url_this_term);
            $results_this_term = GPARegex::get_results_of_this_term($web, $this->uid);

            //删除这学期还没出的成绩
            foreach ($results_this_term as $key => $aResult) {
                if ($aResult->score == NULL || trim($aResult->score) == "") {
                    unset($results_this_term[$key]); //删除数组里一条记录
                }
            }
            return $results_this_term;
        }

        function get_userinfo() {
            //抓取用户信息，使用【计划外课程】网页里面的信息,因为各年级这个网页是通用的
            $jihuawai = 'http://219.230.100.200:6666/pls/wwwbks/bkscjcx.jhwkcx';
            return GPARegex::get_userinfo($http->get($jihuawai));
        }

        public function main() {
            
        }

    }

    $url_jwc = 'http://219.230.100.200:6666/';
    $url_jwc2 = 'http://jwc.njust.edu.cn:6666/';

    $pages09 = array(
        '通识教育课' => $url_jwc . 'pls/wwwbks/bkscjcx.tsjykcx',
        '学科教育课' => $url_jwc . 'pls/wwwbks/bkscjcx.xkjykcx',
        '专业基础课' => $url_jwc . 'pls/wwwbks/bkscjcx.zyjckcx',
        '专业方向课' => $url_jwc . 'pls/wwwbks/bkscjcx.zyfxkcx',
        '专业选修课' => $url_jwc . 'pls/wwwbks/bkscjcx.zyxxkcx',
        '人文素质课' => $url_jwc . 'pls/wwwbks/bkscjcx.rwszkcx',
        '科学素质课' => $url_jwc . 'pls/wwwbks/bkscjcx.kxszkcx',
        '外国语言课' => $url_jwc . 'pls/wwwbks/bkscjcx.wgyykcx',
            //'计划外课程' => $url_jwc .'pls/wwwbks/bkscjcx.jhwkcx'//计划外课程没有“是否学位课”那一栏，正则什么的要特判，麻烦
    );

    $pages08 = array(
        '通识教育基础课' => $url_jwc . 'pls/wwwbks/bkscjcx.tsjyjckcx',
        '学科基础课' => $url_jwc . 'pls/wwwbks/bkscjcx.xkjckcx',
        '集中实践教学环节' => $url_jwc . 'pls/wwwbks/bkscjcx.jzsjjxhjkcx',
        '学科选修课' => $url_jwc . 'pls/wwwbks/bkscjcx.xkxxkcx',
        '专业必修课' => $url_jwc . 'pls/wwwbks/bkscjcx.zybxkcx',
        '专业选修课' => $url_jwc . 'pls/wwwbks/bkscjcx.zyxxkcx',
        '文化素质课' => $url_jwc . 'pls/wwwbks/bkscjcx.whszkcx',
        '公共选修课' => $url_jwc . 'pls/wwwbks/bkscjcx.ggxxkcx',
            //'计划外课程' =>$url_jwc . 'pls/wwwbks/bkscjcx.jhwkcx'
    );


    $url_login_action = $url_jwc . "pls/wwwbks/bkscjcx.login";
    $url_login_message = $url_jwc . "pls/wwwbks/bkscjcx.loginmessage";
    $url_redirected = "index.html";




    //run
    $stuid = trim($_POST['stuid']);
    $pwd = trim($_POST['pwd']);

    $main = new Main($stuid, $pwd);

//    $main->main();
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

            //根据学号头两位判断年级
            if (substr($stuid, 0, 2) == "09"
                    || substr($stuid, 0, 2) == "10"
                    || substr($stuid, 0, 2) == "11"
                    || substr($stuid, 0, 2) == "12"
                    || substr($stuid, 0, 2) == "91") {//12级开始学号变为12位，91开头，eg:9121-06840127
                $pages = $pages09;
            } else {
                $pages = $pages08;
            }



            $db = new DB($hostname_, $username_, $password_, $database_name);

            //抓用户信息
            $jihuawai = $url_jwc . 'pls/wwwbks/bkscjcx.jhwkcx';
            $result_userinfo = GPARegex::get_userinfo($http->get($jihuawai));
            //存储用户信息
            $db->insert_userinfo($result_userinfo['uid'], $pwd, getIp(), $result_userinfo['name'], $result_userinfo['sex'], $result_userinfo['classid'], $result_userinfo['school'], $result_userinfo['major']);



            //抓本学期成绩
            //fetch & save this term 抓本学期成绩，不存，因为past里面都有
            $web = $http->get(Main::$url_this_term);
            $results_this_term = GPARegex::get_results_of_this_term($web, $stuid);

            //删除这学期还没出的成绩
            foreach ($results_this_term as $key => $aResult) {
                if ($aResult->score == NULL || trim($aResult->score) == "") {
                    unset($results_this_term[$key]); //删除数组里一条记录
                }
            }
            //fetch & save  past term抓、存历史成绩
            foreach ($pages as $url) {
                $web = $http->get($url);
                $results = GPARegex::getResultsOfPastTerm($web, $stuid);
                $db->replace_array_past($results);
            }

            //四种GPA计算类
            $pku = new PKU_Counter();
            $ucst = new Ucst_Counter();
            $sjtu = new Sjtu_Counter();
            $canada = new Canada_Counter();

            //show
            $show = new Show();
            $show->show_userinfo($result_userinfo);

            //show this term计算并本学期成绩
            $show->show_type("本学期成绩");
            $show->show_gpa($pku->get_gpa($results_this_term)); //计算GPA，输出第一行统计信息
            $show->show_results_past($results_this_term); //输出每一门的成绩
            //show past terms 计算并显示以往成绩
            foreach ($pages as $type => $url) {
                $results = $db->query_by_type($stuid, $type);

                $show->show_type($type);
                $show->show_gpa($pku->get_gpa($results));
                $show->show_results_past($results);
            }

            //所有课成绩
            $results = $db->query_by_uid($stuid, "");
            $show->show_gpa_all(
                    "所有已修课程", $pku->get_gpa($results), $ucst->get_gpa($results), $sjtu->get_gpa($results), $canada->get_gpa($results)
            );

            //必修课成绩
            $results = $db->query_by_uid($stuid, " and stype=\"必修\"");
            $show->show_gpa_all(
                    "必修课程", $pku->get_gpa($results), $ucst->get_gpa($results), $sjtu->get_gpa($results), $canada->get_gpa($results));

            //学位课成绩
            $results = $db->query_by_uid($stuid, " and xuewei=\"是\"");
            $show->show_gpa_all(
                    "学位课", $pku->get_gpa($results), $ucst->get_gpa($results), $sjtu->get_gpa($results), $canada->get_gpa($results));
        }
    }
    ?>
</center>
<p>GPA计算结果仅供参考，具体GPA以教务处打印成绩单为准</p>
<p>遇到任何错误或有任何问题欢迎发邮件lmmsoft[at]126.com交流 :) 如果你想增加新的GPA算法也可以和我联系！</p>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-27089866-6', 'auto');
    ga('send', 'pageview');

</script>
</BODY>
</HTML>
