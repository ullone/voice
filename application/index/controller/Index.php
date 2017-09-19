<?php
namespace app\index\controller;

use \think\View;

class Index {
    public function index() {
        $this->checkToken();
        // $view = new \think\View();
        // return $view->fetch();
    }

    private function checkToken() {
        $token = '0f19212c2592c6a2';
        echo sha1($token);
        exit();
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $rand      = $_GET['rand'];
        $token     = 'db9028a54856d895';
        $tmpArr = array($token, $timestamp, $rand);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if($tmpStr == $signature) {
          exit('true');
          echo sha1($token);
          exit;
        } exit('false');
    }
}
