<?php

//include 'config.php';
//$conn = mysql_connect($hostname_, $username_, $password_);
//$conn = mysqli_connect($hostname_, $username_, $password_);

class DB {
    public $conn;

    public function __construct($hostname_, $username_, $password_, $database_name) {
        if ($this->connect($hostname_, $username_, $password_)) {
            mysql_query("SET NAMES 'utf8'", $this->conn);
            mysql_select_db($database_name, $this->conn);
        } else {
            //数据库都不能连，错误报告都搞不定
            die('Could not connect: ' . mysql_error());
        }
    }

    private function connect($hostname_, $username_, $password_) {
        $this->conn = mysql_connect($hostname_, $username_, $password_);
        if (!$this->conn) {
            //die('Could not connect: ' . mysql_error());
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function __destruct() {
        if ($this->conn)
            mysql_close($this->conn);
    }

    private function replace_array($results) {//to be edit
        foreach ($results as $result) {
            $this->replace($result);
        }
    }

    public function replace_array_past($results) {
        foreach ($results as $result) {
            $this->replace_past($result);
        }
    }

    private function replace($result) {//to be edit
        $sql = "replace into result(uid,sid,sname, spoint, stype, score, gradepoint, `type`, xuewei, rank, numperson) 
            values('%s'，'%s'，'%s'，'%s'，'%s'，'%s'，'%s'，'%s'，'%s'，'%s'，'%s')";
        $query = sprintf($sql, mysql_real_escape_string($result->uid), mysql_real_escape_string($result->sid), mysql_real_escape_string($result->spoint), mysql_real_escape_string($result->sname), mysql_real_escape_string($result->stype), mysql_real_escape_string($result->score), mysql_real_escape_string($result->gradepoint), mysql_real_escape_string($result->type), mysql_real_escape_string($result->xuewei), mysql_real_escape_string($result->rank), mysql_real_escape_string($result->numperson)
        );
        echo $query;
        if (mysql_query($query))
            return TRUE;
        else {
            $this->error("result更新错误", "uid=" . $result->uid . "sid=" . $result->sid);
            return FALSE;
        }
    }

    private function replace_past($result) {
        $sql = "replace into result(uid,sid,sname, spoint, stype, score, gradepoint,`type`,`xuewei`)
            values('%s','%s','%s','%s','%s','%s','%s','%s','%s')";
        $query = sprintf($sql, mysql_real_escape_string($result->uid), mysql_real_escape_string($result->sid), mysql_real_escape_string($result->sname), mysql_real_escape_string($result->spoint), mysql_real_escape_string($result->stype), mysql_real_escape_string($result->score), mysql_real_escape_string($result->gradepoint), mysql_real_escape_string($result->type), mysql_real_escape_string($result->xuewei)
        );
        if (mysql_query($query))
            return TRUE;
        else {
            $this->error("result更新错误", "uid=" . $result->uid . "sid=" . $result->sid);
            return FALSE;
        }
    }

    private function query_by_sid_type($uid, $sid, $type) {
        $sql = "SELECT uid, sid, sname, spoint, stype, score, gradepoint, `type`, xuewei, rank, numperson 
            FROM `result` 
            where `uid`='%s' AND `sid`='%s' AND `type`='%s' ";

        $query = sprintf($sql, mysql_real_escape_string($uid), mysql_real_escape_string($sid), mysql_real_escape_string($type));

        //验证是否成功查询
        if ($query_result = mysql_query($query)) {

            $ary = array(); //保存数组

            while ($row = mysql_fetch_array($query_result)) {
                $result = new Result();
                $result->uid = $row['uid'];
                $result->sid = $row['sid'];
                $result->sname = $row['sname'];
                $result->spoint = $row['spoint'];
                $result->stype = $row['stype'];
                $result->score = $row['score'];
                $result->gradepoint = $row['gradepoint'];
                $result->type = $row['type'];
                $result->xuewei = $row['xuewei'];
                $result->rank = $row['rank'];
                $result->numperson = $row['numperson'];
                $ary[] = $result;
            }
            mysql_free_result($query_result);
            return $ary;
        } else {
            $this->error("result sid查询错误", "uid=" . $uid . "sid=" . $sid);
            $message = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
            return FALSE;
        }
    }

    public function query_by_type($uid, $type) {
        $sql = "SELECT uid, sid, sname, spoint, stype, score, gradepoint, `type`, xuewei, rank, numperson 
            FROM `result` 
            where `uid`='%s' AND `type`='%s' ";

        $query = sprintf($sql, mysql_real_escape_string($uid), mysql_real_escape_string($type));

        //验证是否成功查询
        if ($query_result = mysql_query($query)) {

            $ary = array(); //保存数组

            while ($row = mysql_fetch_array($query_result)) {
                $result = new Result();
                $result->uid = $row['uid'];
                $result->sid = $row['sid'];
                $result->sname = $row['sname'];
                $result->spoint = $row['spoint'];
                $result->stype = $row['stype'];
                $result->score = $row['score'];
                $result->gradepoint = $row['gradepoint'];
                $result->type = $row['type'];
                $result->xuewei = $row['xuewei'];
                $result->rank = $row['rank'];
                $result->numperson = $row['numperson'];
                $ary[] = $result;
            }
            mysql_free_result($query_result);
            return $ary;
        } else {
            $this->error("result type查询错误", "uid=" . $uid . "type=" . $type);
            $message = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
            return FALSE;
        }
    }

    public function query_by_uid($uid, $more) {
        $sql = "SELECT uid, sid, sname, spoint, stype, score, gradepoint, `type`, xuewei, rank, numperson 
            FROM `result` 
            where `uid`='%s' ";

        $query = sprintf($sql, mysql_real_escape_string($uid));
        if ($more != "") {
            $query = $query . $more;
        }


        //验证是否成功查询
        if ($query_result = mysql_query($query)) {

            $ary = array(); //保存数组

            while ($row = mysql_fetch_array($query_result)) {
                $result = new Result();
                $result->uid = $row['uid'];
                $result->sid = $row['sid'];
                $result->sname = $row['sname'];
                $result->spoint = $row['spoint'];
                $result->stype = $row['stype'];
                $result->score = $row['score'];
                $result->gradepoint = $row['gradepoint'];
                $result->type = $row['type'];
                $result->xuewei = $row['xuewei'];
                $result->rank = $row['rank'];
                $result->numperson = $row['numperson'];
                $ary[] = $result;
            }
            mysql_free_result($query_result);
            return $ary;
        } else {
            $this->error("result type查询错误", "uid=" . $uid . "type=" . $type);
            $message = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
            return FALSE;
        }
    }

    public function error($type, $content) {
        $sql = "insert into error(`type`,`context`) values('%s','%s')";
        $query = sprintf($sql, mysql_real_escape_string($type), mysql_real_escape_string($content));
        mysql_query($query);
    }

    //插入gpa里的用户信息
    public function insert_userinfo($stuid, $ip, $name, $sex, $classid, $school, $major) {
        $sql = "insert into user(`uid`,name,sex,classid,school,major,`ip`) values('%s','%s','%s','%s','%s','%s','%s')";
        $query = sprintf($sql, mysql_real_escape_string($stuid), mysql_real_escape_string($name), mysql_real_escape_string($sex), mysql_real_escape_string($classid), mysql_real_escape_string($school), mysql_real_escape_string($major), mysql_real_escape_string($ip)
        );
        mysql_query($query);
    }
    //插入打印课表里的用户信息
    public function insert_userinfo_print($stuid, $ip, $name, $sex, $classid, $school, $major) {
        $sql = "insert into user_print(`uid`,name,sex,classid,school,major,`ip`) values('%s','%s','%s','%s','%s','%s','%s')";
        $query = sprintf($sql, mysql_real_escape_string($stuid), mysql_real_escape_string($name), mysql_real_escape_string($sex), mysql_real_escape_string($classid), mysql_real_escape_string($school), mysql_real_escape_string($major), mysql_real_escape_string($ip)
        );
        mysql_query($query);
    }

    public function insert_user_agent($browser, $os, $datetime, $ip, $HTTP_USER_AGENT, $type, $from) {
        $sql = "insert into user_agent(`browser`,os,`datetime`,`ip`,`HTTP_USER_AGENT`,`type`,`from`) values('%s','%s','%s','%s','%s','%s','%s')";
        $query = sprintf($sql, mysql_real_escape_string($browser), mysql_real_escape_string($os), mysql_real_escape_string($datetime), mysql_real_escape_string($ip), mysql_real_escape_string($HTTP_USER_AGENT), mysql_real_escape_string($type), mysql_real_escape_string($from)
        );
        mysql_query($query);
    }

    public function plus($num, $id) {
        $sql = "replace into info(id,num,beizhu)(select id,num+" . $num . ",beizhu from info where id=" . $id . ")";
        mysql_query($sql);
        $sql = "select * from info where id =" . $id;
        if ($query_result = mysql_query($sql)) {
            while ($row = mysql_fetch_array($query_result)) {
                $ret = $row['num'];
            }
            mysql_free_result($query_result);
            return $ret;
        }
    }
}

?>
