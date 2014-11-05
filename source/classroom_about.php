<!DOCTYPE html>
<html>
    <head>
        <title>南理工自习教室推荐 关于</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>

        版本历史
        <ul>
            <li>2012-05-07 下午 ltj 收集了四工AB座教室数据
            <li>2012-05-08 凌晨 lmmsoft 和 ltj 通过结对编程的方式，写出了第一版程序
            <li>2012-05-08 中午 lmmsoft通过人人网广播了一下，当天pv达到14000
            <li>2012-05-09 晚上 ckj 收集了四工C座数据，并更新了AB座的数据，大大增加了自习室的数量
        </ul>
        <p>遇到任何错误或有任何问题欢迎发邮件lmmsoft@126.com交流 :) </p>
        <p>All rights reserved by lmmsoft && ltj && ckj @ 2012</p>
        <?php
        require_once 'DB.php';
        require_once 'config.php';

        $db = new DB($hostname_, $username_, $password_, $database_name);
        $num = $db->plus(1, 2);
        echo '<hr />你是第' . $num . "个访问本页面的同学↖(^ω^)↗";
        ?>
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
