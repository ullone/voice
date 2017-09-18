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
        $token = 'e3b1e0ffcdd5c2f5';
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
