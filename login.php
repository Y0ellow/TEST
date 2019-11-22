<?php 
include_once 'public/config.php';
include_once 'public/linkmysql.php';
include_once 'public/tool.inc.php';
$link=connect();
$user_id=is_login($link);

if(isset($_POST['submit'])){
// 	$query="insert into user(name,pw,register_time,photo,last_time) values('{$_POST['name']}',md5('{$_POST['pw']}'),now(),'',now())";
// 	run($link,$query);
// 	var_dump(mysqli_affected_rows($link)==1);
	
	include 'public/check_login.inc.php';
	escape($link,$_POST);
	$query="select * from user where name='{$_POST['name']}' and pw=md5('{$_POST['pw']}')";
	$result=run($link, $query);
// 	var_dump(mysqli_num_rows($result));
	if(mysqli_num_rows($result)==1){
		setcookie('kk[name]',$_POST['name'],time()+$_POST['time']);
		setcookie('kk[pw]',sha1(md5($_POST['pw'])),time()+$_POST['time']);
		/*设置这个登录的会员对于的last_time这个字段为now()*/
		skip('index.php','ok','登录成功！');
	}else{
		skip('login.php', 'error', '用户名或密码填写错误！');
	}
}
$template['title']='欢迎登录';
$template['css']=array('style/public.css','style/register.css','style/landstyle.css');
?>
<?php include 'public/header.inc.php'?>
<div align="center" style="font-size: 200%">校园信息发布系统</div>
<div id="login_frame" >
	<form method="post" >
		<p><label>用户名：<input type="text" name="name" placeholder="请输入学号/教工号/管理号" class="text_field" /></label></p>
			<p><label>密码：<input type="password" name="pw" placeholder="请输入6位登陆密码"
				class="text_field" /></label></p>

		<div style="clear: both;"></div>
		<input class="btn" type="submit" name="submit" value="登录" />
	</form>
</div>
<?php include 'public/footer.php'?>