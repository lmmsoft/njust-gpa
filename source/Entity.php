<?php

//保存成绩的实体类
class Result {

    public $uid, $sid, $sname, $spoint, $stype, $score, $gradepoint, $type, $xuewei, $rank, $numperson;

    public static function convert_gbk_to_utf8($text) {
//        $text = iconv("gbk", "UTF-8//IGNORE", $text); // 编码转换
//        $text = mb_convert_encoding($text, "UTF-8", "gbk");
        return mb_convert_encoding($text, "UTF-8", "gbk");
    }

    public static function convert_utf8_to_gbk($text) {
//        $text = iconv("gbk", "UTF-8//IGNORE", $text); // 编码转换
//        $text = mb_convert_encoding($text, "UTF-8", "gbk");
        return mb_convert_encoding($text, "gbk", "UTF-8");
    }

    //for debug
    public function show() {
        $br = "<br />";

        echo $this->uid . $br;
        echo $this->sid . $br;
        echo $this->sname . $br;
        echo $this->spoint . $br;
        echo $this->stype . $br;
        echo $this->score . $br;
        echo $this->gradepoint . $br;
        echo $this->type . $br;
        echo $this->xuewei . $br;
        echo $this->rank . $br;
        echo $this->numperson . $br;
    }

}

abstract class GPACounter {

    public $list = array();

    public function __construct() {

    }

    public function get_gpa($results) {
        $sum_point = 0; //学分和
        $sum_gradepoint = 0; //积点和
        $sum_score = 0; //加权和

        foreach ($results as $row) {
            $sum_point+=$row->spoint;
            $score = $this->convert_to_int($row->score);

            $sum_gradepoint+=$row->spoint * $this->get_score($score);
            $sum_score+=$row->spoint * $score;
        }

        if ($sum_point == 0) {//防止除数为0
            $gpa = 0;
            $average_score = 0;
        } else {
            $gpa = $sum_gradepoint / $sum_point;
            $average_score = $sum_score / $sum_point;
        }

        return array(
            'sum_point' => $sum_point,
            'sum_gradepoint' => $sum_gradepoint,
            'sum_score'=>$sum_score,
            'gpa' => $gpa,
            'num' => count($results),//门数
            'average_score'=>$average_score
        );
    }

    abstract public function get_score($score);

    private static function convert_to_int($param) {
        if (is_string($param)) {
            if ($param == "优秀")
                return 90;
            if ($param == "免修")
                return 89;
            if ($param == "良好")
                return 80;
            if ($param == "中等")
                return 70;
            if ($param == "及格")
                return 60;
            if ($param == "不及格")
                return 0;
            return (int) $param;
        }
        return (int) $param;
    }

}

class PKU_Counter extends GPACounter {

    public function __construct() {
        parent::__construct();
    }

    public function get_score($score) {
        if ($score >= 90 && $score <= 100)
            return 4.0;
        elseif ($score >= 85 && $score <= 89)
            return 3.7;
        elseif ($score >= 82 && $score <= 84)
            return 3.3;
        elseif ($score >= 78 && $score <= 81)
            return 3.0;
        elseif ($score >= 75 && $score <= 77)
            return 2.7;
        elseif ($score >= 72 && $score <= 74)
            return 2.3;
        elseif ($score >= 68 && $score <= 71)
            return 2.0;
        elseif ($score >= 64 && $score <= 67)
            return 1.5;
        elseif ($score >= 60 && $score <= 63)
            return 1.0;
        elseif ($score >= 0 && $score <= 59)
            return 0.0;
        else {
            echo "成绩convert有误,请报告给管理员" . $param . "<br />";
            return 0.0;
        }
    }

}

class Canada_Counter extends GPACounter {

    public function __construct() {
        parent::__construct();
    }

    public function get_score($score) {
        if ($score >= 90 && $score <= 100)
            return 4.3;
        elseif ($score >= 85 && $score <= 89)
            return 4.0;
        elseif ($score >= 80 && $score <= 84)
            return 3.7;
        elseif ($score >= 75 && $score <= 79)
            return 3.3;
        elseif ($score >= 70 && $score <= 74)
            return 3.0;
        elseif ($score >= 65 && $score <= 69)
            return 2.7;
        elseif ($score >= 60 && $score <= 74)
            return 2.3;
        elseif ($score >= 0 && $score <= 59)
            return 0.0;
        else {
            echo "成绩convert有误,请报告给管理员" . $param . "<br />";
            return 0.0;
        }
    }

}

class Ucst_Counter extends GPACounter {

    public function __construct() {
        parent::__construct();
    }

    public function get_score($score) {
        if ($score >= 95 && $score <= 100)
            return 4.3;
        elseif ($score >= 90 && $score <= 94)
            return 4.0;
        elseif ($score >= 85 && $score <= 89)
            return 3.7;
        elseif ($score >= 82 && $score <= 84)
            return 3.3;
        elseif ($score >= 78 && $score <= 81)
            return 3.0;
        elseif ($score >= 75 && $score <= 77)
            return 2.7;
        elseif ($score >= 72 && $score <= 74)
            return 2.3;
        elseif ($score >= 68 && $score <= 71)
            return 2.0;
        elseif ($score >= 65 && $score <= 67)
            return 1.7;
        elseif ($score >= 64 && $score <= 64)
            return 1.5;
        elseif ($score >= 61 && $score <= 63)
            return 1.3;
        elseif ($score >= 60 && $score <= 60)
            return 1.0;
        elseif ($score >= 0 && $score <= 59)
            return 0.0;
        else {
            echo "成绩convert有误,请报告给管理员" . $param . "<br />";
            return 0.0;
        }
    }

}

class Sjtu_Counter extends GPACounter {

    public function __construct() {
        parent::__construct();
    }

    public function get_score($score) {
        if ($score >= 95 && $score <= 100)
            return 4.3;
        elseif ($score >= 90 && $score <= 94)
            return 4.0;
        elseif ($score >= 85 && $score <= 89)
            return 3.7;
        elseif ($score >= 80 && $score <= 84)
            return 3.3;
        elseif ($score >= 75 && $score <= 79)
            return 3.0;
        elseif ($score >= 70 && $score <= 74)
            return 2.7;
        elseif ($score >= 67 && $score <= 69)
            return 2.3;
        elseif ($score >= 65 && $score <= 66)
            return 2.0;
        elseif ($score >= 62 && $score <= 64)
            return 1.7;
        elseif ($score >= 60 && $score <= 61)
            return 1.0;
        elseif ($score >= 0 && $score <= 59)
            return 0.0;
        else {
            echo "成绩convert有误,请报告给管理员" . $param . "<br />";
            return 0.0;
        }
    }

}

?>
