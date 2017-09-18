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
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $rand      = $_GET['rand'];
        $token     = '3bfe75bfb2d4752e';
        $tmpArr = array($token, $timestamp, $rand);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if($tmpStr == $signature) {
          echo sha1($token);
          exit;
        }
    }
}
