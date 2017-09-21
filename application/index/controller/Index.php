<?php
namespace app\index\controller;

use \think\View;

class Index {
    public function index() {
        $view = new \think\View();
        return $view->fetch();
    }

    public function semanticComprehension() {
      $text   = empty($_POST['text'])?'今天星期几':$_POST['text'];
      $text   = base64_encode($text);
      $timestamp = time();
      $time = date("Y-m-d H:i:s",$timestamp);
      var_dump($timestamp);var_dump($time);die;
      //生成param参数
      $userid = '';
      for ($i = 0; $i < 10; $i++)
      {
        $userid .= chr(mt_rand(33, 126));
      }
      $param    = array('scene' => 'main');
      $param    = base64_encode(json_encode($param));
      $checkSum = md5('406ea0c36b4f49cea2b45360bb84271f'.$timestamp.$param.'text='.$text);
      // var_dump($text);die;
      $url      = 'http://api.xfyun.cn/v1/aiui/v1/text_semantic';
      $data     = array(
        'timestamp' => $timestamp,
        'checkSum'  => $checkSum,
        'param'     => $param,
        'text'      => $text
      );
      $this->doCurl($url, 'post', $data);
    }

    private function doCurl($url, $method = 'get', $data = null) {
      $header = [
        "X-Appid: 59bf7ad0",
        "X-CurTime: ".$data['timestamp'],
        "X-CheckSum: ".$data['checkSum'],
        "X-Param: ".$data['param'],
        "Content-Type: application/x-www-form-urlencoded; charset=utf-8"
      ];
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    	if($method == 'post') {
    		curl_setopt($ch, CURLOPT_POST, 1);
    		curl_setopt($ch, CURLOPT_POSTFIELDS, $data['text']);
    	}
    	$response = curl_exec($ch);
    	if(curl_errno($ch)){
    		print curl_error($ch);
    	}
    	curl_close($ch);
    	var_dump($response);die;
    }
}
