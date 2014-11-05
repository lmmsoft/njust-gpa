<!DOCTYPE html>
<html>
    <head>
        <title>南理工 评教助手</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <p>评教这种事情，既浪费时间也看不见什么实际的意义，不是么？</p>
        <p></p>
        <p>为节约大家时间，简单写了一个评教助手插件</p>
        <p></p>
        <ul>
            <li>1.打开谷歌Chrome浏览器</li>
            <li>2.安装插件： <a href="https://chrome.google.com/webstore/detail/%E5%8D%97%E7%90%86%E5%B7%A5%E8%AF%84%E6%95%99%E5%8A%A9%E6%89%8B/mpgpckncmbhlldfciofgecaaaeeefjbe" target="_blank">一键安装</a>    </li>
            <li>3.点击&ldquo;评教网站&rdquo;，进入评教网站，登陆时注意选择右边的&ldquo;本科生&rdquo;</li>
            <li>4.点击页面上方的【评教我的老师】，然后在页面左边选择老师，开始评教</li>
        </ul>
        <p></p>
        <p>怎么样，很方便吧？</p>
        <p>(*^__^*) 嘻嘻&hellip;&hellip;</p>
        <p>心动不如行动！</p>

        <?php
        require_once '../DB.php';
        require_once '../config.php';
        $db = new DB($hostname_, $username_, $password_, $database_name);
        $num = $db->plus(1, 3);
        echo '<hr />你是第' . $num . "个访问本页面的同学↖(^ω^)↗";
        ?>
    </ul>

</body>
</html>
