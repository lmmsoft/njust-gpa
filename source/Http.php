<?php

class Http {
    public $ch, $cookie_jar;

    //这其实是也是个post方法，只是
    public function login($url, $post_field) {//"stuid=&pwd="
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1); //如果把这行注释掉的话，就会直接输出
        curl_setopt($this->ch, CURLOPT_AUTOREFERER, 0); //自动设置refer信息
        curl_setopt($this->ch, CURLOPT_HEADER, 0); //不要头部
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookie_jar); //cookie储存在临时文件里

        curl_setopt($this->ch, CURLOPT_TIMEOUT, 5); //设置超时时间为5秒，超过5秒还抓不回网页的话认为教务处垮了 ps:我大概要抓10个页面，要在15秒内完成

        curl_setopt($this->ch, CURLOPT_POST, 1); // 我们在POST数据哦！
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_field); // 把post的变量加上

        return curl_exec($this->ch);
    }

    public function get($url) {
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookie_jar);
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POST, 0);
        return curl_exec($this->ch);
    }

    /*
     * 抓取网页，带post信息
     */

    public function post($url, $post_field) {
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookie_jar);
        curl_setopt($this->ch, CURLOPT_URL, $url);

        curl_setopt($this->ch, CURLOPT_POST, 1); // 我们在POST数据哦！
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post_field); // 把post的变量加上

        return curl_exec($this->ch);
    }

    public function __construct() {
        $this->ch = curl_init();
        $this->cookie_jar = tempnam('.', 'cookie');
    }

    public function __destruct() {
        curl_close($this->ch);
        unlink($this->cookie_jar);
    }

}

?>
