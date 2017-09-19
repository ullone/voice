<?php
namespace app\index\controller;

use \think\View;

class Index {
    public function index() {
        // $this->checkToken();
        // $view = new \think\View();
        // return $view->fetch();
        // if($this->getIsPostRequest()) {
        //   $input=file_get_contents("php://input");
        //   file_put_contents("log.txt", date('H:i:s')." ".$input."\r\n",FILE_APPEND);
        // } else {
          $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
          $txt = "Bill Gates\n";
          fwrite($myfile, $txt);
          $txt = "Steve Jobs\n";
          fwrite($myfile, $txt);
          fclose($myfile);
        //回传后处理 token，token 在官网上有
          // echo sha1("3cb58146e71d1557");
          // file_put_contents("log.txt",date('H:i:s'),FILE_APPEND);
          // foreach ($_GET as $key=>$value)
          // {
          //   file_put_contents("log.txt", date('H:i:s')." "."_GET: Key: $key; Value: $value"."\r\n", FILE_APPEND);
          // }
          // exit;

    }
    public function getIsPostRequest()
    {
      Return isset($_SERVER['REQUEST_METHOD'])&& !strcasecmp($_SERVER['REQUEST_METHOD'],'POST');
    }
}
