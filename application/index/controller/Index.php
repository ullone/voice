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
      $text      = 'text='.$text;
      $timestamp = time();
      //生成param参数
      $userid = '';
      for ($i = 0; $i < 10; $i++)
      {
        $userid .= chr(mt_rand(33, 126));
      }
      $param    = array('scene' => 'main', 'userid' => $userid);
      $param    = base64_encode(json_encode($param));
      $checkSum = 'daa3e49549c8481389ef01d2a4488f88'.$timestamp.$param.$text;
      $checkSum = md5($checkSum);
      $url      = 'http://api.xfyun.cn/v1/aiui/v1/text_semantic';
      $data     = array(
        'timestamp' => $timestamp,
        'checkSum'  => $checkSum,
        'param'     => $param,
        'text'      => $text
      );
      $this->doCurl($url, 'post', $data);
    }

    public function voiceToText() {
      $file      = isset($_POST['file'])?$_POST['file']:'test.wav';
      $handle    = fopen($file,"r");
      $content   = fread($handle,filesize($file));
      var_dump($content);die;
      $text      = 'data='.base64_encode($content);
      $timestamp = time();
      $param     = array('auf' => '8k', 'aue' => 'raw', 'scene' => 'main');
      $param     = base64_encode(json_encode($param));
      $checkSum  = md5('daa3e49549c8481389ef01d2a4488f88'.$timestamp.$param.$text);
      $url       = 'http://api.xfyun.cn/v1/aiui/v1/iat';
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
        "X-Appid:59c37565",
        "X-CurTime:".$data['timestamp'],
        "X-Param:".$data['param'],
        "X-CheckSum:".$data['checkSum'],
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
