<?php
//服务器校验
$token = sha1("6a37c34cd75ea12c");
echo $token;
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $token.'\n');
$txt = "Steve Jobs\n";
fwrite($myfile, $txt);
fclose($myfile);
exit();
?>
