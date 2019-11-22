<?php 
include_once 'public/config.php';
include_once 'public/linkmysql.php';
include_once 'public/tool.inc.php';
$link=connect();
$member_id=is_login($link);

setcookie('kk[name]','',time()-3600);
setcookie('kk[pw]','',time()-3600);
skip('index.php','ok','退出成功！');
?>