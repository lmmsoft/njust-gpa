<?php

require_once 'Entity.php';

//封装了系统方法
class Regex {
    public $pattern;

    public function __construct($pattern) {
        $this->pattern = $pattern;
    }

    public function __toString() {
        return $this->pattern;
    }

    function isMatch($text) {
        return preg_match($this->pattern, $text);
    }

    function getMatches($text) {
        preg_match_all($this->pattern, $text, $matches);
        return $matches;
    }

//    function getMatch($str){
//        preg_match($this->pattern, $str,$match);
//        return $match;;
//    }

    function replace($replaceStr, $text) {
        return preg_replace($this->pattern, $replaceStr, $text);
    }

}

//定义正则表达式
class GPARegex {
    static private $pattern_tr = "";
    //这是原版，没转义，没忽略大小写 <TD ALIGN=\"center\">(\d{8})<\/tD>\s<T[^>]+>(.*?)<\/tD>\s<TD ALIGN=\"center\">([\.\d]+?)<\/tD>\s<TD ALIGN=\"center\">(.*?)<\/tD>\s<TD ALIGN=\"center\">(.*?)<\/tD>\s<TD ALIGN=\"center\">([.\d]+?)<\/tD>\s<TD ALIGN=\"center\">(.*?)<\/tD>\s<TD ALIGN=\"center\">(.*?)<\/tD>\s
    static private $pattern_past_term = "/<TD ALIGN=\"center\">(\\d{8})<\/tD>\\s<T[^>]+>(.*?)<\/tD>\\s<TD ALIGN=\"center\">([\\.\\d]+?)<\/tD>\\s<TD ALIGN=\"center\">(.*?)<\/tD>\\s<TD ALIGN=\"center\">(.*?)<\/tD>\\s<TD ALIGN=\"center\">([.\\d]+?)<\/tD>\\s<TD ALIGN=\"center\">(.*?)<\/tD>\\s<TD ALIGN=\"center\">(.*?)<\/tD>\\s/i";
    static private $pattern_this_term = "/<T[^>]+>(\\d{8})<\/TD>\\s<T[^>]+>(.*?)<\/TD>\\s<T[^>]+>(\\d+?)<\/TD>\\s<T[^>]+>([\\.\\d]+?)<\/TD>\\s<T[^>]+>(.*?)<\/TD>\\s<T[^>]+>(.*?)<\/TD>\\s<T[^>]+>(.*?)<\/TD>\\s<T[^>]+>(.*?)<\/TD>\\s<T[^>]+>(.*?)<\/TD>\\s/i";

    //<T[^>]+>(\\d{8})</TD>\\s<T[^>]+>(.*?)</TD>\\s<T[^>]+>(\\d+?)</TD>\\s<T[^>]+>([\\.\\d]+?)</TD>\\s<T[^>]+>(.*?)</TD>\\s<T[^>]+>(.*?)</TD>\\s<T[^>]+>(.*?)</TD>\\s<T[^>]+>(.*?)</TD>\\s<T[^>]+>(.*?)</TD>\\s/i
    //在计划外抓取个人信息
    static function get_userinfo($web) {
        //学号为12级为12位，其他10位，班号12级10位，其他8位
        $pattern_user = "/姓名：(.*?)\\((.*?)\\)，学号：(\\d{10,})，班级：(\\d{8,})\\((.*?)\\s(\\S*?)\\)/";

        $reg = new Regex($pattern_user);
//        echo Result::convert_gbk_to_utf8($web);
        $matches = $reg->getMatches(Result::convert_gbk_to_utf8($web));

//        var_dump($matches);
//        echo $pattern_user;
//        echo count($matches[0]);

        return array(
            'name' => $matches[1][0],
            'sex' => $matches[2][0],
            'uid' => $matches[3][0],
            'classid' => $matches[4][0],
            'school' => $matches[5][0],
            'major' => $matches[6][0]
        );
    }

    //在课表页抓取个人信息
    static function get_userinfo_in_schedule($web) {
        //学号为12级为12位，其他10位，班号12级10位，其他8位
        $pattern_user = "/姓名:(.*?)\\s学号:(\\d{10,})\\s\\s班级:(\\d{8,})\\((.*?)\\s(\\S*?)\\)/";

        $reg = new Regex($pattern_user);
        $matches = $reg->getMatches(($web));

//        var_dump($matches);
//        echo $pattern_user;
//        echo count($matches[0]);

        return array(
            'name' => $matches[1][0],
            'uid' => $matches[2][0],
            'classid' => $matches[3][0],
            'school' => $matches[4][0],
            'major' => $matches[5][0],
            'sex' => "未知"
        );
    }

    static function getResultsOfPastTerm($web, $stuid) {

        $reg = new Regex(GPARegex::$pattern_past_term);
        $matches = $reg->getMatches($web);

        $count = count($matches[0]); //下标是0~cnt-1

        $ary = array();

        for ($i = 0; $i < $count; ++$i) {
            $result = new Result();
//            $_POST['stdid'];
            $result->uid = $stuid;
            $result->sid = $matches[1][$i];
            $result->sname = Result::convert_gbk_to_utf8($matches[2][$i]);
            $result->spoint = $matches[3][$i];
            $result->stype = Result::convert_gbk_to_utf8($matches[4][$i]);
            $result->score = Result::convert_gbk_to_utf8($matches[5][$i]);
            $result->gradepoint = $matches[6][$i];
            $result->type = Result::convert_gbk_to_utf8($matches[7][$i]);
            $result->xuewei = Result::convert_gbk_to_utf8($matches[8][$i]);

            $ary[] = $result;
//            $result->show();
        }
        return $ary;
    }

    static function get_results_of_this_term($web, $stuid) {

        $reg = new Regex(GPARegex::$pattern_this_term);
        $matches = $reg->getMatches($web);

        $count = count($matches[0]); //下标是0~cnt-1

        $ary = array();

        for ($i = 0; $i < $count; ++$i) {
            $result = new Result();
            $result->uid = $stuid;
            $result->sid = $matches[1][$i]; //课程号 8位
            $result->sname = Result::convert_gbk_to_utf8($matches[2][$i]); //课程名
            $result->spoint = $matches[4][$i]; //学分 必然存在
            $result->stype = Result::convert_gbk_to_utf8($matches[5][$i]); //课程属性
            $result->score = Result::convert_gbk_to_utf8($matches[6][$i]); //成绩
            $result->gradepoint = $matches[7][$i]; //课程绩点
            $result->type = Result::convert_gbk_to_utf8($matches[8][$i]); //课程类别
            $result->xuewei = Result::convert_gbk_to_utf8($matches[8][$i]); //是否学位课

            $ary[] = $result;
//            $result->show();
        }
        return $ary;
    }

    //获取课表里有用部分
    static function get_schedule($web) {
        $pattern_schedule = "/<BODY[\\s\\S]*?<\/BODY>/";

        $reg = new Regex($pattern_schedule);
        //echo "test:".Result::convert_gbk_to_utf8($web);
        $matches = $reg->getMatches(Result::convert_gbk_to_utf8($web));

//        var_dump($matches);
//        echo $pattern_user;
//        echo count($matches[0]);

        return $matches[0][0];
    }

}

//用文件测试
//$br = "<br />";
////test:
//$url_xueke = "http://njust.aliapp.com/web/xueke.htm";
//$page = file_get_contents($url_xueke);
//echo $page;
//echo $pattern_past_term;
?>
